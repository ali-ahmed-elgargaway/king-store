<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$dbname = "easyshop_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
