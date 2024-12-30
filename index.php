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

  <!-- Form Section -->
  <section class="form">
    <form action="" method="post">
      <div class="form-input">
        <label for="value">Enter the length to convert</label>
        <input type="number" name="value" id="value">
      </div>
      <div class="form-input">
        <label for="from">Unit to convert from</label>
        <select name="from" id="from">
          <option value="">Select unit</option>
        </select>
      </div>
      <div class="form-input">
        <label for="to">Unit to convert to</label>
        <select name="to" id="to">
          <option value="">Select unit</option>
        </select>
      </div>
      <button type="submit" name="convert">Convert</button>
    </form>
  </section>

  <!-- Result Section -->
  <section class="result">
    <h3>Result of your calculation</h3>
    <h2>20 ft = 609cm</h2>
    <button>Reset</button>
  </section>
</body>

</html>