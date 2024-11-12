<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style_sheet.css">
    <title>Admin</title>
    <style>
       #dash{
            padding-top: 5rem;
            margin: 0 auto; /* Center-align and add margin around the table */
            max-width: 1200px; /* Limit the maximum width of the content */
            overflow-x: auto; /* Enable horizontal scrolling if needed */
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
            padding: 8px;
            
            text-align: center;
            border: none; /* Remove table cell borders */
        }

        #dash table th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #f2f2f2;
            color: black;
            border-radius: 15px;
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
    </style>
</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="../img/logo.png" alt="Logo">
    </div>
    <ul>
    <li><a href="super_admin_index.php">Dashboard</a></li>
        <li><a href="super_admin_sales.php" >Orders</a></li>
        <li><a href="super_admin_transaction.php">Transaction</a></li>
        <li><a href="super_admin.php" class="active">Admins</a></li>
        <li><a href="#"class="active">Users</a></li>
        <li><a href="super_admin_products.php">Products</a></li>
    </ul>
    <a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>
    <section>
        <div id="dash">
            <table>
            <thead>
                <tr>
                    <td>User ID</td>
                    <td>User Name</td>
                    <td>Password</td>
                    <td>Date Created</td>
                    
                </tr>
            </thead>

                <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "batang_kalye";
                    $dateCreated = date('Y-m-d H:i:s'); // Current date and time
                    // Create connection to the database
                    $connection = new mysqli($servername, $username, $password, $database);

                    // Check the connection
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    // Read data from the customer table
                    $sql = "SELECT * FROM user";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["user_id"] . "</td>
                                <td>" . $row["user_name"] . "</td>
                                <td>" . $row["password"] . "</td>
                                <td>" . $row["date"] . "</td>
                                
                            </tr>";
                        }
                    } else {
                        echo "0 results";
                    }

                    // Close the connection
                    $connection->close();
                    ?>

                </tbody>
            </table>
        </div>
    </section>
</body>
</html>