<?php
/**
* @package PayscaleCalculator
**/
/*
Plugin Name: Payscale Calculator
Text Domain: payscale-calculator
*/

if(!defined('ABSPATH')) {
  die;
}

class PayscaleCalculator {

  function __construct() {

  }

  function register() {
    add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
  }

  function activate(){
    //create custom data tables
    $this->custom_data_tables();
    flush_rewrite_rules();
  }

  function deactivate(){
    // temp drop tables only for dev
    global $wpdb;
    $wpdb->query('DROP TABLE IF EXISTS wp_Software_Prices');
    $wpdb->query('DROP TABLE IF EXISTS wp_Software_Ranges');
    $wpdb->query('DROP TABLE IF EXISTS wp_Software_Options');
    $wpdb->query('DROP TABLE IF EXISTS wp_Software_Groups');
    $wpdb->query('DROP TABLE IF EXISTS wp_Software');
    flush_rewrite_rules();
  }

  function uninstall(){
    //remove custom tables from DB
  }

  function custom_data_tables() {
    createDataTables();
  }

  function enqueue() {
    wp_enqueue_style('payscale_calculator_style', plugins_url('/assets/admin_styles.css', __FILE__));
    wp_enqueue_script('payscale_calculator_script', plugins_url('/assets/scripts.js', __FILE__));
  }

}

if( class_exists('PayscaleCalculator')) {
  $payscaleCalculator = new PayscaleCalculator();
  $payscaleCalculator->register();
}

//activation
register_activation_hook( __FILE__, array($payscaleCalculator, 'activate'));

//deactivation
register_deactivation_hook( __FILE__, array($payscaleCalculator, 'deactivate'));


function createDataTables() {
  global $wpdb;

  $wpdb->show_errors();

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

   $table_sw = $wpdb->prefix . "Software";
     $sql_sw = "CREATE TABLE  $table_sw  (
     id int(20) unsigned NOT NULL AUTO_INCREMENT,
     name nvarchar(50) NOT NULL,
     crowdCuts char(1) NOT NULL,
     PRIMARY KEY  (id)
   ) COLLATE utf8_general_ci";
   dbDelta($sql_sw);

  $table_sw_groups = $wpdb->prefix . "Software_Groups";
    $sql_sw_groups = "CREATE TABLE $table_sw_groups (
    id int(20) unsigned NOT NULL AUTO_INCREMENT,
    softwareID int(20) unsigned NOT NULL,
    name nvarchar(100) NOT NULL,
    isMulti char(1) NOT NULL,
    PRIMARY KEY  (id),
    KEY par_id (softwareID)
   ) COLLATE utf8_general_ci";
   dbDelta($sql_sw_groups);

  // Alter table link
   $sql = "ALTER TABLE $table_sw_groups ADD FOREIGN KEY (softwareID) REFERENCES $table_sw(id)
      ON DELETE CASCADE;";
   $wpdb->query($sql);

  $table_sw_options = $wpdb->prefix . "Software_Options";
    $sql_sw_options = "CREATE TABLE  $table_sw_options  (
      id int(20) unsigned NOT NULL AUTO_INCREMENT,
      groupID int(20) unsigned NOT NULL,
      name nvarchar(100) NOT NULL,
      PRIMARY KEY  (id),
      KEY par_id (groupID)
     ) COLLATE utf8_general_ci";
     dbDelta($sql_sw_options);

   $sql = "ALTER TABLE $table_sw_options ADD FOREIGN KEY (groupID) REFERENCES $table_sw_groups(id)
      ON DELETE CASCADE;";
   $wpdb->query($sql);

    $table_sw_ranges = $wpdb->prefix . "Software_Ranges";
      $sql_sw_ranges = "CREATE TABLE  $table_sw_ranges  (
        id int(20) unsigned NOT NULL AUTO_INCREMENT,
        softwareID int(20) unsigned NOT NULL,
        name nvarchar(100) NOT NULL,
        corePrice int(20) NOT NULL,
        start int(10) NULL,
        stop int(10) NULL,
        PRIMARY KEY  (id),
        KEY par_id (softwareID)
       ) COLLATE utf8_general_ci";
       dbDelta($sql_sw_ranges);

     $sql = "ALTER TABLE $table_sw_ranges ADD FOREIGN KEY (softwareID) REFERENCES $table_sw(id)
        ON DELETE CASCADE;";
     $wpdb->query($sql);

   $table_sw_prices = $wpdb->prefix . "Software_Prices";
     $sql_sw_prices = "CREATE TABLE  $table_sw_prices  (
       id int(20) unsigned NOT NULL AUTO_INCREMENT,
       optionID int(20) unsigned NOT NULL,
       rangeID int(20) unsigned NOT NULL,
       emloyeesStart int(10) NULL,
       emloyeesStop int(10) NULL,
       price int(20) NOT NULL,
       PRIMARY KEY  (id),
       KEY par_id (rangeID)
      ) COLLATE utf8_general_ci";
      dbDelta($sql_sw_prices);

      $sql = "ALTER TABLE $table_sw_prices ADD FOREIGN KEY (optionID) REFERENCES $table_sw_options(id)
         ON DELETE CASCADE;";
      $wpdb->query($sql);

      $sql = "ALTER TABLE $table_sw_prices ADD FOREIGN KEY (rangeID) REFERENCES $table_sw_ranges(id)
         ON DELETE CASCADE;";
      $wpdb->query($sql);
}

function my_save_error()
{
    file_put_contents(dirname(__file__).'/error_activation.txt', ob_get_contents());
}
add_action('activated_plugin','my_save_error');
