<?php 
require_once 'db.php'; 
include 'header.php'; 

if(!isset($_GET['id'])) { header("Location: products.php"); exit; }
$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<div class='container text-center py-5'><h2 class='text-danger fw-bold'>Product not found.</h2><a href='products.php' class='btn btn-primary mt-3'>Back to Products</a></div>";
} else {
?>

<div class="container pb-5 fade-in-up">
    <a href="products.php" class="text-decoration-none text-primary mb-4 d-inline-block hover-scale"><i class="fa-solid fa-arrow-left me-2"></i>Back to Products</a>
    
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-6 bg-light d-flex align-items-center justify-content-center p-5">
                <img src="<?php echo $product['image']; ?>" class="img-fluid rounded shadow-sm hover-scale" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-height: 500px; object-fit: contain;">
            </div>
            <div class="col-md-6 p-5 d-flex flex-column justify-content-center">
                <span class="badge bg-primary bg-opacity-10 text-primary mb-3 align-self-start fw-bold p-2 text-uppercase" style="letter-spacing: 1px;"><?php echo $product['category']; ?></span>
                <h1 class="display-5 fw-bold text-dark mb-3"><?php echo $product['name']; ?></h1>
                <p class="display-6 text-primary mb-4 fw-bold">$<?php echo $product['price']; ?></p>
                <div class="mb-5">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">Description</h5>
                    <p class="text-muted lead" style="line-height: 1.8;"><?php echo nl2br($product['description']); ?></p>
                </div>
                <form action="add_to_cart.php" method="POST" class="mt-auto">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="return_url" value="product.php?id=<?php echo $product['id']; ?>">
                    <button type="submit" class="btn btn-primary btn-lg btn-custom w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-5 border-top">
        <div class="col-lg-7 mb-5">
            <h3 class="fw-bold mb-4 text-dark">Customer Reviews</h3>
            <?php 
            $rev_stmt = $conn->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY id DESC");
            $rev_stmt->execute([$id]);
            while($rev = $rev_stmt->fetch(PDO::FETCH_ASSOC)):
            ?>
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-3 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold m-0 text-dark"><?php echo htmlspecialchars($rev['name']); ?></h6>
                        <div class="text-warning">
                            <?php echo str_repeat('<i class="fa-solid fa-star"></i>', $rev['rating']); ?>
                        </div>
                    </div>
                    <p class="text-muted small mb-0"><?php echo htmlspecialchars($rev['comment']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 p-4 sticky-top" style="top: 100px;">
                <h4 class="fw-bold mb-4 text-dark">Leave a Review</h4>
                <form action="add_review.php" method="POST" class="ajax-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="text" name="name" placeholder="Your Name" required class="form-control bg-light border-0 px-3 py-2 mb-3">
                    <select name="rating" class="form-select bg-light border-0 px-3 py-2 mb-3">
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                    <textarea name="comment" rows="4" placeholder="Your Feedback" required class="form-control bg-light border-0 px-3 py-2 mb-4"></textarea>
                    <button type="submit" class="btn btn-primary btn-custom w-100 py-3 shadow">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
}
include 'footer.php'; 
?>
