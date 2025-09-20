<?php
namespace App\Modules\AutoTrader;

class Live {
  public function __construct() {
  }

  public function output(String $myString): void {
    echo $myString;

    $test = [
      'name' => 'mm',
      'age' => 12
    ];

    foreach ($test as $k => $v) {
      echo "$k --  $v" . PHP_EOL;
    }
  }
}
