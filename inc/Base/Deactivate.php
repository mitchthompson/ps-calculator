<?php
/**
* @package PricingCalculator
**/

namespace Inc\Base;

class Deactivate {

  //removes custom tables from DB. only for dev. this will be removed and only happen on plugin removal
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
