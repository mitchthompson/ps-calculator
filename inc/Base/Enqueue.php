<?php
/**
* @package PricingCalculator
**/

namespace Inc\Base;
use \Inc\Base\BaseController;

/**
*
**/
class Enqueue extends BaseController {

  function register(){
    add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
  }

  //enqueue all scripts
  function enqueue(){
    wp_enqueue_style('pricing_calculator_admin_style', $this->plugin_url . 'assets/admin_styles.css');
    wp_enqueue_script('pricing_calculator_script', $this->plugin_url . 'assets/scripts.js');
  }


}
