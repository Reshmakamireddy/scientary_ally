<?php
$host = "localhost";
$user = "root"; // use your DB username
$pass = "";     // use your DB password
$db = "user_auth";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>