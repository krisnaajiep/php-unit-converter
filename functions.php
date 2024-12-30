<?php

function setUnits(): array
{
  $lengths = [
    'milimeter' => ['convert' => 0.000001, 'symbol' => 'mm',],
    'centimeter' => ['convert' => 0.00001, 'symbol' => 'cm',],
    'meter' => ['convert' => 0.001, 'symbol' => 'm'],
    'kilometer' => ['convert' => 1, 'symbol' => 'km'],
    'inch' => ['convert' => 0.0000254, 'symbol' => ' in'],
    'foot' =>  ['convert' => 0.0003048, 'symbol' => ' ft'],
    'yard' => ['convert' => 0.0009144, 'symbol' => ' yd'],
    'mile' => ['convert' => 1.60934, 'symbol' => ' mi'],
  ];

  $weights = [
    'miligram' => ['convert' => 0.000001, 'symbol' => 'mg'],
    'gram' => ['convert' => 0.001, 'symbol' => 'g'],
    'kilogram' => ['convert' => 1, 'symbol' => 'kg'],
    'ounce' => ['convert' => 0.0283495, 'symbol' => 'oz'],
    'pound' => ['convert' => 0.453592, 'symbol' => 'lb']
  ];

  $temperatures = [
    'celcius' => ['symbol' => '°C'],
    'fahrenheit' => ['symbol' => '°F'],
    'kelvin' => ['symbol' => 'K'],
  ];

  return !isset($_GET['unit']) || $_GET['unit'] == 'length'
    ? $lengths
    : ($_GET['unit'] == 'weight'
      ? $weights
      : $temperatures);
}

function convertLengthOrWeight(array $units, int $value, string $from, string $to): array
{
  $result = ($value * $units[$from]['convert']) / $units[$to]['convert'];

  if (strlen($result) > 8) $result = round($result, 4);

  return [
    'from' => $value . $units[$from]['symbol'],
    'to' => $result . $units[$to]['symbol'],
  ];
}

function convertTemperature(array $units, int $value, string $from, string $to): array
{
  switch ($from) {
    case 'celcius':
      $result = $to == 'fahrenheit'
        ? $value * 9 / 5 + 32
        : $value + 273.15;
      break;

    case 'fahrenheit':
      $result = $to == 'celcius'
        ? ($value - 32) * 5 / 9
        : ($value - 32) * 5 / 9 + 273.15;
      break;

    case 'kelvin':
      $result = $to == 'celcius'
        ? $value - 273.15
        : ($value - 273.15) * 9 / 5 + 32;
      break;
  }

  if (strlen($result) > 8) $result = round($result, 4);

  return [
    'from' => $value . $units[$from]['symbol'],
    'to' => $result . $units[$to]['symbol'],
  ];
}
