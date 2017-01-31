jQuery(function($) {

	$(".scissorselpopup").click(function() 
	{
		window.scissorselx1Val = $j("#scissorselx1Val").val();
		window.scissorselx2Val = $j("#scissorselx2Val").val();
		window.scissorsely1Val = $j("#scissorsely1Val").val();
		window.scissorsely2Val = $j("#scissorsely2Val").val();
		loadScissorPopup(scissorselx1Val,scissorselx2Val,scissorsely1Val,scissorsely2Val); // function show popup
		return false;
	});

	/* event for close the popup */
	$("div.closeScissorSel").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);

	$("div.closeScissorSel").click(function() {
		disableScissorSelPopup();  // function close pop up
	});

	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disableScissorSelPopup();  // function close pop up
		}
	});

        $("div#backgroundScissorSelPopup").click(function() {
		disableScissorSelPopup();  // function close pop up
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

	var popupScissorSelStatus = 0; // set value

	function loadScissorPopup(scissorselx1Val,scissorselx2Val,scissorsely1Val,scissorsely2Val) {
		if(popupScissorSelStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#scissorselpopup").fadeIn(0500); // fadein popup div
			$("#backgroundScissorSelPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundScissorSelPopup").fadeIn(0001);
			window.ias = $('img#imgScissorSelSel').imgAreaSelect
			({
				x1: scissorselx1Val, y1: scissorsely1Val, x2: scissorselx2Val, y2: scissorsely2Val, 
	        	handles: true,
	        	instance: true,
    	    	onSelectEnd: function(img , selection)
    	    	{
					$('#showscissorselx1').val(selection.x1);
					$('#showscissorsely1').val(selection.x2);
					$('#showscissorselx2').val(selection.y1);
					$('#showscissorsely2').val(selection.y2);
    	    		$("#prb_img_scisel_x1").val(selection.x1);
    	    		$("#prb_img_scisel_x2").val(selection.x2);
    	    		$("#prb_img_scisel_y1").val(selection.y1);
    	    		$("#prb_img_scisel_y2").val(selection.y2);
    	    	}
    		});
    		popupScissorSelStatus = 1; // and set value to 1
		}
	}
	$( "#showscissorselx1" ).keyup(function() 
	{
		var tx1 = $('#showscissorselx1').val();
		var ty1 = $('#showscissorsely1').val();
		var tx2 = $('#showscissorselx2').val();
		var ty2 = $('#showscissorsely2').val();
		ias.setSelection(tx1, ty1, tx2, ty2, true);
		ias.setOptions({ show: true });
		ias.update();
		$("#prb_img_scisel_x1").val(tx1);
		$("#prb_img_scisel_x2").val(tx2);
		$("#prb_img_scisel_y1").val(ty1);
		$("#prb_img_scisel_y2").val(ty2);
	});

	$( "#showscissorselx2" ).keyup(function() 
	{
		var tx1 = $('#showscissorselx1').val();
		var ty1 = $('#showscissorsely1').val();
		var tx2 = $('#showscissorselx2').val();
		var ty2 = $('#showscissorsely2').val();
		ias.setSelection(tx1, ty1, tx2, ty2, true);
		ias.setOptions({ show: true });
		ias.update();
		$("#prb_img_scisel_x1").val(tx1);
		$("#prb_img_scisel_x2").val(tx2);
		$("#prb_img_scisel_y1").val(ty1);
		$("#prb_img_scisel_y2").val(ty2);
	});

	$( "#showscissorsely1" ).keyup(function() 
	{
		var tx1 = $('#showscissorselx1').val();
		var ty1 = $('#showscissorsely1').val();
		var tx2 = $('#showscissorselx2').val();
		var ty2 = $('#showscissorsely2').val();
		ias.setSelection(tx1, ty1, tx2, ty2, true);
		ias.setOptions({ show: true });
		ias.update();
		$("#prb_img_scisel_x1").val(tx1);
		$("#prb_img_scisel_x2").val(tx2);
		$("#prb_img_scisel_y1").val(ty1);
		$("#prb_img_scisel_y2").val(ty2);
	});

	$( "#showscissorsely2" ).keyup(function() 
	{
		var tx1 = $('#showscissorselx1').val();
		var ty1 = $('#showscissorsely1').val();
		var tx2 = $('#showscissorselx2').val();
		var ty2 = $('#showscissorsely2').val();
		ias.setSelection(tx1, ty1, tx2, ty2, true);
		ias.setOptions({ show: true });
		ias.update();
		$("#prb_img_scisel_x1").val(tx1);
		$("#prb_img_scisel_x2").val(tx2);
		$("#prb_img_scisel_y1").val(ty1);
		$("#prb_img_scisel_y2").val(ty2);
	});
	function disableScissorSelPopup() {
		if(popupScissorSelStatus == 1) { // if value is 1, close popup
			$('img#imgScissorSelSel').imgAreaSelect
			({
	        	hide: true,
	        	disable : true,
	        	remove : true,
    		});
    		$("#scissorselpopup").fadeOut("normal");
			$("#backgroundScissorSelPopup").fadeOut("normal");
			popupScissorSelStatus = 0;  // and set value to 0
		}
	}
	/************** end: functions. **************/
}); // jQuery End
