<?php
session_start(); // Start the session

// Check if the cartID parameter is set
if (isset($_POST['cartID'])) {
    // Get the cartID from the POST data
    $cartID = $_POST['cartID'];

    // Establish a database connection (Replace with your database credentials)
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

    // Construct the SQL query to delete the item from the cart
    $sql = "DELETE FROM cart WHERE cart_id = $cartID";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Item removed successfully
        echo "Item removed from cart successfully";
    } else {
        // Error occurred while removing item
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where cartID parameter is not set
    echo "Cart ID parameter is missing";
}
?>
