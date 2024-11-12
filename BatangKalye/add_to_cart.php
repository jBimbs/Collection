
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($userID) {
        // Retrieve POST data
        $productID = isset($_POST['productID']) ? $_POST['productID'] : '';
        $productName = isset($_POST['productName']) ? $_POST['productName'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $orderQuantity = isset($_POST['orderQuantity']) ? $_POST['orderQuantity'] : 1; // Default to 1
        $image = isset($_POST['image']) ? $_POST['image'] : '';

        // Validate data
        if (!empty($productID) && !empty($productName) && !empty($price) && !empty($orderQuantity) && !empty($image)) {
            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "batang_kalye";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Insert product into cart
            $stmt = $conn->prepare("INSERT INTO cart (product_id, product_name, user_id, price, order_quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isiids", $productID, $productName, $userID, $price, $orderQuantity, $image);

            if ($stmt->execute()) {
                echo "Product added to cart successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Invalid product data";
        }
    } else {
        echo "User not logged in";
    }
} else {
    echo "Invalid request method";
}
?>