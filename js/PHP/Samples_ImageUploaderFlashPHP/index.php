<?php
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("Location: http://$host$uri/BasicDemo/index.php"); /* Redirect browser */

/* Make sure that code below does not get executed when we redirect. */
exit;