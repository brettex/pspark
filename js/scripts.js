
jQuery(document).ready( function($){
	
	getScreenWidth();
	/** Change Header size on Scroll **/
	window.addEventListener('scroll', function(e){
		var header = jQuery('header');
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 30;
        if (distanceY > shrinkOn) {
            header.addClass('shrink');
        } else {
            header.removeClass('shrink');
        }
    });
	
	/* Slide the sub nav on mobile */
	$('nav .menu-item-has-children').on('click', function(e){
		if($('body').hasClass('mobile')){
			$(this).toggleClass('open').find('ul').slideToggle(400, 'swing', function(){});
		}
	});
	$('nav .menu-item-has-children > a').on('click', function(e){
		e.stopPropagation();
	});
	
	/** Pre-expand sub navs if its a child page **/
	$('.mobile li.menu-item-has-children.current_page_parent').addClass('open').find('ul').show();
	
	
	
	
	/*** Displaying Labels inside of Text boxes and hiding them when focus() *****/	
	// Hide inline labels on Forms
	$('.wpcf7-form input, .wpcf7-form textarea, .widget input, .search input, input#email, input.hideLabel').not(':hidden').each( function (){
		
		var label = $(this).parent('div').find('label').html();
		// If already filled in on Page Load, hide label
		if($(this).val() != ''){
			$(this).parents('.form-item').find('label').addClass('above');
		}
		//On Focus, hide the label
		$(this).focus( function(){
			$(this).parents('.form-item').find('label').addClass('above');
		});
		// Show Label if Value of Field is still empty
		$(this).blur( function(){
				if($(this).val() == ""){
					$(this).parents('.form-item').find('label').removeClass('above');
				}
				else{
					$(this).parents('.form-item').find('label').addClass('above');
				}
					
		});
		$(this).keypress( function(){
			$(this).parents('.form-item').find('label').addClass('above');
		});
	
	});
	
	/* If the Window Resizes, Do some Stuff!! */
	jQuery( window ).resize(function() {
		
		var width = getScreenWidth();
		setNavHeight();
		if(width>979){
			$('nav ul ul').removeAttr('style');
		}
	});
	
});


/** Get the screen width, add a class */
function getScreenWidth(){
	var width = jQuery('body').width();
	// Add class mobile to body 
	if(width < 979){
		jQuery('body').addClass('mobile');
	} else {
		jQuery('body').removeClass('mobile');
	}
	
	return width;
}

/** Set Max Height on Mobile Nav so it can scroll **/
function setNavHeight(){
	var windowHeight = parseInt($(window).height()) -  100;
	$('header nav').css('max-height', windowHeight+'px');
}
