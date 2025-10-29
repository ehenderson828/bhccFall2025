<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- External CSS import -->
        <link rel="stylesheet" href="styles/main.css">
        <title>PHP Midterm - Problem 1</title>
    </head>
    <body>
        <header class="header">
            Final Grade Calculator
        </header>
        <main class="form-container">
            <form class="form">
                <label class="form-label">Select Numeric Grade Value</label>
                <!-- Grade select - selection handled by below PHP -->
                <select name="grades" id="grades">
                    <option value="default" disabled selected>Choose from List</option>
                    <option value="94-100">94-100%</option>
                    <option value="90-93">90-93%</option>
                    <option value="87-89">87-89%</option>
                    <option value="83-86">83-86%</option>
                    <option value="80-82">80-82%</option>
                    <option value="77-79">77-79%</option>
                    <option value="70-76">70-76%</option>
                    <option value="60-69">60-69%</option>
                    <option value="0-59">0-59%</option>
                </select>
                <!-- Submission button -->
                <button type="submit" id="submit-button">Submit</button>
            </form>
            <!-- Form handler -->
            <?php
                // Get the grade response from the user - if no selection, use default
                $grades = $_GET['grades'] ?? 'default';
                // Switch start
                switch ($grades) {
                    case '94-100':
                        $letterGrade = 'A';
                        break;
                    case '90-93':
                        $letterGrade = 'A-';
                        break;
                    case '87-89':
                        $letterGrade = 'B+';
                        break;
                    case '83-86':
                        $letterGrade = 'B';
                        break;
                    case '80-82':
                        $letterGrade = 'B-';
                        break;
                    case '77-79':
                        $letterGrade = 'C+';
                        break;
                    case '70-76':
                        $letterGrade = 'C';
                        break;
                    case '60-69':
                        $letterGrade = 'D';
                        break;
                    case '0-59':
                        $letterGrade = 'F';
                        break;
                    default:
                        $letterGrade = 'Please select a grade';
                        break;
                }
                // Switch end
                // Display the result
                echo "<div class='result'><h1 class='final-grade'>Your letter grade is: $letterGrade</h1></div>";
            ?>
        </main>
        
    </body>
</html>