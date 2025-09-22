<?php
namespace App\Modules;

use PDO;
use PDOException;

class Database {
  private static $_instance;

  private function __construct(Array $configs) {
    $type = $configs['DATABASE_CONNECTION'] ?? '';
    $host = $configs['DATABASE_HOST'] ?? '';
    $name = $configs['DATABASE_NAME'] ?? '';
    $username = $configs['DATABASE_USERNAME'] ?? '';
    $password = $configs['DATABASE_PASSWORD'] ?? '';
    $dsn = "$type:host=$host;dbname=$name;charset=utf8mb4";

    try {
      self::$_instance = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  private function __clone() {}

  public function __wakeup() {}

  public static function getInstance(Array $configs): PDO {
    if (self::$_instance === null) {
      new self($configs);
    }

    return self::$_instance;
  }
}
