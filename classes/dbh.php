<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dealership";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}