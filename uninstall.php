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
$wpdb->query('DROP TABLE IF EXISTS wp_Software_Ranges');
