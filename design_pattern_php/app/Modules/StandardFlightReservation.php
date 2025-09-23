<?php
namespace App\Modules;

use App\Modules\FlightReservation;

class StandardFlightReservation implements FlightReservation
{
  public const PRICE = 300;

  public function calculatePrice(): int
  {
    return StandardFlightReservation::PRICE;
  }

}
