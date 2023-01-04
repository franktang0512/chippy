<?php

$servername = "127.0.0.1";
$username = "viplab";
$password = "chippy2022";
$db ="chippy";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "hello";
// echo "Connected successfully";

?>