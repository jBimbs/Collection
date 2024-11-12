<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

// Get user ID
$userID = $_SESSION['user_id'];

// Check if file was sent
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get file details
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps)); // Get file extension

    // Valid extensions
    $allowedExtensions = ['jpeg', 'jpg', 'png'];

    // Check if extension is valid
    if (in_array($fileExtension, $allowedExtensions)) {
        // Generate unique file name to prevent overwriting existing files
        $newFileName = uniqid() . '.' . $fileExtension;

        // Directory to save uploaded images (adjust as needed)
        $uploadDir = 'user_image_upload/';

        // Path to save in the database (assuming user_image column in users table)
        $dbImagePath = $uploadDir . $newFileName;

        // Upload file to server
        $uploadFilePath = $uploadDir . $newFileName;
        if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
            // Update user image path in the database
            // Connect to your database (replace with your database credentials)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "batang_kalye";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare update statement
            $stmt = $conn->prepare("UPDATE user SET user_image = ? WHERE user_id = ?");
            $stmt->bind_param("si", $dbImagePath, $userID);

            // Execute update statement
            if ($stmt->execute()) {
                // Close statement and connection
                $stmt->close();
                $conn->close();

                // Return the uploaded image path
                echo $dbImagePath;
            } else {
                // Error updating database
                echo "Error updating database.";
            }
        } else {
            // Error uploading file
            echo "Error uploading file.";
        }
    } else {
        // Invalid file type
        echo "Invalid file type. Allowed types: jpeg, jpg, png.";
    }
} else {
    // Error with file upload
    echo "Error with file upload: " . $_FILES['file']['error'];
}
?>
