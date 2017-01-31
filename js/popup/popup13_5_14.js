jQuery(function($) {

	$(".topopup").click(function() 
	{
		var x1Val = $j("#x1Val").val();
		var x2Val = $j("#x2Val").val();
		var y1Val = $j("#y1Val").val();
		var y2Val = $j("#y2Val").val();
		loadPopup(x1Val,x2Val,y1Val,y2Val); // function show popup
		return false;
	});

	/* event for close the popup */
	$("div.close").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);

	$("div.close").click(function() {
		disablePopup();  // function close pop up
	});

	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup();  // function close pop up
		}
	});

        $("div#backgroundPopup").click(function() {
		disablePopup();  // function close pop up
	});

	$('a.livebox').click(function() {
		alert('Hello World!');
	return false;
	});

	 /************** start: functions. **************/
	function loading() {
		$("div.loader").show();
	}
	function closeloading() {
		$("div.loader").fadeOut('normal');
	}

	var popupStatus = 0; // set value

	function loadPopup(x1,x2,y1,y2) {
		if(popupStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#toPopup").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001);
			$('img#imgSel').imgAreaSelect
			({
				x1: x1, y1: y1, x2: x2, y2: y2, 
	        	handles: true,
    	    	onSelectEnd: function(img , selection)
    	    	{
    	    		$("#prb_img_x1").val(selection.x1);
    	    		$("#prb_img_x2").val(selection.x2);
    	    		$("#prb_img_y1").val(selection.y1);
    	    		$("#prb_img_y2").val(selection.y2);
    	    	}
    		});
    		popupStatus = 1; // and set value to 1
		}
	}

	function disablePopup() {
		if(popupStatus == 1) { // if value is 1, close popup
			$('img#imgSel').imgAreaSelect
			({
	        	hide: true,
	        	disable : true,
    		});
    		$("#toPopup").fadeOut("normal");
			$("#backgroundPopup").fadeOut("normal");
			popupStatus = 0;  // and set value to 0
		}
	}
	/************** end: functions. **************/
}); // jQuery End
