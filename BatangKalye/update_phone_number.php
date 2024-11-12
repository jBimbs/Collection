<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Unauthorized
    exit("User not logged in");
}

// Retrieve POST data
$userID = $_SESSION['user_id'];
$newPhoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';

// Validate phone number format if necessary
if (!preg_match("/^\d{10}$/", $newPhoneNumber)) {
    http_response_code(400); // Bad Request
    exit("Invalid phone number format");
}

// Connect to your database
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "batang_kalye";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    exit("Connection failed: " . $conn->connect_error);
}

// Update phone number in the database
$sql = "UPDATE user SET phone_number = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $newPhoneNumber, $userID); // Assuming 'phone_number' is VARCHAR or TEXT

if ($stmt->execute()) {
    http_response_code(200); // Success
    echo "Phone number updated successfully!";
} else {
    http_response_code(500); // Internal Server Error
    echo "Failed to update phone number: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
