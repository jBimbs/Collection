<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Forbidden
    exit("Unauthorized access");
}

// Receive POST data
$userID = $_POST['user_id'];
$newUsername = $_POST['username'];

// Validate inputs (you can add more validation as needed)
if (empty($userID) || empty($newUsername)) {
    http_response_code(400); // Bad request
    exit("User ID and new username are required");
}

// Sanitize inputs to prevent SQL injection
$userID = htmlspecialchars($userID);
$newUsername = htmlspecialchars($newUsername);

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "batang_kalye";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500); // Internal server error
    exit("Connection failed: " . $conn->connect_error);
}

// Update username in the database
$sql = "UPDATE user SET user_name = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $newUsername, $userID);

if ($stmt->execute()) {
    // Username updated successfully
    http_response_code(200); // OK
    echo "Username updated successfully";
} else {
    // Failed to update username
    http_response_code(500); // Internal server error
    echo "Error updating username: " . $conn->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
