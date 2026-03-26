<?php 
require_once 'db.php'; 
include 'header.php'; 
?>

<div class="container pb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 border-bottom pb-3">
        <h1 class="display-5 fw-bold text-dark m-0">All Products</h1>
        <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0 pb-2">
            <a href="products.php" class="btn btn-sm <?php echo !isset($_GET['category']) ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-pill px-3">All</a>
            <?php 
            $cat_stmt = $conn->query("SELECT DISTINCT category FROM products");
            while($c = $cat_stmt->fetch(PDO::FETCH_ASSOC)): 
                $active = (isset($_GET['category']) && $_GET['category'] == $c['category']) ? 'btn-primary' : 'btn-outline-primary';
            ?>
                <a href="products.php?category=<?php echo urlencode($c['category']); ?>" class="btn btn-sm <?php echo $active; ?> rounded-pill px-3"><?php echo $c['category']; ?></a>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="row g-4">
        <?php 
        $query = "SELECT * FROM products";
        $params = [];
        $title = "All Products";

        if (isset($_GET['search'])) {
            $query .= " WHERE name LIKE ? OR category LIKE ?";
            $params = ["%".$_GET['search']."%", "%".$_GET['search']."%"];
            $title = "Results for: " . htmlspecialchars($_GET['search']);
        } elseif (isset($_GET['category'])) {
            $query .= " WHERE category = ?";
            $params = [$_GET['category']];
            $title = htmlspecialchars($_GET['category']);
        }

        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        $products = $stmt->fetchAll();

        echo "<script>document.querySelector('h1.display-5').innerText = '$title';</script>";

        if (count($products) > 0) {
            foreach($products as $product) {
        ?>
                <div class="col-sm-6 col-lg-4 col-xl-3 fade-in-up">
                    <div class="card product-card h-100">
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="text-decoration-none">
                            <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </a>
                        <div class="card-body card-body-custom">
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-2 align-self-start fw-bold text-uppercase"><?php echo htmlspecialchars($product['category']); ?></span>
                            <h5 class="card-title fw-bold mb-3">
                                <a href="product.php?id=<?php echo $product['id']; ?>" class="text-decoration-none text-dark hover-text-primary"><?php echo htmlspecialchars($product['name']); ?></a>
                            </h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo htmlspecialchars($product['description']); ?>
                            </p>
                            <div class="mt-auto d-flex justify-content-between align-items-center border-top pt-3">
                                <span class="price-tag">$<?php echo $product['price']; ?></span>
                                <form action="add_to_cart.php" method="POST" class="m-0">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="return_url" value="products.php">
                                    <button type="submit" class="btn btn-primary btn-custom btn-sm"><i class="fa-solid fa-cart-plus me-1"></i> Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php 
            }
        } else {
            echo "<div class='col-12 text-center text-muted py-5'><i class='fa-solid fa-box-open fa-4x mb-4 text-secondary'></i><p class='lead'>No products available.</p></div>";
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
