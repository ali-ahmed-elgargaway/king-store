<?php
require_once 'db.php';

if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if ($product) {
        $add_stmt = $conn->prepare("INSERT INTO cart (product_id, quantity) VALUES (?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
        $add_stmt->execute([$id]);
        
        $msg = $product['name'] . " added to cart!";
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo $msg; exit;
        }
        
        $return_url = isset($_POST['return_url']) ? $_POST['return_url'] : 'products.php';
        $sep = (strpos($return_url, '?') !== false) ? '&' : '?';
        header("Location: " . $return_url . $sep . "msg=" . urlencode($msg)); exit;
    }
}
header("Location: products.php");
?>
