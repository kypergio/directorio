var _openMenu = true;
var _openModal = false;

$(document).ready(function () {
    /* $(window).on("scroll", function(e){
     var height = $(window).scrollTop();
     if(_openModal)
     {
     var modal = $(".modal");

     if(height  > modal.outerHeight()) {
     e.preventDefault()
     }
     }
     });*/
    $(document).on("change keyup click focusout",
        ".modal .row .column .registration form fieldset input, " +
        ".modal .row .column .registration form fieldset select," +
        ".modal .row .column .registration form fieldset textarea", function () {
            var value = $(this).val();
            var focus = $(this).is(":focus");
            if (value != "" && value != null || focus) {
                $(this).css("border-color", "#f4bb50");
            } else {
                $(this).css("border", "2px solid rgba(0, 0, 0, 0.1)");
            }
        });
});
var toggleMenu = function (e) {
    e.preventDefault();

    if (!_openMenu) return;

    _openMenu = false;

    setTimeout(function () {
        $(".js-c-nav-mobile-ham").toggleClass("c-navigation-hamburger--is-active");
        $(".js-c-nav-mobile-sidebar").toggleClass("c-navigation-sidebar--is-active");
    }, 250);
    setTimeout(function () {
        _openMenu = true;
    }, 750);
}

$(".js-c-nav-mobile-ham").on("click", toggleMenu);

function registration() {
    var modal = document.querySelector('.modal');

    if (modal) {
        var registration = modal.querySelector('.registration');
        var success = modal.querySelector('.success');

        registration.style.display = 'none';
        success.style.display = 'block';
    }

    return false;
}

function openModal() {
    var modal = document.querySelector('.modal');
    var overlay = document.querySelector('#overlay');

    if (modal) {
        var width = $(window).width();
        modal.style.display = width <= 838 ? 'flex' : "table";
        overlay.style.display = 'table';
    }
    _openModal = true;

    return false;
}

function closeModal() {
    var modal = document.querySelector('.modal');
    var overlay = document.querySelector('#overlay');

    if (modal) {
        modal.style.display = 'none';
        overlay.style.display = 'none';
    }
    _openModal = false;

    return false;
}