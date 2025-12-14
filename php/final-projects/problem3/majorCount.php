<?php
    // MySQL server credentials, assigned to variables
    $servername = "bdcteachcom.bizlandmysql.com";
    $username = "phpstudent";
    $password = "!3fallt1m3202599";
    $database = "phpfall";

    // Establish connection with database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        // If an error populates, close the database connection
        die("Connection failed: " . $conn->connect_error);
    }

    // Unique major counter
    $majorCount = 0;

    // Query to get majors with student count, grouped by major
    $sql = "SELECT major, COUNT(*) as student_count FROM erhstudents GROUP BY major ORDER BY major"; // Group by will filter duplicate majors
    $result = $conn->query($sql);

    // Count total number of different majors
    if ($result) {
        $majorCount = $result->num_rows;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <!-- Internal styling -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.6;
            color: #333;
        }

        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem 1rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: clamp(1.8rem, 5vw, 3rem);
            color: #667eea;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        main {
            flex: 1;
            max-width: 900px;
            width: 90%;
            margin: 2rem auto;
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        section h3 {
            color: #764ba2;
            font-size: 1.3rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #667eea;
        }

        section h5 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            font-size: 1.2rem;
            margin: 1.5rem 0;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            font-weight: 600;
        }

        section h1 {
            color: #333;
            font-size: 1.8rem;
            margin: 2rem 0 1rem 0;
            text-align: center;
            position: relative;
            padding-bottom: 1rem;
        }

        section h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-top: 1.5rem;
        }

        ul li {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0.8rem 0;
            padding: 1.2rem 1.5rem;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 500;
            color: #2d3748;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #667eea;
        }

        ul li:hover {
            transform: translateX(10px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        footer {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 1.5rem;
            font-size: 0.95rem;
            margin-top: auto;
        }

        /* Media queries */
        @media (max-width: 768px) {
            main {
                width: 95%;
                padding: 1.5rem;
                margin: 1rem auto;
            }

            header {
                padding: 1.5rem 1rem;
            }

            ul li {
                padding: 1rem;
                font-size: 1rem;
            }

            section h1 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            main {
                padding: 1rem;
            }

            section h5 {
                font-size: 1rem;
                padding: 0.8rem 1rem;
            }

            ul li:hover {
                transform: translateX(5px);
            }
        }
    </style>
    <title>PHP Final Project - Problem #3</title>
</head>
<body>
    <header>
        <h1>Student Major Accounting</h1>
    </header>
    <main>
        <section>
            <section>
                <h3>Current Date: <?php echo date('F d, Y'); ?></h3>
                <h5>Total different majors: <?php echo $majorCount; ?></h5>
                <section>
                    <h1>Student count by major:</h1>
                    <ul>
                        <?php
                        // Loop through each major and display with count
                        if ($result && $result->num_rows > 0) {
                            // Reset pointer to beginning of results
                            $result->data_seek(0);
                            while($row = $result->fetch_assoc()) {
                                echo "<li>" . htmlspecialchars($row['major']) . ": " . $row['student_count'] . " students</li>";
                            }
                        } else {
                            echo "<li>No majors found</li>";
                        }
                        ?>
                    </ul>
                </section>
            </section>
        </section>
    </main>
    <footer>
        Page authored by Eric Henderson &copy; 2025
    </footer>

    <?php
        // Close database connection
        $conn->close();
    ?>
</body>
</html>