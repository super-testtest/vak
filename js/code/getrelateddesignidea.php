<?php
$cat_id = $_POST ['cat_id'];
$website_root = 'http://192.168.5.10/html5productbuilder/';
if ($cat_id == 1) {
	echo '
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_1.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_1.png" title="Music Dance" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_3.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_3.png" title="Family Reunion" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_4.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_4.png" title="Walk for Kids" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_17.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_17.png" title="Throw Up" /></a></li>';
} else if ($cat_id == 3) {
	echo '
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_2.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_2.png" title="Coach" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_5.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_5.png" title="Ice snow" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_9.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_9.png" title="Baseball 2013" /></a></li>';
} else if ($cat_id == 19) {
	echo '
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_6.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_6.png" title="World Adventure" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_7.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_7.png" title="Love Nature" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_8.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_8.png" title="Save Tree" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_10.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_10.png" title="Love Birds" /></a></li>';
} else if ($cat_id == 22) {
	echo '
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_14.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_14.png" title="RadioActive" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_15.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_15.png" title="POKEMON" /></a></li>
	<li><a href="javascript:void(0);" onClick="loadDesignIdeaONCanvas(\'' . $website_root . 'media/gallery/gallery_16.svg\', \'load_svg\');"><img src="' . $website_root . 'media/gallery/gallery_16.png" title="PROGRAMMER" /></a></li>';
}