<?php require_once 'inc/header.php'; ?>

<div class="container-scroller">
    <?php require_once 'inc/navbar.php' ?>

    <div class="container-fluid page-body-wrapper">
        <?php require_once 'inc/sidebar.php' ?>

        <div class="main-panel">

            <!-- Main Content -->
            <div class="content-wrapper p-2 p-sm-3 p-xl-4">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card mb-2 mb-sm-3">
                        <div class="card card-rounded bg-primary">
                            <div class="card-body py-3">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash text-light">Contact Requests</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body p-0 p-2 p-sm-4">
                                <div class="table-responsive">
                                    <table id="contactRequestTable" class="table table-bordered align-middle w-100">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Interest</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
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

    getContactRequests();
</script>