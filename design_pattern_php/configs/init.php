<?php
require(dirname(__FILE__) . '/../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
$dotenv->required([
    'DATABASE_CONNECTION',
    'DATABASE_HOST',
    'DATABASE_NAME',
    'DATABASE_USERNAME'
  ]
)->notEmpty();
$dotenv->required(['DATABASE_PASSWORD']);
