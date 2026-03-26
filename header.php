<?php
require_once 'db.php';
$cart_count = 0;
$stmt = $conn->query("SELECT SUM(quantity) as total_items FROM cart");
$row = $stmt->fetch();
if ($row && $row['total_items']) {
    $cart_count = $row['total_items'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <?php 
    if (isset($_GET['msg'])) {
        $cleanMsg = htmlspecialchars($_GET['msg']);
        echo "<script>alert('$cleanMsg');</script>";
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fs-3" href="index.php"><i class="fa-solid fa-crown text-warning me-2"></i>King Store</a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item me-3">
                        <a class="nav-link text-uppercase" href="index.php">Home</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-uppercase" href="products.php">Products</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-uppercase" href="about.php">About</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-uppercase" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-uppercase text-warning" href="track_order.php"><i class="fa-solid fa-truck-fast me-1"></i>Track Order</a>
                    </li>
                    <li class="nav-item mt-3 mt-lg-0">
                        <a class="btn btn-primary btn-custom position-relative" href="cart.php">
                            <i class="fa-solid fa-cart-shopping me-1"></i> Cart
                            <?php if($cart_count > 0): ?>
                            <span class="cart-badge bg-danger"><?php echo $cart_count; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                
                <form class="d-flex ms-lg-4 mt-3 mt-lg-0" action="products.php" method="GET">
                    <input class="form-control rounded-pill px-4 border-0 shadow-sm" type="search" name="search" placeholder="Search products..." required>
                </form>
            </div>
        </div>
    </nav>
    <main class="flex-grow-1 container-fluid px-0">
