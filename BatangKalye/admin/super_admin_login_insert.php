<?php
// Include the database connection script
require 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Login'])) {
    // Get user input from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to check the user's credentials
    $stmt = $conn->prepare("SELECT user_name, password FROM super_admin WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($dbUsername, $dbPassword);

    // Check if a user with the given username exists
    if ($stmt->fetch()) {
        // Debugging: Print out the values for comparison
       // echo "Input Username: $username<br>";
       // echo "DB Username: $dbUsername<br>";
       // echo "Input Password: $password<br>";
       // echo "DB Password: $dbPassword<br>";

        // Verify the password
        if ($password == $dbPassword) {
            // Login successful
            echo '<script>alert("Login successful.");</script>';
            // Redirect to index.php
            header("Location: super_admin_index.php");
            exit; // Make sure to exit to prevent further execution
        } else {
            // Incorrect password
            header("Location: login.php");
            echo '<script>alert("Incorrect password. Youre Not A Super Admin.");</script>';
            exit; // Make sure to exit to prevent further execution
        }
    } else {
        // User not found
        echo '<script>alert("User not found. Please check your username.");</script>';
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
