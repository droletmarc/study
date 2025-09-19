<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Services\TestService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestServiceTest extends TestCase
{
  public function test_sum_equal() {
    $service = new TestService();

    $this->assertEquals(3, $service->sum(1, 2));
  }

  public function test_sum_not_equal() {
    $service = new TestService();

    $this->assertNotEquals(4, $service->sum(1, 2));
  }
}
