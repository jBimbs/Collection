<?php
// Check if the admin ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $user_id = $_GET['id'];

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
    $sql = "DELETE FROM user WHERE user_id=$user_id";

    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('User record deleted successfully'); window.location.href = 'users.php';</script>";
    } else {
        echo "Error deleting user record: " . $connection->error;
    }

    // Close connection
    $connection->close();
} else {
    echo "User ID not provided or invalid";
}
?>
