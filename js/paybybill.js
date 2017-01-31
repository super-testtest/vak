var Paybybill = Class.create();
Paybybill.prototype = {

	initialize: function(form){
        this.form = form;
        this.updatesection = 'payment_form_';
        this.onSuccess = this.updateText.bindAsEventListener(this);
        this.onComplete = this.resetLoadWaiting.bindAsEventListener(this);
        this.onFailure = this.communicationFailure;
    },
    
    checkform: function(method) {
    	if (!$(this.form)) {
    		var pbbform = new Element('form', {"id": "paybybill-payment-form", "action": "" });
    		var pbbinput = new Element("input");
    		pbbinput.setAttribute("type","hidden");
    		pbbinput.setAttribute("name","payment[method]");
    		pbbinput.setAttribute("value",method);
    		pbbform.appendChild(pbbinput);
    		$(this.updatesection).wrap(pbbform);
    		this.form = "paybybill-payment-form";
    	}
        if ($('billing_postcode') != undefined) {
            if ($('paybybill-postalcode') == undefined) {
              var pbbinput = new Element("input", {id: 'paybybill-postalcode'});
              pbbinput.setAttribute("type","hidden");
              pbbinput.setAttribute("name","payment[postal_code]");
              $(this.form).appendChild(pbbinput);
            }
            $('paybybill-postalcode').setAttribute("value",$('billing_postcode').value);
        }
        if ($('billing_email') != undefined) {
            if ($('paybybill-email') == undefined) {
              var pbbinput = new Element("input", {id: 'paybybill-email'});
              pbbinput.setAttribute("type","hidden");
              pbbinput.setAttribute("name","payment[email]");
              $(this.form).appendChild(pbbinput);
            }
            $('paybybill-email').setAttribute("value",$('billing_email').value);
        }
        if ($(this.form)['pbb-wash-ssno'] != undefined) {
        	var ssnoName = $(this.form)['pbb-wash-ssno'].getValue()
        	var ssnoValue = $(this.form)[ssnoName].getValue();
        	$(this.form)[ssnoName].setValue(ssnoValue.gsub(/[^0-9]/,''));
        }
    },
    
    magic: function(method,url) {
    	this.checkUrl = url;
    	this.updatesection = 'payment_form_'+method;
    	this.method = method;
    	this.checkform(method);
    	this.checkcustomer();
    },
    
    checkcustomer: function() {
        if (checkout.loadWaiting!=undefined && checkout.loadWaiting!=false) return;    	
        this.setLoadWaiting(true);
        var request = new Ajax.Request(
            this.checkUrl,
            {
                method:'post',
                onComplete: this.onComplete,
                onSuccess: this.onSuccess,
                onFailure: this.onFailure,
                parameters: Form.serialize(this.form)
            }
        );
    },

	resetLoadWaiting: function(transport){
		this.setLoadWaiting(false);
	},
	
	communicationFailure: function(transport){
		alert(Translator.translate('A communication problem has occured. Please try again.'));

	},
	
	updateText: function(transport) {
        if (transport && transport.responseText){
            try{
                response = eval('(' + transport.responseText + ')');
            }
            catch (e) {
                response = {};
                response.error = true;
            }
        }
        
        if (response.error) {
        	if ((typeof response.html) == 'string') {
        		alert(response.html);
        	}
        	else {
        		alert(Translator.translate('An unknown error has occured. Please try again.'));
        	}
        }
        else {
          $(this.updatesection).up('dd').update(response.html);
          if ($(this.updatesection)) {
            $(this.updatesection).show();
          }
          if (response.address) {
            if ($('billing_firstname')) {
                $('billing_firstname').value = response.address.firstname;    
            }
            if ($('billing_lastname')) {
                $('billing_lastname').value = response.address.lastname;
            }
            if ($('billing_street1')) {
                $('billing_street1').value = response.address.address;    
            }
            if ($('billing_city')) {
                $('billing_city').value = response.address.postalplace;    
            }
            if ($('billing_country_id') && $('billing_country_id').options) {
              if ($('billing_country_id').options.length > 0) {
                for (var i=0;i<$('billing_country_id').options.length;i++) {
                  if ($('billing_country_id').options[i].value == response.address.countrycode) {
                    $('billing_country_id').selectIndex = i;
                    break;
                  }
                }
              }                
            }
          }
        }
	},
	
	setLoadWaiting: function(active) {
		pbb_button = $('pbb_button_'+this.method);
		pbb_progress = $('pbb_progress_'+this.method);
		if (active) {
	        checkout.setLoadWaiting('payment');
	        if(pbb_button) {
	        	pbb_button.hide()
	        }
	        if (pbb_progress) {
	        	pbb_progress.show();	        	
	        }
		}
		else {
			checkout.setLoadWaiting(false);
			pbb_button.show();
			pbb_progress.hide();
		}
	},
	
	showterms: function(url,close_text) {

		var text_window = $('pbb_terms_text');
		var pbb_window = $('pbb_terms');

		if (text_window == null) {
			pbb_window = new Element('div', { 'id': 'pbb_terms'});
			pbb_window.hide();
			
			text_window = new Element('div', {'id': 'pbb_terms_text'});
			pbb_window.appendChild(text_window);

			close_button = new Element('a', {'onclick': '$(\'pbb_terms\').hide(); return false;', href: '#'}).update(close_text);
			pbb_window.appendChild(close_button);
			
			document.body.appendChild(pbb_window);
		}
		
		left_pos =  (document.documentElement.offsetWidth/2 - 250);
		top_pos = (window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop) + 50;
		pbb_window.setStyle({ 
			left: left_pos + 'px',
			top: top_pos + 'px'
		});
		
		text_window.update('<div class="loading-ajax">&nbsp;</div>');
		
		new Ajax.Updater('pbb_terms_text', url, { method: 'get' });
		pbb_window.show();
	},
	
	showpartpaymentterms: function(url,close_text) {

		var text_window = $('pbb_ppterms_text');
		var pbb_window = $('pbb_ppterms');

		if (text_window == null) {
			pbb_window = new Element('div', { 'id': 'pbb_ppterms'});
			pbb_window.hide();
			
			text_window = new Element('div', {'id': 'pbb_ppterms_text'});
			pbb_window.appendChild(text_window);

			close_button = new Element('a', {'onclick': '$(\'pbb_ppterms\').hide(); return false;', href: '#'}).update(close_text);
			pbb_window.appendChild(close_button);
			
			document.body.appendChild(pbb_window);
		}
		
		left_pos =  ((document.documentElement.offsetWidth-pbb_window.getWidth())/2);
		top_pos = (window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop) + 50;
		pbb_window.setStyle({ 
			left: left_pos + 'px',
			top: top_pos + 'px'
		});
		
		
		text_window.update('<div class="loading-ajax" id="pptLoading">&nbsp;</div><iframe src="' + url + '" id="ppIframe" onLoad="paybybill.showpptiframe()" style="display: none"></iframe>');
		pbb_window.show();
	},
	
	showpptiframe: function() {
		
		if ($('ppIframe') != undefined) {
			$('pptLoading').hide();
			$('ppIframe').show();
		}
	}
	
}

var paybybill = new Paybybill('co-payment-form');

