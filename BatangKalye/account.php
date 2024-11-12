<?php
session_start(); // Start the session

// Check if the user is logged in
$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$imagePath = 'img/user_image_default.png'; // Default image path

// Set current month and year
$currentMonthYear = date('Y-m');

// Connect to your database
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "batang_kalye";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch logged-in user's image and other details
$sql = "SELECT * FROM user WHERE user_id = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch user's data
    $row = $result->fetch_assoc();
    if (!empty($row["user_image"])) {
        // Use uploaded image if available
        $imagePath = 'user_image_upload/' . basename($row["user_image"]);
    }
    // Fetch phone number from the user table
    $phoneNumber = $row['phone_number']; // Assuming 'phone_number' is a column in your 'user' table
} else {
    // Handle case where user data is not found
    $phoneNumber = ''; // Set default or handle as per your application logic
}

// Query to fetch user's orders for the current month
$sql_orders = "SELECT o.order_id, o.product_id, o.date, p.image, p.price, p.product_name
               FROM orders o 
               INNER JOIN product p ON o.product_id = p.product_id 
               WHERE o.user_id = '$userID' 
               AND DATE_FORMAT(o.date, '%Y-%m') = '$currentMonthYear'";

$result_orders = $conn->query($sql_orders);

// Close the database connection
$conn->close();
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
        
       h2 {
    position: relative;
    text-align: center;
    background:black;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: colorChange .5s linear infinite;
    transition: background-color 0.5s ease;
}

@keyframes colorChange {
    0% {
        background-position: 0 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

h2::after {
    content: "";
    display: block;
    width: 220px;
    height: 2px;
    background-color: #ffd800;
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
}

.profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    
    border-radius: 25px;
    background-color: #f0f0f0;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 80%;
    margin: 0 auto;
    position: relative;
}

.profile-info {
    width: 100%;
}

.profile-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 20px;
}

.profile-header h3 {
    font-family: 'Sifonn', sans-serif;
    margin-bottom: 10px;
    color: #ffd800;
}

.student-info {
    display: flex;
    justify-content: space-between;
    width: 100%;
}



table {
    border-collapse: collapse;
    width: 100%;
    overflow-y: auto; /* This line ensures horizontal scrolling */
    background: whitesmoke;
    table-layout: fixed; /* This makes the table fixed */
}

.container {
    padding-top: 7rem;
    margin-bottom: 5rem;
}

.container h2 {
    padding-top: 1rem;
    font-size: 30px;
}

.container-table {
    display: flex;
    
    flex-direction: column; 
}

.container-table table th {
    border-left: none;
    border-right: none;
}

table, th, td {
    border: 1px solid #e2e9e1;
    border-left: none;
    border-right: none;
    font-size: 10px;
}

.container-table th {
    border-top: none;
}

.container-table table td {
    border-bottom: none;
}

th, td {
    padding: 8px;
    text-align: left;
}

.container-table form {
    display: inline-block;
    vertical-align: top;
}

.container-table form input[type="submit"] {
    width: 100px;
    min-height: 50px;
    
    
    cursor: pointer;
}


.table-box {
    width: 100%;
    border: 1px solid #e2e9e1;
    padding: 15px;
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    background: whitesmoke;
    box-sizing: border-box;
    overflow-x: auto;
}

.table-box th {
    border: none;
    padding: 8px;
    text-align: left;
}

thead {
    background-color: #333;
    color: white;
}

.navbar .logo img {
    width: 60px;
    height: 60px;
}

.navbar h1 {
    font-size: 20px;
    padding-right: 45rem;
    color: #ccc;
}

.container-table h2 {
    color: #ffd800;
}
form{
    padding-left:37rem;
}
input {
    margin-bottom: 1rem;
    width: 10rem;
    font-size: 15px;
    
}

.table table-bordered table-striped mt-4 {
    border-radius: 15px;
}
.profile-container .profile-header img {
    width: 100px; /* Adjust image width */
    height: 100px; /* Adjust image height */
    border-radius: 50%; /* Make the image circular */
    object-fit: cover; /* Maintain aspect ratio and cover container */
}
    .profile-header h1{
        font-size: 20px;
    }
    .user-image img{
        width: 300px;
    }
    .username-section {
        
        align-items: center;
    }
    .edit {
    background: #ffd800;
    border: none;
    color: white; /* Blue color, change as needed */
    cursor: pointer;
    margin-left: 5px; /* Adjust spacing */
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
            <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
            <li><a href="#" class="active">Account</a></li>
            <?php if ($userID): ?>
                <li><a href="log_out.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout (<?php echo htmlspecialchars($username); ?>)</a></li>
            <?php else: ?>
                <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="container">
        <<div class="profile-container">
        <div class="profile-info">
            <div class="profile-header">
                <h2>Account Information</h2>
                <div class="user-image">
                    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($username); ?>">
                    <!-- Edit button to trigger image upload -->
                    <button class="edit-button" onclick="openFileInput()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                </div>
                <div class="student-info">
                    <div class="left-side">
                        <p><b>User ID:</b> <?php echo $userID; ?></p>
                        <div class="username-section">
                            <p><b>Username:</b> <span id="username"><?php echo htmlspecialchars($username); ?></span><button class="edit" onclick="editUsername()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></p>
                            
                        </div>
                        <p><b>Password:</b> ********* <button class="edit" onclick="editPassword()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></p>
                    </div>
                    <div class="right-side">
                    <p><b>Phone Number:</b> <?php echo htmlspecialchars($phoneNumber); ?> <button class="edit" onclick="editPhoneNumber()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></p>
                    <p><b>Address:</b> 2-7</p>
                    </div>
                </div>
            </div>
        </div>
        <h1>Purchases This Month</h1>
        <section id="cart" class="section-p1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Image</td>
                        <td>Product Name</td>
                        <td>Price</td>
                        <td>Date Ordered</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    if ($result_orders->num_rows > 0) {
                        // Loop through each row of the result set
                        while($row = $result_orders->fetch_assoc()) {
                            // Display or process each order row
                            $imagePath = isset($row["image"]) ? 'admin/uploads/' . basename($row["image"]) : 'path/to/default_image.jpg'; // Use default image if not found
                            echo "<tr>";
                            echo "<td><img src='{$imagePath}' alt='Product Image' style='width: 90px;'></td>";
                            echo "<td>" . $row['product_name'] . "</td>";
                            echo "<td>₱" . $row['price'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td><button onclick='cancelOrder({$row['order_id']})'><i class='fa fa-times' aria-hidden='true'></i></button></td>"; // Add cancel button
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No orders found this month.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    </div>
    
    <!-- Hidden file input for image selection -->
    <input type="file" id="fileInput" style="display: none;" accept="image/*" onchange="uploadImage()">
    
    <script>
        function openFileInput() {
            // Trigger the file input dialog
            document.getElementById('fileInput').click();
        }
        
        function uploadImage() {
            // Function to handle image upload
            var fileInput = document.getElementById('fileInput');
            var file = fileInput.files[0];
            
            if (file) {
                // Create FormData object to send image file
                var formData = new FormData();
                formData.append('file', file);
                
                // Send AJAX request to upload image
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload_image.php'); // Replace with your PHP script for image upload
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        document.getElementById('userImage').src = response; // Update user image src
                        alert('Image uploaded successfully!');
                    } else {
                        alert('Error uploading image. Please try again.');
                    }
                };
                
                xhr.send(formData); // Send FormData object
            }
        }
    </script>
    <script>
    function editUsername() {
        var usernameSpan = document.getElementById('username');
        var currentUsername = usernameSpan.innerText.trim();
        
        var newUsername = prompt('Enter new username:', currentUsername);
        
        if (newUsername && newUsername !== currentUsername) {
            // Update the username display
            usernameSpan.innerText = newUsername;
            
            // Send an AJAX request to update the username in the database
            var formData = new FormData();
            formData.append('user_id', '<?php echo $userID; ?>');
            formData.append('username', newUsername);
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_username.php'); // Replace with your PHP script for updating username
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Username updated successfully!');
                } else {
                    alert('Failed to update username. Please try again.');
                    // Revert back to the previous username if update fails
                    usernameSpan.innerText = currentUsername;
                }
            };
            
            xhr.send(formData); // Send FormData object
        }
    }
    //PASSWORD UPDATE
    function editPassword() {
    var newPassword = prompt('Enter new password:');
    
    if (newPassword) {
        // You may want to add validation and confirmation steps here
        
        // Send an AJAX request to update the password in the database
        var formData = new FormData();
        formData.append('user_id', '<?php echo $userID; ?>');
        formData.append('password', newPassword); // You should hash or encrypt the password
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_password.php'); // Replace with your PHP script for updating password
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Password updated successfully!');
            } else {
                alert('Failed to update password. Please try again.');
            }
        };
        
        xhr.send(formData); // Send FormData object
    }
}

</script>
<script>
function editPhoneNumber() {
    var currentPhoneNumber = "<?php echo htmlspecialchars($phoneNumber); ?>";
    var newPhoneNumber = prompt('Enter new phone number:', currentPhoneNumber);

    if (newPhoneNumber !== null && newPhoneNumber !== currentPhoneNumber) {
        // Update the phone number display
        var phoneNumberElement = document.getElementById('phoneNumber');
        phoneNumberElement.innerText = newPhoneNumber;

        // Send an AJAX request to update the phone number in the database
        var formData = new FormData();
        formData.append('user_id', '<?php echo $userID; ?>');
        formData.append('phone_number', newPhoneNumber);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_phone_number.php'); // Replace with your PHP script for updating phone number
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Phone number updated successfully!');
            } else {
                alert('Failed to update phone number. Please try again.');
                // Revert back to the previous phone number if update fails
                phoneNumberElement.innerText = currentPhoneNumber;
            }
        };

        xhr.send(formData); // Send FormData object
    }
}


</script>
<script>
function cancelOrder(orderId) {
    if (confirm("Are you sure you want to cancel this order?")) {
        // Send an AJAX request to cancel the order
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'cancel_order.php'); // Replace with your PHP script for cancelling order
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Order cancelled successfully!');
                // Reload or update the page after cancellation
                location.reload(); // You may update the UI without reloading as per your application flow
            } else {
                alert('Failed to cancel order. Please try again.');
            }
        };
        xhr.send('order_id=' + orderId); // Send order ID as POST data
    }
}
</script>

</body>
</html>
