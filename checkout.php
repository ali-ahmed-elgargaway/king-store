<?php 
require_once 'db.php';

$stmt = $conn->query("SELECT COUNT(*) as cnt FROM cart");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row['cnt'] == 0) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['firstname']; $lname = $_POST['lastname'];
    $email = $_POST['email']; $address = $_POST['address'];
    $total = 0; $promo = isset($_REQUEST['promo']) ? $_REQUEST['promo'] : '';
    
    $cart_stmt = $conn->query("SELECT cart.quantity, products.name, products.price FROM cart INNER JOIN products ON cart.product_id = products.id");
    $items = $cart_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($items as $item) { $total += $item['price'] * $item['quantity']; }
    if ($promo === 'KING10') { $total *= 0.9; }
    
    $order_stmt = $conn->prepare("INSERT INTO orders (firstname, lastname, email, address, total) VALUES (?, ?, ?, ?, ?)");
    $order_stmt->execute([$fname, $lname, $email, $address, $total]);
    $order_id = $conn->lastInsertId(); 
    
    $item_stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, price, quantity) VALUES (?, ?, ?, ?)");
    foreach($items as $item) { $item_stmt->execute([$order_id, $item['name'], $item['price'], $item['quantity']]); }
    
    $conn->query("TRUNCATE TABLE cart");
    
    $msg = "Order #$order_id placed! Thank you.";
    if($promo === 'KING10') $msg .= " (Discount Applied)";
    
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo $msg; exit;
    }
    
    header("Location: index.php?msg=" . urlencode($msg)); exit;
}

include 'header.php'; 
?>

<div class="container pb-5 fade-in-up">
    <a href="cart.php" class="text-decoration-none text-primary mb-4 d-inline-block hover-scale"><i class="fa-solid fa-arrow-left me-2"></i>Back to Cart</a>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4">
                    <h3 class="mb-0 fw-bold"><i class="fa-solid fa-shield-halved me-2"></i>Secure Checkout</h3>
                </div>
                <div class="card-body p-5">
                    <form action="checkout.php" method="POST" class="ajax-form">
                        <input type="hidden" name="promo" value="<?php echo isset($_GET['promo']) ? htmlspecialchars($_GET['promo']) : ''; ?>">
                        <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Customer Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label class="form-label fw-bold text-muted">First Name</label>
                                <input type="text" name="firstname" required class="form-control form-control-lg bg-light border-0 px-4">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted">Last Name</label>
                                <input type="text" name="lastname" required class="form-control form-control-lg bg-light border-0 px-4">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted">Email Address</label>
                            <input type="email" name="email" required class="form-control form-control-lg bg-light border-0 px-4">
                        </div>
                        <h5 class="fw-bold mb-4 mt-5 text-dark border-bottom pb-2">Shipping Details</h5>
                        <div class="mb-5">
                            <label class="form-label fw-bold text-muted">Delivery Address</label>
                            <textarea name="address" required class="form-control bg-light border-0 px-4 py-3" rows="4"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-custom btn-lg py-3 shadow">Confirm & Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
