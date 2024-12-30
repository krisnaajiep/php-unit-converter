<?php

require_once 'functions.php';

$units = setUnits();
$errors = [];

if (isset($_POST['convert'])) {
  if (empty($_POST['value']))
    $errors['value'] = 'Please enter the ' . $_GET['unit'] . ' to convert';

  if (!empty($_POST['value']) && !is_numeric($_POST['value']))
    $errors['value'] = 'Value must be a number';

  if (empty($_POST['from']))
    $errors['from'] = 'Please select unit to convert from';

  if (empty($_POST['to']))
    $errors['to'] = 'Please select unit to convert to';

  if (empty($errors))
    $result = (array_key_exists('celcius', $units))
      ? convertTemperature($units, $_POST['value'], $_POST['from'], $_POST['to'])
      : convertLengthOrWeight($units, $_POST['value'], $_POST['from'], $_POST['to']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unit Converter</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Header Section -->
  <header>
    <h1>Unit Converter</h1>
  </header>

  <!-- Navigation Section -->
  <nav>
    <ul>
      <li><a href="index.php?unit=length" <?php if (!isset($_GET['unit']) || $_GET['unit'] == 'length'): ?> style="color: blue; text-decoration:underline" <?php endif; ?>>Length</a></li>
      <li><a href="index.php?unit=weight" <?php if (isset($_GET['unit']) && $_GET['unit'] == 'weight'): ?> style="color: blue; text-decoration:underline" <?php endif; ?>>Weight</a></li>
      <li><a href="index.php?unit=temperature" <?php if (isset($_GET['unit']) && $_GET['unit'] == 'temperature'): ?> style="color: blue; text-decoration:underline" <?php endif; ?>>Temperature</a></li>
    </ul>
  </nav>

  <?php if (!isset($_POST['convert']) || !empty($errors)): ?>
    <!-- Form Section -->
    <section class="form">
      <form action="" method="post">
        <div class="form-input">
          <label for="value">Enter the <?= $_GET['unit'] ?> to convert</label>
          <input type="number" name="value" id="value" <?php if (isset($errors['value'])): ?> style="border-color: red;" <?php endif; ?>>
          <?php if (isset($errors['value'])): ?>
            <p style="color: red; font-size:small; margin-top:5px"><?= $errors['value']; ?></p>
          <?php endif; ?>
        </div>
        <div class="form-input">
          <label for="from">Unit to convert from</label>
          <select name="from" id="from" <?php if (isset($errors['from'])): ?> style="border-color: red;" <?php endif; ?>>
            <option value="">Select unit</option>
            <?php foreach ($units as $key => $value): ?>
              <option value="<?= $key; ?>"><?= $key; ?></option>
            <?php endforeach; ?>
          </select>
          <?php if (isset($errors['from'])): ?>
            <p style="color: red; font-size:small; margin-top:5px"><?= $errors['from']; ?></p>
          <?php endif; ?>
        </div>
        <div class="form-input">
          <label for="to">Unit to convert to</label>
          <select name="to" id="to" <?php if (isset($errors['to'])): ?> style="border-color: red;" <?php endif; ?>>
            <option value="">Select unit</option>
            <?php foreach ($units as $key => $value): ?>
              <option value="<?= $key; ?>"><?= $key; ?></option>
            <?php endforeach; ?>
          </select>
          <?php if (isset($errors['to'])): ?>
            <p style="color: red; font-size:small; margin-top:5px"><?= $errors['to']; ?></p>
          <?php endif; ?>
        </div>
        <button type="submit" name="convert">Convert</button>
      </form>
    </section>

  <?php else: ?>
    <!-- Result Section -->
    <section class="result">
      <h3>Result of your calculation</h3>
      <h2><?= $result['from']; ?> = <?= $result['to']; ?></h2>
      <form action="" method="post">
        <button>Reset</button>
      </form>
    </section>
  <?php endif; ?>

</body>

</html>