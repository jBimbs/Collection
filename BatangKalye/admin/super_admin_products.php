
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
            padding-top: 10rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
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

            #addProductBtn {
            padding: 10px 20px;
            margin-bottom: 1rem;
            margin-left: 1100px;
            background-color: #ffd800;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
            /* CSS for modal */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4); /* Black with opacity */
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }
             /* CSS for update modal */
        #updateModal {
            display: none;
        }
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
        #dash table td button {
    padding: 8px 15px;
    margin-right: 5px;
    background-color: #5cb85c; /* Green for 'Delete' button */
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 12px;
    text-transform: uppercase;
    transition: background-color 0.3s;
}

#dash table td button:hover {
    background-color: #4CAF50; /* Darker green on hover */
}

#dash table td button.update-btn {
    background-color: #5bc0de; /* Blue for 'Update' button */
}

#dash table td button.update-btn:hover {
    background-color: #46b8da; /* Darker blue on hover */
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
           <li> <a href="super_admin_transaction.php">Transaction</a></li>
           <li><a href="super_admin.php">Admins</a></li>
           <li><a href="super_admin_users.php" >Users</a></li>
            <li><a href="#" class="active">Products</a></li>
        </ul>
        <a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
    <section>
        <div id="dash">
        <button id="addProductBtn">Add Product</button>
        <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Product</h2>
                <form method="post" action="add_product.php" enctype="multipart/form-data">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="product_name" required><br><br>
            <label for="productPrice">Price:</label>
            <input type="text" id="productPrice" name="price" required><br><br>
            <label for="productQuantity">Quantity:</label>
            <input type="number" id="productQuantity" name="quantity" required min="0"><br><br>
            <label for="productImage">Product Image:</label>
            <input type="file" id="productImage" name="product_image" accept="image/*" required><br><br>
            <input type="submit" value="Submit">
        </form>

        </div>
    </div>
<!-- Update Product Modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateModal()">&times;</span>
        <h2>Update Product</h2>
        <form id="updateForm" method="post" action="update_product.php" enctype="multipart/form-data">
        <label for="productId">Product ID:</label>
            <input type="text" id="productId" name="product_id" readonly><br><br>
            <input type="hidden" id="updateProductId" name="product_id">
            <label for="updateProductName">Product Name:</label>
            <input type="text" id="updateProductName" name="product_name" required><br><br>
            <label for="updateProductImage">Product Image:</label>
            <input type="file" id="updateProductImage" name="product_image" accept="image/*"><br><br>
            <label for="updateProductPrice">Price:</label>
            <input type="text" id="updateProductPrice" name="price" required><br><br>
            <input type="submit" value="Update Product">
        </form>
    </div>
</div>
            <table>
            <thead>
                <tr>
                    <td>Product ID</td>
                    <td>Image</td>
                    <td>Product Name</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Action</td>
                </tr>
            </thead>

                <tbody>
                <?php
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

// Read data from the customer table
$sql = "SELECT * FROM product";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $imagePath = 'uploads/' . basename($row["image"]);
        echo "<tr>
            <td>" . $row["product_id"] . "</td>
            <td><img src='{$imagePath}' alt='Product Image' style='width:70px;'></td>
            <td>" . $row["product_name"] . "</td>
            <td>" . $row["price"] . "</td>
            <td><input type='number' id='quantityInput{$row["product_id"]}' value='{$row["quantity"]}' min='0'></td>
            <td>
                                <button onclick=\"window.location.href='delete_product.php?id=" . $row["product_id"] . "'\">Delete</button>
                                <button onclick=\"openUpdateModal({$row["product_id"]}, '{$row["product_name"]}')\">Update</button>
                            </td>
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
    <script>
        // Get the modal
    var modal = document.getElementById("myModal");
    var updateModal = document.getElementById("updateModal");

    // Get the button that opens the modal
    var btn = document.getElementById("addProductBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
        updateModal.style.display = "none"; // Close update modal if open
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            updateModal.style.display = "none"; // Close update modal if open
        }
    }

    // Function to open update modal with product ID and name
    function openUpdateModal(productId, productName) {
        // Fill update form with product details
        document.getElementById("updateProductId").value = productId;
        document.getElementById("updateProductName").value = productName;

        // Show update modal
        updateModal.style.display = "block";
    }

    // Function to close update modal
    function closeUpdateModal() {
        updateModal.style.display = "none";
    }
    </script>
    </body>
    </html>
