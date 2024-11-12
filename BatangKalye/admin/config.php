<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "batang_kalye";
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
$con = mysqli_connect($host, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
