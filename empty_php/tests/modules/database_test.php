<?php
namespace Tests;

use PDO;
use App\Modules\Database;
use PHPUnit\Framework\TestCase;

class Database_test extends TestCase
{
  public function test_getInstance():void {
    $instance = Database::getInstance($_ENV);
    $this->assertInstanceOf(PDO::class, $instance);
  }
}
