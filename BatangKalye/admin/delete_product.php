<?php
// Check if product ID is set in the URL
if(isset($_GET['id'])) {
    // Retrieve the product ID from the URL
    $product_id = $_GET['id'];
    
    // Database connection
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

    // Prepare SQL statement to delete product
    $sql = "DELETE FROM product WHERE product_id = $product_id";

    // Execute SQL statement
    if ($connection->query($sql) === TRUE) {
        // Redirect back to the admin page after successful deletion
        header("Location: products.php");
        exit();
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    // Close connection
    $connection->close();
} else {
    // If product ID is not set in the URL, redirect to the admin page
    header("Location: admin.php");
    exit();
}
?>
