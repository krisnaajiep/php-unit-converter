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

  // Validate the form
  if (empty($_POST['value']))
    $errors['value'] = 'Please enter the ' . $_GET['unit'] . ' to convert';

  if (!empty($_POST['value']) && !is_numeric($_POST['value']))
    $errors['value'] = 'Value must be a number';

  if (empty($_POST['from']))
    $errors['from'] = 'Please select unit to convert from';

  if (empty($_POST['to']))
    $errors['to'] = 'Please select unit to convert to';

  if (!empty($errors)) {
    $oldData['value'] = $_POST['value'];
    $oldData['from'] = $_POST['from'];
    $oldData['to'] = $_POST['to'];
  }

  if (empty($errors))
    $result = (array_key_exists('celcius', $units))
      ? convertTemperature($units, $_POST['value'], $_POST['from'], $_POST['to'])
      : convertLengthOrWeight($units, $_POST['value'], $_POST['from'], $_POST['to']);
}
