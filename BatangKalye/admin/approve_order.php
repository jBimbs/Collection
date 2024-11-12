<?php
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

// Check if the required data is provided
if (
    isset($_POST['order_id']) && !empty($_POST['order_id']) &&
    isset($_POST['product_id']) && !empty($_POST['product_id']) &&
    isset($_POST['image']) && !empty($_POST['image']) &&
    isset($_POST['product_name']) && !empty($_POST['product_name']) &&
    isset($_POST['price']) && !empty($_POST['price']) &&
    isset($_POST['user_id']) && !empty($_POST['user_id']) &&
    isset($_POST['customer_id']) && !empty($_POST['customer_id']) &&
    isset($_POST['customer_name']) && !empty($_POST['customer_name']) &&
    isset($_POST['address']) && !empty($_POST['address']) &&
    isset($_POST['date']) && !empty($_POST['date'])
) {
    // Sanitize inputs (for security)
    $order_id = htmlspecialchars($_POST['order_id']);
    $product_id = htmlspecialchars($_POST['product_id']);
    $image = htmlspecialchars($_POST['image']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $price = htmlspecialchars($_POST['price']);
    $user_id = htmlspecialchars($_POST['user_id']);
    $customer_id = htmlspecialchars($_POST['customer_id']);
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $address = htmlspecialchars($_POST['address']);
    $date = htmlspecialchars($_POST['date']);

    // Calculate arrival date (7 days from now)
    $arrival_date = date('Y-m-d H:i:s', strtotime('+7 days'));

    // Insert data into transactions table
    $insert_sql = "INSERT INTO transaction (order_id, product_id, image, product_name, price, user_id, customer_id, customer_name, address, date, arrival, approved) 
                   VALUES ('$order_id', '$product_id', '$image', '$product_name', '$price', '$user_id', '$customer_id', '$customer_name', '$address', '$date', '$arrival_date', 'approved')";

    if ($connection->query($insert_sql) === TRUE) {
        // Delete the approved order from sales_view
        $delete_sales_view_sql = "DELETE FROM sales_view WHERE order_id='$order_id' AND product_id='$product_id' AND customer_id='$customer_id'";
        if ($connection->query($delete_sales_view_sql) === TRUE) {
            // Delete the order from orders table
            $delete_orders_sql = "DELETE FROM orders WHERE order_id='$order_id' AND product_id='$product_id' AND customer_id='$customer_id'";
            if ($connection->query($delete_orders_sql) === TRUE) {
                echo "New record created, approved order deleted from sales_view, and deleted from orders successfully";
            } else {
                echo "Error deleting order from orders table: " . $connection->error;
            }
        } else {
            echo "Error deleting approved order from sales_view: " . $connection->error;
        }
    } else {
        echo "Error inserting into transaction table: " . $connection->error;
    }
} else {
    echo "Required data not provided";
}

// Close the connection
$connection->close();
?>
