


////////////////
// Navigation //
////////////////

// Use this variable to set the breakpoint at which the menu changes.
var breakPoint = 700;


// This function uses CSS classes to change the appearance of the menu.
function adjustNav() {

	if ($(document).width() < breakPoint) {

		$("nav.main-menu").removeClass("full").addClass("compact");
		$("nav.main-menu ul").hide();
	}

	else {

		$("nav.main-menu").removeClass("compact").addClass("full");
		$("nav.main-menu ul").show();
	}
}

//Function to resize the home page
function homeSize(){

	if(window.location.pathname == '/creative-services/'){
		var viewportHeight = $(window).height() - 50;

		if(viewportHeight <= 900 && viewportHeight >= 800){
			$('.content-area').css('height', 900);
			$('.content-area').css('padding-top', '3%');
		}else if(viewportHeight <= 800){
			$('.content-area').css('height', 900);
			$('.content-area').css('padding-top', '0%');
		}else{
			$('.content-area').css('padding-top', '6.5%');
			$('.content-area').css('height', viewportHeight);
		}
	}
}


function selectionListener() {
							    
	checkedStr = '';

	if (document.getElementById('graphics').checked) {
		$('#allSection').fadeOut("slow");
		$('#webSection').fadeOut("slow");
		$('#productionSection').fadeOut("slow");
		$('#graphicSection').delay(600).fadeIn( "slow" );
	}

	if (document.getElementById('web').checked) {
		$('#allSection').fadeOut("slow");
		$('#graphicSection').fadeOut("slow");
		$('#productionSection').fadeOut("slow");
		$('#webSection').delay(600).fadeIn( "slow" );
	}
	if (document.getElementById('productions').checked) {
		$('#allSection').fadeOut("slow");
		$('#webSection').fadeOut("slow");
		$('#graphicSection').fadeOut("slow");
		$('#productionSection').delay(600).fadeIn( "slow" );
	}
	if (document.getElementById('all').checked) {
		$('#graphicSection').fadeOut("slow");
		$('#webSection').fadeOut("slow");
		$('#productionSection').fadeOut("slow");
		$('#allSection').delay(600).fadeIn( "slow" );
	}
}

// When the document loads, adjust the nav and add click handlers for the
// mobile view of the menu.

$(document).ready(function () {

	adjustNav();
	homeSize();

	$(".menu-toggle").click(function (evt) {

		$("nav.main-menu ul").slideToggle();
		evt.preventDefault();
	})
});


// On window resize, reevaluate the view of the navigation.
$(window).resize(function () {

	adjustNav();
	homeSize();
});

