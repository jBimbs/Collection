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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>Batang Kalye</title>
    <style>
          /* CSS for navbar */
          body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .row {
            display: flex;
            height: 88%;
            margin-left: 3rem;
            margin-right: 3rem;
            align-items: center;
        }
        .col {
            flex-basis: 50%;
            margin-left: 3rem;
            margin-right: 3rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .col img {
            flex-basis: 50%;
            margin-top: 11rem;
            margin-left: 9rem;
            width: auto;
            height: 530px;
            z-index: 1;
        }
        .row .col h1 {
            margin-top: 08rem;
            color: #fcf40c;
            line-height: 60px;
            font-size: 80px;
            font-family: 'Sifonn', sans-serif;
        }
        .row .col p {
            padding-top: 2rem;
        }
        .btn-content {
            width: 150px;
            padding: 15px 0;
            text-align: center;
            margin: 20px 10px;
            border-radius: 25px;
            font-weight: bold;
            border: solid 2px #ffd800;
            background: transparent;
            color: #fff;
            cursor: pointer;
            position: relative;
            animation-delay: 0.8s;
            overflow: hidden;
        }
        .btn-content a {
            text-decoration: none;
            padding-top: .7rem;
            color: #ffd800;
        }
        .btn-content a:hover {
            color: whitesmoke;
            transition: 0.5s ease;
        }
        span {
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

        .btn-content:hover span {
            width: 100%;
        }
        .btn-content:hover {
            border: none;
            color: whitesmoke;
        }

        /* Featured Products */
        .section-p1 {
            margin: 2rem;
            padding-top: 5rem;
        }
        #product1 {
            text-align: center;
        }
        #product1 .pro-container {
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
            flex-wrap: wrap;
        }
        #product1 .pro {
            width: 23%;
            min-width: 250px;
            padding: 10px 12px;
            border: 1px solid #cce7d0;
            border-radius: 25px;
            cursor: pointer;
            box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02);
            margin: 15px 0;
            transition: 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 400px; /* Set a fixed height for product boxes */
        }
        #product1 .pro:hover {
            box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.06);
        }
        #product1 .pro img {
            width: 100%;
            height: 300px; /* Set a fixed height for images */
            border-radius: 20px;
            object-fit: cover;
        }
        #product1 .pro .des {
            text-align: start;
            padding: 10px 0;
        }
        #product1 .pro .des span {
            color: #606063;
            font-size: 12px;
        }
        #product1 .pro .des h5 {
            padding-top: 7px;
            color: #1a1a1a;
            font-size: 14px;
        }
        #product1 .pro .cart-btn {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            background-color: #e8f6ea;
            font-weight: 500;
            color: #fa3d3b;
            border: 1px solid #cce7d0;
            position: absolute;
            bottom: 20px;
            cursor: pointer;
            right: 10px;
            text-align: center;
        }
        #product1 .pro .cart-btn i {
            line-height: 40px;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="img/logo.png" alt="Logo">
    </div>
    <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href="purchases.php">My Purchases</a></li>
        <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
        <li><a href="account.php">Account</a></li>
        <?php if ($userID): ?>
            <li><a href="log_out.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout (<?php echo htmlspecialchars($username); ?>)</a></li>
        <?php else: ?>
            <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
        <?php endif; ?>
    </ul>
</div>

<div class="container" style="padding: 20px;">
    <div class="row">
        <div class="col">
            <h1>HOOPX X Batang Kalye</h1>
            <p>"Welcome to Batang Kalye Merch, where street style meets urban flair! Explore our collection of trendy apparel and accessories inspired by the vibrant energy of city life. From edgy graphics to bold statements, we've got something to elevate your streetwear game. Shop now and join the urban revolution!"</p>
            <button type="button" class="btn-content"><a href="cart.php"><span></span>Check-out Now!</a></button>
        </div>
        <div class="col">
            <img src="img/banner.jpg"> 
        </div>
    </div>
</div>

<!-- Featured Products section -->
<section id="product1" class="section-p1">
    <h2>Featured Product</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
        // Connect to your database
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

        // Query to fetch products from the database
        $sql = "SELECT * FROM product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch products row by row
            while($row = $result->fetch_assoc()) {
                $imagePath = 'admin/uploads/' . basename($row["image"]);
                ?>
                <div class="pro">
                <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                    <div class="des">
                        <h5><?php echo htmlspecialchars($row['product_name']); ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4><?php echo htmlspecialchars($row['price']); ?></h4>
                    </div>
                    <button class="cart-btn" data-product-id="<?php echo $row['product_id']; ?>" data-product-image="<?php echo htmlspecialchars($imagePath); ?>"><i class="fa fa-shopping-cart"></i></button>

                </div>
                <?php
            }
        } else {
            // If no products found, display a message
            echo "<p>No products available</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</section>

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

<script>
document.querySelectorAll('.cart-btn').forEach(button => {
    button.addEventListener('click', function() {
        const productID = this.getAttribute('data-product-id');
        const productName = this.parentElement.querySelector('.des h5').innerText;
        const price = this.parentElement.querySelector('.des h4').innerText;
        const orderQuantity = 1; // You can adjust this value or make it dynamic if needed
        const productImage = this.getAttribute('data-product-image'); // Get the product image URL

        // Retrieve the user_id from the session
        const userID = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;

        if (userID !== null) {
            // Send an AJAX request to the server
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_to_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Show response from server
                    // Redirect to the cart page if necessary
                    window.location.href = 'cart.php';
                } else {
                    console.error('Failed to add item to cart');
                }
            };
            const params = `userID=${userID}&productID=${productID}&productName=${encodeURIComponent(productName)}&price=${encodeURIComponent(price)}&orderQuantity=${orderQuantity}&image=${encodeURIComponent(productImage)}`;
            xhr.send(params);
        } else {
            // Redirect to the login page if the user is not logged in
            window.location.href = 'login.php';
        }
    });
});

</script>

</body>
</html>
