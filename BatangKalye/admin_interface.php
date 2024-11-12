<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>Admin</title>
    <style>
        #dash{
            padding-top: 5rem;
        }
         #dash table{
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
        }
        #dash table img{
            width: 70px;
        }
        #dash table td:nth-child(1){
            width: 100px;
            text-align: center;
        }
        #dash table td:nth-child(2){
            width: 150px;
            text-align: center;
        }
        #dash table td:nth-child(3){
            width: 250px;
            text-align: center;
        }
        #dash table td:nth-child(4),
        #dash table td:nth-child(5),
        #dash table td:nth-child(6){
            width: 150px;
            text-align: center;
        }
        #dash table td:nth-child(5) input{
            width: 70px;
            padding: 10px 5px 10px 15px;
        }
        #dash table thead{
            border: 1px solid #e2e9e1;
            border-left: none;
            border-right: none;
        }
        #dash table thead td{
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
            padding: 18px 0;
        }
        #dash table tbody tr td{
            padding-top: 15px;
        }
        #dash table tbody  td{
            font-size: 13px;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="img/logo.png" alt="Logo">
    </div>
    <ul>
        <li><a href="#" class="active">Dashboard</a></li>
        <li><a href="#about">Users</a></li>
        <li><a href="#shop">Stocks</a></li>
    </ul>
</div>
<section>
    <div id="dash">
        <table>
        <thead>
            <tr>
                <td>Customer ID</td>
                <td>Customer Name</td>
                <td>Customer Address</td>
                <td>Product ID</td>
                <td>Product Name</td>
                <td>Quantity</td>
                <td>Payment Option</td>
                <td>Date</td>
            </tr>
        </thead>

            <tbody>
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "batangkalye";

// Create connection to the database
$connection = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Read data from the customer table
$sql = "SELECT * FROM customer";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["customer_id"] . "</td>
            <td>" . $row["customer_name"] . "</td>
            <td>" . $row["customer_address"] . "</td>
            <td>" . $row["product_id"] . "</td>
            <td>" . $row["product_name"] . "</td>
            <td><input type='number' id='quantityInput{$row["product_id"]}' value='{$row["quantity"]}' min='0'></td>
            <td>" . $row["payment_option"] . "</td>
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
