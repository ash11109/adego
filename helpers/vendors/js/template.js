// APPLICATION ESSENTIALS =====================================================================================

$(document).ready(function () {

  $(function () {
    const body = $('body');
    const contentWrapper = $('.content-wrapper');
    const scroller = $('.container-scroller');
    const footer = $('.footer');
    const sidebar = $('.sidebar');

    const current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');

    function addActiveClass(element) {
      const href = element.attr('href');
      if (current === "") {
        if (href && href.indexOf("index.html") !== -1) {
          element.parents('.nav-item').last().addClass('active');
          if (element.parents('.sub-menu').length) {
            element.closest('.collapse').addClass('show');
            element.addClass('active');
          }
        }
      } else {
        if (href && href.indexOf(current) !== -1) {
          element.parents('.nav-item').last().addClass('active');
          if (element.parents('.sub-menu').length) {
            element.closest('.collapse').addClass('show');
            element.addClass('active');
          }
          if (element.parents('.submenu-item').length) {
            element.addClass('active');
          }
        }
      }
    }

    $('.nav li a', sidebar).each(function () {
      addActiveClass($(this));
    });

    $('.horizontal-menu .nav li a').each(function () {
      addActiveClass($(this));
    });

    sidebar.on('show.bs.collapse', '.collapse', function () {
      sidebar.find('.collapse.show').collapse('hide');
    });

    function applyStyles() {
      if (!body.hasClass("rtl")) {
        if ($('.settings-panel .tab-content .tab-pane.scroll-wrapper').length) {
          new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper');
        }
        if ($('.chats').length) {
          new PerfectScrollbar('.chats');
        }
        if (body.hasClass("sidebar-fixed")) {
          if ($('#sidebar').length) {
            new PerfectScrollbar('#sidebar .nav');
          }
        }
      }
    }

    applyStyles();

    $('[data-bs-toggle="minimize"]').on("click", function () {
      if (body.hasClass('sidebar-toggle-display') || body.hasClass('sidebar-absolute')) {
        body.toggleClass('sidebar-hidden');
      } else {
        body.toggleClass('sidebar-icon-only');
      }
    });

    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

    $('[data-bs-toggle="horizontal-menu-toggle"]').on("click", function () {
      $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
    });

    const navItemClicked = $('.horizontal-menu .page-navigation > .nav-item');
    navItemClicked.on("click", function () {
      if (window.matchMedia('(max-width: 991px)').matches) {
        if (!$(this).hasClass('show-submenu')) {
          navItemClicked.removeClass('show-submenu');
        }
        $(this).toggleClass('show-submenu');
      }
    });

    $(window).on("scroll", function () {
      const scrollTop = $(this).scrollTop();
      const header = $('.horizontal-menu');

      if (window.matchMedia('(min-width: 992px)').matches) {
        header.toggleClass('fixed-on-scroll', scrollTop >= 70);
      }

      $(".fixed-top").toggleClass("headerLight", scrollTop >= 97);
    });

    if ($("#datepicker").length) {
      $('#datepicker').datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
      }).datepicker("setDate", "0");
    }

    $("#check-all").on("click", function () {
      $(".form-check-input").prop('checked', $(this).prop('checked'));
    });

    $('#navbar-search-icon').on("click", function () {
      $("#navbar-search-input").focus();
    });

  });

  // Hover on sidebar icons
  $(document).on('mouseenter mouseleave', '.sidebar .nav-item', function (ev) {
    var body = $('body');
    var sidebarIconOnly = body.hasClass("sidebar-icon-only");
    var sidebarFixed = body.hasClass("sidebar-fixed");
    if (!('ontouchstart' in document.documentElement)) {
      if (sidebarIconOnly) {
        if (sidebarFixed) {
          if (ev.type === 'mouseenter') {
            body.removeClass('sidebar-icon-only');
          }
        } else {
          var $menuItem = $(this);
          if (ev.type === 'mouseenter') {
            $menuItem.addClass('hover-open')
          } else {
            $menuItem.removeClass('hover-open')
          }
        }
      }
    }
  });

  // file upload controls
  $(function () {
    $('.file-upload-browse').on('click', function () {
      var file = $(this).parent().parent().parent().find('.file-upload-default');
      file.trigger('click');
    });
    $('.file-upload-default').on('change', function () {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
  });

  // codemirror
  (function ($) {
    'use strict';
    if ($('textarea[name=code-editable]').length) {
      var editableCodeMirror = CodeMirror.fromTextArea(document.getElementById('code-editable'), {
        mode: "javascript",
        theme: "ambiance",
        lineNumbers: true
      });
    }
    if ($('#code-readonly').length) {
      var readOnlyCodeMirror = CodeMirror.fromTextArea(document.getElementById('code-readonly'), {
        mode: "javascript",
        theme: "ambiance",
        lineNumbers: true,
        readOnly: "nocursor"
      });
    }

    //Use this method of there are multiple codes with same properties
    if ($('.multiple-codes').length) {
      var code_type = '';
      var editorTextarea = $('.multiple-codes');
      for (var i = 0; i < editorTextarea.length; i++) {
        $(editorTextarea[i]).attr('id', 'code-' + i);
        CodeMirror.fromTextArea(document.getElementById('code-' + i), {
          mode: "javascript",
          theme: "ambiance",
          lineNumbers: true,
          readOnly: "nocursor",
          maxHighlightLength: 0,
          workDelay: 0
        });
      }
    }

    //Use this method of there are multiple codes with same properties in shell mode
    if ($('.shell-mode').length) {
      var code_type = '';
      var shellEditor = $('.shell-mode');
      for (var i = 0; i < shellEditor.length; i++) {
        $(shellEditor[i]).attr('id', 'code-' + i);
        CodeMirror.fromTextArea(document.getElementById('code-' + i), {
          mode: "shell",
          theme: "ambiance",
          readOnly: "nocursor",
          maxHighlightLength: 0,
          workDelay: 0
        });
      }
    }
  })(jQuery);

  // mobile menu toggle
  $(function () {
    $('[data-bs-toggle="offcanvas"]').on("click", function () {
      $('.sidebar-offcanvas').toggleClass('active')
    });
  });

  // select2 single
  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }

  // select2 single in boostrap modal
  $('.modal').on('shown.bs.modal', function () {
    $(this).find('.js-example-basic-single').select2({
      dropdownParent: $(this)
    });
  });

  // select2 multiple
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
  };

  // custom select2, allow to add an option
  $('.custom-select2').select2({
    tags: true,
    placeholder: "-- Select --",
    allowClear: true,
    createTag: function (params) {
      var term = $.trim(params.term);

      var exists = false;
      $('custom-select2 option').each(function () {
        if ($.trim($(this).text()).toLowerCase() === term.toLowerCase()) {
          exists = true;
          return false;
        }
      });

      if (!exists) {
        return {
          id: term,
          text: term,
          newTag: true
        };
      }
      return null;
    }
  });

  // custom select2, allow to add an option, in boostrap modal
  $('.modal').on('shown.bs.modal', function () {
    const $modal = $(this);

    $modal.find('.custom-select2').select2({
      tags: true,
      placeholder: "-- Select --",
      allowClear: true,
      dropdownParent: $modal, // important for modal rendering
      createTag: function (params) {
        var term = $.trim(params.term);
        var exists = false;

        // Fix: Use $(this) context to search inside current select
        $(this).find('option').each(function () {
          if ($.trim($(this).text()).toLowerCase() === term.toLowerCase()) {
            exists = true;
            return false;
          }
        });

        if (!exists && term !== '') {
          return {
            id: term,
            text: term,
            newTag: true
          };
        }

        return null;
      }
    });
  });

  // boostrap 5 theme on select2
  $('.boostrap5-select2').select2({
    theme: 'bootstrap-5',
    width: '100%'
  });

});

// CUSTOMIZED FUNCTIONS ======================================================================================

// only number input
$('.onlyNumber').on('input', function () {
  let value = $(this).val();
  let newValue = value.replace(/[^0-9]/g, '');
  $(this).val(newValue);
});

// Format date 
function formatDate(new_date) {
  var date = new Date(new_date);
  var options = { year: 'numeric', month: 'long', day: 'numeric' };

  return date.toLocaleDateString('en-US', options);
}
