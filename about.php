<?php 
require_once 'db.php'; 
include 'header.php'; 
?>

<div class="container pb-5 fade-in-up">
    <div class="d-flex align-items-center mb-5 border-bottom pb-3">
        <h1 class="display-5 fw-bold text-dark m-0"><i class="fa-solid fa-users me-3 text-primary"></i>About Us</h1>
    </div>
    
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5">
        <div class="row g-0">
            <div class="col-md-6 bg-primary text-white p-5 d-flex flex-column justify-content-center">
                <h2 class="display-6 fw-bold mb-4">The Story Behind King Store</h2>
                <p class="lead mb-0" style="font-weight: 300; line-height: 1.8;">
                    Founded with a passion for excellence, King Store is your premium destination for top-tier products. We believe that shopping should be a luxurious experience, not just a transaction. That's why we meticulously curate every item in our catalog to ensure it meets the royal standard you deserve.
                </p>
            </div>
            <div class="col-md-6 p-5 bg-white">
                <h2 class="h3 fw-bold text-dark mb-4">Our Core Values</h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    Quality, trust, and exceptional customer service are the pillars of everything we do. From the moment you browse our store to the instant your package arrives at your door, we are dedicated to bringing joy and unparalleled satisfaction into your life.
                </p>

                <div class="bg-light border-start border-4 border-warning p-4 rounded-3 mt-4 hover-scale shadow-sm">
                    <h4 class="h5 fw-bold text-dark mb-2"><i class="fa-solid fa-crown text-warning me-2"></i>The Royal Guarantee</h4>
                    <p class="text-muted mb-0">
                        We stand by the quality of our products 100%. Shopping with King Store means you are always treated like royalty, with exclusive products, a highly secure checkout, and lightning-fast shipping right to your doorstep.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
