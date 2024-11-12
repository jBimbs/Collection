<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "batang_kalye";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve and sanitize POST data
$adminId = $_POST['admin_id'];
$adminUserName = $_POST['admin_username'];
$password = $_POST['password']; // It's recommended to hash the password for security, but for simplicity, we'll use it directly

// Prepare SQL statement
$sql = "UPDATE admin SET admin_username=?, password=? WHERE admin_id=?";

// Use prepared statements to prevent SQL injection
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssi", $adminUserName, $password, $adminId);

// Execute SQL statement
if ($stmt->execute()) {
    // If update successful, return success response
    echo json_encode(array("status" => "success", "message" => "Admin updated successfully."));
} else {
    // If update fails, return error response
    echo json_encode(array("status" => "error", "message" => "Error updating admin: " . $stmt->error));
}

// Close statement and connection
$stmt->close();
$connection->close();
?>
