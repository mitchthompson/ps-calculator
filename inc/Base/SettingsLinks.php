<?php
/**
* @package PricingCalculator
**/

namespace Inc\Base;
use Inc\Base\BaseController;

/**
*
**/
class SettingsLinks extends BaseController {

  function register(){
    add_filter('plugin_action_links_' . $this->plugin, array($this, 'settingsLink'));
  }

  function settingsLink($links){
    $settings_link = '<a href="admin.php?page=pricing_calculator_plugin">Manage</a>';
    array_push($links, $settings_link);
    return $links;
  }

}
