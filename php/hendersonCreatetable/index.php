<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- External CSS -->
        <link rel="stylesheet" href="styles/main.css">
        <title>Create Table Assignment</title>
    </head>
    <body>
        <header class="header">
            <h1 class="title">
                Create Table Assignment
            </h1>
        </header>
        <main class="container">
            <p class="content">
                Click the button below to create the "erhstudents" table in the "phpfall" database
            </p>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                <button type="submit" name="submit">Create the database table</button>
            </form>
        </main>
        <footer class="footer">
            <h5 class="signature">
                Site created by Eric Henderson &copy; 2025
            </h5>
        </footer>
        <?php
            if (isset($_POST['submit'])) {
                $servername = "bdcteachcom.bizlandmysql.com";
                $username = "phpstudent";
                $password = "!3fallt1m3202599";
                $database = "phpfall";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Echo success message
                echo "<p>Connected successfully</p>";

                // Check if table already exists
                $tableExists = false;
                $result = $conn->query("SHOW TABLES LIKE 'erhstudents'");
                if ($result->num_rows > 0) {
                    $tableExists = true;
                }

                if ($tableExists) {
                    echo "<p style='background-color: #fff3cd; color: #856404;'>Table 'erhstudents' already exists</p>";
                } else {
                    // Create the table only if it doesn't exist
                    $sql = "CREATE TABLE erhstudents (
                        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        firstname VARCHAR(30) NOT NULL,
                        lastname VARCHAR(30) NOT NULL,
                        address VARCHAR(50),
                        gender VARCHAR(10),
                        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    )";

                    // Check to see if table creation was successful
                    if ($conn->query($sql) === TRUE) {
                        echo "<p style='background-color: #d4edda; color: #155724;'>Table 'erhstudents' created successfully</p>";
                    }
                    // Handle errors
                    else {
                        echo "<p style='background-color: #f8d7da; color: #721c24;'>Error creating table: " . $conn->error . "</p>";
                    }
                }

                // Close the server connection
                $conn->close();
            }
        ?>
    </body>
</html>