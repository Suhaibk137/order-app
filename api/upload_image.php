<?php
// Include database connection
include_once 'config.php';

// Check if request is POST and contains a file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $target_dir = "uploads/";
    
    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    // Generate a unique file name
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . uniqid() . '.' . $file_extension;
    
    // Check file size (limit to 5MB)
    if ($_FILES["image"]["size"] > 5000000) {
        echo json_encode([
            "success" => false,
            "message" => "File is too large. Maximum size is 5MB."
        ]);
        exit;
    }
    
    // Allow only certain file formats
    $allowed_formats = ["jpg", "jpeg", "png"];
    if (!in_array(strtolower($file_extension), $allowed_formats)) {
        echo json_encode([
            "success" => false,
            "message" => "Only JPG, JPEG, and PNG files are allowed."
        ]);
        exit;
    }
    
    // Try to upload the file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo json_encode([
            "success" => true,
            "message" => "File uploaded successfully",
            "file_path" => $target_file
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "There was an error uploading your file."
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "No image file was sent or invalid request method."
    ]);
}
?>