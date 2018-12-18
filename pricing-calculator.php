<?php
/**
* @package PricingCalculator
**/
/*
Plugin Name: Pricing Calculator
Text Domain: pricing-calculator
*/

if(!defined('ABSPATH')) {
  die;
}

// Require once Composer Autoload
if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
* Initialize core classes of plugin
**/
if(class_exists('Inc\\init')){
  Inc\init::registerServices();
};

/**
* Runs on plugin activation
**/
function activatePricingCalculator(){
  Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activatePricingCalculator');

/**
* Runs on plugin deactivation
**/
function deactivatePricingCalculator(){
  Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivatePricingCalculator');


// Logs errors into error_activation.txt
function my_save_error()
{
    file_put_contents(dirname(__file__).'/error_activation.txt', ob_get_contents());
}
add_action('activated_plugin','my_save_error');
