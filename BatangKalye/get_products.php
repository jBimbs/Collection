<?php
// Connect to your database (replace with your actual database credentials)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "batang_kalye";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products from the database
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an empty array to store products
    $products = array();

    // Fetch products row by row
    while($row = $result->fetch_assoc()) {
        // Add each product to the $products array
        $products[] = $row;
    }

    // Encode the products array as JSON and output it
    echo json_encode($products);
} else {
    // If no products found, return an empty array
    echo json_encode(array());
}

// Close the database connection
$conn->close();
?>
