<?php
/**
* @package PricingCalculator
**/

namespace Inc\Base;

class Activate {

  public static function activate() {
    global $wpdb;
    $wpdb->show_errors();

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

     $table_sw = $wpdb->prefix . "Software";
       $sql_sw = "CREATE TABLE  $table_sw  (
       id int(20) unsigned NOT NULL AUTO_INCREMENT,
       name nvarchar(50) NOT NULL,
       crowdCuts BOOLEAN NOT NULL,
       PRIMARY KEY  (id)
     ) COLLATE utf8_general_ci";
     dbDelta($sql_sw);

    $table_sw_groups = $wpdb->prefix . "Software_Groups";
      $sql_sw_groups = "CREATE TABLE $table_sw_groups (
      id int(20) unsigned NOT NULL AUTO_INCREMENT,
      softwareID int(20) unsigned NOT NULL,
      name nvarchar(100) NOT NULL,
      isMulti BOOLEAN NOT NULL,
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
          price int(20) NOT NULL,
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

        flush_rewrite_rules();
  }

  public static function addData(){
    flush_rewrite_rules();
  }

}
