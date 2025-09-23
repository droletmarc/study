<?php
namespace App\Modules;

class LugageReservation extends FlightReservationDecorator
{
  private const PRICE = 60;

  public function calculatePrice(): int {
    return $this->flightReservation->calculatePrice() + self::PRICE;
  }
}
