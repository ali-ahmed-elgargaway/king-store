<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM cart WHERE product_id = ?");
    $stmt->execute([$id]);
    
    $msg = "Item removed from cart.";
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo $msg; exit;
    }
    header("Location: cart.php?msg=" . urlencode($msg)); exit;
}
header("Location: cart.php");
?>
