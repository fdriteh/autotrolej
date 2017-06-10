$(function () {
  	$('.navbar-toggle-sidebar').click(function () {
  		$('.navbar-nav').toggleClass('slide-in');
  		$('.side-body').toggleClass('body-slide-in');
  		$('#search').removeClass('in').addClass('collapse').slideUp(200);
  	});

  	$('#search-trigger').click(function () {
  		$('.navbar-nav').removeClass('slide-in');
  		$('.side-body').removeClass('body-slide-in');
  		$('.search-input').focus();
  	});
  });



var ogl = document.getElementById('oglasavanje');
var obavijest = document.getElementById("obavijest");
var on = false;

ogl.addEventListener("click", function(){
  obavijest.style.display="block";
  linije.style.display="none";
  karte.style.display="none";
  korisnici.style.display="none";
   poslovanje.style.display="none";
});



var uprlinije = document.getElementById('uprlinije');
var linije = document.getElementById("linije");

uprlinije.addEventListener("click", function(){
  linije.style.display="block";
  obavijest.style.display ="none";
  karte.style.display="none";
  korisnici.style.display="none";
   poslovanje.style.display="none";
});


var uprkartama = document.getElementById('uprkartama');
var karte = document.getElementById("karte");

uprkartama.addEventListener("click", function(){
  karte.style.display="block";
   linije.style.display="none";
    obavijest.style.display ="none";
    korisnici.style.display="none";
     poslovanje.style.display="none";
});






var regkorisnici = document.getElementById('regkorisnici');
var korisnici = document.getElementById("korisnici");

regkorisnici.addEventListener("click", function(){
  korisnici.style.display="block";
  karte.style.display="none";
   linije.style.display="none";
    obavijest.style.display ="none";
     poslovanje.style.display="none";
});





var pregled = document.getElementById('pregled');
var poslovanje = document.getElementById("poslovanje");

pregled.addEventListener("click", function(){
  poslovanje.style.display="block";
   korisnici.style.display="none";
  karte.style.display="none";
   linije.style.display="none";
    obavijest.style.display ="none";
});

function brisi_liniju(id)
{
	window.location.href = "/linije-admin.php?delete=" + id;
}

function brisi_kartu(id)
{
	window.location.href = "/karte-admin.php?delete=" + id;
}
