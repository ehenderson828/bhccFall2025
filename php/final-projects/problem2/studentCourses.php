<?php
    // MySQL server credentials, assigned to vaiables
    $servername = "bdcteachcom.bizlandmysql.com";
    $username = "phpstudent";
    $password = "!3fallt1m3202599";
    $database = "phpfall";

    // Establish connection with database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get all students and their courses
    $sql = "SELECT firstname, lastname, course1, course2 FROM erhstudents ORDER BY lastname, firstname";
    $result = $conn->query($sql);

    // Store results in an array for later use
    $students = [];
    $courseCount = 0;

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Create a combined student name field
            $row['studentName'] = $row['firstname'] . ' ' . $row['lastname'];
            $students[] = $row;
            // Count courses beginning with 'A' or 'M' from course1
            if (!empty($row['course1']) && (substr($row['course1'], 0, 1) == 'A' || substr($row['course1'], 0, 1) == 'M')) {
                $courseCount++;
            }
            // Count courses beginning with 'A' or 'M' from course2
            if (!empty($row['course2']) && (substr($row['course2'], 0, 1) == 'A' || substr($row['course2'], 0, 1) == 'M')) {
                $courseCount++;
            }
        }
    }

    // Close database connection
    $conn->close();
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
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #e8e8e8;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        header {
            text-align: center;
            padding: 40px 20px;
            background: linear-gradient(45deg, #e94560, #533483);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(233, 69, 96, 0.3);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.03) 10px,
                rgba(255, 255, 255, 0.03) 20px
            );
            animation: shimmer 20s linear infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(50%); }
        }

        header h1 {
            font-size: 2.8em;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            letter-spacing: 2px;
            position: relative;
            z-index: 1;
        }

        main {
            flex: 1;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        section > section:first-child {
            background: rgba(22, 33, 62, 0.8);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 5px solid #e94560;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        h3, h5 {
            margin: 10px 0;
            font-weight: 600;
        }

        h3 {
            color: #00d4ff;
            font-size: 1.4em;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        h5 {
            color: #ffd700;
            font-size: 1.2em;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: rgba(22, 33, 62, 0.9);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        caption {
            font-size: 1.8em;
            font-weight: 700;
            padding: 25px;
            background: linear-gradient(90deg, #533483, #e94560);
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        thead {
            background: linear-gradient(135deg, #0f3460, #533483);
        }

        th {
            padding: 18px;
            text-align: left;
            font-size: 1.1em;
            font-weight: 600;
            color: #00d4ff;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border-bottom: 3px solid #e94560;
        }

        tbody tr {
            transition: all 0.3s ease;
            background: rgba(26, 26, 46, 0.6);
        }

        tbody tr:nth-child(even) {
            background: rgba(15, 52, 96, 0.4);
        }

        tbody tr:hover {
            background: linear-gradient(90deg, rgba(233, 69, 96, 0.2), rgba(83, 52, 131, 0.2));
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(233, 69, 96, 0.3);
        }

        td {
            padding: 15px 18px;
            color: #e8e8e8;
            font-size: 1em;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tfoot {
            background: linear-gradient(135deg, #533483, #0f3460);
        }

        tfoot td {
            padding: 20px;
            font-weight: 700;
            font-size: 1.1em;
            color: #ffd700;
            text-align: center;
            border-top: 3px solid #e94560;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        footer {
            text-align: center;
            padding: 30px;
            margin-top: 40px;
            background: rgba(22, 33, 62, 0.6);
            border-radius: 12px;
            color: #a8a8a8;
            font-size: 0.95em;
            border-top: 2px solid rgba(233, 69, 96, 0.3);
        }

        section > section:last-child {
            position: relative;
        }

        section > section:last-child::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(45deg, #e94560, #533483, #00d4ff);
            border-radius: 15px;
            z-index: -1;
            opacity: 0.1;
        }

        /* Media query */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2em;
            }

            th, td {
                padding: 12px 10px;
                font-size: 0.9em;
            }

            caption {
                font-size: 1.4em;
                padding: 20px;
            }
        }
    </style>
    <title>PHP Final Project - Problem #2</title>
</head>
<body>
    <header>
        <h1>Student Completed Courses</h1>
    </header>
    <main>
        <section>
            <section>
                <h3>Current Date: <?php echo date('F d, Y'); ?></h3>
                <h5>Count of A & M Courses: <?php echo $courseCount; ?></h5>
            </section>
            <section>
                <table>
                    <caption>Course Completion Record</caption>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Course 1</th>
                            <th>Course 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (count($students) > 0) {
                                foreach ($students as $student) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($student['studentName']) . "</td>";
                                    echo "<td>" . htmlspecialchars($student['course1']) . "</td>";
                                    echo "<td>" . htmlspecialchars($student['course2']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No student records found</td></tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Records: <?php echo count($students); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </section>
        </section>
    </main>
    <footer>
        Page authored by Eric Henderson &copy; 2025
    </footer>
</body>
</html>