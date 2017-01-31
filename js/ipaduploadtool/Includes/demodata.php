<?php

class DemoData {

  private static $_xmlDemo;
  private static $_xmlMenu;
  private static $_currentNode;

  private static function getXmlDemo() {
    if (empty(self::$_xmlDemo)) {
      self::$_xmlDemo = simplexml_load_file(dirname(__FILE__) . '/../demos.xml');
    }
    return self::$_xmlDemo;
  }

  public static function getXmlMenu() {
    if (empty(self::$_xmlMenu)) {
      self::$_xmlMenu = simplexml_load_file(dirname(__FILE__) . '/../menu.xml');
    }
    return self::$_xmlMenu;
  }

  static  function getRootUrl() {
  	$root = rtrim(realpath(dirname(__FILE__) . '/../'), '/\\');
  	$scriptFile = realpath($_SERVER['SCRIPT_FILENAME']);
    $current = substr($scriptFile, strlen($root));
    return substr($_SERVER["SCRIPT_NAME"], 0, -strlen($current)) . '/';
  }

  static function getCurrentNode() {
    if (empty($_currentNode)) {
      $root = rtrim(realpath(dirname(__FILE__) . '/../'), '/\\');
	  $scriptFile = realpath($_SERVER['SCRIPT_FILENAME']);
      $current = substr($scriptFile, strlen($root));
      $current = ltrim(str_replace('\\', '/', $current), '/');
      $doc = self::getXmlMenu();
      $current = $doc->xpath("//siteMapNode[@url='$current']");
      if ($current && count($current) > 0) {
        self::$_currentNode = $current[0];
      }
    }
    return self::$_currentNode;
  }

  static function getRootPage() {
    $root = self::getXmlMenu();
    return array($root['title'], self::getRootUrl() . $root['url']);
  }

  static function getPageTitle() {
    $current = self::getCurrentNode();
    $title = array($current['title']);
    while (($current = $current->xpath('..')) && count($current) > 0) {
      $current = $current[0];
      if (!empty($current['url'])) {
        $title[] = $current['title'];
      }
    }

    $title = implode('&nbsp;&mdash;&nbsp;', array_reverse($title));
    return $title;
  }

  static function getSecondHeader() {
    $level = 0;
    $current = $node = self::getCurrentNode();
    while (($node = $node->xpath('..')) && count($node) > 0) {
      $node = $node[0];
      $level++;
    }

    if ($level == 2) {
      return "<h1 class=\"header2\">{$current['title']}</h1>";
    } else if ($level == 3) {
    	$nodes = $current->xpath('..');
      $parent = $nodes[0];
      $parentUrl = self::getRootUrl() . $parent['url'];
      return "<h1 class=\"header2\"><a href=\"$parentUrl\">{$parent['title']}</a><span class=\"delimiter\">&nbsp;/&nbsp;</span>{$current['title']}</h1>";
    }
    return '';
  }

  static function getFullDescription($key) {
    $xml = self::getXmlDemo();
    $description = array();
    foreach ($xml->xpath("//demo[@key='$key']/fullDescription/*") as $node) {
      $description[] = $node->asXML();
    }
    return implode('', $description);
  }

  static function getShortDescription($key) {
    $xml = self::getXmlDemo();
    $description = array();
    foreach ($xml->xpath("//demo[@key='$key']/shortDescription") as $node) {
      $description[] = (string)$node;
    }
    return implode('', $description);
  }

  static function setDefaultTimeZone() {
    if (!ini_get('date.timezone')) {
      ini_set('date.timezone', 'America/Los_Angeles');
    }
  }

}