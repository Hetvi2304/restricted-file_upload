<?php
$target_dir = "uploads/"; // Directory to store uploads
$allowed_types = ['image/jpeg', 'image/png', 'image/gif']; // Allowed MIME types
$max_size = 2 * 1024 * 1024; // Max file size (2MB)

// Check if a file is uploaded
if (!isset($_FILES["fileToUpload"]) || $_FILES["fileToUpload"]["error"] != 0) {
    die("Error: No file uploaded or an upload error occurred.");
}

// Validate MIME type
$file_type = mime_content_type($_FILES["fileToUpload"]["tmp_name"]);
if (!in_array($file_type, $allowed_types)) {
    die("Error: Invalid file type! Only JPG, PNG, and GIF files are allowed.");
}

// Validate file size
if ($_FILES["fileToUpload"]["size"] > $max_size) {
    die("Error: File size exceeds 2MB limit.");
}

// Generate a unique filename to prevent overwriting and hide original names
$ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
$new_filename = uniqid() . "." . $ext;
$target_file = $target_dir . $new_filename;

// Move file to the upload directory
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "File uploaded successfully. <a href='$target_file'>Click here to view your file</a>";
} else {
    echo "Error: File upload failed.";
}
?>
