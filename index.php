<?php

require_once 'functions.php';

$units = setUnits();

$error = [];
$oldData = [];

if (isset($_POST['submit'])) {
  if (!is_numeric($_POST['value']))
    $error['value'] = 'Value must be a number';

  if (empty($_POST['from']))
    $error['from'] = 'Please select unit to convert from';

  if (empty($_POST['to']))
    $error['to'] = 'Please select unit to convert to';

  if (!empty($error)) {
    $oldData['value'] = $_POST['value'];
    $oldData['from'] = $_POST['from'];
    $oldData['to'] = $_POST['to'];
  }

  if (empty($error))
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
  <div class="main">
    <h1>Unit Converter</h1>
    <div class="menu">
      <ul>
        <li><a href="index.php?menu=length" <?php if (!isset($_GET['menu']) || $_GET['menu'] == 'length'): ?> style="color: blue; text-decoration:underline" <?php endif; ?>>Length</a></li>
        <li><a href="index.php?menu=weight" <?php if (isset($_GET['menu']) && $_GET['menu'] == 'weight'): ?> style="color: blue; text-decoration:underline" <?php endif; ?>>Weight</a></li>
        <li><a href="index.php?menu=temperature" <?php if (isset($_GET['menu']) && $_GET['menu'] == 'temperature'): ?> style="color: blue; text-decoration:underline" <?php endif; ?>>Temperature</a></li>
      </ul>
    </div>
    <?php if (isset($_POST['submit']) && empty($error)): ?>
      <div class="form">
        <h3>Result of your calculation</h3>
        <h2><?= $result['from']; ?> = <?= $result['to']; ?></h2>
        <form method="post">
          <button>Reset</button>
        </form>
      </div>
    <?php else: ?>
      <div class="form">
        <form action="" method="post">
          <div class="form-input">
            <label for="value">Enter the length to convert</label>
            <input type="text" name="value" id="value" <?php if (isset($error['value'])): ?> style="border-color: red;" <?php endif; ?> value="<?= isset($oldData['value']) ? $oldData['value'] : ''; ?>">
            <?php if (isset($error['value'])): ?>
              <p style="color: red; font-size:medium; margin-top:5px"><?= $error['value']; ?></p>
            <?php endif; ?>
          </div>
          <div class="form-input">
            <label for="from">Unit to convert from</label>
            <select name="from" id="from" <?php if (isset($error['from'])): ?> style="border-color: red;" <?php endif; ?>>
              <option value="">Select unit</option>
              <?php foreach ($units as $key => $value): ?>
                <option value="<?= $key; ?>" <?= isset($oldData['from']) && $oldData['from'] == $key ? 'selected' : ''; ?>><?= $key; ?></option>
              <?php endforeach; ?>
            </select>
            <?php if (isset($error['from'])): ?>
              <p style="color: red; font-size:medium; margin-top:5px"><?= $error['from']; ?></p>
            <?php endif; ?>
          </div>
          <div class="form-input">
            <label for="to">Unit to convert to</label>
            <select name="to" id="to" <?php if (isset($error['to'])): ?> style="border-color: red;" <?php endif; ?>>
              <option value="">Select unit</option>
              <?php foreach ($units as $key => $value): ?>
                <option value="<?= $key; ?>" <?= isset($oldData['to']) && $oldData['to'] == $key ? 'selected' : ''; ?>><?= $key; ?></option>
              <?php endforeach; ?>
            </select>
            <?php if (isset($error['to'])): ?>
              <p style="color: red; font-size:medium; margin-top:5px"><?= $error['to']; ?></p>
            <?php endif; ?>
          </div>
          <button type="submit" name="submit">Convert</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>