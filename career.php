<?php
require_once 'inc/header.php';
require_once 'inc/data.php';
?>

<header class="career-hero">
    <h1 class="fw-bold">Careers</h1>
    <p class="lead">Build your future with us. Explore current openings.</p>
</header>

<section class="container my-5 pt-5">
    <h2 class="text-center mb-4">Current Openings</h2>

    <div class="accordion career-accordion" id="careerAccordion">

        <div class="accordion career-accordion" id="careerAccordion">

            <?php foreach ($job_openings as $index => $job):
                $collapseId = "job" . $index;
            ?>
                <div class="accordion-item mb-3 border-0 rounded shadow-sm">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#<?= $collapseId ?>"
                            aria-expanded="false">

                            <?= htmlspecialchars($job['title']) ?>

                            <span class="ms-2 badge bg-primary">
                                <?= htmlspecialchars($job['location']) ?>
                            </span>
                        </button>
                    </h3>

                    <div id="<?= $collapseId ?>" class="accordion-collapse collapse"
                        data-bs-parent="#careerAccordion">

                        <div class="accordion-body">

                            <?php if (!empty($job['experience'])): ?>
                                <p class="text-muted mb-2">
                                    <strong>Experience:</strong>
                                    <?= htmlspecialchars($job['experience']) ?>
                                </p>
                            <?php endif; ?>

                            <?php if (!empty($job['qualification'])): ?>
                                <h6>Qualification</h6>
                                <ul>
                                    <?php foreach ($job['qualification'] as $qual): ?>
                                        <li><?= htmlspecialchars($qual) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (!empty($job['responsibilities'])): ?>
                                <h6>Key Responsibilities</h6>
                                <ul>
                                    <?php foreach ($job['responsibilities'] as $res): ?>
                                        <li><?= htmlspecialchars($res) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (!empty($job['skills'])): ?>
                                <h6>Skills Required</h6>
                                <ul>
                                    <?php foreach ($job['skills'] as $skill): ?>
                                        <li><?= htmlspecialchars($skill) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (!empty($job['salary'])): ?>
                                <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
                            <?php endif; ?>

                            <?php if (!empty($job['selection_mode'])): ?>
                                <p><strong>Selection Mode:</strong> <?= htmlspecialchars($job['selection_mode']) ?></p>
                            <?php endif; ?>

                            <a href="#apply"
                                class="btn btn-outline-primary btn-sm mt-2"
                                onclick="document.getElementById('position').value='<?= htmlspecialchars($job['title']) ?>'">
                                Apply for this position
                            </a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
if ($_GET['status'] ?? '' === 'success'): ?>
    <div class="container my-4">
        <div class="alert alert-success text-center" role="alert">
            Your application has been submitted successfully. We will get back to you soon.
        </div>
    </div>
<?php elseif ($_GET['status'] ?? '' === 'error'): ?>
    <div class="container my-4">
        <div class="alert alert-danger text-center" role="alert">
            There was an error submitting your application. Please try again.
        </div>
    </div>
<?php else: endif;
?>

<section class="container my-5" id="apply">
    <h2 class="text-center mb-4">Apply Now</h2>

    <div class="apply-section bg-primary bg-opacity-10 bg-gradient p-4 py-5 p-md-5 rounded shadow-sm">

        <form action="backend/submit_application.php" method="post" enctype="multipart/form-data" class="row g-3" novalidate>

            <div class="col-md-6">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input type="tel" name="mobile" class="form-control" placeholder="10-digit mobile number" pattern="[0-9]{10}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Applying For <span class="text-danger">*</span></label>
                <select name="position" id="position" class="form-select text-muted" required>
                    <option value="">-- Select Position --</option>
                    <?php foreach ($job_openings as $job): ?>
                        <option value="<?= htmlspecialchars($job['title']) ?>">
                            <?= htmlspecialchars($job['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label"> Upload Resume <small class="text-muted">(PDF only)</small></label>
                <input type="file" name="resume" class="form-control" accept="application/pdf" required>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2"> Submit Application</button>
            </div>
        </form>
    </div>
</section>


<?php require_once 'inc/footer.php' ?>