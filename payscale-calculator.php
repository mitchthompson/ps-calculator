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

if( !class_exists('PayscaleCalculator')) {

  class PayscaleCalculator {
    public $pluginName;

    function __construct(){
      $this->pluginName = plugin_basename(__FILE__);
    }

    function register(){
      add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
      add_action('admin_menu', array($this, 'addAdminPages'));

      add_filter("plugin_action_links_$this->pluginName", array($this, 'settingsLink'));
    }

    function activate(){
      require_once plugin_dir_path(__FILE__) . 'inc/payscale-calculator-activate.php';
      PayscaleCalculatorActivate::createCustomTables();
    }

    //enqueue all scripts
    function enqueue(){
      wp_enqueue_style('payscale_calculator_admin_style', plugins_url('/assets/admin_styles.css', __FILE__));
      wp_enqueue_script('payscale_calculator_script', plugins_url('/assets/scripts.js', __FILE__));
    }

    function addAdminPages(){
        add_menu_page(
          'Payscale Plugin',
          'Calculator',
          'manage_options',
          'payscale_calculator_plugin',
          array($this, 'adminIndex'), 'dashicons-list-view', 110);
    }

    function adminIndex(){
      require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
    }

    function settingsLink( $links ){
        $settings_link = '<a href="admin.php?page=payscale_calculator_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }

  }

  $payscaleCalculator = new PayscaleCalculator();
  $payscaleCalculator->register();

  //plugin activation
  register_activation_hook( __FILE__, array($payscaleCalculator, 'activate'));

  //plugin deactivation
  require_once plugin_dir_path(__FILE__) . 'inc/payscale-calculator-deactivate.php';
  register_deactivation_hook( __FILE__, array('PayscaleCalculatorDeactivate', 'deactivate'));

}


//Logs errors into error_activation.txt
function my_save_error()
{
    file_put_contents(dirname(__file__).'/error_activation.txt', ob_get_contents());
}
add_action('activated_plugin','my_save_error');
