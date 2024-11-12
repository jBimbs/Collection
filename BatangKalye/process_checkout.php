<?php
// Start the session
session_start();

// Check if the user is logged in
$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// If user is not logged in, redirect to the login page or display an error message
if (!$userID) {
    $response = [
        'success' => false,
        'message' => 'User is not logged in.'
    ];
    echo json_encode($response);
    exit;
}

// Include your database connection file
include_once "connection.php";

// Retrieve form data
$name = $_POST['name'];
$address = $_POST['address'];
$paymentOption = $_POST['payment'];

// Insert data into the customer table
$sql = "INSERT INTO customer (customer_name, user_id, address, payment) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $name, $userID, $address, $paymentOption);

if ($stmt->execute()) {
    // Insertion into customer table successful
    // Now, insert orders into the orders table for each product ID
    $sqlSelectCart = "SELECT * FROM cart WHERE user_id = ?";
    $stmtSelectCart = $conn->prepare($sqlSelectCart);
    $stmtSelectCart->bind_param("i", $userID);
    $stmtSelectCart->execute();
    $resultCart = $stmtSelectCart->get_result();

    while ($row = $resultCart->fetch_assoc()) {
        $productID = $row['product_id'];
        $price = $row['price']; // Assuming 'price' is a column in your 'cart' table
        $imageUrl = $row['image']; // Assuming 'image' is a column in your 'cart' table
    
        // Insert into orders table with price and image included
        $orderSql = "INSERT INTO orders (product_id, price, user_id, image) VALUES (?, ?, ?, ?)";
        $orderStmt = $conn->prepare($orderSql);
        $orderStmt->bind_param("idis", $productID, $price, $userID, $imageUrl);
    
        if ($orderStmt->execute()) {
            // Insertion into orders table successful
            // Optionally, you can handle additional logic here
        } else {
            // Insertion into orders table failed
            $response = [
                'success' => false,
                'message' => 'Error inserting into orders table: ' . $orderStmt->error
            ];
            echo json_encode($response);
            exit;
        }
    
        // Remove item from cart
        $deleteSql = "DELETE FROM cart WHERE cart_id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $row['cart_id']);
        $deleteStmt->execute();
    }
    
    // Close statements
    $stmtSelectCart->close();
    $orderStmt->close();
    $deleteStmt->close();

    // Prepare JSON response with success message
    $response = [
        'success' => true,
        'message' => 'Checkout successful.'
    ];
    echo json_encode($response);
} else {
    // Insertion into customer table failed
    $response = [
        'success' => false,
        'message' => 'Error inserting into customer table: ' . $stmt->error
    ];
    echo json_encode($response);
}

$stmt->close();
$conn->close();
?>
