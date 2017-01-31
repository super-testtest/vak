/*
 * svg-editor.js
 *
 * Licensed under the MIT License
 *
 * Copyright(c) 2010 Alexis Deveria
 * Copyright(c) 2010 Pavol Rusnak
 * Copyright(c) 2010 Jeff Schiller
 * Copyright(c) 2010 Narendra Sisodiya
 *
 */

// Dependencies:
// 1) units.js
// 2) browser.js
// 3) svgcanvas.js

( this.svgEditorFunc = function() {

	document.addEventListener("touchstart", touchHandler, true);
	document.addEventListener("touchmove", touchHandler, true);
	document.addEventListener("touchend", touchHandler, true);
	document.addEventListener("touchcancel", touchHandler, true);

	if(!window.svgEditor) window.svgEditor = function($j) {
		var svgCanvas;
		var Editor = {};
		var is_ready = false;
		var defaultPrefs = {
			lang:'en',
			iconsize:'m',
			bkgd_color:'#FFF',
			bkgd_url:'',
			img_save:'embed'
			},
			curPrefs = {},

			// Note: Difference between Prefs and Config is that Prefs can be
			// changed in the UI and are stored in the browser, config can not

			curConfig = {
				canvasName: 'default',
				canvas_expansion: 3,
				dimensions: [640,480],
				
				initFill: {
					color: 'FF0000',  // solid red
					opacity: 1
				},
				initStroke: {
					width: 5,
					color: '000000',  // solid black
					opacity: 1
				},
				initOpacity: 1,
				imgPath: jspath+'images/',
				langPath: jspath+'locale/',
				extPath: jspath+'extensions/',
				jGraduatePath: jspath+'jgraduate/images/',
				//extensions: ['ext-markers.js','ext-connector.js', 'ext-shapes.js','ext-imagelib.js'],	//,'ext-helloworld.js'
				extensions: ['ext-markers.js', 'ext-shapes.js','ext-imagelib.js'],	//,'ext-helloworld.js'
				initTool: 'select',
				wireframe: false,
				colorPickerCSS: null,
				gridSnapping: false,
				gridColor: "#000",
				baseUnit: 'px',
				snappingStep: 10,
				showRulers: true
			},
			uiStrings = Editor.uiStrings = {
				common: {
					"ok":chgPrdOk,
					"cancel":chgPrdCnc,
					"key_up":"Up",
					"key_down":"Down",
					"key_backspace":"Backspace",
					"key_del":"Del"

				},
				// This is needed if the locale is English, since the locale strings are not read in that instance.
				layers: {
					"layer":"Layer"
				},
				notification: {
					"invalidAttrValGiven":"Invalid value given",
					"noContentToFitTo":"No content to fit to",
					"dupeLayerName":"There is already a layer named that!",
					"enterUniqueLayerName":"Please enter a unique layer name",
					"enterNewLayerName":"Please enter the new layer name",
					"layerHasThatName":"Layer already has that name",
					"QmoveElemsToLayer":"Move selected elements to layer \"%s\"?",
					"QwantToClear":"Do you want to clear the drawing?\nThis will also erase your undo history!",
					"QwantToOpen":"Do you want to open a new file?\nThis will also erase your undo history!",
					"QerrorsRevertToSource":"There were parsing errors in your SVG source.\nRevert back to original SVG source?",
					"QignoreSourceChanges":"Ignore changes made to SVG source?",
					"featNotSupported":"Feature not supported",
					"enterNewImgURL":"Enter the new image URL",
					"defsFailOnSave": "NOTE: Due to a bug in your browser, this image may appear wrong (missing gradients or elements). It will however appear correct once actually saved.",
					"loadingImage": "Loading image, please wait...",
					"saveFromBrowser": "Select \"Save As...\" in your browser to save this image as a %s file.",
					"noteTheseIssues": "Also note the following issues: ",
					"unsavedChanges": "There are unsaved changes.",
					"enterNewLinkURL": "Enter the new hyperlink URL",
					"errorLoadingSVG": "Error: Unable to load SVG data",
					"URLloadFail": "Unable to load from URL",
					"retrieving": 'Retrieving "%s" ...'
				}
			};

		var curPrefs = {}; //$j.extend({}, defaultPrefs);

		var customHandlers = {};

		Editor.curConfig = curConfig;

		Editor.tool_scale = 1;
		// Store and retrieve preferences
		$j.pref = function(key, val) {
			//alert(key+':'+val);
			if(val) curPrefs[key] = val;
			key = 'svg-edit-'+key;
			var host = location.hostname,
				onweb = host && host.indexOf('.') >= 0,
				store = (val != undefined),
				storage = false;
				//alert(store);
			// Some FF versions throw security errors here
			try {
				if(window.localStorage) { // && onweb removed so Webkit works locally
					storage = localStorage;
				}
			} catch(e) {}
			try {
				if(window.globalStorage && onweb) {
					storage = globalStorage[host];
				}
			} catch(e) {}

			if(storage) {
				if(store) storage.setItem(key, val);
					else if (storage.getItem(key)) return storage.getItem(key) + ''; // Convert to string for FF (.value fails in Webkit)
			} else if(window.widget) {
				if(store) widget.setPreferenceForKey(val, key);
					else return widget.preferenceForKey(key);
			} else {
				if(store) {
					var d = new Date();
					d.setTime(d.getTime() + 31536000000);
					val = encodeURIComponent(val);
					document.cookie = key+'='+val+'; expires='+d.toUTCString();
				} else {
					var result = document.cookie.match(new RegExp(key + "=([^;]+)"));
					return result?decodeURIComponent(result[1]):'';
				}
			}
		}

		Editor.setConfig = function(opts) {
			$j.each(opts, function(key, val) {
				// Only allow prefs defined in defaultPrefs
				//alert(key);
				if(key in defaultPrefs) {
					$j.pref(key, val);
				}
			});
			$j.extend(true, curConfig, opts);
			if(opts.extensions) {
				curConfig.extensions = opts.extensions;
			}

		}

		// Extension mechanisms must call setCustomHandlers with two functions: opts.open and opts.save
		// opts.open's responsibilities are:
		// 	- invoke a file chooser dialog in 'open' mode
		//	- let user pick a SVG file
		//	- calls setCanvas.setSvgString() with the string contents of that file
		// opts.save's responsibilities are:
		//	- accept the string contents of the current document
		//	- invoke a file chooser dialog in 'save' mode
		// 	- save the file to location chosen by the user
		Editor.setCustomHandlers = function(opts) {
			Editor.ready(function() {
				if(opts.open) {
					$j('#tool_open > input[type="file"]').remove();
					$j('#tool_open').show();
					svgCanvas.open = opts.open;
				}
				if(opts.save) {
					Editor.show_save_warning = false;
					svgCanvas.bind("saved", opts.save);
				}
				if(opts.pngsave) {
					svgCanvas.bind("exported", opts.pngsave);
				}
				customHandlers = opts;
			});
		}

		Editor.randomizeIds = function() {
			svgCanvas.randomizeIds(arguments)
		}

		Editor.init = function() {
			// For external openers
			(function() {
				// let the opener know SVG Edit is ready
				var w = window.opener;
				if (w) {
			    		try {
						var svgEditorReadyEvent = w.document.createEvent("Event");
						svgEditorReadyEvent.initEvent("svgEditorReady", true, true);
						w.document.documentElement.dispatchEvent(svgEditorReadyEvent);
			    		}
					catch(e) {}
				}
			})();

			(function() {
				// Load config/data from URL if given
				var urldata = $j.deparam.querystring(true);
				if(!$j.isEmptyObject(urldata)) {
					if(urldata.dimensions) {
						urldata.dimensions = urldata.dimensions.split(',');
					}

					if(urldata.extensions) {
						urldata.extensions = urldata.extensions.split(',');
					}

					if(urldata.bkgd_color) {
						urldata.bkgd_color = '#' + urldata.bkgd_color;
					}

					svgEditor.setConfig(urldata);

					var src = urldata.source;
					var qstr = $j.param.querystring();

					if(!src) { // urldata.source may have been null if it ended with '='
						if(qstr.indexOf('source=data:') >= 0) {
							src = qstr.match(/source=(data:[^&]*)/)[1];
						}
					}

					if(src) {
						if(src.indexOf("data:") === 0) {
							// plusses get replaced by spaces, so re-insert
							src = src.replace(/ /g, "+");
							Editor.loadFromDataURI(src);
						} else {
							Editor.loadFromString(src);
						}
					} else if(qstr.indexOf('paramurl=') !== -1) {
						// Get paramater URL (use full length of remaining location.href)
						svgEditor.loadFromURL(qstr.substr(9));
					} else if(urldata.url) {
						svgEditor.loadFromURL(urldata.url);
					}
				} else {
					var name = 'svgedit-' + Editor.curConfig.canvasName;
					var cached = window.localStorage.getItem(name);
					//trace("cached = " + cached);
					cached = '';
					if (cached) {
						Editor.loadFromString(cached);
					}
				}
			})();

			var extFunc = function() {
				$j.each(curConfig.extensions, function() {
					var extname = this;
					$j.getScript(curConfig.extPath + extname, function(d) {
						// Fails locally in Chrome 5
						if(!d) {
							var s = document.createElement('script');
							s.src = curConfig.extPath + extname;
							document.querySelector('head').appendChild(s);
						}
					});
				});

				var good_langs = [];

				$j('#lang_select option').each(function() {
					good_langs.push(this.value);
				});

	// 			var lang = ('lang' in curPrefs) ? curPrefs.lang : null;
				Editor.putLocale(null, good_langs);
			}

			// Load extensions
			// Bit of a hack to run extensions in local Opera/IE9
			if(document.location.protocol === 'file:') {
				setTimeout(extFunc, 100);
			} else {
				extFunc();
			}
			$j.svgIcons(curConfig.imgPath + 'svg_edit_icons.svg', {
				w:24, h:24,
				id_match: false,
 				no_img: !svgedit.browser.isWebkit(), // Opera & Firefox 4 gives odd behavior w/images
				fallback_path: curConfig.imgPath,
				fallback:{
					'new_image':'clear.png',
					'save':'save.png',
					'open':'open.png',
					'source':'source.png',
					'docprops':'document-properties.png',
					'wireframe':'wireframe.png',
					'select_node':'select_node.png',

					'undo':'undo.png',
					'redo':'redo.png',

					'pencil':'fhpath.png',
					'pen':'line.png',
					'square':'square.png',
					'rect':'rect.png',
					'fh_rect':'freehand-square.png',
					'circle':'circle.png',
					'ellipse':'ellipse.png',
					'fh_ellipse':'freehand-circle.png',
					'path':'path.png',
					'text':'text.png',
					'image':'image.png',
					'zoom':'zoom.png',

					'clone':'clone.png',
					'blur':'blur.png',
					'node_clone':'node_clone.png',
					'delete':'d_delete.png',
					'node_delete':'d_delete.png',
					'group':'shape_group.png',
					'ungroup':'shape_ungroup.png',
					'move_top':'move_top.png',
					'move_bottom':'move_bottom.png',
					'to_path':'to_path.png',
					'link_controls':'link_controls.png',
					'reorient':'reorient.png',
					'fill':'fill.png',					
					'stroke':'stroke.png',
					'opacity':'opacity.png',	

					'align':'align.png',
					'align_left':'align-left.png',
					'align_center':'align-center.png',
					'align_right':'align-right.png',
					'align_top':'align-top.png',
					'align_middle':'align-middle.png',
					'align_bottom':'align-bottom.png',
					'tool_ds':'tool_ds.png',
					

					'go_up':'go-up.png',
					'go_down':'go-down.png',

					'ok':'save.png',
					'cancel':'cancel.png',

					'arrow_right':'flyouth.png',
					'arrow_down':'dropdown.gif'
				},
				placement: {
					'#logo':'logo',

					//'#tool_clear div,#layer_new':'new_image',
					'#tool_save div':'save',
					'#tool_export div':'export',
					'#tool_open div div':'open',
					'#tool_import div div':'import',
					'#tool_source':'source',
					'#tool_docprops > div':'docprops',
					'#tool_wireframe':'wireframe',

					/*'#tool_undo':'undo',
					'#tool_redo':'redo',*/

					'#tool_fhpath':'pencil',
					'#tool_line':'pen',
					//'#mode_connect':'link_controls',
					'#tool_rect,#tools_rect_show':'rect',
					'#tool_square':'square',
					'#tool_fhrect':'fh_rect',
					'#tool_ellipse,#tools_ellipse_show':'ellipse',
					'#tool_circle':'circle',
					'#tool_fhellipse':'fh_ellipse',
					'#tool_path':'path',
					'#tool_text,#layer_rename':'text',
					'#tool_image':'image',
					'#tool_zoom':'zoom',

					'#tool_clone ,#tool_clone_multi':'clone',
					'#tool_node_clone':'node_clone',
					'#layer_delete,#tool_delete,#tool_delete_multi':'delete',
					'#tool_node_delete':'node_delete',
					'#tool_add_subpath':'add_subpath',
					'#tool_openclose_path':'open_path',
					'#tool_move_top':'move_top',
					'#tool_move_bottom':'move_bottom',
					'#tool_topath':'to_path',
					'#tool_node_link':'link_controls',
					'#tool_reorient':'reorient',
					'#tool_group':'group',
					'#tool_ungroup':'ungroup',
					'#tool_unlink_use':'group',
					/*'#tool_unlink_use':'unlink_use',*/

					'#tool_alignleft, #tool_posleft':'align_left',
					'#tool_aligncenter, #tool_poscenter':'align_center',
					'#tool_alignright, #tool_posright':'align_right',
					'#tool_aligntop, #tool_postop':'align_top',
					'#tool_alignmiddle, #tool_posmiddle':'align_middle',
					'#tool_alignbottom, #tool_posbottom':'align_bottom',
					'#cur_position':'align',
					'#tools_shapelib_show':'tool_ds',

					'#linecap_butt,#cur_linecap':'linecap_butt',
					'#linecap_round':'linecap_round',
					'#linecap_square':'linecap_square',

					'#linejoin_miter,#cur_linejoin':'linejoin_miter',
					'#linejoin_round':'linejoin_round',
					'#linejoin_bevel':'linejoin_bevel',

					'#url_notice':'warning',

					'#layer_up':'go_up',
					'#layer_down':'go_down',
					'#layer_moreopts':'context_menu',
					'#layerlist td.layervis':'eye',

					'#tool_source_save,#tool_docprops_save,#tool_prefs_save':'ok',
					'#tool_edit_close,#tool_pick_color_close,#tool_add_art_close,#tool_place_text_close,#tool_add_image_close,#tool_add_shape_close,#tool_design_idea_close,#tool_choose_prod_close,#tool_source_cancel,#tool_docprops_cancel,#tool_image_upload_cancel,#tool_login_window_cancel,#tool_addnote_cancel,#tool_beforeaddtocart_cancel, #tool_save_design_window_cancel, #tool_facebook_window_cancel, #tool_flickr_window_cancel, #tool_picasa_window_cancel, #tool_preview_window_cancel, #tool_prefs_cancel':'cancel',

					'#rwidthLabel, #iwidthLabel':'width',
					'#rheightLabel, #iheightLabel':'height',
					'#cornerRadiusLabel span':'c_radius',
					'#angleLabel':'angle',
					'#linkLabel,#tool_make_link,#tool_make_link_multi':'globe_link',
					'#zoomLabel':'zoom',
					'#tool_fill label': 'fill',
					'#tool_stroke .icon_label': 'stroke',
					'#group_opacityLabel': 'opacity',
					'#blurLabel': 'blur',
					'#font_sizeLabel': 'fontsize',

					'.flyout_arrow_horiz':'arrow_right',
					'.dropdown button, #main_button .dropdown':'arrow_down',
					'#palette .palette_item:first, #fill_bg, #stroke_bg':'no_color'
				},
				resize: {
					'#logo .svg_icon': 28,
					'.flyout_arrow_horiz .svg_icon': 5,
					'.layer_button .svg_icon, #layerlist td.layervis .svg_icon': 14,
					'.dropdown button .svg_icon': 7,
					'#main_button .dropdown .svg_icon': 9,
					'.palette_item:first .svg_icon' : 15,
					'#fill_bg .svg_icon, #stroke_bg .svg_icon': 19,
					'.toolbar_button button .svg_icon':16,
					'.stroke_tool div div .svg_icon': 20,
					'#tools_bottom label .svg_icon': 18,
					'#tool_clone':30
				},
				callback: function(icons) {
					$j('.toolbar_button button > svg, .toolbar_button button > img').each(function() {
						$j(this).parent().prepend(this);
					});

					var tleft = $j('#tools_left');
					if (tleft.length != 0) {
						var min_height = tleft.offset().top + tleft.outerHeight();
					}

					// Look for any missing flyout icons from plugins
					$j('.tools_flyout').each(function() {
						var shower = $j('#' + this.id + '_show');
						var sel = shower.attr('data-curopt');
						// Check if there's an icon here
						if(!shower.children('svg, img').length) {
							var clone = $j(sel).children().clone();
							if(clone.length) {
								clone[0].removeAttribute('style'); //Needed for Opera
								shower.append(clone);
							}
						}
					});

					svgEditor.runCallbacks();

					setTimeout(function() {
						$j('.flyout_arrow_horiz:empty').each(function() {
							$j(this).append($j.getSvgIcon('arrow_right').width(5).height(5));
						});
					}, 1);
				}
			});
			Editor.canvas = svgCanvas = new $j.SvgCanvas(document.getElementById("svgcanvas"), curConfig);
			Editor.show_save_warning = false;
			var palette = ["#000000", "#3f3f3f", "#7f7f7f", "#bfbfbf", "#ffffff",
			           "#ff0000", "#ff7f00", "#ffff00", "#7fff00",
			           "#00ff00", "#00ff7f", "#00ffff", "#007fff",
			           "#0000ff", "#7f00ff", "#ff00ff", "#ff007f",
			           "#7f0000", "#7f3f00", "#7f7f00", "#3f7f00",
			           "#007f00", "#007f3f", "#007f7f", "#003f7f",
			           "#00007f", "#3f007f", "#7f007f", "#7f003f",
			           "#ffaaaa", "#ffd4aa", "#ffffaa", "#d4ffaa",
			           "#aaffaa", "#aaffd4", "#aaffff", "#aad4ff",
			           "#aaaaff", "#d4aaff", "#ffaaff", "#ffaad4"
			           ],
				isMac = (navigator.platform.indexOf("Mac") >= 0),
				isWebkit = (navigator.userAgent.indexOf("AppleWebKit") >= 0),
				modKey = (isMac ? "meta+" : "ctrl+"), //
				path = svgCanvas.pathActions,
				undoMgr = svgCanvas.undoMgr,
				Utils = svgedit.utilities,
				default_img_url = curConfig.imgPath + "logo.png",
				workarea = $j("#workarea"),
				canv_menu = $j("#cmenu_canvas"),
				layer_menu = $j("#cmenu_layers"),
				exportWindow = null,
				tool_scale = 1,
				zoomInIcon = 'crosshair',
				zoomOutIcon = 'crosshair',
				ui_context = 'toolbars',
				orig_source = '',
				paintBox = {fill: null, stroke:null};

			// This sets up alternative dialog boxes. They mostly work the same way as
			// their UI counterparts, expect instead of returning the result, a callback
			// needs to be included that returns the result as its first parameter.
			// In the future we may want to add additional types of dialog boxes, since
			// they should be easy to handle this way.
			(function() {
				$j('#dialog_container').draggable({cancel:'#dialog_content, #dialog_buttons *', containment: 'window'});
				var box = $j('#dialog_box'), btn_holder = $j('#dialog_buttons');

				var dbox = function(type, msg, callback, defText) {
					$j('#dialog_content').html('<p>'+msg.replace(/\n/g,'</p><p>')+'</p>')
						.toggleClass('prompt',(type=='prompt'));
					btn_holder.empty();

					var ok = $j('<input type="button" id="btn_ok_dig" value="' + uiStrings.common.ok + '">').appendTo(btn_holder);

					if(type != 'alert') {
						$j('<input type="button" id="btn_cancel_dig" value="' + uiStrings.common.cancel + '">')
							.appendTo(btn_holder)
							.click(function() { box.hide();callback(false)});
					}

					if(type == 'prompt') {
						var input = $j('<input type="text">').prependTo(btn_holder);
						input.val(defText || '');
						input.bind('keydown', 'return', function() {ok.click();});
					}

					if(type == 'process') {
						ok.hide();
					}

					box.show();

					ok.click(function() {
						box.hide();
						var resp = (type == 'prompt')?input.val():true;
						if(callback) callback(resp);
					}).focus();

					if(type == 'prompt') input.focus();
				}

				$j.alert = function(msg, cb) { dbox('alert', msg, cb);};
				$j.confirm = function(msg, cb) { dbox('confirm', msg, cb);};
				$j.confirm_custom = function(msg, cb) { dbox('confirm_custom', msg, cb); $j("#btn_ok_dig").val('Yes'); $j("#btn_cancel_dig").val('No');};
				$j.process_cancel = function(msg, cb) {	dbox('process', msg, cb);};
				$j.prompt = function(msg, txt, cb) { dbox('prompt', msg, cb, txt);};

			}());

			var setSelectMode = function() {
				var curr = $j('.tool_button_current');
				if(curr.length && curr[0].id !== 'tool_select') {
					curr.removeClass('tool_button_current').addClass('tool_button');
					$j('#styleoverrides').text('#svgcanvas svg *{cursor:move;pointer-events:all} #svgcanvas svg{cursor:default}');
				}
				svgCanvas.setMode('select');
				workarea.css('cursor','auto');
			};

			var togglePathEditMode = function(editmode, elems) {
				$j('#path_node_panel').toggle(editmode);
				$j('#tools_bottom_2,#tools_bottom_3').toggle(!editmode);
				if(editmode) {
					// Change select icon
					$j('.tool_button_current').removeClass('tool_button_current').addClass('tool_button');
					setIcon('#tool_select', 'select_node');
					multiselected = false;
					if(elems.length) {
						selectedElement = elems[0];
					}
				} else {
					setIcon('#tool_select', 'select');
				}
			}

			// used to make the flyouts stay on the screen longer the very first time
			var flyoutspeed = 1250;
			var textBeingEntered = false;
			var selectedElement = null;
			var multiselected = false;
			var editingsource = false;
			var docprops = false;
			var preferences = false;
			var cur_context = '';
			var orig_title = $j('title:first').text();

			var saveHandler = function(window,svg) {
				Editor.show_save_warning = false;

				// by default, we add the XML prolog back, systems integrating SVG-edit (wikis, CMSs)
				// can just provide their own custom save handler and might not want the XML prolog
				svg = '<?xml version="1.0"?>\n' + svg;

				// Opens the SVG in new window, with warning about Mozilla bug #308590 when applicable

				var ua = navigator.userAgent;

				// Chrome 5 (and 6?) don't allow saving, show source instead ( http://code.google.com/p/chromium/issues/detail?id=46735 )
				// IE9 doesn't allow standalone Data URLs ( https://connect.microsoft.com/IE/feedback/details/542600/data-uri-images-fail-when-loaded-by-themselves )
				if((~ua.indexOf('Chrome') && $j.browser.version >= 533) || ~ua.indexOf('MSIE')) {
					showSourceEditor(0,true);
					return;
				}
				var win = window.open("data:image/svg+xml;content-disposition: attachment;base64," + Utils.encode64(svg));

				// Alert will only appear the first time saved OR the first time the bug is encountered
				var done = $j.pref('save_notice_done');
				if(done !== "all") {

					var note = uiStrings.notification.saveFromBrowser.replace('%s', 'SVG');

					// Check if FF and has <defs/>
					if(ua.indexOf('Gecko/') !== -1) {
						if(svg.indexOf('<defs') !== -1) {
							note += "\n\n" + uiStrings.notification.defsFailOnSave;
							$j.pref('save_notice_done', 'all');
							done = "all";
						} else {
							$j.pref('save_notice_done', 'part');
						}
					} else {
						$j.pref('save_notice_done', 'all');
					}

					if(done !== 'part') {
						win.alert(note);
					}
				}
			};

			var exportHandler = function(window, data) {
				var issues = data.issues;

				if(!$('#export_canvas').length) {
					$('<canvas>', {id: 'export_canvas'}).hide().appendTo('body');
				}
				var c = $('#export_canvas')[0];

				c.width = svgCanvas.contentW;
				c.height = svgCanvas.contentH;
				canvg(c, data.svg, {renderCallback: function() {
					var datauri = c.toDataURL('image/png');
					exportWindow.location.href = datauri;
					var done = $.pref('export_notice_done');
					if(done !== "all") {
						var note = uiStrings.notification.saveFromBrowser.replace('%s', 'PNG');

						// Check if there's issues
						if(issues.length) {
							var pre = "\n \u2022 ";
							note += ("\n\n" + uiStrings.notification.noteTheseIssues + pre + issues.join(pre));
						}

						// Note that this will also prevent the notice even though new issues may appear later.
						// May want to find a way to deal with that without annoying the user
						$.pref('export_notice_done', 'all');
						exportWindow.alert(note);
					}
				}});
			};

			
			/* by rws
			var exportHandler = function(window, data) {
				var issues = data.issues;
				
				if(!$j('#export_canvas').length) {
					$j('<canvas>', {id: 'export_canvas'}).hide().appendTo('body');
				}
				var c = $j('#export_canvas')[0];
				c.width = svgCanvas.contentW;
				c.height = svgCanvas.contentH;
				
				
				canvg(c, data.svg, {renderCallback: function() {
					console.log('in canvg function');
					var datauri = c.toDataURL('image/png');
					
					var ret_string =  clickSave();
					
					if( datauri != 'undefined')
					{
						$j.ajax({
							type: 'POST',
							url: backend_url,
							cache: false,
							data: "id="+ template_id +"&form_key="+ formkey +"&save_str=" + ret_string +"&save_png=" + datauri,
							success: function (html) {
								alert('Design saved successfully!');
								window.location.href = html;
							},
							error:function (html) {alert('error in saving');}
						});
					}
					var done = $j.pref('export_notice_done');
					if(done !== "all") {
						var note = uiStrings.notification.saveFromBrowser.replace('%s', 'PNG');

						// Check if there's issues
						if(issues.length) {
							var pre = "\n \u2022 ";
							note += ("\n\n" + uiStrings.notification.noteTheseIssues + pre + issues.join(pre));
						}

						// Note that this will also prevent the notice even though new issues may appear later.
						// May want to find a way to deal with that without annoying the user
						$j.pref('export_notice_done', 'all');
						exportWindow.alert(note);
					}
				}});
			};*/
			
			// called when we've selected a different element
			var selectedChanged = function(window,elems) {
				var mode = svgCanvas.getMode();
				trace("element change =  " + mode);
				if(mode === "select") setSelectMode();
				var is_node = (mode == "pathedit");
				// if elems[1] is present, then we have more than one element
				selectedElement = (elems.length == 1 || elems[1] == null ? elems[0] : null);
				multiselected = (elems.length >= 2 && elems[1] != null);
				
				if (selectedElement != null ) {
					// unless we're already in always set the mode of the editor to select because
					// upon creation of a text element the editor is switched into
					// select mode and this event fires - we need our UI to be in sync
					//is_node =true; //25-7-13 added by rws to solve image loading issue on first click
					//updateToolbar();
					if (!is_node) {
						updateToolbar();
					}
					if (selectedElement !== null && selectedElement !== '') 
					{
						if(selectedElement.tagName === "text")
						{
							var cls = selectedElement.getAttributeNS(null, 'class');
							if (cls == "titleClass")
								myButton = "addtitle";
							if (cls == "textClass")
								myButton = "addtext";
						}
						if(selectedElement.tagName === 'image')
						{
							if(selectedElement.getAttributeNS(null, 'class') === "scissorImage")
							{
								myButton = "addOneScissors";
							}
						}
					}


				}
				
				// Deal with pathedit mode
				togglePathEditMode(is_node, elems);
				updateContextPanel();
				svgCanvas.runExtensions("selectedChanged", {
					elems: elems,
					selectedElement: selectedElement,
					multiselected: multiselected
				});
			};

			// Call when part of element is in process of changing, generally
			// on mousemove actions like rotate, move, etc.
			var elementTransition = function(window,elems) {
				