<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External Stylesheet -->
    <link rel="stylesheet" href="styles/main.css"/>
    <title>PHP Loop Assignment</title>
</head>
<body>
    <main>
        <header class="header">
            <h1 class="title">
                All of the US East Coast States
            </h1>
        </header>
        <section class="states-container">
            <ul>
                <!-- Embedded PHP -->
                <?php
                    // Array declaration
                    $eastCoaststates = [
                        "Maine", "New Hampshire", "Massachusetts", "Rhode Island", "Connecticut", "New York", "New Jersey", "Delaware", "Maryland", "Virginia", "North Carolina", "South Carolina", "Georgia", "Florida"
                    ];

                    // Loop through all array positions
                    foreach($eastCoaststates as $state) {
                        // Output each state in an <li>
                        echo "<li>$state</li>";
                    };
                ?>
            </ul>
        </section>
    </main>
</body>
</html>