<?php 
    // GET desired file
    $fileName = $_GET['file'] ?? '';
    // Check to see if file is empty
    if (empty($fileName)) {
        die('no file specified');
    }
    // Sanitize filename to prevent directory issues
    $fileName = basename($fileName);
    $filePath = __DIR__ . '/output-data/' . $fileName;
    // Check to see if file exists
    if (!file_exists($filePath)) {
        die('File not found');
    }
    // Set headers for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Length: ' . filesize($filePath));
    // Output file
    readfile($filePath);
    exit;
?>