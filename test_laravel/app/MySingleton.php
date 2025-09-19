<?php
namespace App;

class MySingleton {
  private static $instance;

  private function __construct() {

  }

  private function __clone() {}

  public function __wakeup() {}

  public static function getInstance(): MySingleton {
    if (self::$instance === null) {
      return self::$instance = new self();
    }

    return self::$instance;
  }
}
