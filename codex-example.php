<?php

function jal_install() {
  global $wpdb;

// Is InnoDB available?
$have_innodb = $wpdb->get_results("SHOW VARIABLES LIKE 'have_innodb'", ARRAY_A);
$use_innodb = ($have_innodb[0]['Value'] == 'YES') ? 'ENGINE=InnoDB' : '';

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

// this if statement makes sure that the table doe not exist already if ($wpdb->get_var("SHOW TABLES LIKE " . self::$database['user']) != self::$database['user']) {
   $sql_user = "CREATE TABLE " . self::$database['user'] . " (
   id BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
   fp BIGINT UNSIGNED NOT NULL DEFAULT 1,
   PRIMARY KEY (id)
 ) COLLATE utf8_general_ci $use_innodb";
 dbDelta($sql_user);
}
 if ($wpdb->get_var("SHOW TABLES LIKE " . self::$database['link']) != self::$database['link']) {
  $sql_link = "CREATE TABLE " . self::$database['link'] . " (
  id BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
  parent_id BIGINT(20) unsigned NOT NULL,
  PRIMARY KEY (id),
  KEY par_ind (parent_id)
 ) COLLATE utf8_general_ci $use_innodb";

 dbDelta($sql_link);

// Alter table link
 $sql = "ALTER TABLE " . self::$database['link'] . " ADD FOREIGN KEY (parent_id) REFERENCES " . self::$database['user'] . "(id)
    ON DELETE CASCADE;";
 $wpdb->query($sql);
}
}
