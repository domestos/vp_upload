<?php

/*
Plugin Name: Vp Upload Plugin
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: varenik
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

include_once ( __DIR__."/function.php");

register_activation_hook(__FILE__, 'activation_vp_upload_plugin');
register_deactivation_hook(__FILE__, 'deactivation_vp_upload_plugin');
register_uninstall_hook(__FILE__, 'uninstall_vp_upload_plugin');


?>