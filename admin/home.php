<?php require_once 'inc/header.php'; ?>

<div class="container-scroller">
    <?php require_once 'inc/navbar.php' ?>

    <div class="container-fluid page-body-wrapper">
        <?php require_once 'inc/sidebar.php' ?>

        <div class="main-panel">

            <!-- Main Content -->
            <div class="content-wrapper p-2 p-sm-3 p-xl-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="home-tab">
                            <div class="alert alert-primary shadow-sm" role="alert">
                                <h4 class="alert-heading fs-5 fw-semibold">Welcome Admin!</h4>
                                <p class="small text-muted">Hello there! We're glad to see you here.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php require_once 'inc/copyright.php'; ?>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>

<script>
    isLoggedOut();
    loadData();
</script>