<?php
$target_dir = "uploads/"; 
$allowed_types = ['image/jpeg', 'image/png', 'image/gif']; 
$max_size = 2 * 1024 * 1024; 


if (!isset($_FILES["fileToUpload"]) || $_FILES["fileToUpload"]["error"] != 0) {
    die("Error: No file uploaded or an upload error occurred.");
}

$file_type = mime_content_type($_FILES["fileToUpload"]["tmp_name"]);
if (!in_array($file_type, $allowed_types)) {
    die("Error: Invalid file type! Only JPG, PNG, and GIF files are allowed.");
}


if ($_FILES["fileToUpload"]["size"] > $max_size) {
    die("Error: File size exceeds 2MB limit.");
}


$ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
$new_filename = uniqid() . "." . $ext;
$target_file = $target_dir . $new_filename;


if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "File uploaded successfully. <a href='$target_file'>Click here to view your file</a>";
} else {
    echo "Error: File upload failed.";
}
?>
