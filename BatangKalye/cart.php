<?php
session_start(); // Start the session

// Check if the user is logged in
$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <style>
         body {
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        .container-table {
            align-self: center;
            overflow-y: auto;
            max-height: 100vh;
            width: 80%;
            margin: 0 auto; /* Center the table horizontally */
        }
        .section-p1{
            padding-top: 5rem;
        }
        .section-p1 h1{
            text-align: center;
        }
        
        #cart table{
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
        }
        #cart table img{
            width: 70px;
        }
        #cart table td:nth-child(1){
            width: 100px;
            text-align: center;
        }
        #cart table td:nth-child(2){
            width: 150px;
            text-align: center;
        }
        #cart table td:nth-child(3){
            width: 250px;
            text-align: center;
        }
        #cart table td:nth-child(4),
        #cart table td:nth-child(5),
        #cart table td:nth-child(6){
            width: 150px;
            text-align: center;
        }
        #cart table td:nth-child(5) input{
            width: 70px;
            padding: 10px 5px 10px 15px;
        }
        #cart table thead{
            border: 1px solid #e2e9e1;
            border-left: none;
            border-right: none;
        }
        #cart table thead td{
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
            padding: 18px 0;
        }
        #cart table tbody tr td{
            padding-top: 15px;
        }
        #cart table tbody  td{
            font-size: 13px;
        }
        .btn-content{
            width: 150px;
            padding: 15px 0;
            text-align: center;
            margin: 20px 10px;
            border-radius: 25px;
            font-weight: bold;
            border: solid 2px black;
            background: transparent;
            color: black;
            cursor: pointer;
            position: relative;
            animation-delay: 0.8s;
            overflow: hidden;
        }
        .btn-content a{
            text-decoration: none;
            padding-top: .7rem;
            color: #fa3d3b  ;
        }
        .btn-content a:hover{
            color: black;
            transition: 0.5s ease;
        }

        span{
            background: black;
            height: 100%;
            width: 0;
            border-radius: 25px;
            position: absolute;
            bottom: 0;
            left: 0;
            z-index: -1;
            transition: 0.5s ease;
        }

        .btn-content:hover span{
            width: 100%;
        }

        .btn-content:hover{
            border: none;
            color: whitesmoke;
        }

        #cart-add{
            display: flex;
            flex-wrap: wrap; 
            justify-content: space-between;
        }
        #coupon{
            width: 50%;
            margin-bottom: 30px;
        }
        #coupon h3,
        #subTotal h3{
            padding-bottom: 15px;
        }
        #coupon input{
            padding: 10px 20px;
            outline: none;
            width: 60%;
            margin-right: 10px;
            border: 1px solid #e2e9e1;
        }
        #subTotal{
            width: 50%;
            margin-bottom: 30px;
            border: 1px solid #e2e9e1;
            padding: 30px;
        }
        #subTotal table{
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        #subTotal table td{
            width: 50%;
            border: 1px solid #e2e9e1;
            padding:10px;
            font-size: 13px;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            animation-name: fadeIn;
            animation-duration: 0.4s;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            animation-name: slideIn;
            animation-duration: 0.4s;
        }

        /* Modal Content Animation */
        @keyframes slideIn {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }

        @keyframes fadeIn {
            from {opacity: 0}
            to {opacity: 1}
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        /* Add this CSS to your existing styles */
.modal-content form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.modal-content form label {
    margin-bottom: 10px;
}

.modal-content form input,
.modal-content form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
}

.modal-content form button {
    width: auto;
    padding: 10px 20px;
    margin-top: 15px;
}

    </style>
</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="img/logo.png" alt="Logo">
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="purchases.php">My Purchases</a></li>
        <li><a href="#" class="active"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
        <li><a href="account.php">Account</a></li>
        <?php if ($userID): ?>
            <li><a href="log_out.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout (<?php echo htmlspecialchars($username); ?>)</a></li>
        <?php else: ?>
            <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
        <?php endif; ?>
    </ul>
</div>
    <div class="container-table">
        <section id="cart" class="section-p1">
            <h1>Your Cart</h1>
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Sub Total</td>
                </tr>
            </thead>
            <?php
            // Establish a database connection (Replace with your database credentials)
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "batang_kalye";

            // Create connection
            $conn = new mysqli($servername, $db_username, $db_password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve cart items for the current user
            if ($userID) {
                $sql = "SELECT * FROM cart WHERE user_id = $userID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $imagePath = isset($row["image"]) ? 'admin/uploads/' . basename($row["image"]) : 'path/to/default_image.jpg'; // Use default image if not found
                        echo "<tr>";
                        echo "<td><button onclick='removeFromCart(" . $row['cart_id'] . ")'><i class='fa fa-times' aria-hidden='true'></i></button></td>";
                        echo "<td><img src='{$imagePath}' alt='Product Image' style='width: 90px;'></td>";
                        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                        echo "<td>₱" . htmlspecialchars($row['price']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['order_quantity']) . "</td>";
                        echo "<td>₱" . htmlspecialchars($row['price'] * $row['order_quantity']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Please log in to view your cart.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
            </tbody>
        </table>
    </section>
    <?php
    // Establish a database connection (Replace with your database credentials)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "batang_kalye";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize subtotal variable
    $subtotal = 0;

    // Retrieve cart items for the current user
    if ($userID) {
        $sql = "SELECT * FROM cart WHERE user_id = $userID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Calculate subtotal for each item and add it to the total
                $subtotal += $row['price'] * $row['order_quantity'];
            }
        }
    }

    // Close the database connection
    $conn->close();
    ?>      
        <section id="cart-add" class="section-p1">
            <div id="coupon">
                <h3>Apply Coupon</h3>
                <div>
                    <input type="text" placeholder="Enter Your Coupon">
                    <button class="btn-content"><span></span>Apply</button>
                </div>
            </div>
            <div id="subTotal">
                <h3>Cart Total</h3>
                <table>
                    <tr>
                        <td>Cart Subtotal</td>
                        <td>₱<?php echo $subtotal; ?></td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td>₱<?php echo $subtotal; ?></td>
                    </tr>
                </table>
                <button class="btn-content" id="checkoutBtn"><span style="background: #fa3d3b;"></span>Proceed to Checkout</button>
            </div>
        </section>
    </div>
    <!-- MODAL WINDOW WHEN CHECKOUT BUTTON IS PRESSED -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Checkout</h2>
    <form id="checkout-form" action="process_checkout.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
    <label for="payment">Payment Option:</label>
    <select id="payment" name="payment" required>
        <option value="cash">Cash on Delivery(COD)</option>
        <option value="credit">Credit Card</option>
        <option value="paypal">PayPal</option>
    </select>
    <button type="submit" id="submitBtn">Submit</button>
</form>

  </div>
</div>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-col">
                <h4>Batang Kalye Merch</h4>
                <ul>
                    <li><a href="purchases.php">My Purchases</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>About us</h4>
                <ul>
                    <li><a href="cart.php">My Cart</a></li>
                    <li><a href="index.php">Check out now!</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Follow us</h4>
                <div class="social-links">
                    <a href="https://www.facebook.com/batangkalye.1101"><i class="fa fa-facebook-f"></i></a>
                    <a href=""><i class="fa fa-google"></i></a>
                </div>
            </div>
        </div>
        <h3>2024 Batang Kalye</h3>
    </div>
</footer>
</body>
<script>
    function addToCart(productID, productName, price) {
        // Construct the URL with query parameters
        const url = `cart.php?productID=${productID}&productName=${encodeURIComponent(productName)}&price=${price}`;

        // Redirect to cart.php with the product information
        window.location.href = url;
    }
</script>
<script>

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("checkoutBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
        document.body.style.overflow = "hidden"; // Disable scrolling
    }

    // When the user clicks on <span> (x) or outside of the modal, close the modal
    window.onclick = function(event) {
        if (event.target == modal || event.target == span) {
            modal.style.display = "none";
            document.body.style.overflow = "auto"; // Enable scrolling
        }
    }
</script>
<script>
document.getElementById("checkout-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Perform AJAX request to process checkout
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process_checkout.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Reload the page after a short delay to ensure server-side processes are completed
                setTimeout(function() {
                    location.reload();
                }, 1000); // Adjust the delay as needed
            } else {
                alert("Checkout failed: " + response.message);
            }
        } else {
            console.error("Checkout failed: " + xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error("Request failed.");
    };

    // Serialize form data
    var formData = new FormData(document.getElementById("checkout-form"));
    xhr.send(new URLSearchParams(formData));
});
</script>

<script>
    function removeFromCart(cartID) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Prepare the POST request
        xhr.open("POST", "remove_from_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Define what happens on successful data submission
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Reload the page to update the cart view after removal
                location.reload();
            }
        };

        // Define what happens in case of error
        xhr.onerror = function() {
            console.error("Request failed.");
            // You can handle errors here if needed
        };

        // Send the request with cartID as a parameter
        xhr.send("cartID=" + cartID);
    }
</script>
</html>
