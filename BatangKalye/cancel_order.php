<?php
session_start(); // Start the session

// Check if the user is logged in
$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$userID) {
    http_response_code(403); // Unauthorized
    exit("User not logged in");
}

// Validate incoming data (order ID)
$orderID = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;

if (!$orderID) {
    http_response_code(400); // Bad Request
    exit("Invalid order ID");
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

// Perform cancellation (assuming 'orders' table structure)
$sql = "DELETE FROM orders WHERE order_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $orderID, $userID);

if ($stmt->execute()) {
    http_response_code(200); // Success
    echo "Order cancelled successfully!";
} else {
    http_response_code(500); // Internal Server Error
    echo "Failed to cancel order: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
