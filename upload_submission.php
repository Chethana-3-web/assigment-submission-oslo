<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $allowedExtensions = ['doc', 'docx', 'epub', 'gdoc', 'odt', 'oth', 'ott', 'pdf', 'rtf'];
    $maxSize = 20 * 1024 * 1024; // 20 MB

    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $fileSize = $file['size'];

    if (!in_array($fileExt, $allowedExtensions)) {
        echo json_encode(["success" => false, "message" => "Invalid file type."]);
        exit;
    }

    if ($fileSize > $maxSize) {
        echo json_encode(["success" => false, "message" => "File exceeds 20MB limit."]);
        exit;
    }

    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save file."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No file uploaded."]);
}
?>
