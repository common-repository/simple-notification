<?php 
		/** @var Apbd_simple_notification $this */

$this->GetActionUrl("data");

?>
<div class="row">
    <div class="col-sm app-custom-data-list">
        <div class="card apsbd-default-card">
            <div class="card-header"><i class="app-mod-icon <?php echo $this->GetMenuIcon(); ?>"></i> <?php $this->_e("Notification List") ; ?>
                <a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-success float-right ml-1" href="<?php echo $this->GetActionUrl("add") ?>" ><i class="fa fa-plus"></i><?php echo $this->__('Add New')?></a>
                <button id="apbd-btn-reload-data" type="button" class="btn btn-xs btn-info float-right"><?php $this->_e("Reload") ; ?></button>
            </div>
            <div id="apbd-noti-container" class="card-body p-3">
            
            </div>
        </div>
    </div>
    <div class="col-sm-4 pl-sm-0">
        <form class="apbd-module-form <?php echo $this->getFormClass(); ?>"
              role="form"
              id="<?php echo $this->GetMainFormId(); ?>"
              action="<?php echo $this->GetActionUrl( "" ); ?>"
              method="post">

        <div class="card apsbd-default-card">
            <div class="card-header">
                <i class="fa fa-cog mr-1"></i><?php $this->_e("Global Settings") ; ?>
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="status" ><?php $this->_ee("Hide in session on close"); ?></label>
                        </div>
                        <div class="form-control form-control-sm">
                            <?php
                            APBD_GetHTMLSwitchButton("hide_on_session","hide_on_session","N","Y",$this->GetOption("hide_on_session"));
                            ?>

                        </div>

                    </div>
                    <span class="form-text text-muted"><?php _e("If you enable it then, if visitor close a notification then, that notification won't show again on that session ") ; ?></span>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-sm"><?php $this->_e("Save") ; ?></button>
            </div>
        </div>
        </form>
    </div>
</div>

<script type="text/javascript">
(function($) {
        "use strict";
        $( document ).ready(function( $ ) {
           $("#apbd-btn-reload-data").on("click",function(e){
               e.preventDefault();
               apbd_noti_LoadNotificationList();
           })
        });
        APPSBDAPPJS.core.AddOnCloseLightbox(apbd_noti_LoadNotificationList);

        function getItemByObject(itemObj,index){
            var item_container=$('<div class="apbd-simple-noti-item-container"></div>');
            var item=$('<div class="apbd-simple-noti-item">\n' +
                '                    \n' +
                '                     <div class="apbd-noti-actions action-left">\n' +
                '                     </div>\n' +
                '                     <div class="apbd-noti-actions">\n' +
                '                     </div>\n' +
                '                </div>');


            var btn=$('<a class="noti-btn"></a>');
            btn.attr('target',itemObj.open_in_new_tab=='Y'?'_blank':'');
            btn.attr('href',itemObj.notification_link_title);
            btn.css({'background':itemObj.notification_button_color,'color':itemObj.notification_button_text_color});
            btn.text(itemObj.notification_button_title);

            var slNum=$('<div class="noti-sl-number"></div>').html(index);
            var slMsg=$('<div class="noti-full-msg"></div>');
            slMsg.append(itemObj.notification_body);
            slMsg.append(btn);

            item.prepend(slMsg);
            item.prepend(slNum);
            // item.prepend('<div>Last Update:11-02-2021</div>');
            //item.prepend(itemObj.notification_body);
            item.css({'background':itemObj.notification_body_color,'color':itemObj.notification_body_text_color})
            item.find('.apbd-noti-actions:not(.action-left)').html(itemObj.action);
            item.find('.apbd-noti-actions.action-left').html(itemObj.info_data);
            var statusInputContainer=$('<div class="material-switch material-switch-sm ">\n' +
                '            <input class="" id="noti-status-'+itemObj.id+'" name="status" type="checkbox" value="A">\n' +
                '            <label for="noti-status-'+itemObj.id+'" class="bg-mat"></label>\n' +
                '            </div>');

            var statusInput=statusInputContainer.find('>input[type=checkbox]:first-child')
                .on("change",function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    try {
                        var $thisObj = $(this);
                        var $isChecked=$thisObj.is(":checked");
                        var msg = $isChecked ?  "<?php $this->_ee("Are you sure to %s?", "active"); ?>":"<?php $this->_ee("Are you sure to %s?", "inactive"); ?>" ;
                        var url = "<?php echo $this->GetActionUrl("status_change");?>" + "&id=" + itemObj.id;

                        APPSBDAPPJS.notification.ConfirmAlert(msg,function(isConfirm){
                            if(isConfirm) {
                                APPSBDAPPJS.confirmAjax.process_confirm_ajax($thisObj, url);
                            }else{
                                $thisObj.prop("checked",!$isChecked);
                                swal.close();
                            }
                        },true);
                    }catch (ex) {
                        console.log(ex.message);
                    }

                });
            statusInput.prop('checked',itemObj.status=='A');

            var itemStatus=$('<div class="noti-active-status"></div>');
            itemStatus.append(statusInputContainer);
            item_container.append(itemStatus);
            item_container.append(item);
            return item_container;
        }
        //url,data,beforeSend,Success,JSONData,Complete
        function apbd_noti_LoadNotificationList(){
            var container=$("#apbd-noti-container");

            APPSBDAPPJS.core.CallMyAjax("<?php echo $this->GetActionUrl("data"); ?>",null,function(){
                //before send
                container.closest('.app-custom-data-list').addClass('form-loader');
            },function(rdata){
                //success
                try {
                    container.html('');
                    if(rdata.total==0 || rdata.rowdata.length==0){
                        container.append('<div class="text-center text-danger text-bold"><?php $this->_ee("No notification added") ?></div>');
                    }
                    $.each(rdata.rowdata,function(i,v){
                        container.append(getItemByObject(v,i+1));
                    });
                    APPSBDAPPJS.core.CallOnLoadGridData();
                    APPSBDAPPJS.lightbox.SetLightbox();
                }catch(e){
                    console.log(e.message);
                }
            },true,function(){
                //complete
                container.closest('.app-custom-data-list').removeClass('form-loader');
            });
        }
        APPSBDAPPJS.core.AddOnOnTabActive("<?php echo $this->GetModuleId() ?>",function(){
            apbd_noti_LoadNotificationList();
        });
    })(jQuery);
</script>
