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
  <link href="<?php echo $rootUrl; ?>/Styles/style.css" rel="stylesheet" type="text/css" />
  <!--[if IE]>  
  <link href="<?php echo $rootUrl; ?>/Styles/ie.css" rel="stylesheet" type="text/css" />
  <![endif]-->
  <script type="text/javascript" src="<?php echo $rootUrl; ?>/Libraries/jquery/jquery-1.4.3.min.js"></script>
  <?php
    echo isset($page_head) ? $page_head : '';
  ?>
</head>
<body>
  <form id="form1" class="page">
  <div id="container">
    
    <div id="center">
        <div class="aB-B">
          <?php //echo DemoData::getSecondHeader(); ?>
          <?php if ('Uploaded files' != $current['title']) :?>
            
          <?php endif;?>
          <div class="demo">
            <div class="inner">
              <div class="container">
                <?php
                  echo $page_body;
                ?>
              </div>
            </div>
          </div>
         
          
        </div>
       
     
    </div>
    
  </div>
  </form>
</body>
</html>