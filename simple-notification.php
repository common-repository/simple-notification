<?php
/*
Plugin Name: Simple Notification
Plugin URI: https://www.appsbd.com/product/simple-notification
Description: Sale promotion notification
Version: 1.3
Author: Appsbd
Author URI: https://appsbd.com
Slug: simple-notification
Text Domain: simple-notification
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/




include_once 'core/helper_lite.php';
include_once 'appcore/plugin_helper.php';
include_once 'appcore/APBD_Simple_Notification_base.php';
$appAPBD_Simple_Notification = new APBD_Simple_Notification_base(__FILE__, "1.3");


$appAPBD_Simple_Notification->StartPlugin();