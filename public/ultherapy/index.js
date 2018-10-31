var _openMenu = true;

var toggleMenu = function(e) {
  e.preventDefault();

  if (!_openMenu) return;

  _openMenu = false;

  setTimeout(function() {
    $(".js-c-nav-mobile-ham").toggleClass("c-navigation-hamburger--is-active");
    $(".js-c-nav-mobile-sidebar").toggleClass("c-navigation-sidebar--is-active");
  }, 250);
  setTimeout(function() {
    _openMenu = true;
  }, 750);
}

$(".js-c-nav-mobile-ham").on("click", toggleMenu);

function registration(){
  var modal = document.querySelector('.modal');

  if(modal){
    var registration = modal.querySelector('.registration');
    var success = modal.querySelector('.success');

    registration.style.display = 'none';
    success.style.display = 'block';
  }

  return false;
}

function openModal(){
  var modal = document.querySelector('.modal');

  if(modal){
    modal.style.display = 'table';
  }

  return false;
}

function closeModal(){
  var modal = document.querySelector('.modal');

  if(modal){
    modal.style.display = 'none';
  }

  return false;
}