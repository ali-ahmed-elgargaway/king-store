    </main>

    <footer class="footer-custom text-light pt-5 pb-4 mt-auto">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-primary"><i class="fa-solid fa-crown text-warning me-2"></i>King Store</h5>
                    <p>Experience the most elegant shopping journey. Premium quality, exclusive design, and endless possibilities.</p>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold">Useful Links</h5>
                    <p><a href="index.php" class="text-light text-decoration-none hover-scale d-inline-block">Home</a></p>
                    <p><a href="products.php" class="text-light text-decoration-none hover-scale d-inline-block">Products</a></p>
                    <p><a href="about.php" class="text-light text-decoration-none hover-scale d-inline-block">About Us</a></p>
                    <p><a href="contact.php" class="text-light text-decoration-none hover-scale d-inline-block">Contact Us</a></p>
                </div>
            </div>
            
            <hr class="mb-4 border-secondary">
            
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <p class="mb-0 text-muted"> Copyright © <?php echo date("Y"); ?> All rights reserved by:
                        <strong class="text-primary">King Store</strong>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.classList.contains('ajax-form') || form.action.includes('add_to_cart.php')) {
            e.preventDefault();
            fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text()).then(msg => {
                alert(msg);
                if (form.action.includes('add_to_cart.php')) {
                    let badge = document.querySelector('.cart-badge');
                    if (badge) badge.innerText = parseInt(badge.innerText) + 1;
                    else location.reload(); 
                } else if (form.action.includes('checkout.php')) {
                    window.location.href = 'index.php';
                } else if (form.action.includes('add_review.php') || form.action.includes('remove_from_cart.php')) {
                    location.reload();
                } else {
                    form.reset();
                }
            });
        }
    });

    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.onclick = (e) => {
            e.preventDefault();
            fetch(btn.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text()).then(msg => { alert(msg); location.reload(); });
        }
    });
    </script>
</body>
</html>
