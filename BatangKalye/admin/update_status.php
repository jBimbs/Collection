<?php
// update_status.php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input (transaction_id and status)
    $transactionId = $_POST['transaction_id'];
    $status = $_POST['status'];

    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "batang_kalye";

    // Create connection to the database
    $connection = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Validate status before updating
    if ($status === 'delivered' || $status === 'being-delivered') {
        // Update the status in the database
        $sql = "UPDATE transaction SET approved = '$status' WHERE transaction_id = $transactionId";

        if ($connection->query($sql) === TRUE) {
            // Status updated successfully
            echo json_encode(array("status" => "success"));
        } else {
            // Error updating status
            echo json_encode(array("status" => "error", "message" => "Error updating status: " . $connection->error));
        }
    } else {
        // Invalid status received
        echo json_encode(array("status" => "error", "message" => "Invalid status: " . $status));
    }

    // Close the connection
    $connection->close();
} else {
    // If not a POST request, handle accordingly (e.g., redirect or error response)
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>