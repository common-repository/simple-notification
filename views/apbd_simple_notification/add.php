
<?php
	/** @var Apbd_simple_notification $this */
    if(empty($mainobj)){
        $mainobj=new Mapbd_simple_notification();
        $this->AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except=[];
    	$disabled=[];
    }*/
?>
<div class="clearfix form pb-3">
    <div class="form-row">
        <?php if(!in_array("title",$except)){ ?>
            <div class="form-group col-sm">
                <label class="col-form-label" for="title"><?php $this->_ee("Title"); ?></label>
                <input  class="form-control form-control-sm" type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("title");?>" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php $this->_ee("Title");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Title");?>">
            </div>
        <?php } ?>
        <div class="form-group col-sm-9">
            <label class="col-form-label" for="notification_button_title"><?php $this->_ee("Button Setup"); ?></label>

            <div class="input-group input-group-sm">
                <input  class="form-control form-control-sm col-sm-4" type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("notification_button_title");?>" id="notification_button_title" <?php echo in_array("notification_button_title", $disabled)?' disabled="disabled" ':' name="notification_button_title" ';?>     placeholder="<?php $this->_ee("Button Text");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Button Title");?>">

                <input  class="form-control form-control-sm col-sm " type="text" maxlength=""   value="<?php echo  $mainobj->GetPostValue("notification_link_title");?>" id="notification_link_title" <?php echo in_array("notification_link_title", $disabled)?' disabled="disabled" ':' name="notification_link_title" ';?>     placeholder="<?php $this->_ee("Link ex. https://example.com");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Notification Link Title");?>">
                <div class="input-group-append col-sm-3 p-0">
                    <div class="input-group-text text-left">
                        <label for="open_in_new_tab"><?php $this->_e("New Tab") ; ?></label>
                        <?php
                        APBD_GetHTMLSwitchButton("open_in_new_tab","open_in_new_tab","N","Y",$mainobj->GetPostValue("open_in_new_tab"),false,'','bg-mat','material-switch-xs');
                        ?>
                    </div>
                </div>
            </div>
        </div>




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
        <?php if(!in_array("display_animation",$except)){ ?>
            <div class="form-group col-sm">
                <label class="col-form-label" for="display_animation"><?php $this->_ee("Display Animation"); ?></label>
                <div class="form-row apbd-app-box-radio-mr-1 nt-display-animation">
                    <?php
                    $anim_selected=  $mainobj->GetPostValue("display_animation","ape-jello");
                    $anim_list = [
                        'bounceIn',
                        'bounceInRight',
                        'fadeIn',
                        'fadeInLeft',
                        'fadeInRight',
                        'flipInX',
                        'flipInY',
                        'fadeInUp',
                        'zoomIn',
                        'slideInDown',
                        'slideInUp'

                    ];
                    $anim_options = [
                        "ape-none"  => '<div title="'.$this->__('None').'" class="apbd-rdo-container ape-animated-pr-hover"><div class="i-container"><span class=" pr-animated ape-none"></span><i class="fas fa-bars"></i></div><div>'.$this->__('None').'</div></div>',
                       ];
                    foreach ($anim_list as $anim_item) {
                        $anim_options['ape-'.$anim_item] = '<div title="'.$anim_item.'" class="apbd-rdo-container ape-animated-pr-hover"><div class="i-container"><span class=" pr-animated ape-'.$anim_item.'"></span><i class="fas fa-bars"></i></div><div>'.$anim_item.'</div></div>';

                    }
                    APBD_GetHTMLRadioBoxByArrayWithCols("row","col-sm-1 pr-1 pl-0 pb-1","Display Animation","display_animation","display_animation",true,$anim_options,$anim_selected);
                    ?>
                </div>
            </div>
        <?php } ?>

    </div>
    <div class="form-row">
        <div class="form-group col-sm-3">
            <label for="body_button_text_size" class="col-form-label">
                <?php $this->_e("Body Text Size");?>
            </label>
                <div class="app-slider-input">
                    <input type="range" name="body_button_text_size" min="12" max="60" data-format="apd_value_format" data-unit="px"  value="<?php echo $mainobj->GetPostValue("body_button_text_size",12);?>" id="body_button_text_size" <?php echo in_array("body_button_text_size", $disabled)?' disabled="disabled" ':' name="body_button_text_size" ';?>   data-bv-notempty="true">
                </div>
        </div>
        <div class="form-group col-sm-6">
            <label for="body_height" class="col-form-label">
                <?php $this->_e("Notification Body Height");?>
                <small  class="text-info">(<?php $this->_e("value 0, means auto height") ; ?>)</small>
            </label>
                <div class="app-slider-input">
                    <input type="range" name="body_height" min="0" max="200" data-format="apd_value_format" data-unit="px"  value="<?php echo $mainobj->GetPostValue("body_height",0); ?>" id="body_height" <?php echo in_array("body_height", $disabled)?' disabled="disabled" ':' name="body_height" ';?>   data-bv-notempty="true">
                </div>
        </div>
        <div class="form-group col-sm-3">
            <label for="display_in_sec" class="col-form-label">
                <?php $this->_e("Display Delay");?>
            </label>
                <div class="app-slider-input">
                    <input type="range" name="display_in_sec" min="0" max="60" data-format="apd_value_format" data-unit="sec"  value="<?php echo $mainobj->GetPostValue("display_in_sec",0); ?>" id="display_in_sec" <?php echo in_array("display_in_sec", $disabled)?' disabled="disabled" ':' name="display_in_sec" ';?>   data-bv-notempty="true">
                </div>
        </div>
    </div>
    <div class="form-row">
        <?php if(!in_array("notification_type",$except)){ ?>
            <div class="form-group col-sm-8">
                <label class="col-form-label" for="notification_type"><?php $this->_ee("Notification Type"); ?></label>
                <div class="form-row">
                    <?php
                    $notification_type_selected= $mainobj->GetPostValue("notification_type","H");
                    $notification_type_isDisabled= [
                        "H"  => '<div class="apbd-rdo-container"><img src="' . plugins_url( 'images/positions/fillter-home.jpg', $this->pluginFile ) . '"/>'.$this->__('Home Page').'</div>',
                        "A"  => '<div class="apbd-rdo-container "><img src="' . plugins_url( 'images/positions/fillter-all-page.jpg', $this->pluginFile ) . '"/>'.$this->__('All Page').'</div>',
                        "S"  => '<div class="apbd-rdo-container "><img src="' . plugins_url( 'images/positions/fillter-specific.jpg', $this->pluginFile ) . '"/>'.$this->__('Specific Page').'</div>',
                        "I"  => '<div class="apbd-rdo-container "><img src="' . plugins_url( 'images/positions/fillter-hidden.jpg', $this->pluginFile ) . '"/>'.$this->__('Exclude Page').'</div>',
                    ];
                    APBD_GetHTMLRadioBoxByArray("Notification Type","notification_type","notification_type",true,$notification_type_isDisabled,$notification_type_selected,false,'','has_depend_fld bg-green');
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
                        "T"  => '<div class="apbd-rdo-container"><img src="' . plugins_url( 'images/positions/position-top.jpg', $this->pluginFile ) . '"/>'.$this->__('Top').'</div>',
                        "B"  => '<div class="apbd-rdo-container "><img src="' . plugins_url( 'images/positions/position-bottom.jpg', $this->pluginFile ) . '"/>'.$this->__('Bottom').'</div>',
                    ];
                    APBD_GetHTMLRadioBoxByArray("Position","position","position",true,$app_wg_pos_option,$app_chat_pattern_selected,false,'','has_depend_fld bg-green');
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="form-row mb-3">
        <?php if(!in_array("page_list",$except)){
            $page_list_value=APBD_PostValue("page_list",$mainobj->PageList());
            ?>
            <div class="form-group col-sm fld-notification-type fld-notification-type-i fld-notification-type-s">
                <label class="col-form-label" for="page_list"><?php $this->_ee("Page List"); ?></label>
                <select data-allow-clear="true" data-placeholder="<?php $this->_e("Select Page List") ; ?>" multiple="multiple"  class="form-control app-select2-picker " id="page_list" <?php echo in_array("page_list", $disabled)?' disabled="disabled" ':' name="page_list[]" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php   $this->_ee("%s is required","Page List");?>">
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
    </div>
    <div class="form-row">
        <?php if(!in_array("notification_fixed_absolute",$except)){
            ?>
            <div class="form-group col-sm-3 fld-position fld-position-t">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="notification_fixed_absolute" ><?php $this->_ee("Is Fixed"); ?>?</label>
                    </div>
                    <div class="form-control form-control-sm">
                        <?php
                        APBD_GetHTMLSwitchButton("notification_fixed_absolute","notification_fixed_absolute","A","F",$mainobj->GetPostValue("notification_fixed_absolute"));
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if(!in_array("status",$except)){ ?>
            <div class="form-group col-sm-3">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="status" ><?php $this->_ee("Status"); ?></label>
                    </div>
                    <div class="form-control form-control-sm">
                        <?php
                        APBD_GetHTMLSwitchButton("status","status","I","A",$mainobj->GetPostValue("status"));
                        ?>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>
</div>
<div class="btn-group-md popup-footer text-right">
    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> <?php echo $isUpdateMode?$this->__("Update"):$this->__("Save"); ?></button>
    <button type="button" class="close-pop-up btn btn-sm  btn-danger"><i class="fa fa-times"></i> <?php $this->_e("Cancel"); ?></button>
</div>
