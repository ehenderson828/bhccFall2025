<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- External CSS -->
        <link rel="stylesheet" href="styles/main.css">
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="assets/favicon.png" >
        <title>Input Data Assignment</title>
    </head>
    <body>
        <!-- Header w/document title -->
        <header class="header">
            <h1 class="title">
                Input Data Assignment
            </h1>
        </header>
        <!-- Main content container -->
        <main class="container">
            <!-- User instruction -->
            <p class="content">
                Click the button below to insert a row into the "erhstudents" table in the "phpfall" database
            </p>
            <!-- Button to make post request to php below 👇 -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                <button type="submit" name="submit">Insert a row into the 'erhstudents' table</button>
            </form>

            <?php
                // Check to see if post request is true
                if (isset($_POST['submit'])) {
                    // MySQL server credentials, assigned to vaiables
                    $servername = "bdcteachcom.bizlandmysql.com";
                    $username = "phpstudent";
                    $password = "!3fallt1m3202599";
                    $database = "phpfall";

                    // Create MySQL connection using said credentials
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Check connection to MySQL server
                    if ($conn->connect_error) {
                        echo "<p class='message message-error'>✗ Connection failed: " . htmlspecialchars($conn->connect_error) . "</p>";
                        echo "<p class='message message-info'>Please check your database credentials and try again.</p>";
                        exit(); // Stop execution gracefully
                    }

                    // Echo server connection success message
                    echo "<p class='message message-info'>✓ Connected successfully to database</p>";

                    // Check if table already exists
                    $tableExists = false;
                    // Make MySQL query to check if target table exists
                    $result = $conn->query("SHOW TABLES LIKE 'erhstudents'");
                    // Check to see if a row already exists
                    if ($result->num_rows > 0) {
                        // If table exists, assign tableExists variable to true
                        $tableExists = true;
                    }

                    // If tableExists returns true
                    if ($tableExists) {
                        // Check for duplicate row with same values
                        $checkDuplicate = "SELECT * FROM erhstudents
                            WHERE firstname = 'Eric'
                            AND lastname = 'Henderson'
                            AND address = '123 Main Street Somerville, MA 02144'
                            AND gender = 'male'";

                        $duplicateResult = $conn->query($checkDuplicate);

                        // If duplicate exists, show warning message
                        if ($duplicateResult->num_rows > 0) {
                            echo "<p class='message message-warning'>⚠ A row with these exact values already exists in the database. Duplicate not inserted.</p>";
                        }
                        // If no duplicate, proceed with insert
                        else {
                            // Insert a row into the 'erhstudents' table
                            $sql = "INSERT INTO erhstudents (
                                firstname,
                                lastname,
                                address,
                                gender
                            )
                                VALUES (
                                'Eric',
                                'Henderson',
                                '123 Main Street Somerville, MA 02144',
                                'male'
                            )";

                            // Check to see if row insertion was successful
                            if ($conn->query($sql) === TRUE) {
                                // Provide success message to user
                                echo "<p class='message message-success'>✓ Row inserted into 'erhstudents' successfully</p>";
                            }
                            // Handle errors
                            else {
                                echo "<p class='message message-error'>✗ Error inserting row: " . $conn->error . "</p>";
                            }
                        }
                    }
                    // If table does not exist
                    else {
                        echo "<p class='message message-error'>Table 'erhstudents' does not exist. Please create it first.</p>";
                    }

                    // Display current data if table exists
                    if ($tableExists) {
                        // Get total row count
                        $countResult = $conn->query("SELECT COUNT(*) as total FROM erhstudents");
                        $countRow = $countResult->fetch_assoc();
                        $totalRows = $countRow['total'];

                        echo "<div class='data-summary'>";
                        echo "<h2 class='summary-title'>Database Summary</h2>";
                        echo "<p class='row-count'>Total rows in table: <strong>$totalRows</strong></p>";
                        echo "</div>";

                        // Get and display recent records
                        $displayRecords = $conn->query("SELECT * FROM erhstudents ORDER BY reg_date DESC LIMIT 5");
                        // If rows exists, echo a table with current data
                        if ($displayRecords->num_rows > 0) {
                            echo "<div class='records-container'>";
                            echo "<h3 class='records-title'>Recent Records (Last 5)</h3>";
                            echo "<table class='records-table'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>First Name</th>";
                            echo "<th>Last Name</th>";
                            echo "<th>Address</th>";
                            echo "<th>Gender</th>";
                            echo "<th>Registration Date</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while($row = $displayRecords->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['reg_date']) . "</td>";
                                echo "</tr>";
                            }

                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        }
                    }

                    // Close the server connection
                    $conn->close();
                }
            ?>
        </main>
        <footer class="footer">
            <h5 class="signature">
                Site created by Eric Henderson &copy; 2025
            </h5>
        </footer>
    </body>
</html>