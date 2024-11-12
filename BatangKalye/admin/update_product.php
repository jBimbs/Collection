<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST['price'];

    // Sanitize input to prevent SQL injection
    $product_name = mysqli_real_escape_string($connection, $product_name);
    $price = mysqli_real_escape_string($connection, $price);

    // Check if an image was uploaded
    if ($_FILES["product_image"]["error"] === UPLOAD_ERR_OK) {
        // Handle image upload
        // ...
    } else {
        // Update product information excluding image
        $sql = "UPDATE product SET product_name='$product_name', price='$price' WHERE product_id=$product_id";
        if ($connection->query($sql) === TRUE) {
            // Redirect to products page after successful update
            header("Location: products.php");
            exit(); // Ensure no further code execution after redirect
        } else {
            // Handle database error
            echo "Error updating product: " . $connection->error;
        }
    }
}

// Close the connection
$connection->close();
?>
