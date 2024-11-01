<?php
/**
 * @since: 23/Jan/2021
 * @author: Sarwar Hasan
 * @version 1.0.0
 */

class Apbd_simple_notification extends AppsBDLiteModule
{


    function initialize()
    {
        parent::initialize();
        $this->disableDefaultForm();
        $this->AddAjaxAction("add", [$this, "add"]);
        $this->AddAjaxAction("edit", [$this, "edit"]);
        $this->AddAjaxAction("delete_item", [$this, "delete_item"]);
        $this->AddAjaxAction("status_change", [$this, "status_change"]);
        $this->addTopMenu( "View Other Plugins", "ap ap-documentation",'https://appsbd.com' , "btn btn-success", false, [ "target" => "_blank"] );

    }
    public function OnActive() {
	    parent::OnActive();
	    Mapbd_simple_notification::CreateDBTable();
    }
	
	function OnInit()
    {
        parent::OnInit();
        add_action('wp_footer', [$this, 'simple_notification_display']);

    }
    public function ClientStyle()
    {
        parent::ClientStyle();
       // $this->AddClientStyle('apbd-simple-noti-custom-style', 'uilib/apbd-notification-style/style.css', true);
        $this->AddClientStyle('apbd-simple-noti-style', 'client_style.css');

    }

    function SettingsPage()
    {
        $this->SetTitle("Apbd Simple Notification List");
        $this->SetSubtitle("");
        $this->Display();
    }

    function GetMenuTitle()
    {
        return $this->__("Notification");
    }

    function GetMenuSubTitle()
    {
        return $this->__("View Notification List");
    }

    function GetMenuIcon()
    {
        return "far fa-bell";
    }

    function add()
    {
        $this->SetTitle("Add New Notification ");
        $this->SetPOPUPColClass("col-sm-8");

        if (APPSBD_IsPostBack) {
            $nobject = new Mapbd_simple_notification();
            if ($nobject->SetFromPostData(true)) {
                if ($nobject->Save()) {
                    $this->AddInfo("Successfully added");
                    APBD_AddLog("A", $nobject->settedPropertyforLog(), "l001", "");
                    $this->DisplayPOPUPMsg();
                    return;
                }
            }
        }
        $mainobj = new Mapbd_simple_notification();
        //$this->SetPopupFromMutipart();
        $this->AddViewData("isUpdateMode", false);
        $this->AddViewData("mainobj", $mainobj);
        $this->DisplayPOPUp("add");
    }

    function edit($param_id = "")
    {
        $this->SetPOPUPColClass("col-sm-8");

        $param_id = APBD_GetValue("id");
        if (empty($param_id)) {
            $this->AddError("Invalid request");
            $this->DisplayPOPUPMsg();
            return;
        }
        $this->SetTitle("Edit Notification");
        if (APPSBD_IsPostBack) {
            $uobject = new Mapbd_simple_notification();
            if ($uobject->SetFromPostData(false)) {
                file_put_contents(WP_CONTENT_DIR . "/post.log", print_r($uobject, true));
                $uobject->SetWhereUpdate("id", $param_id);
                if ($uobject->Update()) {
                    APBD_AddLog("U", $uobject->settedPropertyforLog(), "l002", "");
                    $this->AddInfo("Successfully updated");
                    $this->DisplayPOPUPMsg();
                    return;
                }
            }
        }
        $mainobj = new Mapbd_simple_notification();
        $mainobj->id($param_id);
        if (!$mainobj->Select()) {
            $this->AddError("Invalid request");
            $this->DisplayPOPUPMsg();
            return;
        }
        APBD_OldFields($mainobj, "title,notification_body_title,notification_button_title,notification_link_title,notification_body_color,notification_button_color,notification_link_hover_color,notification_body_text_color,notification_button_text_color,body_button_text_size,body_height,notification_fixed_absolute,notification_type,display_animation,page_list,position,view_style,status");
        //$this->SetPopupFromMutipart();
        $this->AddViewData("mainobj", $mainobj);
        $this->AddViewData("isUpdateMode", true);
        $this->DisplayPOPUP("add");
    }


    function data()
    {
        $mainResponse = new AppsbdAjaxDataResponse();
        $mainResponse->setDownloadFileName("apbd-simple-notification-list");
        $mainobj = new Mapbd_simple_notification();
        $mainResponse->setDateRange($mainobj);
        $records = $mainobj->CountALL($mainResponse->srcItem, $mainResponse->srcText, $mainResponse->multiparam, "after");
        if ($records > 0) {
            $mainResponse->SetGridRecords($records);
           // $mainResponse->setOrderByIfEmpty("position","DESC");
            //wp_apbd_simple_notification:id,title,notification_body_title,notification_button_title,notification_link_title,notification_body_color,notification_button_color,notification_link_hover_color,notification_body_text_color,notification_button_text_color,notification_type,page_list,position,view_style,status
            $result = $mainobj->SelectAllGridData("id,notification_body,notification_button_title,notification_link_title,notification_body_color,notification_button_color,notification_link_hover_color,notification_body_text_color,notification_button_text_color,notification_type,position,notification_fixed_absolute,open_in_new_tab,display_animation,status", $mainResponse->orderBy, $mainResponse->order, $mainResponse->rows, $mainResponse->limitStart, $mainResponse->srcItem, $mainResponse->srcText, $mainResponse->multiparam, "after");
            if ($result) {

                $status_change = $mainobj->GetPropertyOptionsTag("status");
                $notification_type_options = $mainobj->GetPropertyOptionsTag("notification_type");
                $position_options = $mainobj->GetPropertyRawOptions("position");

                foreach ($result as &$data) {
                    $data->action = "";
                    $data->action .= "<a data-effect='mfp-move-from-top' class='popupformWR' href='" . $this->GetActionUrl("edit", ["id" => $data->id]) . "'><i class='fas fa-pen'></i></a>";
                    $data->action .= " <a class='ConfirmAjaxWR action-danger'  data-msg='" . $this->__("Are you sure to delete?") . "' href='" . $this->GetActionUrl("delete_item", ["id" => $data->id]) . "'><i class='fas fa-trash'></i></a>";

                    //$data->status=" <a class='ConfirmAjaxWR' data-on-complete='APPSBDAPPJS.confirmAjax.ConfirmWRChange' data-msg='".$this->__("Are you sure to change?")."' href='" .$this->GetActionUrl("status_change",["id"=>$data->id])."'>".APBD_getTextByKey($data->status,$status_change)."</a>";

                    $data->notification_type = APBD_getTextByKey($data->notification_type, $notification_type_options);
                    $data->info_data =APBD_getTextByKey($data->position, $position_options) .( $data->position=='T' && $data->notification_fixed_absolute=="F"?" - Fixed":"");

                    unset($data->position);
                    unset($data->notification_fixed_absolute);
                }
            }
            $mainResponse->SetGridData($result);
        }
        $mainResponse->DisplayGridResponse();
    }


    function delete_item()
    {
        $mainResponse = new AppsbdAjaxConfirmResponse();
        $param = APBD_GetValue("id");
        if (empty($param)) {
            $mainResponse->DisplayWithResponse(false, __("Invalid Request"));
            return;
        }
        $mr = new Mapbd_simple_notification();
        $mr->id($param);
        if ($mr->Select()) {
            //$ur=new Mapbd_simple_notification();
            if (Mapbd_simple_notification::DeleteByID($param)) {
                APBD_AddLog("D", "id={$param}", "l003", "Wp_apbd_simple_notification_confirm");
                $mainResponse->DisplayWithResponse(true, __("Successfully deleted"));
            } else {
                $mainResponse->DisplayWithResponse(false, __("Delete failed try again"));
            }
        }
    }

    function status_change()
    {
        $param = APBD_GetValue("id");
        if (empty($param)) {
            $this->DisplayWithResponse(false, __("Invalid Request"));
            return;
        }
        $mainResponse = new AppsbdAjaxConfirmResponse();
        $mr = new Mapbd_simple_notification();
        $statusChange = $mr->GetPropertyOptionsTag("status");

        $mr->id($param);
        if ($mr->Select("status")) {
            $newStatus = $mr->status == "A" ? "I" : "A";
            $uo = new Mapbd_simple_notification();
            $uo->status($newStatus);
            $uo->SetWhereUpdate("id", $param);
            if ($uo->Update()) {
                $status_text = APBD_getTextByKey($uo->status, $statusChange);
                APBD_AddLog("U", $uo->settedPropertyforLog(), "l002", "Wp_apbd_simple_notification");
                $mainResponse->DisplayWithResponse(true, __("Successfully Updated"), $status_text);
            } else {
                $mainResponse->DisplayWithResponse(false, __("Update failed try again"));
            }

        }

    }

    // Notification in client side


    function simple_notification_display()
    {

        $a = new Mapbd_simple_notification();
        $a->status('A');

        $data = $a->SelectAll('','display_in_sec','ASC');
        $styles="";
        $finalJson=new stdClass();
        $finalJson->html='';
        $finalJson->items=[];


        foreach ($data as $noti_data) {
            $idkey=&$noti_data->id;
            ob_start();
            $pglist = [];
            if (!empty($noti_data->page_list)) {
                $pglist = explode(",", $noti_data->page_list);
            }
            if ($noti_data->notification_type != "A") {
                if ($noti_data->notification_type == "H" && !(is_home() || is_front_page())) {
                    continue;
                } elseif ($noti_data->notification_type == "S" && (empty($pglist) || !is_page($pglist))) {
                    continue;
                } elseif ($noti_data->notification_type == "I" && is_page($pglist)) {
                    continue;
                }
            }

            $isFixed=$noti_data->notification_fixed_absolute=='F';
            ?>
            <div id="id-<?php echo $idkey ?>" data-unid="<?php echo $idkey ?>" class="animated <?php echo $noti_data->display_animation; ?> apbd-simple-noti-item <?php echo ($noti_data->position=='B'?' apbd-noti-footer-bar ':($isFixed?' apbd-sn-pos-fixed ':'')); ?>"
                 style="<?php if($noti_data->body_height>10){ ?>height: <?php echo $noti_data->body_height; ?>px;<?php } ?>font-size:<?php echo $noti_data->body_button_text_size?>px; background:<?php echo $noti_data->notification_body_color ?>;color:<?php echo $noti_data->notification_body_text_color; ?>">
                <?php echo $noti_data->notification_body; ?>
                <a href="<?php echo $noti_data->notification_link_title ?>" target="<?php echo $noti_data->open_in_new_tab=='Y'?'_blank':'' ?>"
                   style="background-color: <?php echo $noti_data->notification_button_color ?>!important; color: <?php echo $noti_data->notification_button_text_color ?>"
                   class="noti-btn"><?php echo $noti_data->notification_button_title ?></a>
                <span class="apbd-rm-noti">&times;</span>
            </div>

            <?php   ob_start();
?>#id-<?php echo $idkey ?> a:hover{
 color:<?php  echo $noti_data->notification_link_hover_color; ?>;
}

<?php
            $styles.=ob_get_clean();
            $itemData=new stdClass();
            $itemData->html=ob_get_clean();
            $itemData->id=$noti_data->id;
            $itemData->delay_ms=$noti_data->display_in_sec*1000;
            $itemData->pos=$noti_data->position;


            if($noti_data->position=="T" && $noti_data->notification_fixed_absolute=="F"){
                $itemData->pos="TF";
            }elseif($noti_data->position=="T" && $noti_data->notification_fixed_absolute!="F"){
                $itemData->pos="T";
            }else{
                $itemData->pos="B";
            }
            $finalJson->items[]=$itemData;
        }
        ob_start();
        ?>
        <div id="apbd-sn-fixed-div"></div>
        <div id="apbd-sn-normal-div"></div>
        <div id="apbd-sn-fixed-footer"></div>
        <?php

        $finalJson->html = ob_get_clean();
        ?>

        <style type="text/css">
<?php echo $styles; ?>

        </style>
        <script type="text/javascript">
            (function($) {
                "use strict";
                <?php if($this->GetOption('hide_on_session','N')=="Y"){ ?>
                function _apbd_get_old_skip_list(){
                    var oldNlist=sessionStorage.getItem('apb_close_nlist');
                    if(!oldNlist){
                        oldNlist=[];
                    }else{
                        oldNlist=JSON.parse(oldNlist);
                    }
                    return oldNlist;
                }
                function _apbd_in_array(needle, haystack) {
                    for(var i in haystack) {
                        if(haystack[i] == needle) return true;
                    }
                    return false;
                }
                <?php } ?>
                var apbd_notification_msgs =<?php echo json_encode($finalJson); ?>;
                jQuery(document).ready(function ($) {
                    $('body').on("click", '.apbd-rm-noti', function (e) {
                        e.preventDefault();
                        var item=$(this).closest('.apbd-simple-noti-item ');
                        <?php if($this->GetOption('hide_on_session','N')=="Y"){ ?>
                        var oldNlist=_apbd_get_old_skip_list();
                        oldNlist.push(item.data('unid'));
                        sessionStorage.setItem('apb_close_nlist',JSON.stringify(oldNlist));
                        <?php } ?>
                        if(item.hasClass('apbd-sn-pos-fixed')){
                            var newPadding=parseInt($("body").css('padding-top'))- parseInt(item.outerHeight());
                        }
                        item.fadeOut();
                    });
                    var elems=$(apbd_notification_msgs.html);
                    $('body').prepend(elems);
                    var fixmeTop = $("#apbd-sn-fixed-div").offset().top;
                    $(window).scroll(function() {
                        var currentScroll = $(window).scrollTop();
                        if (currentScroll > fixmeTop) {
                            $("#apbd-sn-fixed-div").addClass('apbd-sn-on-scroll');
                        } else {
                            $("#apbd-sn-fixed-div").removeClass('apbd-sn-on-scroll');
                        }
                    });
                    <?php if($this->GetOption('hide_on_session','N')=="Y"){ ?>
                    var xkipList=_apbd_get_old_skip_list();
                    <?php } ?>

                    $.each(apbd_notification_msgs.items,function(i,v){
                       <?php if($this->GetOption('hide_on_session','N')=="Y"){ ?>
                       if(_apbd_in_array(v.id,xkipList)){
                           return;
                       }
                       <?php } ?>
                        if(v.pos=="TF"){
                            setTimeout(function(){
                                $("#apbd-sn-fixed-div").append(v.html);
                            },v.delay_ms);
                        }else if(v.pos=="T"){
                            setTimeout(function(){
                                $("#apbd-sn-normal-div").append(v.html);
                            },v.delay_ms);
                        }else if(v.pos=="B"){
                            setTimeout(function(){
                                $("#apbd-sn-fixed-footer").append(v.html);
                            },v.delay_ms);
                        }
                    });
                });
            })(jQuery);
        </script>
        <?php
    }

}