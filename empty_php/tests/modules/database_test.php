<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Modules\Database;

class Database_test extends TestCase
{
  public function test_getInstance():void {
    $instance = Database::getInstance();
    $this->assertInstanceOf(Database::class, $instance);
  }
}
