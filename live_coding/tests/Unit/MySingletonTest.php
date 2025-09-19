<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modules\AutoTrader\MySingleton;

class MySingletonTest extends TestCase
{
    public function test_intantiate(): void
    {
      $instance = MySingleton::getInstance();
      $this->assertInstanceOf(MySingleton::class, $instance);
    }
}
