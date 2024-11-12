<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style_sheet.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Admin</title>
    <style>
       #dash{
            padding-top: 5rem;
            margin: 0 auto; /* Center-align and add margin around the table */
            max-width: 1400px; /* Limit the maximum width of the content */
           
        }
        #dash table {
            width: 100%;
            border-radius: 15px;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
        }

        #dash table img {
            width: 70px;
        }

        #dash table th,
        #dash table td {
            border: 1px solid #ddd;
            padding: 2px;
            
            text-align: center;
            border: none; /* Remove table cell borders */
        }

        #dash table th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #333;
            color: #ddd;
           
            text-transform: uppercase;
            border: none; /* Remove table cell borders */
        }

        #dash table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
            border-radius: 15px;
        }

        #dash table tbody tr:hover {
            background-color: #ddd;
        }
        #dash table td:first-child,
#dash table th:first-child {
    width: 50px; /* Adjust the width of the Transaction ID column */
    min-width: 50px; /* Ensure minimum width for responsiveness */
    max-width: 50px; /* Ensure maximum width for responsiveness */
    font-size: 10px;
    text-align: center; /* Center-align content in the Transaction ID column */
}
        /* Targeting specific column (product name) */
#dash table td:nth-child(4) {
    font-size: 8px; /* Adjust font size for the product name column */
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



 /* Style for transaction table */
 table {
            border-collapse: collapse;
            width: 100%;
            font-size: 8px;
            overflow-y: auto; /* Enable vertical scrolling if needed */
            background: whitesmoke;
            table-layout: fixed; /* This makes the table fixed */
        }

        thead {
            background-color: #333;
            color: white;
        }

        th, td {
            border: 1px solid #e2e9e1;
            border-left: none;
            border-right: none;
            padding: 2px;
            text-align: center;
            font-size: 12px;
        }

        th {
            border-top: none;
            background-color: #f2f2f2;
            text-transform: uppercase;
        }

        td {
            border-bottom: none;
        }

       /* Styling for the action buttons */
.delivered-btn,
.being-delivered-btn {
    padding: 5px 5px; /* Adjusted padding for buttons */
    border: none;
    cursor: pointer;
    border-radius: 3px;
    color: #fff;
    font-size: 7px;
    text-transform: uppercase;
    transition: background-color 0.3s;
    width: 80px; /* Fixed width for buttons */
}

.delivered-btn {
    background-color: #5cb85c; /* Green */
}

.being-delivered-btn {
    background-color: #5bc0de; /* Blue */
}

.delivered-btn:hover,
.being-delivered-btn:hover {
    opacity: 0.8;
}

.status-delivered {
    background-color: #5cb85c; /* Green */
    color: white;
}

.status-being-delivered {
    background-color: #5bc0de; /* Blue */
    color: white;
}

    </style>
 <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deliveredButtons = document.querySelectorAll('.delivered-btn');
            deliveredButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default form submission or link navigation

                    const transactionId = this.dataset.transactionId;
                    updateTransactionStatus(transactionId, 'delivered');
                });
            });

            const beingDeliveredButtons = document.querySelectorAll('.being-delivered-btn');
            beingDeliveredButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default form submission or link navigation

                    const transactionId = this.dataset.transactionId;
                    updateTransactionStatus(transactionId, 'being-delivered');
                });
            });

            function updateTransactionStatus(transactionId, status) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_status.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status === 200) {
                        alert('Status updated successfully!');
                        location.reload(); // Reload the page after successful update
                    } else {
                        alert('An error occurred while updating the status.');
                    }
                };
                xhr.send(`transaction_id=${transactionId}&status=${status}`);
            }
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
            <li><a href="super_admin_sales.php"  >Orders</a></li>
           <li> <a href="#"class="active">Transaction</a></li>
           <li><a href="super_admin.php">Admins</a></li>
           <li><a href="super_admin_users.php" >Users</a></li>
            <li><a href="super_admin_products.php">Products</a></li>
        </ul>
        <a href="logout.php" class="logout"><i class="fa fa-sign-out"></i> Logout</a>
    </div>
    <h1>Transaction List</h1>
    
    <div id="dash">
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <td>Order ID</td>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Customer Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Arrival</th>
                    <th>Action</th>
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

                // SQL query to fetch transaction data
                $sql = "SELECT transaction_id, order_id, image, product_name, customer_name, price, approved, arrival FROM transaction ORDER BY transaction_id DESC";

                $result = $connection->query($sql);

                // Display table rows
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $imagePath = 'uploads/' . basename($row["image"]);
                        ?>
                        <tr>
                            <td><?php echo $row["transaction_id"]; ?></td>
                            <td><?php echo $row["order_id"]; ?></td>
                            <td><img src="<?php echo $imagePath; ?>" alt="Product Image" style="width: 70px;"></td>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["customer_name"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td class="<?php echo $row['approved'] === 'delivered' ? 'status-delivered' : ($row['approved'] === 'being-delivered' ? 'status-being-delivered' : ''); ?>">
    <?php echo $row['approved']; ?>
</td>

                            <td><?php echo $row["arrival"]; ?></td>
                            <td>
                                <button class="delivered-btn" data-transaction-id="<?php echo $row["transaction_id"]; ?>">Delivered</button>
                                <button class="being-delivered-btn" data-transaction-id="<?php echo $row["transaction_id"]; ?>">Being Delivered</button>
                            </td>
                        </tr>
                        <?php
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
</body>
</html>