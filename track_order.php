<?php 
require_once 'db.php'; 

$order = null;
$items = [];
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['order_id'];
    $email = $_POST['email'];
    
   
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND email = ?");
    $stmt->execute([$id, $email]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($order) {
        $stmt2 = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt2->execute([$id]);
        $items = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error = "Order not found. Please check your Order ID and Email.";
    }
}

include 'header.php'; 
?>

<div class="container pb-5 fade-in-up">
    <div class="d-flex align-items-center mb-5 border-bottom pb-3">
        <h1 class="display-5 fw-bold text-dark m-0"><i class="fa-solid fa-location-crosshairs me-3 text-primary"></i>Track Your Order</h1>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-5">
                <form action="track_order.php" method="POST">
                    <p class="text-muted mb-4 text-center">Enter your Order ID and Email Address to track your shipment.</p>
                    
                    <?php if($error): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted">Order ID</label>
                        <input type="number" name="order_id" required class="form-control form-control-lg bg-light border-0 px-4" placeholder="e.g. 15">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted">Email Address</label>
                        <input type="email" name="email" required class="form-control form-control-lg bg-light border-0 px-4" placeholder="Email used during checkout">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-custom btn-lg w-100 py-3 mt-2 shadow">
                        <i class="fa-solid fa-magnifying-glass me-2"></i> Find Order
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php if($order): ?>
    <div class="row justify-content-center fade-in-up mt-2">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white p-4 border-bottom-0 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold"><i class="fa-solid fa-box-open me-2"></i>Order #<?php echo $order['id']; ?></h4>
                    <span class="badge bg-white text-success fs-6"><i class="fa-solid fa-spinner fa-spin me-2"></i>Processing</span>
                </div>
                <div class="card-body p-5">
                    <div class="row mb-5">
                        <div class="col-sm-6 mb-4 mb-sm-0">
                            <h6 class="text-muted fw-bold mb-2">Customer Details:</h6>
                            <p class="mb-1 text-dark fw-bold"><?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?></p>
                            <p class="mb-1 text-muted"><?php echo htmlspecialchars($order['email']); ?></p>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h6 class="text-muted fw-bold mb-2">Shipping To:</h6>
                            <p class="mb-1 text-muted"><?php echo nl2br(htmlspecialchars($order['address'])); ?></p>
                            <p class="mb-1 text-muted mt-2"><small>Ordered on: <?php echo date('M d, Y', strtotime($order['order_date'])); ?></small></p>
                        </div>
                    </div>

                    <h5 class="fw-bold border-bottom pb-3 mb-4">Order Items</h5>
                    <ul class="list-group list-group-flush mb-4">
                        <?php foreach($items as $item): ?>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold text-dark mb-0"><?php echo htmlspecialchars($item['product_name']); ?></h6>
                                <small class="text-muted">Qty: <?php echo $item['quantity']; ?> × $<?php echo $item['price']; ?></small>
                            </div>
                            <span class="fw-bold text-primary">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="d-flex justify-content-between align-items-center bg-light p-4 rounded-3 border-start border-4 border-success">
                        <span class="h5 fw-bold text-muted mb-0">Total Paid</span>
                        <span class="h3 fw-bold text-success mb-0">$<?php echo number_format($order['total'], 2); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
