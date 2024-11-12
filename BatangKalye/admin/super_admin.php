<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style_sheet.css">
    <title>Super Admin</title>
    <style>
        #dash{
            padding-top: 3rem;
            margin: 0 auto; /* Center-align and add margin around the table */
            max-width: 1200px; /* Limit the maximum width of the content */
            overflow-x: auto; /* Enable horizontal scrolling if needed */
            background-color: whitesmoke;
            margin-left: 2rem;
            margin-right: 2rem;
        }
        #dash table {
            width: 100%;
            border-radius: 15px;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
            margin-bottom: 2rem;
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
         /* Additional styling for modal form */
    #updateForm {
        text-align: center;
    }

    #updateForm label {
        font-weight: bold;
    }

    #updateForm select {
        margin: 10px;
        padding: 5px;
        font-size: 14px;
    }

    #updateForm button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 3px;
    }

    #updateForm button:hover {
        opacity: 0.8;
    }
    /* CSS for buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: bold;
    transition: background-color 0.3s ease;
}
#dash table td button {
    padding: 8px 15px;
    margin-right: 5px;
    background-color: #5cb85c; /* Green for 'Delete' button */
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 20px;
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
button:hover {
    background-color: #45a049; /* Darker shade of green on hover */
}

button.delete-btn {
    background-color: #f44336; /* Red color for delete button */
}

button.delete-btn:hover {
    background-color: #d32f2f; /* Darker shade of red on hover */
}

button.update-btn {
    background-color: #2196F3; /* Blue color for update button */
}

button.update-btn:hover {
    background-color: #0b7dda; /* Darker shade of blue on hover */
}
section {
    margin-left: 200px; /* Align with the navbar width */
    height: calc(100vh - 70px); /* Full viewport height minus the top padding */
    overflow-y: auto; /* Enable vertical scrolling if needed */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-top: 5rem;
   
}
body{
    background-color: #474747;
}
.header{
    text-align: center;
    font-size: 30px;
}
.table-container {
            width: 100%;
            height: 350px; /* Adjust this height as needed */
            overflow-y: auto;
        }
#searchBar {
            width: 20%;
            margin-left: 5rem;
            padding: 10px;
            font-size: 16px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        <li><a href="#" class="active">Admins</a></li>
        <li><a href="super_admin_users.php">Users</a></li>
        <li><a href="super_admin_products.php">Products</a></li>
    </ul>
    <a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>
    <section>
        
        <div id="dash">
        <h1 class="header">Admin Users</h1>
        
        <button id="addAdminBtn">Add Admin</button>
        <input type="text" id="searchBar" placeholder="Search for an admin...">
        <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add Admin</h2>
        <form method="post" action="add_admin.php">
            <label for="adminUserName">Admin User Name:</label>
            <input type="text" id="adminUserName" name="admin_user_name" required><br><br>
            <label for="adminPassword">Password:</label>
            <input type="password" id="adminPassword" name="password" required><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>  
        <div class="table-container">
            <table>
            <thead>
                <tr>
                    <td>Admin ID</td>
                    <td>Admin User Name</td>
                    <td>Password</td>
                    <td>Date Created</td>
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
                    $sql = "SELECT * FROM admin";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["admin_id"] . "</td>
                                <td>" . $row["admin_user_name"] . "</td>
                                <td>" . $row["password"] . "</td>
                                <td>" . $row["date"] . "</td>
                                <td>
                                <button onclick=\"window.location.href='delete.php?id=" . $row["admin_id"] . "'\"><i class='fa fa-trash' aria-hidden='true'></i></button>
                                <button class='update-btn' 
                            data-admin-id='" . $row["admin_id"] . "' 
                            data-admin-user-name='" . $row["admin_user_name"] . "' 
                            data-admin-password='" . $row["password"] . "'><i class='fa fa-pencil' aria-hidden='true'></i></button>
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
        </div>
    </section>
    <!-- Modal HTML -->
    <div id="updateAdminModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Admin</h2>
        <form id="updateAdminForm" method="post" action="update_admin.php">
            <input type="hidden" id="adminId" name="admin_id">
            <label for="adminUserName">Admin User Name:</label>
            <input type="text" id="adminUserName" name="admin_username" required><br><br>
            <label for="adminPassword">Password:</label>
            <input type="password" id="adminPassword" name="password" required><br><br>
            <input type="submit" value="Update">
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateButtons = document.querySelectorAll('.update-btn');
        const updateModal = document.getElementById('updateAdminModal');
        const closeBtn = document.querySelector('.close');

        updateButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission or link navigation

                // Retrieve admin data from the table row
                const adminId = this.dataset.adminId;
                const adminUserName = this.dataset.adminUserName;
                const adminPassword = this.dataset.adminPassword;

                // Populate modal fields with current admin data
                document.getElementById('adminId').value = adminId;
                document.getElementById('adminUserName').value = adminUserName;
                document.getElementById('adminPassword').value = adminPassword;

                // Display the modal
                updateModal.style.display = 'block';
            });
        });

        // Close the modal when the user clicks on the close button
        closeBtn.addEventListener('click', function() {
            updateModal.style.display = 'none';
        });

        // Close the modal when the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (event.target === updateModal) {
                updateModal.style.display = 'none';
            }
        });

        // Handle form submission in the modal
        const updateAdminForm = document.getElementById('updateAdminForm');
        updateAdminForm.addEventListener('submit', function(event) {
            event.preventDefault();

            // Perform AJAX request to update admin data
            const adminId = document.getElementById('adminId').value;
            const adminUserName = document.getElementById('adminUserName').value;
            const adminPassword = document.getElementById('adminPassword').value;

            // Example AJAX call (modify URL and parameters as per your setup)
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_admin.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Admin updated successfully!');
                    location.reload(); // Reload the page after successful update
                } else {
                    alert('Error updating admin.');
                }
                updateModal.style.display = 'none'; // Hide modal after update
            };
            xhr.send(`admin_id=${adminId}&admin_user_name=${adminUserName}&password=${adminPassword}`);
        });
    });
</script>


    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("addAdminBtn");

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>