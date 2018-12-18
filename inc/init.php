<?php
/**
* @package PricingCalculator
**/

namespace Inc;

class init {

  /**
  * Store all classes in an array
  * @return array full list of classes
  **/
  public static function getServices(){
    return array(
      Pages\Admin::class,
      Base\Enqueue::class,
      Base\SettingsLinks::class
    );
  }

  /**
  * Loop through the classes, initialize them, and call the register() method if it exists
  * @return
  **/
  public static function registerServices(){
    foreach (self::getServices() as $class){
      $service = self::instantiate($class);
      if(method_exists($service, 'register')){
        $service->register();
      }
    }
  }

  /**
  * Initialize the class
  * @param class $class  class from service array
  * @return class  new instance of the class
  **/
  private static function instantiate($class){
    $service = new $class();
    return $service;
  }

}
