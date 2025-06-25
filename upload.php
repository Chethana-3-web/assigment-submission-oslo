<?php
// upload.php

// Define the directory where files will be saved
$uploadDir = 'uploads/';

// Create the directory if it doesn't exist
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Check if a file is received
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Validate the file size (limit to 20 MB)
    if ($file['size'] > 20 * 1024 * 1024) { // 20 MB limit
        echo "File is too large. Max file size is 20MB.";
        exit;
    }

    // Define the path to save the file
    $targetFile = $uploadDir . basename($file['name']);

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        echo "File uploaded successfully!";
    } else {
        echo "Failed to upload file.";
    }
} else {
    echo "No file uploaded.";
}
?>
