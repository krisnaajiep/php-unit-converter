<?php

require_once 'functions.php';

$units = setUnits();
$errors = [];
$oldData = [];

if (isset($_POST['convert'])) {
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
