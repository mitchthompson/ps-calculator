<?php
/**
* @package PayscaleCalculator
**/

class PayscaleCalculatorDeactivate {

  function __construct(){

  }

  public static function deactivate(){
    global $wpdb;
    $wpdb->query('DROP TABLE IF EXISTS wp_Software_Prices');
    $wpdb->query('DROP TABLE IF EXISTS wp_Software_Ranges');
    $wpdb->query('DROP TABLE IF EXISTS wp_Software_Options');
    $wpdb->query('DROP TABLE IF EXISTS wp_Software_Groups');
    $wpdb->query('DROP TABLE IF EXISTS wp_Software');
    flush_rewrite_rules();
  }

}
