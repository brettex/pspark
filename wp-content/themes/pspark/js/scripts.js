// DOM Ready
$(function() {
	
	// SVG fallback
	// toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script#update
	if (!Modernizr.svg) {
		var imgs = document.getElementsByTagName('img');
		var dotSVG = /.*\.svg$/;
		for (var i = 0; i != imgs.length; ++i) {
			if(imgs[i].src.match(dotSVG)) {
				imgs[i].src = imgs[i].src.slice(0, -3) + "png";
			}
		}
	}

});

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
			$(this).parents('.form-item').find('label').animate({'opacity': 0.0}, 300);
		}
		//On Focus, hide the label
		$(this).focus( function(){
			$(this).parents('.form-item').find('label').animate({'opacity': 0.0}, 300);
		});
		// Show Label if Value of Field is still empty
		$(this).blur( function(){
				if($(this).val() == ""){
					$(this).parents('.form-item').find('label').show();
					$(this).parents('.form-item').find('label').animate({'opacity': 1.0}, 300);
				}
				else{
					$(this).parents('.form-item').find('label').hide();
				}
					
		});
		$(this).keypress( function(){
			$(this).parents('.form-item').find('label').hide();
		});
	
	});
	
	/* If the Window Resizes, Do some Stuff!! */
	jQuery( window ).resize(function() {
		
		var width = getScreenWidth();
		setNavHeight();
		if(width>979){
			$('nav ul ul').removeAttr('style');
		}
		
		//Convert tabs to Accordian if too small!!
		if(width<600 && $('.tab-accordion').hasClass('tab-wrap')){
			changeToAccordian($('.tab-accordion'));	
		} else if(width>599 && $('.tab-accordion').hasClass('accordion-wrap')){
			changeToTab($('.tab-accordion'));
		} else {
			$( ".tab-wrap" ).tabs( "refresh" );
			$( ".accordion-wrap" ).accordion( "refresh" );
			
		}
	});
	
	// Function to submit the Get Updates Form in Sidebar
	// Submit the Pardot form via AJAX
		jQuery('#signup').on('click', function(e){
			e.preventDefault();
			var email = jQuery('#email').val();
			//Only Submit if it appears like a valid email
			if(checkField(jQuery('#email')) != 1){
				//Show ajax loader
				jQuery(this).parents('.widget').addClass('active');;
				// Send to iContact
				jQuery.post(ajaxurl, { action: 'addSubscription',email: email }, function( data ) {
					data = jQuery.parseJSON(data);
					var display = jQuery('#signupMessage');
					
					if(data.result == 'fail'){;
						display.addClass('error');
					} else {
						display.removeClass('error');
					}
					//Hide the spinner
					jQuery('.widget.sidebar-form').removeClass('active');
					// Update the HTML with a messsage
					display.html(data.copy).show();

				}); 

			} else {
				//Display error message
				jQuery('#signupMessage').addClass('error').html('Sorry, thats not a valid email address.').show();
			}

		});
	
});

/** Change jQuery UI Tab mark up to Accordian Markup and 
    iniate accordian method
	
	@parameter - div - the jQuery object
**/

function changeToAccordian(div){

		// Create new markup
		var a = jQuery('<div class="accordion-wrap tab-accordion">');
		var b = new Array();
		div.find('>ul>li').each(function(){
			b.push('<h3>'+$(this).html()+'</h3>');
		});
		var c = new Array();
		div.find('>div').each(function(){
			c.push('<div>'+$(this).html()+'</div>');
		});
		for(var i = 0; i < b.length; i++){
			a.append(b[i]).append(c[i]);
		}
		//Add new mark up, remove OLD!
		div.before(a);
		div.remove();
		
		jQuery('.accordion-wrap').accordion({
			active: false,
			collapsible: true,
			animate: true,
		});
}

/** Change jQuery UI Tab mark up to Tab Markup and 
    iniate tab method
	
	@parameter - div - the jQuery object
**/

function changeToTab(div){
	
		//Create new markup
		var a = $('<div class="tab-wrap vertical-tabs tab-accordion clear">');
		var count = 0;
		var b = $('<ul class="left">');
		div.find('>h3').each(function(){
			count++;
			b.append('<li>'+$(this).html()+'</li>');
		});
		var count = 0;
		var c = $('');
		div.find('>div').each(function(){
			count++;
			c=c.add('<div class="tab left" id="'+count+'">'+$(this).html()+'</div>');
		});
		
		// Add new markup and remove old!!
		a.append(b).append(c);
		div.before(a);
		div.remove();
		
		//Initiate Tabs
		jQuery('.tab-accordion').tabs({
			create: function(){
				//Refresh Tabs!
				$( ".tab-wrap" ).tabs( "refresh" );
				
			}
			
		});
		
}

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

function checkField(el){
		var error = 0;
		var emailcheck = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; // Variable for email format
		var value = el.val();
		var req = el.attr('data-req');
		var type = jQuery('input[name="type"]').val();
		if(value.length < 1){
			error = 1;
		}
		
		// If email field, check for valid email format
		if(el.is('.email')){
			if(!emailcheck.test(value)){
				error = 1;
			}
		}
		
		// If its a Radio Field with multi options, make sure ONE of
		// the options is selected.
		if(req = 'multi'){
			jQuery('.form-item.'+type).each( function(){
				if(jQuery(this).find('input').val().length < 1){
					//jQuery(this).addClass('error');
					//error = 1;
				} else {
					//jQuery(this).removeClass('error');
				}
			});
		}
		
		
		
		if(error == 1){
			el.parent('.form-item').removeClass('success').addClass('error');
		} else {
			el.parent('.form-item').removeClass('error').addClass('success');
		}
		
		return error;
}
/*** Javascript Cookies Functions ****/
// Function to set a Cookie
function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	var domain = location.host;
	domain = domain.replace(/^www\./, "");
	document.cookie=c_name + "=" + c_value+"; path=/; domain=."+domain;
}

// Function to Retrieve a Cookie
function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
	x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name)
		{
			return unescape(y);
		}
	}
} 

function eraseCookie(name) {
	setCookie(name,"",-1);
}