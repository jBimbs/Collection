<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $adminUserName = $_POST['admin_user_name'];
    $adminPassword = $_POST['password'];
    $dateCreated = date('Y-m-d H:i:s'); // Current date and time

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "batang_kalye";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare SQL statement to insert admin data into the database
    $sql = "INSERT INTO admin (admin_user_name, password, date) VALUES ('$adminUserName', '$adminPassword', '$dateCreated')";

    // Execute SQL statement
    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('New admin added successfully'); window.location.href = 'super_admin.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    // Close connection
    $connection->close();
}
?>
