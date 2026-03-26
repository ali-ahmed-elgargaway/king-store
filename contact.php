<?php 
require_once 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $msg = "Thank you $name! Your message has been sent successfully.";
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo $msg;
        exit();
    }
    
    header("Location: contact.php?msg=" . urlencode($msg));
    exit();
}

include 'header.php'; 
?>

<div class="container pb-5 fade-in-up">
    <div class="d-flex align-items-center mb-5 border-bottom pb-3">
        <h1 class="display-5 fw-bold text-dark m-0"><i class="fa-solid fa-envelope me-3 text-primary"></i>Contact Us</h1>
    </div>

    <div class="row g-5">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white h-100 p-5">
                <h3 class="fw-bold mb-4">Get in touch</h3>
                <p class="mb-5 lead opacity-75">We'd love to hear from you. Our friendly team is always here to chat.</p>
                
                <div class="d-flex align-items-center mb-4 hover-scale">
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 me-4">
                        <i class="fa-solid fa-location-dot fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Our Office</h5>
                        <p class="mb-0 opacity-75">123 Tech Avenue, Code City</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-4 hover-scale">
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 me-4">
                        <i class="fa-solid fa-phone fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Phone Number</h5>
                        <p class="mb-0 opacity-75">+1 (555) 123-4567</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center hover-scale">
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 me-4">
                        <i class="fa-solid fa-envelope-open fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Email Address</h5>
                        <p class="mb-0 opacity-75">hello@kingstore.local</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-lg rounded-4 p-5 h-100">
                <h3 class="fw-bold text-dark mb-4">Send us a Message</h3>
                <form action="contact.php" method="POST" class="ajax-form">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted">Full Name</label>
                        <input type="text" name="name" required class="form-control form-control-lg bg-light border-0 px-4">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted">Email Address</label>
                        <input type="email" name="email" required class="form-control form-control-lg bg-light border-0 px-4">
                    </div>
                    
                    <div class="mb-5">
                        <label class="form-label fw-bold text-muted">Your Message</label>
                        <textarea name="message" required class="form-control bg-light border-0 px-4 py-3" rows="5"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-custom btn-lg px-5 py-3 w-100 shadow">
                        <i class="fa-regular fa-paper-plane me-2"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
