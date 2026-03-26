<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $pid = $_POST['product_id']; $name = $_POST['name'];
    $rating = $_POST['rating']; $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO reviews (product_id, name, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->execute([$pid, $name, $rating, $comment]);

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo "Review submitted! Thank you."; exit;
    }
    header("Location: product.php?id=$pid&msg=" . urlencode("Review submitted!")); exit;
}
?>
