<?php
	/**
	 * @since: 07/09/2019
	 * @author: Sarwar Hasan
	 * @version 1.0.0
	 */
	class Apbd_notification_video extends AppsBDLiteModule
    {

        function initialize()
        {
            parent::initialize();
            // APBDAjaxMiniCart::GetInstance()->AddAdminNoticePlain($this->notice_body());
        }

        function OnInit()
        {
            parent::OnInit();
        }

        function GetMenuSubTitle()
        {
            return $this->__("Tutorials");
        }

        function GetMenuIcon()
        {
            return 'fas fa-video animated apf-pulse';
        }

        function GetMenuTitle()
        {
            return $this->__("Video");
        }

        function SettingsPage()
        {
            $this->Display();
        }

        public function GetMenuCounter()
        {
        }
    }