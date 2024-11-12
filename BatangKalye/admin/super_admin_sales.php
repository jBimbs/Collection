<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style_sheet.css">
    <title>Admin</title>
    <style>
        #dash {
            padding-top: 2rem;
            display: flex;
            justify-content: center;
            width: 100%;border-radius: 15px;
        }
        h1 {
            padding-top: 7rem;
            text-align: center;
        }
        #dash table {
            width: 1400px;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
            margin: auto;
            border-radius: 15px;
        }
        #dash table img {
            width: 70px;
        }
        #dash table th:nth-child(5),
        #dash table th:nth-child(6) {
            width: 150px;
            text-align: center;
        }
        #dash table td:nth-child(5),
        #dash table td:nth-child(6) {
            width: 150px;
            text-align: center;
        }
        #dash table thead {
            border: 1px solid #e2e9e1;
            border-left: none;
            text-align: center;
            border-right: none;
        }
        #dash table thead td {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
            
        }
        #dash table tbody tr td {
            padding-top: 15px;
        }
        #dash table tbody td {
            font-size: 13px;
            align-items: center;
            text-align: center;
        }
        /* Pagination styles */
        .pagination {
            text-align: center; /* Center align pagination links */
            margin-top: 1rem; /* Adjust margin as needed */
        }
        .pagination a, .pagination strong {
            text-decoration: none;
            color: #333;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
            border-radius: 3px;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
        .pagination strong {
            background-color: #333;
            color: #fff;
        }
        .approve-btn{
            width: 30px;
            font-size: 30px;
            border-radius: 50%;
            color: green;
            border: none;
        }
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
    border-radius:15px;
    overflow-x: auto;
}

.table-box th {
    border: none;
    padding: 8px;
    text-align: left;
    border-radius:15px;
}

thead {
    background-color: #333;
    color: white;
    border-radius:15px;
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
#dash{
    border-radius: 15px;
}


.table table-bordered table-striped mt-4 {
    border-radius: 15px;
}

    </style>
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const approveButtons = document.querySelectorAll('.approve-btn');
        approveButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.dataset.orderId;
                const productId = this.dataset.productId;
                const productName = this.dataset.productName;
                const price = this.dataset.productPrice;
                const userId = this.dataset.userId;
                const customerId = this.dataset.customerId;
                const customerName = this.dataset.customerName;
                const address = this.dataset.address;
                const date = this.dataset.date;
                const image = this.dataset.image; // Added image data

                // Send AJAX request to PHP script
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'approve_order.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert('Order approved successfully!');
                        location.reload(); // Reload the page after approval
                    } else {
                        alert('An error occurred while approving the order.');
                    }
                };

                // Prepare data to send
                const data = new URLSearchParams();
                data.append('order_id', orderId);
                data.append('product_id', productId);
                data.append('product_name', productName);
                data.append('image', image);
                data.append('price', price);
                data.append('user_id', userId);
                data.append('customer_id', customerId);
                data.append('customer_name', customerName);
                data.append('address', address);
                data.append('date', date);

                xhr.send(data);
            });
        });
    });
</script>

</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="../img/logo.png" alt="Logo">
    </div>
    <ul>
    <li><a href="super_admin_index.php">Dashboard</a></li>
            <li><a href="#" class="active" >Orders</a></li>
           <li> <a href="super_admin_transaction.php">Transaction</a></li>
           <li><a href="super_admin.php">Admins</a></li>
           <li><a href="super_admin_users.php" >Users</a></li>
            <li><a href="super_admin_products.php">Products</a></li>
    </ul>
    <a href="logout.php" class="logout"><i class="fa fa-sign-out"></i> Logout</a>
</div>
<h1>Batang Kalye Sales</h1>
<section>
    <div id="dash">
        <table>
            <thead>
                <tr>
                    <td>Approve</td>
                    <td>Order ID</td>
                    <td>Product ID</td>
                    <td>Product Image</td>
                    <td>Product Name</td>
                    <td>Price</td>
                    <td>User ID</td>
                    <td>Customer Name</td>
                    <td>Address</td>
                    <td>Date Created</td>
                </tr>
            </thead>
            <tbody>
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

// Pagination variables
$rows_per_page = 15; // Number of rows per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number

// SQL query to fetch grouped orders with pagination
$sql = "SELECT order_id, product_id, image, product_name,price, user_id,customer_id, customer_name, address, date 
                            FROM sales_view WHERE order_id NOT IN (SELECT order_id FROM transaction WHERE approved='approved')
                            GROUP BY order_id,product_name,product_id
                            ORDER BY order_id DESC";




$result = $connection->query($sql);

// Calculate total number of rows
$total_rows = $result->num_rows;

// Calculate total number of pages
$total_pages = ceil($total_rows / $rows_per_page);

// Calculate the offset for the query
$offset = ($page - 1) * $rows_per_page;

// Adjust SQL query with LIMIT and OFFSET for pagination
$sql .= " LIMIT $rows_per_page OFFSET $offset";

$result = $connection->query($sql);

// Display table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Output each row as before
        $imagePath = 'uploads/' . basename($row["image"]);
        echo "<tr>
                <td>
                    <button class='approve-btn' 
                            data-order-id='" . $row["order_id"] . "'
                            data-product-id='" . $row["product_id"] . "'
                            data-product-name='" . $row["product_name"] . "'
                            data-image ='". $row["image"] ."'
                             data-product-price='" . $row["price"] . "'
                             data-user-id='" . $row["user_id"] . "'
                            data-customer-id='" . $row["customer_id"] . "'
                            data-customer-name='" . $row["customer_name"] . "'
                            data-address='" . $row["address"] . "'
                            data-date='" . $row["date"] . "'>
                        <i class='fa fa-check-circle' aria-hidden='true'></i>
                    </button>
                </td>
                <td>" . $row["order_id"] . "</td>
                <td>" . $row["product_id"] . "</td>
                <td><img src='{$imagePath}' alt='Product Image' style='width:70px;'></td>
                <td>" . $row["product_name"] . "</td>
                <td>" . $row["price"] . "</td>
                <td>" . $row["user_id"] . "</td>
                <td>" . $row["customer_name"] . "</td>
                <td>" . $row["address"] . "</td>
                <td>" . $row["date"] . "</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>0 results</td></tr>";
}

// Close the connection
$connection->close();
?>



            </tbody>
        </table>

    </div>
    <!-- Pagination links -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo ($page - 1); ?>">&laquo; Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i == $page): ?>
            <strong><?php echo $i; ?></strong>
        <?php else: ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
        <a href="?page=<?php echo ($page + 1); ?>">Next &raquo;</a>
    <?php endif; ?>
</div>
</section>
</body>
</html>