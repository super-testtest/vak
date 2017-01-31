<?php

require_once 'BaseControl.class.php';
require_once 'ClientEvents.class.php';
require_once 'Converter.class.php';
require_once 'FlashControl.class.php';
require_once 'Restrictions.class.php';
require_once 'UploadSettings.class.php';
require_once 'TopPane.class.php';
require_once 'StatusPane.class.php';
require_once 'UploadPane.class.php';
require_once 'Messages.class.php';
require_once 'ImagePreviewWindow.class.php';
require_once 'UploaderUtils.class.php';
require_once 'Metadata.class.php';
require_once 'CommonDialog.class.php';
require_once 'UploadErrorDialog.class.php';
require_once 'PaneItem.class.php';
require_once 'DescriptionEditor.class.php';
require_once 'AddFilesProgressDialog.class.php';

final class ImageUploaderFlash extends BaseControl
{
  public $attributes;

  
	private $_CancelUploadButtonText;
	/**
	* @return string
	*/
	public function getCancelUploadButtonText() {
		if (isset($this->_CancelUploadButtonText))
			return $this->_CancelUploadButtonText;
		else
			return null;
	}
	public function setCancelUploadButtonText($value) {
		$this->_CancelUploadButtonText = $value;
	}
	
	private $_ClientEvents;
	/**
	* @return ClientEvents
	*/
	public function getClientEvents() {
		if (isset($this->_ClientEvents))
			return $this->_ClientEvents;
		else
			return null;
	}
	public function setClientEvents($value) {
		$this->_ClientEvents = $value;
	}
	
	private $_CommonDialog;
	/**
	* @return CommonDialog
	*/
	public function getCommonDialog() {
		if (isset($this->_CommonDialog))
			return $this->_CommonDialog;
		else
			return null;
	}
	public function setCommonDialog($value) {
		$this->_CommonDialog = $value;
	}
	
	private $_Converters;
	/**
	* @return array
	*/
	public function &getConverters() {
		return $this->_Converters;
	}
	public function setConverters($value) {
		if (is_array($value)) {
			$this->_Converters = $value;
		} else {
			$this->_Converters = array($value);
		}
	}
	
	private $_DescriptionEditor;
	/**
	* @return DescriptionEditor
	*/
	public function getDescriptionEditor() {
		if (isset($this->_DescriptionEditor))
			return $this->_DescriptionEditor;
		else
			return null;
	}
	public function setDescriptionEditor($value) {
		$this->_DescriptionEditor = $value;
	}
	
	private $_EnableAddingFiles;
	/**
	* @return boolean
	*/
	public function getEnableAddingFiles() {
		if (isset($this->_EnableAddingFiles))
			return $this->_EnableAddingFiles;
		else
			return null;
	}
	public function setEnableAddingFiles($value) {
		$this->_EnableAddingFiles = $value;
	}
	
	private $_EnableAutoRotation;
	/**
	* @return boolean
	*/
	public function getEnableAutoRotation() {
		if (isset($this->_EnableAutoRotation))
			return $this->_EnableAutoRotation;
		else
			return null;
	}
	public function setEnableAutoRotation($value) {
		$this->_EnableAutoRotation = $value;
	}
	
	private $_EnableDescriptionEditor;
	/**
	* @return boolean
	*/
	public function getEnableDescriptionEditor() {
		if (isset($this->_EnableDescriptionEditor))
			return $this->_EnableDescriptionEditor;
		else
			return null;
	}
	public function setEnableDescriptionEditor($value) {
		$this->_EnableDescriptionEditor = $value;
	}
	
	private $_EnableRotation;
	/**
	* @return boolean
	*/
	public function getEnableRotation() {
		if (isset($this->_EnableRotation))
			return $this->_EnableRotation;
		else
			return null;
	}
	public function setEnableRotation($value) {
		$this->_EnableRotation = $value;
	}
	
	private $_FlashControl;
	/**
	* @return FlashControl
	*/
	public function getFlashControl() {
		if (isset($this->_FlashControl))
			return $this->_FlashControl;
		else
			return null;
	}
	public function setFlashControl($value) {
		$this->_FlashControl = $value;
	}
	
	private $_Height;
	/**
	* @return string
	*/
	public function getHeight() {
		if (isset($this->_Height))
			return $this->_Height;
		else
			return null;
	}
	public function setHeight($value) {
		$this->_Height = $value;
	}
	
	private $_ImagePreviewWindow;
	/**
	* @return ImagePreviewWindow
	*/
	public function getImagePreviewWindow() {
		if (isset($this->_ImagePreviewWindow))
			return $this->_ImagePreviewWindow;
		else
			return null;
	}
	public function setImagePreviewWindow($value) {
		$this->_ImagePreviewWindow = $value;
	}
	
	private $_Language;
	/**
	* @return string
	*/
	public function getLanguage() {
		if (isset($this->_Language))
			return $this->_Language;
		else
			return null;
	}
	public function setLanguage($value) {
		$this->_Language = $value;
	}
	
	private $_LicenseKey;
	/**
	* @return string
	*/
	public function getLicenseKey() {
		if (isset($this->_LicenseKey))
			return $this->_LicenseKey;
		else
			return null;
	}
	public function setLicenseKey($value) {
		$this->_LicenseKey = $value;
	}
	
	private $_Locale;
	/**
	* @return string
	*/
	public function getLocale() {
		if (isset($this->_Locale))
			return $this->_Locale;
		else
			return null;
	}
	public function setLocale($value) {
		$this->_Locale = $value;
	}
	
	private $_UploadPane;
	/**
	* @return UploadPane
	*/
	public function getUploadPane() {
		if (isset($this->_UploadPane))
			return $this->_UploadPane;
		else
			return null;
	}
	public function setUploadPane($value) {
		$this->_UploadPane = $value;
	}
	
	private $_Messages;
	/**
	* @return Messages
	*/
	public function getMessages() {
		if (isset($this->_Messages))
			return $this->_Messages;
		else
			return null;
	}
	public function setMessages($value) {
		$this->_Messages = $value;
	}
	
	private $_Metadata;
	/**
	* @return Metadata
	*/
	public function getMetadata() {
		if (isset($this->_Metadata))
			return $this->_Metadata;
		else
			return null;
	}
	public function setMetadata($value) {
		$this->_Metadata = $value;
	}
	
	private $_PaneItem;
	/**
	* @return PaneItem
	*/
	public function getPaneItem() {
		if (isset($this->_PaneItem))
			return $this->_PaneItem;
		else
			return null;
	}
	public function setPaneItem($value) {
		$this->_PaneItem = $value;
	}
	
	private $_AddFilesProgressDialog;
	/**
	* @return AddFilesProgressDialog
	*/
	public function getAddFilesProgressDialog() {
		if (isset($this->_AddFilesProgressDialog))
			return $this->_AddFilesProgressDialog;
		else
			return null;
	}
	public function setAddFilesProgressDialog($value) {
		$this->_AddFilesProgressDialog = $value;
	}
	
	private $_Restrictions;
	/**
	* @return Restrictions
	*/
	public function getRestrictions() {
		if (isset($this->_Restrictions))
			return $this->_Restrictions;
		else
			return null;
	}
	public function setRestrictions($value) {
		$this->_Restrictions = $value;
	}
	
	private $_StatusPane;
	/**
	* @return StatusPane
	*/
	public function getStatusPane() {
		if (isset($this->_StatusPane))
			return $this->_StatusPane;
		else
			return null;
	}
	public function setStatusPane($value) {
		$this->_StatusPane = $value;
	}
	
	private $_TopPane;
	/**
	* @return TopPane
	*/
	public function getTopPane() {
		if (isset($this->_TopPane))
			return $this->_TopPane;
		else
			return null;
	}
	public function setTopPane($value) {
		$this->_TopPane = $value;
	}
	
	private $_Type;
	/**
	* @return string
	*/
	public function getType() {
		if (isset($this->_Type))
			return $this->_Type;
		else
			return null;
	}
	public function setType($value) {
		$this->_Type = $value;
	}
	
	private $_UploadButtonText;
	/**
	* @return string
	*/
	public function getUploadButtonText() {
		if (isset($this->_UploadButtonText))
			return $this->_UploadButtonText;
		else
			return null;
	}
	public function setUploadButtonText($value) {
		$this->_UploadButtonText = $value;
	}
	
	private $_UploadErrorDialog;
	/**
	* @return UploadErrorDialog
	*/
	public function getUploadErrorDialog() {
		if (isset($this->_UploadErrorDialog))
			return $this->_UploadErrorDialog;
		else
			return null;
	}
	public function setUploadErrorDialog($value) {
		$this->_UploadErrorDialog = $value;
	}
	
	private $_UploadSettings;
	/**
	* @return UploadSettings
	*/
	public function getUploadSettings() {
		if (isset($this->_UploadSettings))
			return $this->_UploadSettings;
		else
			return null;
	}
	public function setUploadSettings($value) {
		$this->_UploadSettings = $value;
	}
	
	private $_Width;
	/**
	* @return string
	*/
	public function getWidth() {
		if (isset($this->_Width))
			return $this->_Width;
		else
			return null;
	}
	public function setWidth($value) {
		$this->_Width = $value;
	}
	

  function __construct($id = NULL) {
    parent::__construct($id);
    $this->_Converters = array();

    
		$this->setCancelUploadButtonText('Cancel');
		$this->setClientEvents(new ClientEvents());
		$this->setCommonDialog(new CommonDialog());
		$this->setDescriptionEditor(new DescriptionEditor());
		$this->setEnableAddingFiles(true);
		$this->setEnableAutoRotation(false);
		$this->setEnableDescriptionEditor(true);
		$this->setEnableRotation(true);
		$this->setFlashControl(new FlashControl());
		$this->setHeight('400px');
		$this->setImagePreviewWindow(new ImagePreviewWindow());
		$this->setLocale('en');
		$this->setUploadPane(new UploadPane());
		$this->setMessages(new Messages());
		$this->setMetadata(new Metadata());
		$this->setPaneItem(new PaneItem());
		$this->setAddFilesProgressDialog(new AddFilesProgressDialog());
		$this->setRestrictions(new Restrictions());
		$this->setStatusPane(new StatusPane());
		$this->setTopPane(new TopPane());
		$this->setType('html|flash');
		$this->setUploadButtonText('Upload');
		$this->setUploadErrorDialog(new UploadErrorDialog());
		$this->setUploadSettings(new UploadSettings());
		$this->setWidth('600px');

    
		$this->attributes['CancelUploadButtonText'] = array('jsName' => 'cancelUploadButtonText','jsType' => 'String','defaultValue' => 'Cancel');
		$this->attributes['ClientEvents'] = array('jsName' => 'events','jsType' => 'events','defaultValue' => '[new]');
		$this->attributes['CommonDialog'] = array('jsName' => 'commonDialog','jsType' => 'commonDialog','defaultValue' => '[new]');
		$this->attributes['Converters'] = array('jsName' => 'converters','jsType' => 'converters','defaultValue' => '[new]');
		$this->attributes['DescriptionEditor'] = array('jsName' => 'descriptionEditor','jsType' => 'descriptionEditor','defaultValue' => '[new]');
		$this->attributes['EnableAddingFiles'] = array('jsName' => 'enableAddingFiles','jsType' => 'Boolean','defaultValue' => true);
		$this->attributes['EnableAutoRotation'] = array('jsName' => 'enableAutoRotation','jsType' => 'Boolean','defaultValue' => false);
		$this->attributes['EnableDescriptionEditor'] = array('jsName' => 'enableDescriptionEditor','jsType' => 'Boolean','defaultValue' => true);
		$this->attributes['EnableRotation'] = array('jsName' => 'enableRotation','jsType' => 'Boolean','defaultValue' => true);
		$this->attributes['FlashControl'] = array('jsName' => 'flashControl','jsType' => 'flashControl','defaultValue' => '[new]');
		$this->attributes['Height'] = array('jsName' => 'height','jsType' => 'String','defaultValue' => '400px');
		$this->attributes['ID'] = array('jsName' => 'id','jsType' => 'String','defaultValue' => '');
		$this->attributes['ImagePreviewWindow'] = array('jsName' => 'imagePreviewWindow','jsType' => 'imagePreviewWindow','defaultValue' => '[new]');
		$this->attributes['LicenseKey'] = array('jsName' => 'licenseKey','jsType' => 'String','defaultValue' => '');
		$this->attributes['Locale'] = array('jsName' => 'locale','jsType' => 'String','defaultValue' => 'en');
		$this->attributes['UploadPane'] = array('jsName' => 'uploadPane','jsType' => 'uploadPane','defaultValue' => '[new]');
		$this->attributes['Messages'] = array('jsName' => 'messages','jsType' => 'messages','defaultValue' => '[new]');
		$this->attributes['Metadata'] = array('jsName' => 'metadata','jsType' => 'metadata','defaultValue' => '[new]');
		$this->attributes['PaneItem'] = array('jsName' => 'paneItem','jsType' => 'paneItem','defaultValue' => '[new]');
		$this->attributes['AddFilesProgressDialog'] = array('jsName' => 'addFilesProgressDialog','jsType' => 'addFilesProgressDialog','defaultValue' => '[new]');
		$this->attributes['Restrictions'] = array('jsName' => 'restrictions','jsType' => 'restrictions','defaultValue' => '[new]');
		$this->attributes['StatusPane'] = array('jsName' => 'statusPane','jsType' => 'statusPane','defaultValue' => '[new]');
		$this->attributes['TopPane'] = array('jsName' => 'topPane','jsType' => 'topPane','defaultValue' => '[new]');
		$this->attributes['Type'] = array('jsName' => 'type','jsType' => 'String','defaultValue' => 'html|flash');
		$this->attributes['UploadButtonText'] = array('jsName' => 'uploadButtonText','jsType' => 'String','defaultValue' => 'Upload');
		$this->attributes['UploadErrorDialog'] = array('jsName' => 'uploadErrorDialog','jsType' => 'uploadErrorDialog','defaultValue' => '[new]');
		$this->attributes['UploadSettings'] = array('jsName' => 'uploadSettings','jsType' => 'uploadSettings','defaultValue' => '[new]');
		$this->attributes['Width'] = array('jsName' => 'width','jsType' => 'String','defaultValue' => '600px');
  }

  protected function getClientClassName() {
    return 'imageUploaderFlash';
  }
  
  protected function getClientNamespace() {
	return 'Aurigma.ImageUploaderFlash';
  }
  
  function render()
  {
    if (isset($this->_preRenderCallbacks)) {
      foreach ($this->_preRenderCallbacks as $callback) {
        call_user_func($callback);
      }
    }
    
    $this->addScriptFileName('aurigma.htmluploader.control', 'aurigma.htmluploader.control.js');
    
    if ($this->getDebugScriptLevel() > 0) {
      $this->addScriptFileName('aurigma.imageuploaderflash', 'aurigma.imageuploaderflash.js');
    } else {
      $this->addScriptFileName('aurigma.imageuploaderflash', 'aurigma.imageuploaderflash.min.js');
    }

    if (method_exists($this, 'getLanguage')) {
      $lang = $this->getLanguage();
      if (!empty($lang)) {
        $this->addScriptFileName('aurigma.imageuploaderflash.' . $lang . '_localization',
          'aurigma.imageuploaderflash.' . $lang . '_localization.js');
      }
    }

    $this->renderClientScripts();

    $namespace = $this->getClientNamespace();
	
    $html = array ();
    $html[] = "<script type=\"text/javascript\">";
    $html[] = "//<![CDATA[";

    //keep global namespace clean. wrap all script in anonymous function.
    $html[] = '(function() {';

    if ($this->getDebugScriptLevel() > 0) {
      $html[] = "$namespace.debug().level({$this->getDebugScriptLevel()});";
    }

    if ($this->getDebugScriptMode()) {
      $mode = $this->getDebugScriptMode();
      $values = explode(',', strtolower($mode));
      if (count($values) > 1) {
        $rg = '#console|popup|alert#';
        for ($i = 0, $imax = count($values); $i < $imax; $i++) {
          $m = NULL;
          if (preg_match($rg, $values[$i], $m)) {
            $values[$i] = "'" . $m[0] . "'";
          }
        }
        $mode = '[' . implode(',', $values) . ']';
      } else {
        $mode = "'$mode'";
      }
      $html[] = "$namespace.debug().mode($mode);";
    }

    $html[] = "var u = $namespace.imageUploaderFlash({ id: '{$this->getID()}' });";

    $lang = $this->getLanguage();
    // add apply localization script
    if ($lang) {
      $html[] = 'u.set(' . $lang . '_localization);';
    }

    // add properties script
    $html[] = 'u.set(' . $this->getJson() . ');';

    //add session cookie and other cookies
    $session_name = session_name();
    $sessin_id = session_id();
    $cookies = array();
    if (!empty($sessin_id) && !empty($session_name)) {
      $cookies[] = rawurlencode($session_name) . '=' . rawurlencode($sessin_id);
    }
    foreach ($_COOKIE as $key => $value) {
    	if ($key != $session_name) {
    	 $cookies[] = rawurlencode($key) . '=' . rawurlencode($value);
    	}
    }
    $cookies = implode(';', $cookies);
    if ($cookies) {
    	$cookie_field = UPLOADER_COOKIE_PARAM_NAME;
    	$html[] = "u.metadata().addCustomField('$cookie_field', '$cookies')";
    }

    // add write markup script
    if (!$this->getManualRendering()) {
      $html[] = 'u.writeHtml();';
    }

    $html[] = '})();';

    $html[] = "//]]>";
    $html[] = "</script>";

    echo implode("\n", $html);
  }
  
  /**
   * Render uploader stylesheets. Call this function in &lt;head&gt;&lt;/head&gt; section of the page.
   * @param $cssDirectory string Path to uploader css directory. If NULL default css location will be used.
   */
  public static function renderCssRules($cssDirectory = NULL) {
  	if ($cssDirectory == NULL) {
  		$cssDirectory = UploaderUtils::getDefaultCssDirectory();
  	}
    echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"$cssDirectory/aurigma.htmluploader.control.css\" />";
  }
}