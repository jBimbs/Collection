<?php
// Start the session
session_start();

// Include the database connection script
require 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Login'])) {
    // Get user input from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to check the user's credentials
    $stmt = $conn->prepare("SELECT user_id, user_name, password FROM user WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userID, $dbUsername, $dbPassword);

    // Check if a user with the given username exists
    if ($stmt->fetch()) {
        // Verify the password
        if ($password == $dbPassword) {
            // Store user information in the session
            $_SESSION['user_id'] = $userID;
            $_SESSION['username'] = $dbUsername;
            
            // Redirect to index.php
            header("Location: index.php");
            exit; // Make sure to exit to prevent further execution
        } else {
            // Incorrect password
            echo '<script>alert("Incorrect password. Please try again.");</script>';
            echo '<script>window.location.href = "login.php";</script>';
        }
    } else {
        // User not found
        echo '<script>alert("User not found. Please check your username.");</script>';
        echo '<script>window.location.href = "login.php";</script>';
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
