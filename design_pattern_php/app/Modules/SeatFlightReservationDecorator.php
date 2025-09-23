<?php
namespace App\Modules;

class SeatFlightReservationDecorator extends FlightReservationDecorator
{
  private const PRICE = 40;

  public function calculatePrice(): int {
    return $this->flightReservation->calculatePrice() + self::PRICE;
  }
}
