<?php require_once 'inc/header.php'; ?>

<div class="container-scroller bg-white vh-100 login-page-container">
    <!-- <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-6 col-xl-4 col-sm-10 mx-auto">
                    <div class="auth-form-light rounded text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo d-flex justify-content-between align-items-center">
                            <img src="../helpers/vendors/images/logo/logo.png">
                            <div>
                                <h3 class="text-primary fw-bold text-end">Shreevishwanath Services</h3>
                                <h6 class="text-end">Admin Panel</h6>
                            </div>
                        </div>
                        <h4>Hello! let's get started</h4>
                        <h6 class="fw-light">Sign in to continue.</h6>
                        <form class="pt-3" id="login_form">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-block btn-primary fw-medium auth-form-btn">SIGN IN</button>
                            </div>
                            <div class="mt-3 d-flex justify-content-center align-items-center">
                                <a href="#" class="auth-link text-black text-decoration-none">Forgot password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row justify-content-center align-items-center g-0 overflow-hidden">
        <div class="col-lg-6 col-xl-7 d-none-on-sm d-lg-block">
            <div id="carouselExampleFade" class="carousel slide carousel-fade vh-100" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <img src="../helpers/vendors/images/carousel/1.jpg" class="d-block w-100" alt="Welcome Slide">
                        <div class="carousel-caption d-none d-md-block text-start glass-effect mb-3">
                            <h2 class="fw-bold fs-2 mb-2">Welcome to Admin Panel</h2>
                            <p>Manage your business effortlessly with our reliable IT solutions. Designed to keep your operations smooth, secure, and scalable.</p>
                            <ul class="list-unstyled">
                                <li>✔ Customized IT Solutions</li>
                                <li>✔ Easy-to-use admin dashboard</li>
                                <li>✔ Scalable Business Software</li>
                            </ul>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../helpers/vendors/images/carousel/2.jpg" class="d-block w-100" alt="Services Slide">
                        <div class="carousel-caption d-none d-md-block text-start glass-effect mb-3">
                            <h2 class="fw-bold fs-2 mb-2">Everything You Need in One Place</h2>
                            <p>Our platform connects all your essential services for smooth workflow.</p>
                            <ul class="list-unstyled">
                                <li>✔ Project & task management</li>
                                <li>✔ Data & report tracking</li>
                                <li>✔ AI & Data Analytics</li>
                            </ul>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../helpers/vendors/images/carousel/3.jpg" class="d-block w-100" alt="Security Slide">
                        <div class="carousel-caption d-none d-md-block text-start glass-effect mb-3">
                            <h2 class="fw-bold fs-2 mb-2">Secure and Reliable</h2>
                            <p>Enterprise-grade security ensures your information stays safe. Built with compliance, encryption, and continuous monitoring for complete peace of mind.</p>
                            <ul class="list-unstyled">
                                <li>✔ Data Encryption</li>
                                <li>✔ Regular data backups</li>
                                <li>✔ Enterprise-level compliance</li>
                            </ul>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../helpers/vendors/images/carousel/4.jpg" class="d-block w-100" alt="Contact Slide">
                        <div class="carousel-caption d-none d-md-block text-start glass-effect mb-3">
                            <h2 class="fw-bold fs-2 mb-2">Always Here to Support You</h2>
                            <p>Our team is committed to assisting you 24/7. Think of us not just as your IT provider, but as your technology partner.</p>
                            <ul class="list-unstyled">
                                <li><span class="mdi mdi-phone me-2"></span>+91-9852314661</li>
                                <li><span class="mdi mdi-email-outline me-2"></span> contact@sysrootsolution.com</li>
                                <li><span class="mdi mdi-web me-2"></span> <a href="https://www.sysrootsolution.com" class="text-white text-decoration-none" target="_blank">www.sysrootsolution.com</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-5 d-flex justify-content-center align-items-center">
            <div class="page-body-wrapper p-0 w-100">
                <div class="d-flex align-items-center justify-content-center auth m-auto px-0 row w-100">
                    <div class="auth-form-light rounded text-left py-5 px-5 px-sm-5 form-container col-sm-8 col-md-6 col-lg-11 col-xl-8 bg-transparent">
                        <div class="brand-logo d-flex justify-content-between align-items-center">
                            <img src="../helpers/vendors/images/logo/logo.png" style="width: 90px;">
                            <div>
                                <h3 class="text-primary fw-bold fs-5 text-end m-0" id="project-name"></h3>
                                <h6 class="text-end text-muted">Admin Panel</h6>
                            </div>
                        </div>
                        <h4 class="m-0 mb-1">Good to See You Again!</h4>
                        <h6 class="fw-light text-muted small">Log in to continue.</h6>

                        <form class="pt-3" id="login_form">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-block btn-primary fw-medium auth-form-btn">SIGN IN</button>
                            </div>
                            <!-- <div class="mt-3 d-flex justify-content-center align-items-center">
                                <a href="#" class="auth-link text-black text-decoration-none">Forgot password?</a>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>

<script>
    isLoggedIn();
</script>