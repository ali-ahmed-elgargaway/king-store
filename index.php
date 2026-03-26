<?php 
require_once 'db.php'; 
include 'header.php'; 
?>

<div class="container-fluid hero-section mb-5 text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-4">Welcome to King Store!</h1>
        <a href="products.php" class="btn btn-light btn-lg btn-custom text-primary px-5 py-3 mt-3">Explore Now</a>
    </div>
</div>

<div class="container fade-in-up pb-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold text-dark">Featured Collections</h2>
        <div class="mx-auto mt-2" style="height: 4px; width: 60px; background-color: #0d6efd; border-radius: 2px;"></div>
    </div>

    <div class="row g-4">
        <?php
        $stmt = $conn->query("SELECT * FROM products LIMIT 4");
        $products = $stmt->fetchAll();
        
        foreach($products as $product) {
        ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="card product-card">
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="text-decoration-none text-dark">
                            <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </a>
                        <div class="card-body card-body-custom">
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-2 align-self-start fw-bold text-uppercase"><?php echo htmlspecialchars($product['category']); ?></span>
                            <h5 class="card-title fw-bold mb-3">
                                <a href="product.php?id=<?php echo $product['id']; ?>" class="text-decoration-none text-dark"><?php echo htmlspecialchars($product['name']); ?></a>
                            </h5>
                            
                            <div class="mt-auto d-flex justify-content-between align-items-center border-top pt-3">
                                <span class="price-tag">$<?php echo $product['price']; ?></span>
                                
                                <form action="add_to_cart.php" method="POST" class="m-0">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="return_url" value="index.php">
                                    <button type="submit" class="btn btn-primary btn-custom btn-sm"><i class="fa-solid fa-cart-plus"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
