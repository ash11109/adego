$(document).ready(function () {
  // Override default Bootstrap dropdown behavior
  $(".dropdown").on("show.bs.dropdown", function () {
    $(this).find(".dropdown-menu").first().stop(true, true).slideDown(300);
  });

  $(".dropdown").on("hide.bs.dropdown", function () {
    $(this).find(".dropdown-menu").first().stop(true, true).slideUp(300);
  });

  // scroll effect
  function checkInView() {
    var windowHeight = $(window).height();

    $(".animatedFadeInUp").each(function () {
      var elementTop = $(this).offset().top;
      var scrollTop = $(window).scrollTop();

      // Check if the element is in the viewport
      if (elementTop < scrollTop + windowHeight) {
        $(this).addClass("scroll-active");
      }
    });
  }

  // Check on page load and on scroll
  checkInView();
  $(window).on("scroll", checkInView);

  // When an image is clicked
  $(".gallery img").click(function () {
    var imgSrc = $(this).attr("src"); // Get the source of the clicked image
    $("#modalImage").attr("src", imgSrc); // Set the modal image source
  });
});


// Custom Functions -------------------------------------------------------------------------------------

function validateFile(inputElement, allowedTypes, maxSizeMB) {

  let file = inputElement.files[0];

  if (!file) {
    return true;
  }

  let fileName = file.name.toLowerCase();
  let extension = fileName.split('.').pop();

  if (!allowedTypes.includes(extension)) {
    return "Only " + allowedTypes.join(", ").toUpperCase() + " files are allowed.";
  }

  let maxSize = maxSizeMB * 1024 * 1024;

  if (file.size > maxSize) {
    return "File size must be less than " + maxSizeMB + "MB.";
  }

  return true;
}


// Contact Us Application -------------------------------------------------------------------------------

$("#contact-form").submit(async function (e) {
  e.preventDefault();

  const $btn = $("#contact-btn");
  const btnText = $btn.text();

  $btn.prop("disabled", true).html("Sending...");

  try {
    let formData = new FormData(this);
    formData.append("action", "website_contact_us");

    let response = await fetch(API, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error("Server error");
    }

    let result = await response.json();

    if (result.status == 1) {
      document.getElementById("msg").innerHTML = `
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            <strong>Success!</strong> ${result.msg}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
    } else {
      document.getElementById("msg").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <strong>Error!</strong> ${result.msg}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
    }

  } catch (error) {
    document.getElementById("msg").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <strong>Error!</strong> Failed to send message. Please try again later.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
  } finally {
    $btn.prop("disabled", false).html(btnText);
  }
});


// Job Application ------------------------------------------------------------------------------------

$("#career-application-form").submit(async function (e) {
  e.preventDefault();

  const $btn = $("#career-btn");
  const btnText = $btn.text();

  if ($("#resume")[0].files[0]) {
    let result = validateFile($("#resume")[0], ["pdf"], 2);

    if (result !== true) {
      e.preventDefault();
      document.getElementById("msg").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <strong>Error!</strong> ${result}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
    }
  }

  $btn.prop("disabled", true).html("Submitting...");

  try {
    let formData = new FormData(this);
    formData.append("action", "save_career_application");

    let response = await fetch(API, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error("Server error");
    }

    let result = await response.json();

    if (result.status == 1) {
      document.getElementById("msg").innerHTML = `
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            <strong>Success!</strong> ${result.msg}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
    } else {
      document.getElementById("msg").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <strong>Error!</strong> ${result.msg}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
    }

  } catch (error) {
    document.getElementById("msg").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <strong>Error!</strong> Failed to submit job application. Please try again later.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
  } finally {
    $btn.prop("disabled", false).html(btnText);
  }
});
