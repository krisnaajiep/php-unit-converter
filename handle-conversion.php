<?php

require_once 'functions.php';

$units = setUnits();
$errors = [];
$oldData = [];

// Set the default unit to length if the unit is not set or not in the list
$_GET['unit'] = empty($_GET['unit']) || !in_array($_GET['unit'], ['length', 'weight', 'temperature'])
  ? 'length'
  : $_GET['unit'];

// Convert the value if the form is submitted
if (isset($_POST['convert'])) {

  // Sanitize the form data
  $value = htmlspecialchars($_POST['value'], ENT_QUOTES, 'UTF-8');
  $from = htmlspecialchars($_POST['from'], ENT_QUOTES, 'UTF-8');
  $to = htmlspecialchars($_POST['to'], ENT_QUOTES, 'UTF-8');

  // Validate the form
  if (empty($value))
    $errors['value'] = 'Please enter the ' . $_GET['unit'] . ' to convert';

  if (!empty($value) && !is_numeric($value))
    $errors['value'] = 'Value must be a number';

  if (empty($from))
    $errors['from'] = 'Please select unit to convert from';

  if (empty($to))
    $errors['to'] = 'Please select unit to convert to';

  if (!empty($errors)) {
    $oldData['value'] = $value;
    $oldData['from'] = $from;
    $oldData['to'] = $to;
  }

  if (empty($errors))
    $result = (array_key_exists('celcius', $units))
      ? convertTemperature($units, $value, $from, $to)
      : convertLengthOrWeight($units, $value, $from, $to);
}
