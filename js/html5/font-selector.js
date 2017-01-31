var Smm = {
	fontDirectory: mediapath + 'font/font-selector/',
    selectorId: 'font-selector',
    visible: false
};
fonts_used += Smm.fontDirectory + first_font + ".css||";
Smm.fonts = jsonfontList;

Smm.loadFont = function(fontFace, active, loading){
    console.log('Loading font: ' + fontFace);
    console.log('fonts_used: ' + fonts_used);
	
    if(Smm.fonts[fontFace]['loaded'] === false){
        console.log('Font not loaded... Getting css file now');
        
        Smm.fonts[fontFace]['loaded'] = true;
        
        WebFont.load({
            custom: {
                families: [fontFace],
                urls: [ Smm.fontDirectory + Smm.fonts[fontFace]['cssFile'] ]
            },
            loading: loading,
            active: active
        });
		console.log('Font not loaded... Getting css file now' + Smm.fontDirectory + Smm.fonts[fontFace]['cssFile']);
		fonts_used += Smm.fontDirectory + Smm.fonts[fontFace]['cssFile'] + "||";
    }
    else {
        console.log('Font already loaded, using file.' +  Smm.fontDirectory + Smm.fonts[fontFace]['loaded']);
		fonts_used += Smm.fontDirectory + Smm.fonts[fontFace]['cssFile'] + "||";
        active();
    }
};

Smm.init = function(divId){
   /* $j('#tool_font_family').css('position','relative').append('<div id="font-selector"></div>');
    var selector = $j('#'+Smm.selectorId);
    $j.each(Smm.fonts, function(index,value){
		selector.append('<div class="font-item" font-name="' + index + '">' + index + '</div>');
    });*/
	
	/*$j('#tool_font_family').css('position','relative').append('<select class="select-small" id="font-selector">');
    var selector = $j('#'+Smm.selectorId);
    $j.each(Smm.fonts, function(index,value){
        selector.append('<option class="font-item" font-name="' + index + '">' + index + '</option>');       */
		$j('#dd').css('position','relative').append('<ul tabindex="1" class="dropdown select-small" id="font-selector">');
		var selector = $j('#'+Smm.selectorId);
		$j.each(Smm.fonts, function(index,value){
			selector.append('<li font-name="' + index + '"><a class="font-item" font-name="' + index + '" style="font-family:' + index + '">' + index + '</a></li>');       
	  
    });
    
    $j("#close-selector").click(Smm.hideSelector);
    $j(".font-item").click(Smm.selectFont);
	/*$j('#font-selector').change(function(){
		var font = $j(this).val();
		var active = function(){
		svgCanvas.setFontFamily(font);
		};
		$j('#font_family').val(font);
		var loading = function(){};
		Smm.loadFont(font, active, loading);
	});*/
	
    $j('#font_family_dropdown button').unbind('mousedown').bind('mousedown',function(event){
        if (Smm.visible === false) {
            Smm.showSelector();
        } else {
            //Smm.hideSelector();
        }
    });
    $j(window).mouseup(function(evt) {
        if(!Smm.visible === true) {
            //Smm.hideSelector();
        }
        Smm.visible = false;
    });
    $j('#'+Smm.selectorId).mouseup(function(){
        Smm.showSelector();
    });
};

Smm.showSelector = function(){
    $j('#'+Smm.selectorId).show();
    Smm.visible = true;
};

Smm.hideSelector = function(){
    $j('#'+Smm.selectorId).hide();
    Smm.visible = false;
};

Smm.selectFont = function(){
    var font = $j(this).attr('font-name');
    var active = function(){
        svgCanvas.setFontFamily(font);
    };
	$j('#font_family').val(font);
    var loading = function(){};
    Smm.loadFont(font, active, loading);
    //Smm.hideSelector();
}

function DropDown(el) {
	this.dd = el;
	this.placeholder = this.dd.children('span');
	this.opts = this.dd.find('ul.dropdown > li');
	this.val = '';
	this.index = -1;
	this.initEvents();
}
DropDown.prototype = {
	initEvents : function() {
		var obj = this;						
		obj.dd.on('click', function(event){					
			$j(this).toggleClass('active');
			return false;
		});
		
		obj.opts.on('click',function(){
			var opt = $j(this);
			obj.val = opt.text();
			obj.index = opt.index();
			obj.placeholder.text(obj.val);
			obj.placeholder.css('font-family', obj.val);
		});
	},
	getValue : function() {
		return this.val;
	},
	getIndex : function() {
		return this.index;
	}
}
