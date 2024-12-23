<?php require_once 'inc/header.php' ?>

<section class="container py-5 mt-5">

    <div class="container mt-5">
        <div class="row justify-content-center  animated animatedFadeInUp fadeInUp rounded px-4 shadow mb-5 py-4">
            <div class="col-md-8">
                <div class="text-center">
                    <span class="text-muted">Discover the Highlights</span>
                    <h1 class="display-5 fw-bold">Gallery</h1>
                    <p class="lead">A Showcase of Our GIS, Mapping, and Surveying Expertise.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 gallery">
        <div>
            <div class="row">
                <?php
                function loadGallery($galleryPath)
                {
                    if (is_dir($galleryPath)) {

                        $folders = scandir($galleryPath);

                        foreach ($folders as $folder) {

                            if ($folder !== '.' && $folder !== '..' && is_dir($galleryPath . '/' . $folder)) {

                                echo "<h3 class='my-4 px-3 py-2 animated animatedFadeInUp fadeInUp text-light bg-info bg-gradient rounded'>" . ucfirst($folder) . "</h3>";

                                $images = scandir($galleryPath . '/' . $folder);

                                foreach ($images as $image) {
                                    $imagePath = $galleryPath . '/' . $folder . '/' . $image;
                                    if (in_array(strtolower(pathinfo($imagePath, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
                                        echo "
                                        <div class='col-lg-4 mb-0 mb-lg-0 mb-5'>
                                            <img src='$imagePath' class='w-100 h-100 img-thumbnail shadow-1-strong rounded animated animatedFadeInUp fadeInUp' alt='$image' data-bs-toggle='modal' data-bs-target='#imageModal' />
                                        </div>
                                        ";
                                    }
                                }
                            }
                        }
                    } else {
                        echo "Gallery folder does not exist.";
                    }
                }

                $galleryPath = 'assets/images/gallery';

                loadGallery($galleryPath);

                ?>
            </div>
            <!-- Gallery -->
        </div>
    </div>
</section>

<!-- bootstrap modal -->

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary bg-gradient">
                <!-- <h5 class="modal-title" id="imageModalLabel">Preview</h5> -->
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" class="img-fluid" alt="Full Size Image">
            </div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php' ?>