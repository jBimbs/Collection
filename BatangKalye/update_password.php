<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['password'])) {
    $user_id = $_POST['user_id'];
    $new_password = $_POST['password']; // Plain text password

    // Perform database update (example using mysqli)
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "batang_kalye";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET password = '$new_password' WHERE user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Password updated successfully";
    } else {
        echo "Error updating password: " . $conn->error;
    }

    $conn->close();
} else {
    // Handle invalid request
    echo "Invalid request";
}
?>
