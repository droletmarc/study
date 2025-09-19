<?php
namespace App\Modules\AutoTrader;

class MySingleton {
  private static $instance;

  private function __construct() {}

  private function __clone() {}

  public function  __wakeup(){}

  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}
