<?php
	foreach (ini_get_all() as $setting => $options) {
		echo $setting . ": " . $options["local_value"] . "\n";
	}
?>