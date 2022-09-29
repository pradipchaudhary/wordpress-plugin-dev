<?php
/**
 * Plugin Name: Ads Manages
 * Plugin URI: https://www.myplugin.com
 * Description: Plugin Description
 * Version: 1.0.0
 * Author: myplugin
 * Author URI: https://www.myplugin.com
 * Requires at least: 5.5.1
 * Tested up to: 5.5.1
 */

// echo plugins_url(); die;
 define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
 define("PLUGIN_URL", plugins_url());
 define("PLUGIN_VERSION", "1.0");

if ( !defined( 'ABSPATH' ) ) exit;

// wp_enqueue_media();

// 


// Plugin Active function 
function active_plugin()
{      
  global $wpdb; 
  $db_table_name = $wpdb->prefix . 'adsmanage';  // table name
  $charset_collate = $wpdb->get_charset_collate();

 //Check to see if the table exists already, if not, then create it
if($wpdb->get_var( "show tables like '$db_table_name'" ) != $db_table_name ) 
 {
       $sql = "CREATE TABLE $db_table_name (
                id int(11) NOT NULL auto_increment,
                name varchar(60) NOT NULL,
                location varchar(200) NOT NULL,
                image varchar(500) NOT NULL,
                link varchar(500) NOT NULL,
                UNIQUE KEY id (id)
        ) $charset_collate;";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
   add_option( 'test_db_version', $test_db_version );
 }
} 


//Plugin Dactivate Plugin
function deactive_plugin() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'adsmanage'; //table name 
  $sql = "DROP TABLE IF EXISTS $table_name;";
  $wpdb->query($sql);
  delete_option("my_plugin_db_version");
}    


// Add Admin Menu
function ads_manage_menu(){
  // add_menu_page('Ads Manage', 'Ads Manage', 8, __FILE__, 'ads_data_list');
  add_menu_page('Ads Manage', 'Ads Manage', 'manage_options','wp-ads-manage-plugin', 'ads_data_list');
  // SubMenu 
  add_submenu_page('wp-ads-manage-plugin', 'List Ads', 'list Ads', 'manage_options', 'wp-ads-manage-plugin', 'ads_data_list');
  add_submenu_page('wp-ads-manage-plugin', 'Add Ads', 'Add Ads', 'manage_options', 'wp-ads-add', 'ads_data_add');
}
function ads_data_list(){
  include_once PLUGIN_DIR_PATH. '/views/list-ads.php';

  
}

function ads_data_add(){
  include_once PLUGIN_DIR_PATH. '/views/add-ads.php';
  // insert_ads();
}

// Plugin CSS File Includes 
function ads_plugin_assets(){
  wp_enqueue_style(
    "ads_css",
    PLUGIN_URL."/ads-manages/assets/css/ads_css.css",
    '',
    PLUGIN_VERSION
  );
  wp_enqueue_script(
    "ads_script",
    PLUGIN_URL."/ads-manages/assets/js/script.js",
    '',
    PLUGIN_VERSION,
    true
  );
}



// Action Hook 
register_activation_hook( __FILE__, 'active_plugin' );
register_deactivation_hook( __FILE__, 'deactive_plugin' );
register_uninstall_hook(__FILE__,'deactive_plugin' );
add_action('admin_menu', 'ads_manage_menu');
add_action("init", "ads_plugin_assets");



