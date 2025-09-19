<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\MySingleton;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MySIngletonTest extends TestCase
{
  public function test_create_instance() {
    $instance = MySingleton::getInstance();
    $this->assertInstanceOf(MySingleton::class, $instance);
  }
}
