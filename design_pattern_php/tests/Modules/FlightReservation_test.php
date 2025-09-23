<?php

use App\Modules\LugageReservation;
use App\Modules\SeatFlightReservationDecorator;
use App\Modules\StandardFlightReservation;
use PHPUnit\Framework\TestCase;

class FlightReservation_test extends TestCase
{
  public function test_priceCalculation() {
    $reservation = new StandardFlightReservation();
    $reservation = new SeatFlightReservationDecorator($reservation);
    $reservation = new LugageReservation($reservation);
    $this->assertEquals(400, $reservation->calculatePrice());
  }
}
