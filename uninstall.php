<?php

/**
* Trigger this file on plugin uninstall
*
* @package PayscaleCalculator
**/

if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

// drop custom data tables
global $wpdb;
$wpdb->query('DROP TABLE IF EXISTS wp_Software_Prices');
$wpdb->query('DROP TABLE IF EXISTS wp_Software_Ranges');
$wpdb->query('DROP TABLE IF EXISTS wp_Software_Options');
$wpdb->query('DROP TABLE IF EXISTS wp_Software_Groups');
$wpdb->query('DROP TABLE IF EXISTS wp_Software');
flush_rewrite_rules();
