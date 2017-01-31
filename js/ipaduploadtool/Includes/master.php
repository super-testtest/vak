<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
  require_once 'demodata.php';
  $current = DemoData::getCurrentNode();
  list($rootTitle, $rootUrl) = DemoData::getRootPage();
  $rootUrl = DemoData::getRootUrl();
?>
<head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script type="text/javascript" src="../Libraries/jquery/jquery-1.4.3.min.js"></script>
  <?php
    echo isset($page_head) ? $page_head : '';
  ?>
</head>
<body>
  <form id="form1" class="page">
  <div id="container">
    
                <?php
                  echo $page_body;
                ?>
    
  </div>
  </form>
</body>
</html>