/*

File: js
*/

var gallery = [];
var dataCallbackForm;
$(function () {
  'use strict';
  $(function () {
    $('.preloader').fadeOut();
  });
  jQuery(document).on('click', '.mega-dropdown', function (e) {
    e.stopPropagation();
  });
  // ==============================================================
  // This is for the top header part and sidebar part
  // ==============================================================
  var set = function () {
    var width = window.innerWidth > 0 ? window.innerWidth : this.screen.width;
    var topOffset = 0;
    if (width < 1170) {
      $('body').addClass('mini-sidebar');
      $('.navbar-brand span').hide();
      $('.sidebartoggler i').addClass('ti-menu');
    } else {
      $('body').removeClass('mini-sidebar');
      $('.navbar-brand span').show();
    }

    var height =
      (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 1;
    height = height - topOffset;
    if (height < 1) height = 1;
    if (height > topOffset) {
      $('.page-wrapper').css('min-height', height + 'px');
    }
  };
  $(window).ready(set);
  $(window).on('resize', set);

  // ==============================================================
  // Theme options
  // ==============================================================
  $('.sidebartoggler').on('click', function () {
    if ($('body').hasClass('mini-sidebar')) {
      $('body').trigger('resize');
      $('body').removeClass('mini-sidebar');
      $('.navbar-brand span').show();
    } else {
      $('body').trigger('resize');
      $('body').addClass('mini-sidebar');
      $('.navbar-brand span').hide();
    }
  });

  // this is for close icon when navigation open in mobile view
  $('.nav-toggler').click(function () {
    $('body').toggleClass('show-sidebar');
    $('.nav-toggler i').toggleClass('ti-menu');
    $('.nav-toggler i').addClass('ti-close');
  });

  $('.search-box a, .search-box .app-search .srh-btn').on('click', function () {
    $('.app-search').toggle(200);
  });
  // ==============================================================
  // Right sidebar options
  // ==============================================================
  $('.right-side-toggle').click(function () {
    $('.right-sidebar').slideDown(50);
    $('.right-sidebar').toggleClass('shw-rside');
  });
  // ==============================================================
  // This is for the floating labels
  // ==============================================================
  $('.floating-labels .form-control')
    .on('focus blur', function (e) {
      $(this)
        .parents('.form-group')
        .toggleClass('focused', e.type === 'focus' || this.value.length > 0);
    })
    .trigger('blur');

  // ==============================================================
  // Auto select left navbar
  // ==============================================================

  // ==============================================================
  //tooltip
  // ==============================================================
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
  // ==============================================================
  //Popover
  // ==============================================================
  $(function () {
    $('[data-toggle="popover"]').popover();
  });
  // ==============================================================
  // Sidebarmenu
  // ==============================================================
  $(function () {
    $('#sidebarnav').AdminMenu();
  });

  // ==============================================================
  // Perfact scrollbar
  // ==============================================================
  $(
    '.scroll-sidebar, .right-side-panel, .message-center, .right-sidebar'
  ).perfectScrollbar();

  // ==============================================================
  // Resize all elements
  // ==============================================================
  $('body').trigger('resize');
  // ==============================================================
  // To do list
  // ==============================================================
  $('.list-task li label').click(function () {
    $(this).toggleClass('task-done');
  });

  function cerrarTooltips() {
    $('[data-toggle="tooltip"]').tooltip('hide');
  }

  // ==============================================================
  // Collapsable cards
  // ==============================================================
  $('a[data-action="collapse"]').on('click', function (e) {
    e.preventDefault();
    $(this)
      .closest('.card')
      .find('[data-action="collapse"] i')
      .toggleClass('ti-minus ti-plus');
    $(this).closest('.card').children('.card-body').collapse('toggle');
  });
  // Toggle fullscreen
  $('a[data-action="expand"]').on('click', function (e) {
    e.preventDefault();
    $(this)
      .closest('.card')
      .find('[data-action="expand"] i')
      .toggleClass('mdi-arrow-expand mdi-arrow-compress');
    $(this).closest('.card').toggleClass('card-fullscreen');
  });

  // Close Card
  $('a[data-action="close"]').on('click', function () {
    $(this).closest('.card').removeClass().slideUp('fast');
  });
});

function getSpin(size) {
  if (typeof size == 'undefined') size = 'fa-3x';
  return `<div class="text-center"><i class="fa fa-refresh fa-spin ${size} fa-fw"></i></div>`;
}
function nl2br(str, is_xhtml) {
  if (typeof str === 'undefined' || str === null) {
    return '';
  }
  var breakTag =
    is_xhtml || typeof is_xhtml === 'undefined' ? '<br />' : '<br>';
  return (str + '').replace(
    /([^>\r\n]?)(\r\n|\n\r|\r|\n)/g,
    '$1' + breakTag + '$2'
  );
}
function encodeImageFileAsURL(element) {
  var file = element.files[0];
  file.base64 = '';
  var reader = new FileReader();
  reader.onloadend = function () {
    file.base64 = reader.result;
    $("input[name='" + $(element).attr('name') + "Base64']").val(reader.result);
  };
  reader.readAsDataURL(file);
}

function checkArray(data, formData) {
  var n = formData.name.indexOf('[]');
  if (n != -1) {
    if (typeof data[formData.name.replace('[]', '')] == 'undefined')
      data[formData.name.replace('[]', '')] = [];
    data[formData.name.replace('[]', '')].push(formData.value);
  }
}
window.mobileCheck = function () {
  let check = false;
  (function (a) {
    if (
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(
        a
      ) ||
      /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
        a.substr(0, 4)
      )
    )
      check = true;
  })(navigator.userAgent || navigator.vendor || window.opera);
  return check;
};

function loadingTable(tableId, colspan) {
  $(tableId + ' tbody').html(
    `<tr><td colspan="${colspan}" class="text-center"><i class="fa fa-refresh fa-spin fa-2x fa-fw"></i></td></tr>`
  );
}

function renderDate(date) {
  let day = date.getDate();
  let month = date.getMonth() + 1;
  let year = date.getFullYear();
  day = day < 10 ? '0' + day : day;
  month = month < 10 ? '0' + month : month;
  return `${day}/${month}/${year}`;
}
function renderDateTime(date) {
  let day = date.getDate();
  let month = date.getMonth() + 1;
  let year = date.getFullYear();
  let hour = date.getHours();
  let minute = date.getMinutes();
  day = day < 10 ? '0' + day : day;
  hour = hour < 10 ? '0' + hour : hour;
  month = month < 10 ? '0' + month : month;
  minute = minute < 10 ? '0' + minute : minute;
  return `${day}/${month}/${year} ${hour}:${minute}`;
}
