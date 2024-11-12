<?php
session_start(); // Start the session

// Establish a database connection
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

// Fetch monthly sales data
$monthly_sales_sql = "SELECT DATE_FORMAT(arrival, '%Y-%m') AS month, SUM(price) AS sales 
                      FROM transaction 
                      WHERE approved = 'delivered' 
                      GROUP BY DATE_FORMAT(arrival, '%Y-%m') 
                      ORDER BY DATE_FORMAT(arrival, '%Y-%m')";
$monthly_result = $conn->query($monthly_sales_sql);

$monthly_sales_data = array();
if ($monthly_result->num_rows > 0) {
    while ($row = $monthly_result->fetch_assoc()) {
        $monthly_sales_data[] = array(
            "month" => $row['month'],
            "sales" => $row['sales']
        );
    }
}

$conn->close();

// Output JSON formatted data
header('Content-Type: application/json');
echo json_encode($monthly_sales_data);
?>
