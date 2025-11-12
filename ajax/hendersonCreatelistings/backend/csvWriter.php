<?php 
    // Set headers for JSON response
    header('Content-Type: application/json');
    // Error handling
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // Assign data from the POST request
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    if (!$data) {
        echo json_encode(['success' => false, 'error' => 'No data received']);
        exit;
    }
    // Data extraction
    $fileName = $data['filename'] ?? 'output.csv';
    $headers = $data['headers'] ?? [];
    $rows = $data['rows'] ?? [];
    // Create output directory if it does not already exist
    $outputDir = __DIR__ . '/output-data';
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0755, true);
    }
    // Create file path to the CSV file
    $filePath = $outputDir . '/' . $fileName;
    // Open the file
    $file = fopen($filePath, 'w');
    // Check to see if the file exists
    if ($file === false) {
        echo json_encode(['success' => false, 'error' => 'Could not create file']);
        exit;
    }
    // Write the CSV headers
    fputcsv($file, $headers);
    // Write the CSV rows
    foreach($rows as $row) {
        fputcsv($file, $row);
    }
    // Close the file
    fclose($file);
    // Return success response with the file path
    echo json_encode([
        'success' => true,
        'filename' => $fileName,
        'filepath' => 'output-data/' . $fileName,
        'message' => 'CSV file created successfully'
    ]);
?>