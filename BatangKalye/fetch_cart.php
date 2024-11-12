<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit;
}

// Retrieve user ID from the session
$userID = $_SESSION['user_id'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = ""; // Enter your password here
$dbname = "batang_kalye";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to fetch cart items
$sql = "SELECT * FROM cart WHERE user_id = $userID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='#'><i class='far fa-times-circle'></i></a></td>";
        echo "<td><img src='' alt='" . $row['product_name'] . "'></td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td><input type='number' value='" . $row['order_quantity'] . "'></td>";
        echo "<td>Total Price</td>"; // Placeholder for the total price, you can calculate this if needed
        echo "<td><button class='cart-btn' data-product-id='" . $row['product_id'] . "'><i class='fa fa-shopping-cart'></i></button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No items in the cart.</td></tr>";
}

$conn->close();
?>
