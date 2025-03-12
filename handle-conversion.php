<?php

// Convert the value if the form is submitted
if (isset($_POST['convert'])) {

  // Validate the CSRF token
  if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
    die('Invalid CSRF token');

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
