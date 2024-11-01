<?php
/**
 * @since: 23/Jan/2021
 * @author: Sarwar Hasan
 * @version 1.0.0
 * @property:id,title,notification_body_title,notification_button_title,notification_link_title,notification_body_color,notification_button_color,notification_link_hover_color,notification_body_text_color,notification_button_text_color,notification_type,page_list,position,view_style,status
 */
class Mapbd_simple_notification extends AppsBDModel{
	public $id;
	public $title;
	public $notification_body;
	public $notification_button_title;
	public $notification_link_title;
	public $notification_body_color;
	public $notification_button_color;
	public $notification_link_hover_color;
	public $notification_body_text_color;
	public $notification_button_text_color;
    public $body_button_text_size;
    public $body_height;
    public $notification_fixed_absolute;
	public $notification_type;
	public $page_list;
	public $position;
	public $view_style;
	public $status;
	public $created_at;
	public $display_in_sec;
	public $display_animation;
	public $open_in_new_tab;



	    /**
	     *@property id,title,notification_body_title,notification_button_title,notification_link_title,notification_body_color,notification_button_color,notification_link_hover_color,notification_body_text_color,notification_button_text_color,notification_type,page_list,position,view_style,status
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();
			$this->tableName="apbd_simple_notification";
			$this->primaryKey="id";
			$this->uniqueKey=array();
			$this->multiKey=array();
			$this->autoIncField=array("id");
			$this->app_base_name="apbd_simple_notification";

		}


	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[11]|integer"),
			"title"=>array("Text"=>"Title", "Rule"=>"max_length[255]"),
			"notification_body"=>array("Text"=>"Notification Body", "Rule"=>"required"),
			"notification_button_title"=>array("Text"=>"Notification Button Title", "Rule"=>"max_length[100]"),
			"notification_link_title"=>array("Text"=>"Notification Link Title", "Rule"=>"required"),
			"notification_body_color"=>array("Text"=>"Notification Body Color", "Rule"=>"max_length[100]"),
			"notification_button_color"=>array("Text"=>"Notification Button Color", "Rule"=>"max_length[100]"),
			"notification_link_hover_color"=>array("Text"=>"Notification Link Hover Color", "Rule"=>"max_length[100]"),
			"notification_body_text_color"=>array("Text"=>"Notification Body Text Color", "Rule"=>"max_length[100]"),
			"notification_button_text_color"=>array("Text"=>"Notification Button Text Color", "Rule"=>"max_length[100]"),
			"body_button_text_size"=>array("Text"=>"Body & Button Text Size", "Rule"=>"max_length[100]"),
			"body_height"=>array("Text"=>"Body Height", "Rule"=>"max_length[100]"),
			"notification_fixed_absolute"=>array("Text"=>"Notification Type(Fixed/Absolute)", "Rule"=>"max_length[1]"),
			"notification_type"=>array("Text"=>"Notification Type", "Rule"=>"max_length[1]"),
			"page_list"=>array("Text"=>"Page List", "Rule"=>"max_length[255]"),
			"position"=>array("Text"=>"Position", "Rule"=>"max_length[1]"),
			"view_style"=>array("Text"=>"View Style", "Rule"=>"max_length[100]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]"),
            "created_at"=>array("Text"=>"Created At", "Rule"=>"max_length[20]"),
			"display_in_sec"=>array("Text"=>"Display in Sec", "Rule"=>"max_length[11]|integer"),
			"display_animation"=>array("Text"=>"Display Animation", "Rule"=>"max_length[100]"),
            "open_in_new_tab"=>array("Text"=>"Open in New Tab", "Rule"=>"max_length[1]")

		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "notification_type":
	         $returnObj=array("H"=>"Home Page","A"=>"All Page","S"=>"Specific Page","I"=>"Hidden Page");
	         break;
	      case "position":
	         $returnObj=array("T"=>"Top","B"=>"Bottom");
	         break;
	      case "status":
	         $returnObj=array("A"=>"Active","I"=>"Inactive");
	         break;
	      default:
	    }
        if($isWithSelect){
            return array_merge(array(""=>"Select"),$returnObj);
        }
        return $returnObj;

	}

	public function GetPropertyOptionsColor($property){
	    $returnObj=array();
		switch ($property) {
	      case "notification_type":
	         $returnObj=array("A"=>"success","S"=>"success","H"=>"success","I"=>"danger");
	         break;
	      case "position":
	         $returnObj=array("T"=>"success","B"=>"success","P"=>"info");
	         break;
	      default:
	    }
        return $returnObj;

	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "notification_type":
	         $returnObj=array("A"=>"fa fa-check-circle-o","S"=>"fa fa-check-circle-o","H"=>"","I"=>"fa fa-times-circle-o");
	         break;
	      case "position":
	         $returnObj=array("T"=>"","B"=>"","P"=>"fa fa-hourglass-1");
	         break;
	      default:
	    }
        return $returnObj;

	}
	function SetPageList()
    {
        if ($this->IsSetPrperty('page_list')) {
            $pagelist=!empty($this->setProperties['page_list'])?$this->setProperties['page_list']:null;
            if (is_array($pagelist)) {
                $pagelist = implode(",", $pagelist);
                $this->page_list($pagelist);
            }
        }
    }
    function PageList()
    {
        if (empty($this->page_list)) {
            return [];
        }
        if (is_string($this->page_list)) {
            return explode(",", $this->page_list);
        }
        return $this->page_list;
    }

	//auto generated
    public function Update($notLimit = false, $isShowMsg = true, $dontProcessIdWhereNotset = true)
    {
        $this->SetPageList();
        return parent::Update($notLimit, $isShowMsg, $dontProcessIdWhereNotset);
    }

    function Save(){
        $this->SetPageList();
	    return parent::Save();
	}


	 static function CreateDBTable(){
		$thisObj=new static();
		$table=$thisObj->db->prefix.$thisObj->tableName;
		if($thisObj->db->get_var("show tables like '{$table}'") != $table){
			$sql = "CREATE TABLE `{$table}` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `title` char(255) NOT NULL DEFAULT '',
					  `notification_body` text NOT NULL,
					  `notification_button_title` char(100) NOT NULL DEFAULT '',
					  `notification_link_title` text NOT NULL,
					  `notification_body_color` char(100) NOT NULL DEFAULT '',
					  `notification_button_color` char(100) NOT NULL DEFAULT '',
					  `notification_link_hover_color` char(100) NOT NULL DEFAULT '',
					  `notification_body_text_color` char(100) NOT NULL DEFAULT '',
					  `notification_button_text_color` char(100) NOT NULL DEFAULT '',
					  `body_button_text_size` char(100) NOT NULL DEFAULT '',
                      `body_height` char(100) NOT NULL DEFAULT '',
                      `notification_fixed_absolute` char(1) NOT NULL DEFAULT '',
					  `notification_type` char(1) NOT NULL DEFAULT '' COMMENT 'radio(H=Home Page,A=All Page,S=Specific Page,I=Hidden Page)',
					  `page_list` char(255) NOT NULL DEFAULT '',
					  `position` char(1) NOT NULL DEFAULT '' COMMENT 'radio(T=Top,B=Bottom,P=Popup)',
					  `view_style` char(100) NOT NULL DEFAULT '',
					  `status` char(1) NOT NULL DEFAULT '' COMMENT 'bool(A=Active,I=Inactive)',
					  `open_in_new_tab` char(1) NOT NULL DEFAULT '' COMMENT 'bool(Y=Yes,N=No)',
					  `display_in_sec` int(11) unsigned NOT NULL,
					  `display_animation` char(100) NOT NULL DEFAULT '',
					  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					  PRIMARY KEY (`id`)
					) ";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	 }
	 function DropDBTable() {
		 global $wpdb;
		
		 $table_name = $wpdb->prefix . $this->tableName;
		 $sql        = "DROP TABLE IF EXISTS $table_name;";
		 $sql        = esc_sql( $sql );
		 $wpdb->query( $sql );
	 }
/* add custom function here*/
    static function DeleteByID($value,$extraParam = [])
    {
        return parent::DeleteByKeyValue("id", $value, false, $extraParam);
    }

    /* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){

				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<div class="form-row">
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group col-sm">
		      	<label class="col-form-label" for="title"><?php $this->_ee("Title"); ?></label>
		      	 <input  class="form-control form-control-sm" type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("title");?>" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php $this->_ee("Title");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Title");?>">
		      </div>
		     <?php } ?>
                <?php if(!in_array("notification_button_title",$except)){ ?>
                    <div class="form-group col-sm">
                        <label class="col-form-label" for="notification_button_title"><?php $this->_ee("Button Title"); ?></label>
                        <input  class="form-control form-control-sm" type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("notification_button_title");?>" id="notification_button_title" <?php echo in_array("notification_button_title", $disabled)?' disabled="disabled" ':' name="notification_button_title" ';?>     placeholder="<?php $this->_ee("Notification Button Title");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Button Title");?>">
                    </div>
                <?php } ?>
                <?php if(!in_array("notification_link_title",$except)){ ?>
                    <div class="form-group col-sm">
                        <label class="col-form-label" for="notification_link_title"><?php $this->_ee("Button Link"); ?></label>
                        <input  class="form-control form-control-sm" type="text" maxlength=""   value="<?php echo  $mainobj->GetPostValue("notification_link_title");?>" id="notification_link_title" <?php echo in_array("notification_link_title", $disabled)?' disabled="disabled" ':' name="notification_link_title" ';?>     placeholder="<?php $this->_ee("ex. https://www.example.com");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Link Title");?>">
                    </div>
                <?php } ?>
            </div>
         <div class="form-row">
			<?php if(!in_array("notification_body",$except)){ ?>
			 <div class="form-group col-sm">
		      	<label class="col-form-label" for="notification_body"><?php $this->_ee("Body"); ?></label>
                 <textarea  class="form-control form-control-sm" type="text" maxlength="" id="notification_body" <?php echo in_array("notification_body", $disabled)?' disabled="disabled" ':' name="notification_body" ';?>     placeholder="<?php $this->_ee("Notification Body");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Body");?>"><?php echo  $mainobj->GetPostValue("notification_body");?></textarea>
		      </div>
		     <?php } ?>
            </div>
			<div class="form-row">
			<?php if(!in_array("notification_body_color",$except)){ ?>
			 <div class="form-group col-sm">
		      	<label class="col-form-label" for="notification_body_color"><?php $this->_ee("Body Color"); ?></label>
		      	 <input  class="form-control form-control-sm app-color-picker" type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("notification_body_color");?>" id="notification_body_color" <?php echo in_array("notification_body_color", $disabled)?' disabled="disabled" ':' name="notification_body_color" ';?>     placeholder="<?php $this->_ee("Notification Body Color");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Body Color");?>">
		      </div>
		     <?php } ?>
                <?php if(!in_array("notification_body_text_color",$except)){ ?>
                    <div class="form-group col-sm">
                        <label class="col-form-label" for="notification_body_text_color"><?php $this->_ee("Body Text Color"); ?></label>
                        <input  class="form-control form-control-sm app-color-picker" type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("notification_body_text_color");?>" id="notification_body_text_color" <?php echo in_array("notification_body_text_color", $disabled)?' disabled="disabled" ':' name="notification_body_text_color" ';?>     placeholder="<?php $this->_ee("Notification Body Text Color");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Body Text Color");?>">
                    </div>
                <?php } ?>
			<?php if(!in_array("notification_button_color",$except)){ ?>
			 <div class="form-group col-sm">
		      	<label class="col-form-label" for="notification_button_color"><?php $this->_ee("Button Color"); ?></label>
		      	 <input  class="form-control form-control-sm app-color-picker" type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("notification_button_color");?>" id="notification_button_color" <?php echo in_array("notification_button_color", $disabled)?' disabled="disabled" ':' name="notification_button_color" ';?>     placeholder="<?php $this->_ee("Notification Button Color");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Button Color");?>">
		      </div>
		     <?php } ?>
                <?php if(!in_array("notification_button_text_color",$except)){ ?>
                    <div class="form-group col-sm">
                        <label class="col-form-label" for="notification_button_text_color"><?php $this->_ee("Button Text Color"); ?></label>
                        <input  class="form-control form-control-sm app-color-picker" type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("notification_button_text_color");?>" id="notification_button_text_color" <?php echo in_array("notification_button_text_color", $disabled)?' disabled="disabled" ':' name="notification_button_text_color" ';?>     placeholder="<?php $this->_ee("Notification Button Text Color");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Button Text Color");?>">
                    </div>
                <?php } ?>
			<?php if(!in_array("notification_link_hover_color",$except)){ ?>
			 <div class="form-group col-sm">
		      	<label class="col-form-label" for="notification_link_hover_color"><?php $this->_ee("Link Hover Color"); ?></label>
		      	 <input  class="form-control form-control-sm app-color-picker" type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("notification_link_hover_color");?>" id="notification_link_hover_color" <?php echo in_array("notification_link_hover_color", $disabled)?' disabled="disabled" ':' name="notification_link_hover_color" ';?>     placeholder="<?php $this->_ee("Notification Link Hover Color");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Link Hover Color");?>">
		      </div>
		     <?php } ?>
            </div>
         <div class="form-row">
			<?php if(!in_array("notification_type",$except)){ ?>
			 <div class="form-group col-sm-8">
		      	<label class="col-form-label" for="notification_type"><?php $this->_ee("Notification Type"); ?></label>
		      	 <div class="form-row">
			        <?php
			            $notification_type_selected= $mainobj->GetPostValue("notification_type","H");
			            $notification_type_isDisabled=in_array("notification_type", $disabled);
			            APBD_GetHTMLRadioByArray("Notification Type","notification_type","notification_type",true,$mainobj->GetPropertyOptions("notification_type"),$notification_type_selected,$notification_type_isDisabled,false,"has_depend_fld");
			            ?>
			       </div>
		      </div>
		     <?php } ?>
                <?php if(!in_array("position",$except)){ ?>
                    <div class="form-group col-sm">
                        <label class="col-form-label" for="position"><?php $this->_ee("Position"); ?></label>
                        <div class="form-row">
                            <?php
                            $app_chat_pattern_selected= $mainobj->GetPostValue("position","T");
                            $app_wg_pos_option = [
                                "T"  => '<div class="apbd-rdo-container"><img src="' . plugins_url( 'images/positions/left-top.jpg', $this->pluginFile ) . '"/>'.$this->__('Top').'</div>',
                                "B"  => '<div class="apbd-rdo-container "><img src="' . plugins_url( 'images/positions/left-middle.jpg', $this->pluginFile ) . '"/>'.$this->__('Bottom').'</div>',
                                ];
                            APBD_GetHTMLRadioBoxByArray("Position","position","position",true,$app_wg_pos_option,$app_chat_pattern_selected,false,'','has_depend_fld bg-green');
                            ?>
                        </div>
                    </div>
                <?php } ?>
			</div>
			<div class="form-row">
                <?php if(!in_array("page_list",$except)){
                    $page_list_value=APBD_PostValue("page_list",$mainobj->PageList());
                    ?>
                    <div class="form-group col-sm fld-notification-type fld-notification-type-i fld-notification-type-s">
                        <label class="col-form-label" for="page_list"><?php $this->_ee("Page List"); ?></label>
                        <select multiple class="custom-select app-select-picker form-control-sm" id="page_list" <?php echo in_array("page_list", $disabled)?' disabled="disabled" ':' name="page_list[]" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Page List");?>">
                            <option  value=""><?php $this->_e("Select"); ?></option>
                            <?php
                            $pages=get_pages();
                           foreach ($pages as $page) {
                              // $page=new WP_Post()
                               ?>
                               <option <?php echo in_array($page->ID,$page_list_value)?' selected ':''; ?>  value="<?php echo $page->ID ?>"><?php echo $page->post_title; ?></option>
                               <?php
                            }
                           ?>
                           </select>
                    </div>
                <?php } ?>
                <?php if(!in_array("view_style",$except)){ ?>
                    <div hidden class="form-group col-sm">
                        <label class="col-form-label" for="view_style"><?php $this->_ee("View Style"); ?></label>
                        <select class="custom-select app-select-picker form-control-sm" id="view_style" <?php echo in_array("view_style", $disabled)?' disabled="disabled" ':' name="view_style" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","View Style");?>">
                            <option  value=""><?php $this->_e("Select"); ?></option>
                            <option  value="faheem"><?php $this->_e("Select1"); ?></option>
                            <option  value="tats"><?php $this->_e("Select2"); ?></option>
                            <option  value="tuts"><?php $this->_e("Select3"); ?></option>
                        </select>
                    </div>
                <?php } ?>
			</div>
         <div class="form-row">
             <?php if(!in_array("status",$except)){ ?>
                 <div class="form-group col-sm">
                     <label class="col-form-label" for="status"><?php $this->_ee("Status"); ?></label>
                     <?php
                     APBD_GetHTMLSwitchButton("status","status","I","A",$mainobj->GetPostValue("status"));
                     ?>
                 </div>
             <?php } ?>
         </div>
         <?php
	}
}
