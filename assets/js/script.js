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


  // contact us form handler

  $("#contact-form").submit(function (e) {
    e.preventDefault();
    if (
      $("#form_name").val() == "" ||
      $("#form_email").val() == "" ||
      $("#form_interest").val() == ""
    ) {
      var msg = `<div class="alert alert-danger alert-dismissible fade show" role="alert mt-3">
        <strong>Error:</strong> Please fill all required <span class="text-danger">*</span> details.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
      $("#msg").html(msg);
    } else {
      const formData = new FormData(this);
      $.ajax({
        url: "backend/contact_process.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
          var obj = jQuery.parseJSON(res);
          if (obj.status == 1) {
            $("#msg").html(obj.msg);
            $("#contact-form")[0].reset();
          } else {
            $("#msg").html(obj.msg);
          }
        },
      });
    }
  });

  // When an image is clicked
  $(".gallery img").click(function () {
    var imgSrc = $(this).attr("src"); // Get the source of the clicked image
    $("#modalImage").attr("src", imgSrc); // Set the modal image source
  });
});
