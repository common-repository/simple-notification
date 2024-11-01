<?php
/**
 * Simple Notification
 * Author: S M Sarwar Hasan
 * A Product of appsbd.com
 */
APBD_LoadCore("AppsBDKarnelLiteV1","AppsBDKarnelLiteV1",__FILE__);
class APBD_Simple_Notification_base  extends AppsBDKarnelLiteV1 {
	function __construct( $pluginBaseFile, $version = '1.0.0' ) {
		$this->pluginFile     = $pluginBaseFile;
		$this->pluginSlugName = 'simple-notification';
		$this->pluginName     = 'Simple Notification';
		$this->pluginVersion  = $version;
        $this->boostrapVersion="4.6.0";
		parent::__construct($pluginBaseFile,$version);
		$this->setMenuTitle("Simple Notification");
	}

	public function initialize() {
		parent::initialize();
		$this->SetIsLoadJqGrid(false);
		$this->SetPluginIconClass("abp abp-simple-notification",'dashicons-apbd-simple-notification');
		$this->setSetActionPrefix("apbd_simple_notification");


	    $this->AddliteModule("Apbd_simple_notification");
//        $this->AddliteModule("Apbd_notification_video");
        $this->AddliteModule("Apbd_aboutus_recommended");


	}
	final public function __version(){
		return '1.1';
	}
	public function OnAdminAppStyles()
    {
        parent::OnAdminAppStyles();
        $this->RemoveAdminStyle( "font-awesome-4.7.0");
        $this->AddAdminStyle( "font-awesome-5.15.1", "uilib/font-awesome/5.15.1/css/all.min.css", true );
        $this->AddAdminStyle("bootstrap-material-css","uilib/material/material.css",true);
        $this->AddAdminStyle( "apbd-select2-css", "uilib/select2/css/select2.min.css",true);
	    $this->AddAdminStyle( "apbd-select2-bs-css", "uilib/select2/css/select2-bootstrap4.min.css",true);

    }
    public function OnAdminGlobalStyles() {
        parent::OnAdminGlobalStyles();
    }
    public function OnAdminAppScripts() {
		parent::OnAdminAppScripts();
	    self::RegisterAdminScript("select2_js",'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',['jquery'],'4.0.3');
	}

    function onSettingsLink(&$links){
		$links[] = "<a class='edit coption' href='admin.php?page=" . $this->pluginSlugName . "#tb-APBDWCM_settings'>" . $this->__( "Settings", $this->pluginSlugName ) . "</a><br/><br/>";
	}
	function GetHeaderHtml() {

	}

	function GetFooterHtml() {

	}


	static function StartApp( $fileName ) {

	}

}