<?php
namespace App\Modules;

require_once(dirname(__FILE__) . '/../../configs/database.php');

use PDO;
use PDOException;

class Database {
  private static $_instance;

  private function __construct() {
    $type = DATABASE['type'];
    $host = DATABASE['host'];
    $name = DATABASE['name'];
    $dsn = "$type:host=$host;dbname=$name;charset=utf8mb4";

    try {
      self::$_instance = new PDO($dsn, DATABASE['username'], DATABASE['password']);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  private function __clone() {}

  public function __wakeup() {}

  public static function getInstance(): PDO {
    if (self::$_instance === null) {
      new self();
    }

    return self::$_instance;
  }
}
