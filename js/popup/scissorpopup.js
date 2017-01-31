jQuery(function($) {

	$(".scissorpopup").click(function() 
	{
		window.scissorx1Val = $j("#scissorx1Val").val();
		window.scissorx2Val = $j("#scissorx2Val").val();
		window.scissory1Val = $j("#scissory1Val").val();
		window.scissory2Val = $j("#scissory2Val").val();
		loadScissorPopup(scissorx1Val,scissorx2Val,scissory1Val,scissory2Val); // function show popup
		return false;
	});

	/* event for close the popup */
	$("div.closeScissor").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);

	$("div.closeScissor").click(function() {
		disableScissorPopup();  // function close pop up
	});

	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disableScissorPopup();  // function close pop up
		}
	});

        $("div#backgroundScissorPopup").click(function() {
		disableScissorPopup();  // function close pop up
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

	var popupScissorStatus = 0; // set value

	function loadScissorPopup(scissorx1,scissorx2,scissory1,scissory2) {
		if(popupScissorStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#scissorpopup").fadeIn(0500); // fadein popup div
			$("#backgroundScissorPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundScissorPopup").fadeIn(0001);
			window.ias = $('img#imgScissorSel').imgAreaSelect
			({
				x1: scissorx1, y1: scissory1, x2: scissorx2, y2: scissory2, 
	        	handles: true,
	        	instance: true,
    	    	onSelectEnd: function(img , selection)
    	    	{
					$('#showscissorx1').val(selection.x1);
					$('#showscissory1').val(selection.x2);
					$('#showscissorx2').val(selection.y1);
					$('#showscissory2').val(selection.y2);
    	    		$("#prb_img_sci_x1").val(selection.x1);
    	    		$("#prb_img_sci_x2").val(selection.x2);
    	    		$("#prb_img_sci_y1").val(selection.y1);
    	    		$("#prb_img_sci_y2").val(selection.y2);
    	    	}
    		});
    		popupScissorStatus = 1; // and set value to 1
		}
	}
	$( "#showscissorx1" ).keyup(function() 
	{
		var tx1 = $('#showscissorx1').val();
		var ty1 = $('#showscissory1').val();
		var tx2 = $('#showscissorx2').val();
		var ty2 = $('#showscissory2').val();
		ias.setSelection(tx1, ty1, tx2, ty2, true);
		ias.setOptions({ show: true });
		ias.update();
		$("#prb_img_sci_x1").val(tx1);
		$("#prb_img_sci_x2").val(tx2);
		$("#prb_img_sci_y1").val(ty1);
		$("#prb_img_sci_y2").val(ty2);
	});

	$( "#showscissorx2" ).keyup(function() 
	{
		var tx1 = $('#showscissorx1').val();
		var ty1 = $('#showscissory1').val();
		var tx2 = $('#showscissorx2').val();
		var ty2 = $('#showscissory2').val();
		ias.setSelection(tx1, ty1, tx2, ty2, true);
		ias.setOptions({ show: true });
		ias.update();
		$("#prb_img_sci_x1").val(tx1);
		$("#prb_img_sci_x2").val(tx2);
		$("#prb_img_sci_y1").val(ty1);
		$("#prb_img_sci_y2").val(ty2);
	});

	$( "#showscissory1" ).keyup(function() 
	{
		var tx1 = $('#showscissorx1').val();
		var ty1 = $('#showscissory1').val();
		var tx2 = $('#showscissorx2').val();
		var ty2 = $('#showscissory2').val();
		ias.setSelection(tx1, ty1, tx2, ty2, true);
		ias.setOptions({ show: true });
		ias.update();
		$("#prb_img_sci_x1").val(tx1);
		$("#prb_img_sci_x2").val(tx2);
		$("#prb_img_sci_y1").val(ty1);
		$("#prb_img_sci_y2").val(ty2);
	});

	$( "#showscissory2" ).keyup(function() 
	{
		var tx1 = $('#showscissorx1').val();
		var ty1 = $('#showscissory1').val();
		var tx2 = $('#showscissorx2').val();
		var ty2 = $('#showscissory2').val();
		ias.setSelection(tx1, ty1, tx2, ty2, true);
		ias.setOptions({ show: true });
		ias.update();
		$("#prb_img_sci_x1").val(tx1);
		$("#prb_img_sci_x2").val(tx2);
		$("#prb_img_sci_y1").val(ty1);
		$("#prb_img_sci_y2").val(ty2);
	});
	function disableScissorPopup() {
		if(popupScissorStatus == 1) { // if value is 1, close popup
			$('img#imgScissorSel').imgAreaSelect
			({
	        	hide: true,
	        	disable : true,
	        	remove : true,
    		});
    		$("#scissorpopup").fadeOut("normal");
			$("#backgroundScissorPopup").fadeOut("normal");
			popupScissorStatus = 0;  // and set value to 0
		}
	}
	/************** end: functions. **************/
}); // jQuery End
