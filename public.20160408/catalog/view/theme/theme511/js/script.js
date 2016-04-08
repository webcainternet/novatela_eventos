jQuery(document).ready(function(){
/**************swipe menu***************/
jQuery('#page').click(function(){
	if(jQuery(this).parents('body').hasClass('ind')){
		jQuery(this).parents('body').removeClass('ind');
		return false
	}
	})
	jQuery('.swipe-control').click(function(){
		if(jQuery(this).parents('body').hasClass('ind')){
		jQuery(this).parents('body').removeClass('ind');
		return false
	}
	else{
		jQuery(this).parents('body').addClass('ind');
		return false
	}
})
/****************BACK TO TOP*********************/
var IE='\v'=='v';
	// hide #back-top first
	jQuery("#back-top").hide();
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (!IE) {
				if (jQuery(this).scrollTop() > 100) {
					jQuery('#back-top').fadeIn();
				} else {
					jQuery('#back-top').fadeOut();
				}
			}
			else {
				if (jQuery(this).scrollTop() > 100) {
					jQuery('#back-top').show();
				} else {
					jQuery('#back-top').hide();
				}	
			}
		});

		// scroll body to 0px on click
		jQuery('#back-top a').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
/************************************************************************************************shadow height*****************************************************************************************************/
var sect = 1;
$(document).ready(function() {
	$('.swipe').height($(window).height()-50);

	$(window).resize(function() {
		$('.swipe').height($(window).height()-50);
	});

	var sects = $('.swipe').size();

});
/**************lazy load***************/
jQuery("img.lazy").unveil(1, function(){
	jQuery(this).load(function() {
		jQuery(this).animate({'opacity':1}, 700);
	});
});

/************product gallery on product page***********/
$("#gallery_zoom").elevateZoom({gallery:'image-additional', cursor: 'pointer',zoomType : 'inner', galleryActiveClass: 'active', imageCrossfade: true}); 
//pass the images to Fancybox
$("#gallery_zoom").bind("click", function(e) {  
  var ez =   $('#gallery_zoom').data('elevateZoom');	
	$.fancybox(ez.getGalleryList());
  return false;
});
$('#image-additional').bxSlider({
	mode:'vertical',
	pager:false,
	controls:true,
	slideMargin:13,
	minSlides: 6,
	maxSlides: 6,
	slideWidth:88,
	nextText: '<i class="fa fa-chevron-down"></i>',
	prevText: '<i class="fa fa-chevron-up"></i>',
	infiniteLoop:false,
	adaptiveHeight:true,
	moveSlides:1
});
$('#gallery').bxSlider({
	pager:false,
	controls:true,
	minSlides: 1,
	maxSlides: 1,
	infiniteLoop:false,
	moveSlides:1
});

/**********************************************************add icon aside li *****************************************************************************/	
	$(function(){
		$('aside .box-category .menu > li >a').each(function(){
		var title = $(this).html();
		$(this).addClass('custom_hover');
		$(this).html('<i class="fa fa-angle-right "></i><p>'+title+'</p>');
		})
		$('.box_html .tx-title').each(function(){
		var title = $(this).html();
		$(this).addClass('custom_hover');
		$(this).html('<span>'+title+'</span><span class="out">'+title+'</span><span class="over">'+title+'</span>');
		})
	});	
	
	$(document).ready(function(){
		$('column').find('.box-category .menu  li li a').prepend('<i class="fa fa-angle-right "></i>');
		$('#content').find('ul.list-unstyled li a').prepend('<i class="fa fa-angle-right "></i>');
		$('.site-map-page #content ul').find('li a').prepend('<i class="fa fa-angle-right "></i>');
		$('.manufacturer-content ').find(' div>a').prepend('<i class="fa fa-angle-right "></i>');
		$('#tm_menu div > ul > li > ul  ').find(' li>a').prepend('<i class="fa fa-angle-right"></i>');
		$('.box.info .box-content ul li  ').find('a').prepend('<i class="fa fa-angle-right"></i>');
	});
	
/******************* category name height**************************/
(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
$(window).load(function(){
	if($("#content .product-grid .name").length){
	$("#content .product-grid .name").equalHeights()}
});
/**************related name height ******************/
(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
$(window).load(function(){
	if($(".maxheight-r").length){
	$(".maxheight-r").equalHeights()}
});
/******************************************************/
(function($){ //create closure so we can safely use $ as alias for jQuery
	  $(document).ready(function(){
		var exampleOptions = {
			delay:       1000,                            // one second delay on mouseout
			animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
			speed:       'fast',                          // faster animation speed
			autoArrows:  true
		}
		// initialise plugin
		var example = $('#tm_menu').superfish(exampleOptions);
	  });

	})(jQuery); 
/***********CATEGORY DROP DOWN****************/
jQuery("#menu-icon").on("click", function(){
  jQuery("#menu-gadget .menu").slideToggle();
  jQuery(this).toggleClass("active");
 });

  jQuery('#menu-gadget .menu').find('li>ul').before('<i class="fa fa-angle-down"></i>');
  jQuery('#menu-gadget .menu li i').on("click", function(){
   if (jQuery(this).hasClass('fa-angle-up')) { jQuery(this).removeClass('fa-angle-up').parent('li').find('> ul').slideToggle(); } 
	else {
	 jQuery(this).addClass('fa-angle-up').parent('li').find('> ul').slideToggle();
	}
  });
/***********column dropdown box*******************/
  if ($('body').width() < 768) {
		leftColumn = $('body').find('#column-left');
		leftColumn.remove().insertAfter('#content');
	  jQuery("img.lazy").unveil(1, function(){
			jQuery(this).load(function() {
				jQuery(this).animate({'opacity':1}, 700);
			});
		});
		jQuery('.col-sm-3 .box-heading h3').append('<i class="fa fa-plus-circle"></i>');
		jQuery('.col-sm-3 .box-heading').on("click", function(){
		if (jQuery(this).find('i').hasClass('fa-minus-circle')) { jQuery(this).find('i').removeClass('fa-minus-circle').parents('.col-sm-3 .box').find('.box-content').slideToggle(); }
		else {
			jQuery(this).find('i').addClass('fa-minus-circle').parents('.col-sm-3 .box').find('.box-content').slideToggle();
		}
		})
	};
/************************* RELATED PRODUCTS************************************/
$('.related-slider').bxSlider({
	pager:false,
	controls:true,
	slideMargin:30,
	minSlides: 1,
	maxSlides: 5,
	slideWidth: 223,
	infiniteLoop:true,
	moveSlides:1
});

/*********product tabs**********/
if ($('body').width() < 768) {
	jQuery('.tab-heading').append('<i class="fa fa-plus-circle"></i>');
	jQuery('.tab-heading').on("click", function(){
	if (jQuery(this).find('i').hasClass('fa-minus-circle')) { jQuery(this).find('i').removeClass('fa-minus-circle').parents('.tabs').find('.tab-content').slideToggle(); }
		else {
		jQuery(this).find('i').addClass('fa-minus-circle').parents('.tabs').find('.tab-content').slideToggle();
	}
	})
	};


});



var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);

/***********************************/
if(!isMobile) {
	
/***********************Green Sock*******************************/

$(document).ready(function(){
	var stickMenu = false;
	var docWidth= $('body').find('.container').width();
	
	
	if(!isMobile) {
	// init controller
	controller = new ScrollMagic();
	
	// assign handler "scene" and add it to Controller
	fadein_left = jQuery('.banners > div:nth-child(1)');
	fadein_right = jQuery('.banners > div:nth-child(2)');
	fadein_left1 = jQuery('.banners > div:nth-child(3)');
	fadein_right1 = jQuery('.banners > div:nth-child(4)');
	fadein_left2 = jQuery('.banners > div:nth-child(5)');
	fadein_right2 = jQuery('.banners > div:nth-child(6)');
	
	left_animate = TweenMax.from(fadein_left, 0.5, {left:"-200px", alpha: 0, ease:Power1.easeOut});
	right_animate = TweenMax.from(fadein_right, 0.5, {right:"-200px", alpha: 0, ease:Power1.easeOut});left_animate1 = TweenMax.from(fadein_left1, 0.5, {left:"-200px", alpha: 0, ease:Power1.easeOut});
	right_animate1 = TweenMax.from(fadein_right1, 0.5, {right:"-200px", alpha: 0, ease:Power1.easeOut});left_animate2 = TweenMax.from(fadein_left2, 0.5, {left:"-200px", alpha: 0, ease:Power1.easeOut});
	right_animate2 = TweenMax.from(fadein_right2, 0.5, {right:"-200px", alpha: 0, ease:Power1.easeOut});

	  if(jQuery(".banners").length){
		  
	   var scene_1 = new ScrollScene({
		triggerElement: ".banners",
		offset: -100
		}).setTween(left_animate)
		  .addTo(controller)
		  .reverse(false);
		  
	   var scene_2 = new ScrollScene({
		triggerElement: ".banners",
		offset: -100
		}).setTween(right_animate)
		  .addTo(controller)
		  .reverse(false);
		  
		var scene_3 = new ScrollScene({
		triggerElement: ".banners",
		offset: -100
		}).setTween(left_animate1)
		  .addTo(controller)
		  .reverse(false);
		  
	   var scene_4 = new ScrollScene({
		triggerElement: ".banners",
		offset: -100
		}).setTween(right_animate1)
		  .addTo(controller)
		  .reverse(false); 
		  
		var scene_5 = new ScrollScene({
		triggerElement: ".banners",
		offset: -100
		}).setTween(left_animate2)
		  .addTo(controller)
		  .reverse(false); 
		  
	   var scene_6 = new ScrollScene({
		triggerElement: ".banners",
		offset: -100
		}).setTween(right_animate2)
		  .addTo(controller)
		  .reverse(false); 
	  };
	}
	
})

function listBlocksAnimate(block,element,row,offset,difEffect){
	if(!isMobile) {
		if(jQuery(block).length){
			  var i = 1;
			  var j = row;
			  var k = 1;
			  var effect = -1;
			  $(element).each(function() {
				  i++;				  
				  if(i>j){
					j += row;
					k = i;
					effect = effect*(-1);
				  }				  
				  if(effect == -1 && difEffect == true) {
					ef = TweenMax.from(element+':nth-child('+i+')', .5, {scale:.1*i+.5, opacity:.2*i, alpha: 0, ease:Power1.easeOut})
				  }	else{
					  ef = TweenMax.from(element+':nth-child('+i+')', .5, {scale:1-.2*i, opacity:1-.2*i, alpha: 0, ease:Power1.easeOut})					  
				  }			  
				  var scene_new = new ScrollScene({
					triggerElement: element+':nth-child('+k+')',
					offset: offset,
					}).setTween(ef)
					  .addTo(controller)
					  .reverse(false);
			});
		  }
	}
}

$(window).load(function(){
	 listBlocksAnimate('.box.featured', '.box.featured .product-layout', 6, -300, false);
});


}

