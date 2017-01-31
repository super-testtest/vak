<script type="text/javascript">
    $(document).ready(function () {
      $(".aB-a h2 a").click(function (e) {
        $(this).closest('h2').next(".side-menu:first").slideToggle();
        e.preventDefault();
      });
    });
</script>
<div class="sidebar">
<?php

require_once 'demodata.php';

$menuXml = DemoData::getXmlMenu();

function isSelected($node) {
  $current = DemoData::getCurrentNode();
  //return count($node->xpath("descendant-or-self::siteMapNode[@url='{$current['url']}']")) > 0;
  return $node['demo'] . '' == $current['demo'] . '';
}

$current = DemoData::getCurrentNode();

foreach ($menuXml->children() as $level1) : ?>
  <h2><a href="#"><?php echo $level1['title']; ?></a></h2>
  <ul class="side-menu">
  <?php foreach ($level1->children() as $level2) :?>
    <li class="<?php print(isSelected($level2) ? 'selected' : '');?>">
      <a href="<?php echo DemoData::getRootUrl() . $level2['url']; ?>"><?php echo $level2['title']; ?></a>
      <div class="hint">
        <?php echo DemoData::getShortDescription($level2['demo']); ?>
      </div>
    </li>
  <?php endforeach; ?>
  </ul>
<?php endforeach; ?>
</div>