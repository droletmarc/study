<?php
namespace App\Modules;

use App\Modules\FlightReservationInterface;

abstract class FlightReservationDecorator implements FlightReservation
{
  protected FlightReservation $flightReservation;

  public function __construct(FlightReservation $flightReservation)
  {
    $this->flightReservation = $flightReservation;
  }
}

