<?php
/**
* @package PricingCalculator
**/

namespace Inc\Pages;
use \Inc\Base\BaseController;

/**
*
**/
class Admin extends BaseController {

  function register(){
    add_action('admin_menu', array($this, 'addAdminPages'));
  }

  function addAdminPages(){
    add_menu_page(
      'Pricing Calculator Plugin',
      'Calculator',
      'manage_options',
      'pricing_calculator_plugin',
      array($this, 'adminIndex'), 'dashicons-list-view', 110);
  }

  function adminIndex(){
    require_once $this->plugin_path . 'templates/admin.php';
  }

}
