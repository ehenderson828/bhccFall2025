<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/favicon.png">
    <title>Student Course Completions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #1e1e1e 0%, #2d2d2d 100%);
            color: #e0e0e0;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            padding: 60px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 2rem;
            font-weight: 300;
            letter-spacing: 2px;
            color: #f4a261;
            text-transform: uppercase;
            margin-bottom: 10px;
            padding-bottom: 20px;
            border-bottom: 3px solid #f4a261;
        }

        h1::before {
            content: '';
            display: inline-block;
            width: 40px;
            height: 40px;
            background: #f4a261;
            margin-right: 15px;
            vertical-align: middle;
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 400;
            letter-spacing: 1.5px;
            color: #fff;
            text-transform: uppercase;
            margin: 40px 0 20px;
        }

        h2::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 30px;
            background: #f4a261;
            margin-right: 15px;
            vertical-align: middle;
        }

        p {
            font-size: 1rem;
            line-height: 1.6;
            color: #b0b0b0;
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 30px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 2px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        thead {
            background: #000;
        }

        th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
            color: #f4a261;
            border-bottom: 2px solid #f4a261;
        }

        td {
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #e0e0e0;
            font-size: 0.95rem;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(244, 162, 97, 0.1);
            transform: scale(1.01);
        }

        tbody tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.02);
        }

        tbody tr:nth-child(even):hover {
            background: rgba(244, 162, 97, 0.1);
        }

        .stat-box {
            display: inline-block;
            background: rgba(244, 162, 97, 0.1);
            border-left: 4px solid #f4a261;
            padding: 15px 25px;
            margin: 20px 0;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .error-message {
            background: rgba(231, 111, 81, 0.1);
            border-left: 4px solid #e76f51;
            padding: 20px;
            margin: 20px 0;
            color: #ff9b85;
        }

        .success-message {
            background: rgba(42, 157, 143, 0.1);
            border-left: 4px solid #2a9d8f;
            padding: 20px;
            margin: 20px 0;
            color: #70e0d0;
        }

        @media (max-width: 1024px) {
            .container {
                padding: 40px 30px;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 15px;
            }
        }

        /* Media query */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 1.5rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                padding: 12px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo date('F d, Y'); ?></h1>
        <?php
            // Listen for a 'submit' event on a POST request
            if (isset($_POST['submit'])) {
                // MySQL server credentials, assigned to vaiables
                $servername = "bdcteachcom.bizlandmysql.com";
                $username = "phpstudent";
                $password = "!3fallt1m3202599";
                $database = "phpfall";

                // Create connection to database with provided credentials
                $conn = new mysqli($servername, $username, $password, $database);

                // Error handling for database connection
                if ($conn->connect_error) {
                    echo "<div class='error-message'>";
                    echo "<p>Connection failed: " . htmlspecialchars($conn->connect_error) . "</p>";
                    echo "<p>Please check the database credentials and try again</p>";
                    echo "</div>";
                    exit();
                }

                // Check to see if 'student data' and 'course completion' tables exist in DB
                $studentDataexists = false;
                $courseCompletionexists = false;

                // Make MySQL queries to check for 'student data' and 'course completion' existance
                $studentDataresult = $conn->query("SHOW TABLES LIKE 'erhstudents'");
                $courseCompletionresult = $conn->query("SHOW TABLES LIKE 'student_courses'");

                // Check to see if there is data inside these tables
                if ($studentDataresult->num_rows > 0 && $courseCompletionresult->num_rows > 0) {
                    // Assign value of both existance variables to true
                    $studentDataexists = true;
                    $courseCompletionexists = true;
                }
                else {
                    echo "<div class='error-message'>";
                    echo "<p>Could not locate Student Data or Course Completion tables</p>";
                    echo "</div>";
                }

                // If both checks on table existance return true
                if ($studentDataexists && $courseCompletionexists) {
                    // Build inner join query
                    $innerJoinquery = "
                        SELECT
                            erhstudents.firstname,
                            erhstudents.lastname,
                            student_courses.course_name,
                            student_courses.course_date
                        FROM student_courses
                        INNER JOIN erhstudents ON student_courses.student_id = erhstudents.id
                        ORDER BY erhstudents.lastname, erhstudents.firstname, student_courses.course_date
                    ";

                    // Execute inner join query
                    $innerJoinresult = $conn->query($innerJoinquery);

                    // Check to see if query was successful
                    if ($innerJoinresult) {
                        echo "<h2>Student Course Completions</h2>";
                        echo "<div class='stat-box'>Total records found: " . $innerJoinresult->num_rows . "</div>";

                        // Display data resulting from inner join query
                        if ($innerJoinresult->num_rows > 0) {
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>First Name</th>";
                            echo "<th>Last Name</th>";
                            echo "<th>Course Name</th>";
                            echo "<th>Course Date</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            // Output data of each row
                            while ($row = $innerJoinresult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['course_date']) . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "<p>No course completions found.</p>";
                        }
                    }
                    // Handle errors if query was not successful
                    else {
                        echo "<div class='error-message'>";
                        echo "<p>Error executing query: " . htmlspecialchars($conn->error) . "</p>";
                        echo "</div>";
                    }
                }
                // Close database connection
                $conn->close();
            }
            // If submission has not yet been completed, alert user
            else {
                echo "<div class='error-message'>";
                echo "<p>Please submit the form to view course completions.</p>";
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>