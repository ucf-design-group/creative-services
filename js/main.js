


////////////////
// Navigation //
////////////////

// Use this variable to set the breakpoint at which the menu changes.
// var breakPoint = 850;


// This function uses CSS classes to change the appearance of the menu.
function adjustNav() {

	if ($(document).width() < 850) {

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

		if(viewportHeight <= 900 && viewportHeight > 800){
			$('.page-home .content-area').css('height', 900);
			$('.page-home .content-area').css('padding-top', '3%');
		}else if(viewportHeight <= 800 && viewportHeight > 650){
			$('.page-home .content-area').css('height', 900);
			$('.page-home .content-area').css('padding-top', '0%');
		}else if(viewportHeight <= 650){
			$('.page-home .content-area').css('height', 575);
		}else{
			$('.page-home .content-area').css('padding-top', '6.5%');
			$('.page-home .content-area').css('height', viewportHeight);
		}
	}
}

//Sorting Function
function selectionListener() {
						    
	checkedStr = '';

	if (document.getElementById('graphics').checked) {
		$('.isotope').isotope({ filter: '.Graphic' });
	}

	if (document.getElementById('web').checked) {
		$('.isotope').isotope({ filter: '.Web' });
	}
	if (document.getElementById('productions').checked) {
		$('.isotope').isotope({ filter: '.Video' });
	}
	if (document.getElementById('all').checked) {
		$('.isotope').isotope({ filter: '*' });
	}
}



// When the document loads, adjust the nav and add click handlers for the
// mobile view of the menu.

$(document).ready(function () {

	adjustNav();
	homeSize();


	$('.page-team .item').mouseenter(function() {
		$(this).find(".itemIcons").animate({"height":"50px"},250);
	});
	$('.page-team .item').mouseleave(function(){
		$(this).find(".itemIcons").animate({"height":"0px"},200);
	});
	  


	menuShow = false;
	$(".menu-toggle").click(function (evt) {

		$("nav.main-menu ul").slideToggle();

		if(menuShow == false){
			$(".menu-toggle").addClass("toggOn");
			menuShow = true;
		}else if(menuShow == true){
			$(".menu-toggle").removeClass("toggOn");
			menuShow = false;
		}
		evt.preventDefault();
	});


	//Fancy/Isotope Init
	afterChop = document.URL.substr(-6);

	if(afterChop == '/work/' || afterChop == '/team/'){
		$(".fancybox").fancybox();
		$('.fancybox-media').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			helpers : {
				media : {}
			}
		});

		$('.isotope').isotope({
			layoutMode: 'packery',
			itemSelector: '.item'
		});
		//Fancy/Isotope End
	}

});


// On window resize, reevaluate the view of the navigation.
$(window).resize(function () {

	adjustNav();
	homeSize();
});