<?php 
require_once 'db.php'; 
include 'header.php'; 
?>

<div class="container pb-5 fade-in-up">
    <div class="d-flex align-items-center mb-5 border-bottom pb-3">
        <h1 class="display-5 fw-bold text-dark m-0"><i class="fa-solid fa-cart-shopping me-3 text-primary"></i>Shopping Cart</h1>
    </div>

    <?php
    $stmt = $conn->query("SELECT cart.product_id, cart.quantity, products.name, products.price, products.image FROM cart INNER JOIN products ON cart.product_id = products.id");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($items) == 0) { 
    ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-light mt-5">
            <i class="fa-solid fa-basket-shopping fa-5x text-muted mb-4 opacity-50"></i>
            <h2 class="h3 fw-bold text-dark mb-3">Your cart is feeling lonely</h2>
            <a href="products.php" class="btn btn-primary btn-custom btn-lg mt-3"><i class="fa-solid fa-bag-shopping me-2"></i>Start Shopping</a>
        </div>
    <?php } else { ?>
        
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark">Cart Items (<?php echo count($items); ?>)</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <?php 
                            $grand_total = 0;
                            foreach($items as $item) {
                                $item_total = $item['price'] * $item['quantity'];
                                $grand_total += $item_total;
                            ?>
                            <li class="list-group-item p-4 hover-scale">
                                <div class="row align-items-center">
                                    <div class="col-md-2 col-4 mb-3 mb-md-0">
                                        <img src="<?php echo $item['image']; ?>" class="img-fluid rounded shadow-sm" style="height: 100px; width:100%; object-fit:cover;">
                                    </div>
                                    <div class="col-md-4 col-8 mb-3 mb-md-0">
                                        <h5 class="fw-bold text-dark mb-1"><?php echo $item['name']; ?></h5>
                                        <p class="text-muted mb-0">$<?php echo $item['price']; ?></p>
                                    </div>
                                    <div class="col-md-2 col-4 text-center">
                                        <span class="badge bg-light text-dark border px-3 py-2 fs-6">Qty: <?php echo $item['quantity']; ?></span>
                                    </div>
                                    <div class="col-md-3 col-4 text-end">
                                        <p class="h5 fw-bold text-primary mb-0">$<?php echo number_format($item_total, 2); ?></p>
                                    </div>
                                    <div class="col-md-1 col-4 text-end">
                                        <a href="remove_from_cart.php?id=<?php echo $item['product_id']; ?>" class="text-danger hover-scale d-inline-block remove-btn" title="Remove Item">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold border-bottom pb-3 mb-4">Order Summary</h4>
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">Promo Code</label>
                            <div class="input-group">
                                <input type="text" id="promo_input" class="form-control border-0 bg-light px-3" placeholder="Enter KING10">
                                <button class="btn btn-outline-primary border-0" type="button" onclick="applyPromo()">Apply</button>
                            </div>
                            <small id="promo_msg" class="text-success d-none mt-1"><i class="fa-solid fa-check me-1"></i>10% Discount Applied!</small>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Subtotal</span>
                            <span class="fw-bold text-dark" id="subtotal_val">$<?php echo number_format($grand_total, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-muted d-none" id="discount_row">
                            <span>Discount (10%)</span>
                            <span class="fw-bold text-danger">-$<?php echo number_format($grand_total * 0.1, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Estimated Shipping</span>
                            <span class="fw-bold text-success">Free</span>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <span class="h5 fw-bold mb-0">Total</span>
                            <span class="h3 fw-bold text-primary mb-0" id="total_val">$<?php echo number_format($grand_total, 2); ?></span>
                        </div>
                        
                        <form action="checkout.php" method="GET">
                            <input type="hidden" name="promo" id="promo_hidden" value="">
                            <button type="submit" class="btn btn-success btn-custom btn-lg w-100 py-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <span>Secure Checkout</span> <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>

                        <script>
                        function applyPromo() {
                            let code = document.getElementById('promo_input').value.trim().toUpperCase();
                            if(code === 'KING10') {
                                document.getElementById('promo_msg').classList.remove('d-none');
                                document.getElementById('discount_row').classList.remove('d-none');
                                let sub = <?php echo $grand_total; ?>;
                                let total = sub * 0.9;
                                document.getElementById('total_val').innerText = '$' + total.toFixed(2);
                                document.getElementById('promo_hidden').value = 'KING10';
                            } else { alert('Invalid Promo Code'); }
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
