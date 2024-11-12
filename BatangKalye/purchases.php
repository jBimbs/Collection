<?php
session_start(); // Start the session

// Check if the user is logged in
$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

// Establish database connection (replace with your own credentials)
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "batang_kalye";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders from the database for the logged-in user
$sql = "SELECT transaction_id, product_id, image, product_name, price, arrival, approved
        FROM transaction
        WHERE user_id = '$userID'
        ORDER BY arrival DESC"; // Assuming 'customer_id' is the field that links to the user


$result = $conn->query($sql);

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

        .row{
            display: flex;
            height: 88%;
            margin-left: 3rem;
            margin-right: 3rem;
            align-items: center;
        }
        .col{
            flex-basis: 50%;
            margin-left: 3rem;
            margin-right: 3rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .col img{
            flex-basis: 50%;
            margin-top: 11rem;
            margin-left: 9rem;
            width: auto;
            height: 530px;
            z-index: 1;
        }
        .row .col h1{
            margin-top: 08rem;   
            color: #fcf40c;
            line-height: 60px;
            font-size: 80px;
            font-family: 'Sifonn', sans-serif;
        }
        .row .col p{
            padding-top: 2rem;
        }
        .btn-content{
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
        .btn-content a{
            text-decoration: none;
            padding-top: .7rem;
            color: #ffd800  ;
        }
        .btn-content a:hover{
            color: whitesmoke;
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

        /*Featured Products */
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
        
        .container-table h1{
            text-align: center;
            padding-top: 5rem;
        }
        .container-table {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            margin-bottom: 6rem;
        }

        #purchases {
            line-height: 20px;
            width: 100%;
        }
        /* CSS for changing font color based on status */
.delivered {
    color: green;
}

.being-delivered {
    color: blue;
}

    </style>
</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="img/logo.png" alt="Logo">
    </div>
    <ul>
        <li><a href="index.php" >Home</a></li>
        <li><a href="purchases.php" class="active">My Purchases</a></li>
        <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
        <li><a href="account.php">Account</a></li>
        <?php if ($userID): ?>
            <li><a href="log_out.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout (<?php echo htmlspecialchars($username); ?>)</a></li>
        <?php else: ?>
            <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
        <?php endif; ?>
    </ul>
</div>
    <div class="container-table">
        <h1>Purchases History</h1>
        <section id="cart" class="section-p1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Image</td>
                        <td>Product Name</td>
                        <td>Price</td>
                        
                        <td>Date of Arrival</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each row of the result set
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $imagePath = isset($row["image"]) ? 'admin/uploads/' . basename($row["image"]) : 'path/to/default_image.jpg'; // Use default image if not found
                            echo "<tr>";
                            echo "<td><img src='{$imagePath}' alt='Product Image' style='width: 90px;'></td>";
                            echo "<td>" . $row['product_name'] . "</td>";
                            echo "<td>₱" . $row['price'] . "</td>";
                            echo "<td>" . $row['arrival'] . "</td>";
                            echo "<td class='" . getStatusClass($row['approved']) . "'>" . $row['approved'] . "</td>"; // Apply class based on approved status
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No orders found.</td></tr>";
                    }
                    // Function to return CSS class based on approved status
function getStatusClass($approvedStatus) {
    switch ($approvedStatus) {
        case 'delivered':
            return 'delivered';
        case 'being delivered':
            return 'being-delivered';
        default:
            return ''; // Default to no special class
    }
}
                    ?>
                </tbody>
            </table>
        </section>
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
</html>

<?php
// Close the database connection
$conn->close();
?>
