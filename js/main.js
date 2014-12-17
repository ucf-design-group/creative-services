


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

//Mobile Work Reveals
function itemReveal(){
	if($(window).width() <= 800){
		$( ".itemDescription" ).click(function() {
		if(itemShow == false){
				$( this ).css( "opacity", 1 );
				itemShow = true;
		}else if(itemShow == true){
				$(".itemDescription").css("opacity", 0);
				itemShow = false;
		}
		});
	}
}




//Variables
itemShow = false;
workShow = false;

// When the document loads, adjust the nav and add click handlers for the
// mobile view of the menu.

$(document).ready(function () {

	adjustNav();
	homeSize();
	itemReveal();


	if($(window).width() >= 800){
		$('.page-team .item').mouseenter(function() {
			$(this).find(".itemIcons").animate({"height":"50px"},250);
		});

		$('.page-team .item').mouseleave(function(){
			$(this).find(".itemIcons").animate({"height":"0px"},200);
		});
	}else{
		$( ".page-team .item" ).click(function() {
			if(workShow == false){
				$(this).find(".itemIcons").animate({"height":"50px"},250);
				workShow = true;
			}else if(workShow == true){
				$(".itemIcons").animate({"height":"0px"},200);
				workShow = false;
			}
		});
	}


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
	itemReveal();
});