<?php require_once 'inc/header.php' ?>

<div class="container py-5 mt-5">
    <div class="mt-5">
        <div class="text-center py-5 rounded px-4 animated animatedFadeInUp fadeInUp shadow mb-5">
            <span class="text-muted">May I help you?</span>
            <h1 class="text-center fw-bold">Contact Us</h1>
            <p class="text-muted text-center">Get in touch! We always here to answer your questions and ensure you have the best experience possible.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="animated animatedFadeInUp fadeInUp">
                <div class=""><img class="img-fluid rounded-3 w-100" src="assets/images/other/contact.png"></div>
            </div>
        </div>
        <div class="col-md-6">
            <form class="p-md-5 rounded-3 bg-body-tertiary bg-gradient shadow p-3 animated animatedFadeInUp fadeInUp" id="contact-form">
                <div class="form-floating mb-3">
                    <input type="text" id="form_name" name="name" class="form-control" required />
                    <label class="form-label" for="form_name">Full Name <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" id="form_email" name="email" class="form-control" required />
                    <label class="form-label" for="form_email">Email address <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="form_phone" name="phone" class="form-control"  maxlength="10" pattern="[0-9]{10}" />
                    <label class="form-label" for="form_phone">Phone Number</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="form_address" name="address" class="form-control" />
                    <label class="form-label" for="form_address">Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="form_interest" name="interest" class="form-control" required />
                    <label class="form-label" for="form_interest">Training Program of Interest <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="#form_message" name="message" rows="5"></textarea>
                    <label class="form-label" for="#form_message">Message / Enquiry</label>
                </div>
                <button type="submit" class="w-100 btn btn btn-primary" id="contact-btn">Send</button>
            </form>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <strong>Success!</strong> <?= htmlspecialchars($_GET['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php } ?>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <strong>Error!</strong> <?= htmlspecialchars($_GET['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php } ?>

        </div>
    </div>
</div>
<div class="contact-us mb-5 container mt-5  animated animatedFadeInUp fadeInUp">
    <div class="hero">
        <h2 class="py-4 text-muted fw-bold">Reg. Office</h2>
        <ul style="list-style-type:none; display: flex; flex-direction:column; align-items:center; justify-content: center;" class="rounded bg-body-tertiary bg-gradient shadow py-5 m-0 gx-0">
            <li>Block-A5-3F Sail City</li>
            <li>New Pundag, Ranchi</li>
            <li>Jharkhand-834004</li>
            <div class="border border-white border-5 bg-white p-3 mt-4 rounded m-0">
                <li><i class="fas fa-phone text-primary"></i> <a href="tel:+91-7004551533" class="text-decoration-none text-dark">+91-7004551533</a>, <a href="tel:+91-8787526521" class="text-decoration-none text-dark">+91-8787526521</a></li>
                <li><i class="fas fa-envelope text-primary"></i> <a href="mailto:adegocommunication@gmail.com" class="text-decoration-none text-dark">adegocommunication@gmail.com</a></li>
            </div>
        </ul>
    </div>
</div>
<div class="contact-us mb-5 container  animated animatedFadeInUp fadeInUp">
    <div class="hero">
        <h2 class="py-4 text-muted fw-bold">Connect to social media</h1>

            <div class="social-links">
                <a href="https://www.facebook.com/adegocommunications/"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/adegocommunications/"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/@Adego-u7d"><i class="fab fa-twitter"></i></a>
                <a href="#!"><i class="fab fa-google"></i></a>
                <a href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
    </div>
</div>


<?php require_once 'inc/footer.php' ?>