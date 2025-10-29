<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- External CSS import -->
        <link rel="stylesheet" href="../styles/main.css">
        <title>Parking Permit Confirmation</title>
    </head>
    <body>
        <div class="container">
            <h1>Parking Permit Registration Confirmation</h1>
            <?php
                // Check if form was submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve and sanitize form data
                    $studentId = htmlspecialchars($_POST['studentId']);
                    $firstName = htmlspecialchars($_POST['firstName']);
                    $middleName = htmlspecialchars($_POST['middleName']);
                    $lastName = htmlspecialchars($_POST['lastName']);
                    $homeAddress = htmlspecialchars($_POST['homeAddress']);
                    $city = htmlspecialchars($_POST['city']);
                    $state = htmlspecialchars($_POST['state']);
                    $zip = htmlspecialchars($_POST['zip']);
                    $cellPhone = htmlspecialchars($_POST['cellPhone']);
                    $permitNumber = htmlspecialchars($_POST['permitNumber']);

                    // Display the submitted information
                    echo "<div class='confirmation-box'>";
                    echo "<h2>Thank you for registering your parking permit!</h2>";
                    echo "<p>Here is the information you submitted:</p>";

                    echo "<div class='info-section'>";
                    echo "<h3>Student Information</h3>";
                    echo "<p><strong>Student ID:</strong> $studentId</p>";
                    echo "<p><strong>Name:</strong> $firstName $middleName $lastName</p>";
                    echo "</div>";

                    echo "<div class='info-section'>";
                    echo "<h3>Contact Information</h3>";
                    echo "<p><strong>Home Address:</strong> $homeAddress</p>";
                    echo "<p><strong>City:</strong> $city</p>";
                    echo "<p><strong>State:</strong> $state</p>";
                    echo "<p><strong>Zip Code:</strong> $zip</p>";
                    echo "<p><strong>Cell Phone:</strong> $cellPhone</p>";
                    echo "</div>";

                    echo "<div class='info-section'>";
                    echo "<h3>Permit Details</h3>";
                    echo "<p><strong>Permit Number:</strong> $permitNumber</p>";
                    echo "</div>";

                    echo "</div>";
                } else {
                    // If accessed directly without form submission
                    echo "<div class='error-message'>";
                    echo "<p>No form data received. Please submit the form first.</p>";
                    echo "</div>";
                }
            ?>
            <!-- Reset/Return button -->
            <div class="form-group">
                <a href="../prob2.php">
                    <button type="button">Return to Registration Form</button>
                </a>
            </div>
        </div>
    </body>
</html>
