<?php
namespace App\Modules;

interface FlightReservation {
  public function calculatePrice(): int;
}
