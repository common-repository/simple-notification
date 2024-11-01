<?php 
		/** @var AppsBDBaseModule $this */
$grid=new jQGrid();
$grid->url =$this->GetActionUrl("data");;
$grid->width = "auto";
//$grid->minWidth=500;
$grid->height = "auto";
$grid->rowNum = 20;
$grid->pager = "#pagerb";
$grid->container = "#".$this->GetModuleId()." .grid-body";;
$grid->ShowReloadButtonInTitle=true;
$grid->ShowDownloadButtonInTitle=true;
//$grid->shrinkToFit=false;
$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.$this->GetActionUrl("add").'" ><i class="fa fa-plus"></i>'.$this->__('Add New').'</a>');

//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
$grid->AddModelNonSearchable("Title", "title", 100 ,"center");
$grid->SetXSCombindeField("title");
$grid->AddModelNonSearchable("Body Title", "notification_body", 100 ,"center");
$grid->AddModelNonSearchable("Button Title", "notification_button_title", 100 ,"center");
$grid->AddModelNonSearchable("Link Title", "notification_link_title", 100 ,"center");
$grid->AddModelNonSearchable("Body Color", "notification_body_color", 100 ,"center");
$grid->AddModelNonSearchable("Button Color", "notification_button_color", 100 ,"center");
$grid->AddModelNonSearchable("Link Hover Color", "notification_link_hover_color", 100 ,"center");
$grid->AddModelNonSearchable("Body Text Color", "notification_body_text_color", 100 ,"center");
$grid->AddModelNonSearchable("Button Text Color", "notification_button_text_color", 100 ,"center");
$grid->AddModelNonSearchable("Type", "notification_type", 100 ,"center");
$grid->AddModelNonSearchable("Page List", "page_list", 100 ,"center");
$grid->AddModelNonSearchable("Position", "position", 100 ,"center");
$grid->AddModelNonSearchable("View Style", "view_style", 100 ,"center");
$grid->AddModelNonSearchable("Status", "status", 100 ,"center");
$grid->DisableAutoInit();

$grid->AddModelNonSearchable("Action", "action", 100 ,"center");

?>
<div class="card apsbd-default-card">
    <div class="card-header"><i class="app-mod-icon <?php echo $this->GetMenuIcon(); ?>"></i> <?php echo $this->GetMenuTitle(); ?></div>
    <div class="card-body p-3 grid-body" style="min-height: 335px;">
	    <?php $grid->show();
        ?>
    </div>
</div>
<script type="text/javascript">
 APPSBDAPPJS.core.AddOnOnTabActive("<?php echo $this->GetModuleId() ?>",<?php echo $grid->ResizeMethod(); ?>);
 APPSBDAPPJS.core.AddOnOnTabActive("<?php echo $this->GetModuleId() ?>",function(){
     <?php echo $grid->GetInitMethod(); ?>();
 });

 (function($) {
     "use strict";

 })(jQuery);

</script>
