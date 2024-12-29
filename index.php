<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unit Converter</title>
</head>

<body>
  <!-- Header Section -->
  <header>
    <h1>Unit Converter</h1>
  </header>

  <!-- Navigation Section -->
  <nav>
    <ul>
      <li><a href="#">Length</a></li>
      <li><a href="#">Weight</a></li>
      <li><a href="#">Temperature</a></li>
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
      <button type="submit">Convert</button>
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