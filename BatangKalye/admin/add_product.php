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

// Prepare and bind the parameters
$stmt = $connection->prepare("INSERT INTO product (product_name, price, quantity, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdis", $product_name, $price, $quantity, $image);

// Set parameters and execute
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

// File upload handling
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["product_image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        header("Location: products.php");
        echo "The file ". basename( $_FILES["product_image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Set image path in the database
$image = $target_file;

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New product created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>
