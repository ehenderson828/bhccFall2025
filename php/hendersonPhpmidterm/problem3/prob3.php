<?php
    // Exchange rate: 1 USD = 0.92 EUR (approximate at time of page creation)
    $exchangeRate = 0.92;
    // Declare variables
    $usdAmount = null;
    $euroAmount = null;
    $converted = false;
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usd_amount'])) {
        $usdAmount = intval($_POST['usd_amount']);
        // Perform the conversion logic
        $euroAmount = $usdAmount * $exchangeRate;
        $converted = true;
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- External CSS import -->
        <link rel="stylesheet" href="styles/main.css">
        <title>PHP Midterm - Problem 3</title>
    </head>
    <body>
        <div class="converter-container">
            <h1>USD to Euro Currency Converter</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="usd_amount">Select Amount in US Dollars (USD):</label>
                    <select name="usd_amount" id="usd_amount" required>
                        <option value="default" disabled selected>-- Choose Amount --</option>
                        <option value="10">$10</option>
                        <option value="20">$20</option>
                        <option value="30">$30</option>
                        <option value="40">$40</option>
                        <option value="50">$50</option>
                        <option value="60">$60</option>
                        <option value="70">$70</option>
                        <option value="80">$80</option>
                        <option value="90">$90</option>
                        <option value="100">$100</option>
                    </select>
                </div>
                <button type="submit">Convert Currency</button>
            </form>
            <!-- Rendering the result -->
            <?php if ($converted): ?>
                <div class="result">
                    <h2>Conversion Result</h2>
                    <div class="currency-line">
                        <span class="input-currency">Input Amount (USD):</span>
                        <span class="currency-value">$<?php echo number_format($usdAmount, 2); ?> US Dollars</span>
                    </div>
                    <div class="currency-line">
                        <span class="output-currency">Converted Amount (EUR):</span>
                        <span class="currency-value">€<?php echo number_format($euroAmount, 2); ?> Euros</span>
                    </div>
                    <p class="exchange-rate-info">
                        Exchange Rate: 1 USD = <?php echo $exchangeRate; ?> EUR
                    </p>
                    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <button type="submit" class="btn-reset">Reset Converter</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>