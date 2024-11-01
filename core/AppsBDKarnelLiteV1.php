<?php
/**
 * @since: 03/02/2019
 * @author: Sarwar Hasan
 * @version 1.0.0
 */
APBD_LoadCore('AppsbdAjaxConfirmResponse','AppsbdAjaxConfirmResponse',__FILE__);
APBD_LoadCore('AppsbdAjaxDataResponse','AppsbdAjaxDataResponse',__FILE__);
APBD_LoadCore('AppsbdAPIResponse','AppsbdAPIResponse',__FILE__);
APBD_LoadCore('AppsbdAPIEncryptResponse','AppsbdAPIEncryptResponse',__FILE__);
APBD_LoadCore('AppsBDModel','AppsBDModel',__FILE__);
APBD_LoadCore('APPSBDQueryBuilder','APPSBDQueryBuilder',__FILE__);
APBD_LoadCore( 'AppsBDKarnelLite', 'AppsBDKarnelLite',__FILE__);
APBD_LoadCore( 'AppsBDLiteModule', 'AppsBDLiteModule',__FILE__);



/**
 * @property AppsBDProModule [] moduleList
 */
if(!class_exists("AppsBDKarnelLiteV1")) {
	abstract class AppsBDKarnelLiteV1  extends AppsBDKarnelLite{
		
		public $pluginSlugWitoutChar="";
		protected $menuTitle;
		protected $boostrapVersion='4.6.0';
		protected $isLoadJqGrid = false;
		protected  $product_icon_version='1.1';
        protected static $latest_icon_version='';
        protected static $full_link='';


        function initialize() {
            add_action( 'admin_print_styles', [ $this, 'updateProductIconVersion' ] ,9);
        }
        public function updateProductIconVersion(){

            if(empty(self::$latest_icon_version) || version_compare($this->product_icon_version,self::$latest_icon_version,'>')){
                self::$latest_icon_version=$this->product_icon_version;
                wp_deregister_style('appsbd-product-icon');
                wp_register_style('appsbd-product-icon',plugins_url( "uilib/product-icon/icon.css", $this->pluginFile ),[],self::$latest_icon_version);
            }
        }
        public function SetIsLoadJqGrid( $isLoadJqGrid ) {
            $this->isLoadJqGrid = $isLoadJqGrid;
        }

		function OnAdminAppStyles() {
            $this->AddAdminStyle( 'wp-color-picker' );
			$this->AddAdminStyle( "boostrap-".$this->boostrapVersion, "uilib/boostrap/".$this->boostrapVersion."/css/bootstrap.min.css", true );
			$this->AddAdminStyle( "font-awesome-5.15.1", "uilib/font-awesome/5.15.1/css/all.min.css", true );
			$this->AddAdminStyle( "apboostrap_magnificcss", "uilib/magnific/apbd-magnific-bootstrap.css", true );
			$this->AddAdminStyle( "apboostrap_validatior_css", "uilib/bootstrapValidation/css/bootstrapValidator.min.css", true );
            $this->AddAdminStyle("bootstrap-material-css","uilib/material/material.css",true);
			$this->AddAdminStyle( "apboostrap_sgnofi_css1", "uilib/sliding-growl-notification/css/notify.css", true );
			$this->AddAdminStyle( "apboostrap_sweetalertcss", "uilib/sweetalert/sweetalert.css", true );
			$this->AddAdminStyle( "apboostrap_datetimepickercss", "uilib/datetimepicker/jquery.datetimepicker.css", true );
			$this->AddAdminStyle( "apboostrap_boostrap_select", "uilib/boostrap-select/css/bootstrap-select-bundle.css", true );
			//$this->AddAdminStyle("uilib/sliding-growl-notification/css/themes/right-bottom.css","apboostrap_sgnofi_css2",true);
			if ( $this->isLoadJqGrid ) {
				$this->AddAdminStyle( "jquery-grid-ui", "uilib/grid/grid-ui-helper.min.css", true );
				$this->AddAdminStyle( "jquery-grid", "uilib/grid/css/ui.jqgrid.css", true );
			}
			$this->AddAdminStyle( "appsbdcore", "admin-core-style.css" );
			
			foreach ( $this->moduleList as $moduleObject ) {
				//$moduleObject=new APPSBDBase();
				$moduleObject->AdminStyles();
			}
		}
		
		function OnAdminAppScripts() {
			$this->AddAdminScript( "boostrap-".$this->boostrapVersion, "uilib/boostrap/".$this->boostrapVersion."/js/bootstrap.bundle.min.js", true );
			$this->SetLocalizeScript("boostrap-".$this->boostrapVersion);
			$this->AddAdminScript( "apboostrap_validatior_js", "uilib/bootstrapValidation/js/bootstrapValidator4.min.js", true );
			$this->AddAdminScript( "apboostrap_magnificjs", "uilib/magnific/magnific.min.js", true );
			$this->AddAdminScript( "apboostrap_sgnofi_js", "uilib/sliding-growl-notification/js/notify.min.js", true );
			$this->AddAdminScript( "apboostrap_sweetalertjs", "uilib/sweetalert/sweetalert.min.js", true );
			$this->AddAdminScript( "apboostrap_datetimepickercss", "uilib/datetimepicker/jquery.datetimepicker.js", true );
			$this->AddAdminScript( "apboostrap_boostrap_select", "uilib/boostrap-select/js/bootstrap-select.min.js", true );
			$this->AddAdminScript( "apboostrap_ajax_boostrap_select", "uilib/boostrap-select/js/ajax-bootstrap-select.js", true );
			$this->AddAdminScript( "apd-main-js", "main.min.js", false, [ 'wp-color-picker' ] );
            file_put_contents(WP_CONTENT_DIR."/me.log", "status : ".print_r($this,true),FILE_APPEND);
			if ( $this->isLoadJqGrid ) {

				$this->AddAdminScript( "jquery-grid-js-118n", "uilib/grid/js/i18n/grid.locale-en.js", true, [ 'jquery' ] );
				$this->AddAdminScript( "jquery-grid-js", "uilib/grid/js/jquery.jqGrid.src.min.js", true, [ 'jquery' ] );
			}
			
			foreach ( $this->moduleList as $moduleObject ) {
				//$moduleObject=new APPSBDBase();
				$moduleObject->AdminScripts();
			}
		}
        function RemoveAdminScript($ScriptId) {
           self::DeregisterAdminScript( $ScriptId);
        }
        function RemoveAdminStyle($StyleId) {
            self::DeregisterAdminStyle( $StyleId);
        }
		static function RegisterAdminStyle( $handle, $src = "", $deps = [], $ver = false, $in_footer = false ) {
			//echo $handle.", ";
			self::$appsbd_globalCss[] = $handle;
			if ( ! empty( $src ) ) {
				wp_register_style( $handle, $src, $deps, $ver, $in_footer );
			}
			wp_enqueue_style( $handle );
		}
        static function DeregisterAdminStyle( $handle)
        {
            //echo $handle.", ";
            $ind = array_search($handle, self::$appsbd_globalCss);
            if (!empty($ind) && !empty(self::$appsbd_globalCss[$ind])) {
                unset(self::$appsbd_globalCss[$ind]);
            }
            wp_deregister_style($handle);
            wp_dequeue_style($handle);
        }
        function OnClientScripts(){
        
        }
		function OnClientStyles(){
		
		}
		function AddClientScript( $ScriptId, $ScriptFileName = '', $isFromRoot = false, $deps = [] ) {
			parent::AddAdminScript( $ScriptId, $ScriptFileName, $isFromRoot, $deps );
		}
		public function AddClientStyle( $StyleId, $StyleFileName = '', $isFromRoot = false, $deps = [] ) {
			parent::AddAdminStyle( $StyleId, $StyleFileName, $isFromRoot, $deps );
		}
		
		function SetClientScript() {
        	$this->OnClientScripts();
			foreach ( $this->moduleList as $moduleObject ) {
				//$moduleObject=new APPSBDBase();
				if ( $moduleObject->IsActive() ) {
					$moduleObject->ClientScript();
				}
			}
		}
		
		function SetClientStyle() {
			$this->OnClientStyles();
			foreach ( $this->moduleList as $moduleObject ) {
				//$moduleObject=new APPSBDBase();
				if ( $moduleObject->IsActive() ) {
					$moduleObject->ClientStyle();
				}
			}
		}
		
		static function RegisterAdminScript( $handle, $src = "", $deps = [], $ver = false, $in_footer = false ) {
			self::$appsbd_globalJS[] = $handle;
			if ( ! empty( $src ) ) {
				wp_deregister_script( $handle );
				wp_register_script( $handle, $src, $deps, $ver, $in_footer );
			}
			wp_enqueue_script( $handle );
		}
        static function DeregisterAdminScript( $handle) {
            $ind = array_search($handle, self::$appsbd_globalJS);
            if (!empty($ind) && !empty(self::$appsbd_globalJS[$ind])) {
                unset(self::$appsbd_globalJS[$ind]);
            }
            wp_deregister_script($handle);
            wp_dequeue_script($handle);
        }
	}
}