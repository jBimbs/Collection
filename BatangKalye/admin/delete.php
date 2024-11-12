<?php
// Check if the admin ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Database connection details
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

    // SQL to delete admin record
    $sql = "DELETE FROM admin WHERE admin_id=$admin_id";

    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('Admin record deleted successfully'); window.location.href = 'super_admin.php';</script>";
    } else {
        echo "Error deleting admin record: " . $connection->error;
    }

    // Close connection
    $connection->close();
} else {
    echo "Admin ID not provided or invalid";
}
?>
