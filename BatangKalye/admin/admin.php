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

// Query to get the total sales amount where approved = "delivered"
$total_sales_sql = "SELECT SUM(price) as total_sales FROM transaction WHERE approved = 'delivered'";
$result = $conn->query($total_sales_sql);

$total_sales = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_sales = $row['total_sales'];
}

$current_month = date('Y-m');
$monthly_sales_sql = "SELECT SUM(price) as monthly_sales 
                      FROM transaction 
                      WHERE approved = 'delivered' 
                      AND DATE_FORMAT(arrival, '%Y-%m') = '$current_month'";
$monthly_result = $conn->query($monthly_sales_sql);

$monthly_sales = 0;
if ($monthly_result->num_rows > 0) {
    $row = $monthly_result->fetch_assoc();
    $monthly_sales = $row['monthly_sales'];
}
// Query to get the frequency of each product sold where approved = "delivered"
$products_sql = "SELECT product_id, product_name, COUNT(*) as count FROM transaction WHERE approved = 'delivered' GROUP BY product_id, product_name";
$products_result = $conn->query($products_sql);

$products_data = [];
if ($products_result->num_rows > 0) {
    while ($row = $products_result->fetch_assoc()) {
        $products_data[] = $row;
    }
}

$conn->close();
?>      
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style_sheet.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <title>Admin</title>
    <style>
        * {
            overflow-y: hidden;
        }
        #dash {
            padding-top: 5rem;
        }
        #dash table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
        }
        #dash table img {
            width: 70px;
        }
        #dash table td:nth-child(1) {
            width: 100px;
            text-align: center;
        }
        #dash table td:nth-child(2) {
            width: 150px;
            text-align: center;
        }
        #dash table td:nth-child(3) {
            width: 250px;
            text-align: center;
        }
        #dash table td:nth-child(4),
        #dash table td:nth-child(5),
        #dash table td:nth-child(6) {
            width: 150px;
            text-align: center;
        }
        #dash table td:nth-child(5) input {
            width: 70px;
            padding: 10px 5px 10px 15px;
        }
        #dash table thead {
            border: 1px solid #e2e9e1;
            border-left: none;
            border-right: none;
        }
        #dash table thead td {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
            padding: 18px 0;
        }
        #dash table tbody tr td {
            padding-top: 15px;
        }
        #dash table tbody td {
            font-size: 13px;
        }
        .container-banner {
            display: flex;
            justify-content: space-between;
            padding-top: 10rem;
            align-items: center;
        }
        .sales-container {
        flex: 1;
        padding-left: 5rem;
    }
    .sales-container h1 {
        margin: 0.5rem 0;
        margin-bottom: 1rem;
        padding-left: 2rem;
        font-size: 30px;
        line-height: 30px;
    }
    .sales-container h2{
        font-size: 40px;
        color: #ffd800;
        margin-bottom   : 2rem;
        font-family: 'Sifonn', sans-serif;
    } 
    .sales-info{
        background: #e2e9e1;
        width: 500px;
        height: 100px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }   
    #sales-chart-container {    
        flex: 1;
        max-width: 800px; /* Limit the maximum width */
        height: 400px;
        background-color: #e2e9e1;
        border-radius: 15px;
        display: flex;
        margin-right: 5rem; 
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    #sales-chart {
        max-width: 90%; /* Ensure the chart canvas does not exceed the container */
        max-height: 80%;
    } 
    canvas{
        height: 400px;
        width: 600px;
    }

      /* Button styles */
      .sales-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .sales-buttons button {
            padding: 1rem 2rem;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #ffd800;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sales-buttons button:hover {
            background-color: #ffc800; /* Darker shade when hovered */
        }
</style>
    </style>
</head>
<body>
<div class="navbar">
    <div class="logo">
        <img src="../img/logo.png" alt="Logo">
    </div>
    <ul>
        <li><a href="#" class="active">Dashboard</a></li>
        <li><a href="sales.php" >Orders</a></li>
        <li><a href="transaction.php">Transaction</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="products.php">Products</a></li>
    </ul>
    <a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>
<section class="container-banner">
    <div class="sales-container">
        <h2>HOOPX X Batang Kalye</h2>
            <div class="sales-info">
                <h1>Total Sales: <?php echo number_format($total_sales, 2); ?></h1>
                <h1>Monthly Sale: <?php echo number_format($monthly_sales, 2); ?></h1>
            </div>  
            <div class="sales-buttons">
                        <button id="best-selling-btn">Best Selling</button>
                        <button id="monthly-sales-btn">Monthly Sales</button>
                    </div>
    </div>
    <div id="sales-chart-container">
        <canvas id="sales-chart" style="width: 400px; height: 400px;"></canvas>
    </div>  
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('sales-chart').getContext('2d');
        var initialData = <?php echo json_encode($products_data); ?>;
        var bestSellingData = initialData.slice(); // Create a copy of initial data
        var monthlySalesData = []; // Placeholder for monthly sales data

        // Initial Chart Setup (Pie Chart - Best Selling Products)
        renderPieChart(bestSellingData);

        // Button Click Handlers
        document.getElementById('best-selling-btn').addEventListener('click', function() {
            renderPieChart(bestSellingData);
        });

        document.getElementById('monthly-sales-btn').addEventListener('click', function() {
            fetchMonthlySalesData();
        });

        // Function to render pie chart with best selling data
        function renderPieChart(data) {
            var labels = data.map(function(item) {
                return item.product_name;
            });
            var dataset = data.map(function(item) {
                return item.count;
            });

            // Destroy the existing chart instance if it exists
            if (window.salesChart) {
                window.salesChart.destroy();
            }

            // Create new pie chart
            window.salesChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataset,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Best Selling Products'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    var value = context.raw;
                                    var percentage = ((value / total) * 100).toFixed(2);
                                    return `${context.label}: ${percentage}% (${value})`;
                                }
                            }
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = ctx.chart._metasets[0].total;
                                let percentage = (value * 100 / sum).toFixed(2) + "%";
                                return percentage;
                            },
                            color: '#fff',
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        }

        // Function to fetch and render monthly sales data
        function fetchMonthlySalesData() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_monthly_sales_data.php', true); // Adjust URL as needed
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    monthlySalesData = JSON.parse(xhr.responseText);
                    renderLineChart(monthlySalesData);
                } else {
                    console.error('Failed to fetch monthly sales data.');
                }
            };
            xhr.onerror = function() {
                console.error('Request failed to fetch monthly sales data.');
            };
            xhr.send();
        }

        // Function to render line chart with monthly sales data
        function renderLineChart(data) {
            var months = data.map(function(item) {
                return item.month;
            });
            var sales = data.map(function(item) {
                return item.sales;
            });

            // Destroy the existing chart instance if it exists
            if (window.salesChart) {
                window.salesChart.destroy();
            }

            // Create new line chart
            window.salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Monthly Sales',
                        data: sales,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Monthly Sales'
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                }
            });
        }
    });
</script>

</body>
</html>
