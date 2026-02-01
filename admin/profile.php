<?php require_once 'inc/header.php';
?>

<div class="container-scroller">
    <?php require_once 'inc/navbar.php' ?>

    <div class="container-fluid page-body-wrapper">
        <?php require_once 'inc/sidebar.php' ?>

        <div class="main-panel">

            <!-- Main Content  -->
            <div class="content-wrapper p-2 p-sm-3 p-xl-4">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card mb-2 mb-sm-3">
                        <div class="card card-rounded bg-primary">
                            <div class="card-body py-3">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash text-light">Admin Profile</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body p-0 p-2 p-sm-4">
                                <div class="pt-3 px-3">
                                    <h4 class="card-title text-info m-0">Change Password</h4>
                                </div>
                                <p class="text-muted my-2"><span class="text-warning">Suggestions:</span> Use a strong password contains letters, numbers, and symbols of atleast 8 characters. It's safer to update your passwords regularly</p>
                                <form class="form-sample p-sm-4" id="update_password_form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row m-0">
                                                <label class="col-sm-3 col-form-label">Current Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="old_password" name="old_pswd" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row  m-0">
                                                <label class="col-sm-3 col-form-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="new_password" name="new_pswd" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row  m-0">
                                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_pswd" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3"></label>
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-success btn-sm rounded-1 px-4" id="update_password_btn">Save</button>
                                                    <button type="reset" class="btn btn-dange clearBtn btn-sm rounded-1 px-4">Clear</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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