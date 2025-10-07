<?php 
    // Check to see if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        // Retrieve the submitted data from the user
        $data = $_POST["data"];    
        // Set the file path
        $file = "../data/records.csv";    
        // Write this submitted data to the targeted file while appending and adding a new line
        file_put_contents($file, $data . PHP_EOL, FILE_APPEND);    
        // Alert the user that the data has been sent successfully
        echo "Data added successfully!"; 
    } 
?>