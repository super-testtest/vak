
$jq(document).ready(function(){	

	
	// wide menu
	$jq('.wine_menu ul.level0').wrap('<div class="container" />');
	$jq('.wine_menu .container').css("display","none");
	(function($jq){
		//cache nav
		var nav = $jq(".wine_menu");
		//add indicator and hovers to submenu parents
		nav.find("li").each(function() {
				//show subnav on hover
				$jq(this).mouseenter(function() {
					$jq(this).find(".container").stop(true, true).fadeIn();
				});
				
				//hide submenus on exit
				$jq(this).mouseleave(function() {
					$jq(this).find(".container").stop(true, true).fadeOut();
				});
		});
	})($jq);
	


	
	
});



            //fixed navbar
            $jq(function() {
                var header = $jq('.nav-container').offset().top;
                $jq(window).scroll(function(){
                    if( $jq(window).scrollTop() > header ) {
                        $jq('.nav-container').addClass("sticky");
                    }else{
                        $jq('.nav-container').removeClass("sticky");
                    }
                });
            });


