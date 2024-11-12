<?php
$host = "localhost";
$username = "root";
$password = "jb30033011";
$dbname = "checklist";

$conn = mysqli_connect($host, $username, $password, $dbname);
if(!$conn){
    die("Error".mysqli_connect_error());
}
else{
    echo"Connection Established";
}
?>
