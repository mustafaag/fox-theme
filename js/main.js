(function($) {
"use strict";
var WITHEMES = WITHEMES || {};

/* Functions
--------------------------------------------------------------------------------------------- */
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};
    
/* Fitvids
--------------------------------------------------------------------------------------------- */
WITHEMES.fitvids = function(){
	if ( $().fitVids ) {
		$(document,'.media-container').fitVids();
	}
}; // fitvids
    
/* Tab
--------------------------------------------------------------------------------------------- */
WITHEMES.tab = function(){
	$('#authorbox').each(function(){
		var tab = $(this);		
		$(this).find('.authorbox-nav').find('a').click(function(){
			tab.find('.authorbox-nav').find('li').removeClass('active');
			$(this).parent().addClass('active');
			var currentTab = $(this).data('href');
			tab.find('.authorbox-tab').removeClass('active');
			tab.find(currentTab).addClass('active');
			return false;
		});	// click
						 });	// each
};	// tab    

/* Flexslider
--------------------------------------------------------------------------------------------- */
WITHEMES.flexslider = function(){
	if ( $().flexslider ) {
       
		$('.wi-flexslider').each(function(){
			var $this = $(this);
			var easing = ( $this.data('effect') == 'slide' ) ? 'easeInOutExpo' : 'swing';
			$this.find('.flexslider').flexslider({
				animation		:	$this.data('effect'),
				pauseOnHover	:	true,
				useCSS			:	false,
				easing			:	easing,
				animationSpeed	:	500,
				slideshowSpeed	:	5000,
				controlNav		:	$this.data('pager') === true ? true : false,
				directionNav	:	true,
				slideshow		:	false,
				smoothHeight	:	false,
                start            :   function(slider){
                    $this.addClass('loaded');
                    WITHEMES.masonry();
                }
								 });	// flexslider
										});	// each
        
				
	}	// if flexslider
    
}; // flexslider

/* Mobile menu
--------------------------------------------------------------------------------------------- */
WITHEMES.mobile_menu = function(){
    
    // add indicator
    $('#wi-mainnav .menu > ul li.menu-item-has-children > a').append('<u class="indicator"><i class="fa fa-chevron-down"></i></u>');
	
    // toggle menu click
	$('.toggle-menu').on('click',function(){
		$('#wi-mainnav').slideToggle('fast','easeOutExpo');
										  });
    
    // document click
    $(document).on('click',function(e){
        if (matchMedia('(max-width: 979px)').matches) { // desktop size
            var target = e.target;
            if (!$(target).is('#toggle-menu') && ($(target).closest('#toggle-menu').length == 0) && ($(target).closest('#wi-mainnav').length == 0) ) {
                $('#wi-mainnav').slideUp('fast','easeOutExpo');
            }
        }
    }); // click
	
    // indicator click
	$('#wi-mainnav .menu > ul > li a .indicator').on('click',function(e){
		var $this = $(this);
		e.preventDefault();
		$this.parent().next().slideToggle('normal','easeOutExpo');
		return false;
																   });
    
    // resize, menu close, open
    $(window).resize(function(){
        if (matchMedia('(min-width: 981px)').matches) { // desktop size
            $('#wi-mainnav').css('display','');
            $('#wi-mainnav ul.menu ul').css('display','');
        } else {
            //$('#wi-mainnav').css('display','');
            //$('#wi-mainnav ul.menu ul').css('display','');
        }
    });
	
}

/* Masonry
--------------------------------------------------------------------------------------------- */
WITHEMES.masonry = function(){
	
    if ($().masonry) {
    
        // blog masonry
        $('.blog-masonry, .blog-newspaper').each(function(){
            var $this = $(this);
            var args = {
                "itemSelector": ".post-masonry, .post-newspaper",
                "percentPosition": true,
                "columnWidth": ".grid-sizer",
            }
            
            $this.imagesLoaded(function(){
                $this.masonry(args);
                $this.addClass('loaded');
                
                $this.find('.post-masonry, .post-newspaper').each(function(){
                    var this_post = $(this);
                    this_post.bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
                    if (isInView) {
                        this_post.addClass('inview');
                    } // inview						  
										  });// bind
                }); // each
                
            }); // imagesLoaded
            
            $(window).resize(function(){
                // it seems stupid but it works!!! it fucking works
                $this.masonry('destroy');
                $this.masonry(args);
            });
            
            setTimeout(function(){$this.addClass('loaded');},6000); // show after 6s anyway
       
        }); // each
        
        // sidebar
        var widget_area = $('#secondary .widget-area');
        
        if (matchMedia('(max-width: 979px) and (min-width: 768px)').matches) {
            
            widget_area.imagesLoaded(function(){
            widget_area.masonry({
                    'gutter'        :   '.gutter-sidebar',
                    'itemSelector'  :   '.widget',
                });
            }); // imagesloaded
            
        } else {
            
            if (widget_area.masonry) {
                widget_area.masonry();
                widget_area.masonry('destroy');
            }
            
        }
        
    
    }
	
}

/* back to top
--------------------------------------------------------------------------------------------- */
WITHEMES.backtotop = function(){
    
    $(window).scroll(function(){
        if ($(this).scrollTop() > 200) {
            $('.backtotop').addClass('shown');
        } else {
            $('.backtotop').removeClass('shown');
        }
    }); 
	
	$('.backtotop').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600 , 'easeOutExpo');
		return false;
	});
    
    $(document).click(function(e){
        
        var target = $(e.target);
        if (
            (target.is('#wi-topbar') || (target.closest('#wi-topbar').length > 0)) && 
            !target.is('#wi-mainnav') &&
            (target.closest('#wi-mainnav').length == 0) && 
            !target.is('#toggle-menu') &&
            (target.closest('#toggle-menu').length == 0) && 
            !target.is('#header-social') && 
            (target.closest('#header-social').length == 0)
           ) {
        
            $("html, body").animate({ scrollTop: 0 }, 600 , 'easeOutExpo');
            return false;
        }
	});
	
}

/* social share
--------------------------------------------------------------------------------------------- */
WITHEMES.social_share = function(){
	
    var Config = {
        Link: "a.share",
        Width: 500,
        Height: 500
    };
 
    $(Config.Link).click(function(e){
 
        e = (e ? e : window.event);
        var t = $(this);
 
        // popup position
        var
            px = Math.floor(((screen.availWidth || 1024) - Config.Width) / 2),
            py = Math.floor(((screen.availHeight || 700) - Config.Height) / 2);
 
        // open popup
		if(t.data('href')) {
			var popup = window.open(t.attr('data-href'), "social", 
				"width="+Config.Width+",height="+Config.Height+
				",left="+px+",top="+py+
				",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
			if (popup) {
				popup.focus();
				if (e.preventDefault) e.preventDefault();
				e.returnValue = false;
			}
	 
			return !!popup;
		}
    }); // click

}

/* Header Sticky
--------------------------------------------------------------------------------------------- */
WITHEMES.header_sticky = function(){
    
    function run_sticky() {
        
        var ele = $('#wi-topbar');
        var header_height = ele.outerHeight();
        var from_top = $(window).scrollTop();
        var adminbar_height = $('#wpadminbar').outerHeight();

        if ( from_top >= (adminbar_height + header_height + 100)) {
            ele.addClass('is-sticky');
        } else {
            ele.removeClass('is-sticky');	
        }
    }
    
    function sticky() {
        
        var ele = $('#wi-topbar');
        
        var header_height = ele.outerHeight();
        ele.parent().css({height:header_height + 'px'});
        
        run_sticky();

        $(window).on('scroll',function(){									   
            run_sticky();
        }); // on scroll

    }
    
    $(window).load(sticky);
    $(window).resize(sticky);
        
} 

/* Slick
--------------------------------------------------------------------------------------------- */
WITHEMES.slick = function(){
	if ( $().slick ) {
       
		$('.wi-slick').each(function(){
			var $this = $(this);
			$this.slick({
                slidesToShow: 1,
                variableWidth: true,
                slide   : '.slick-item',
				infinite: false,
                initialSlide :  0,
                speed       :   300,
                dots        :   false,
                arrows      :   true,
                nextArrow   :   '<button type="button" class="slick-next slick-nav"><i class="fa fa-chevron-right"></i></button>',
                prevArrow   :   '<button type="button" class="slick-prev slick-nav"><i class="fa fa-chevron-left"></i></button>',
                swipeToSlide : false,
                touchMove : false
								 });	// slick
            
            $this.on('setPosition', function(event, slick, direction){
                $this.addClass('loaded');
            });
            
										});	// each
        
				
	}	// if slick
    
}; // slick
  
/* Colorbox
--------------------------------------------------------------------------------------------- */    
WITHEMES.colorbox = function(){    
    if ( $().colorbox ) {
        $('.wi-colorbox').colorbox({
            transition	:	'elastic',
            speed		:	350,
            maxWidth	:	'95%',
            maxHeight	:	'95%',
            scalePhotos :   true,
            returnFocus :   false,
            current     :   "Image {current} of {total}"
                                  });
        
        $('.gallery').each(function(index){
            var id = (	$(this).attr('id')	) ? $(this).attr('id') : 'gallery-' + index;
            $(this).
            find('.gallery-item').
            find('a[href$=".gif"], a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".bmp"]').
            has('img').
            colorbox({
                transition	:	'none',
                speed		:	100,
                maxWidth	:	'90%',
                maxHeight	:	'90%',
                rel			:	id,
                                  });
                                    });	// each
	}	// colorbox
}

/* Animation
--------------------------------------------------------------------------------------------- */    
WITHEMES.animation = function(){    
    
    // related posts
    $('.blog-related, .related-list, #posts-small, .newspaper-related').each(function(){
        var $this = $(this);
        $this.bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if (isInView) {
            $this.addClass('inview');
        } // inview
                              });// bind
    }); // each

}

/* Retina
--------------------------------------------------------------------------------------------- */    
WITHEMES.retina = function(){
    if ($().retina) {
        $('img').retina({
            // Check for data-retina attribute. If exists, swap out image
             dataRetina: true,
             // Suffix to append to image file name
             suffix: "",
             // Check if image exists before swapping out
             checkIfImageExists: false,
             // Callback function if custom logic needs to be applied to image file name
             customFileNameCallback: "",
             // override window.devicePixelRatio
             overridePixelRation: false
        });
    }
}

/* Header search
--------------------------------------------------------------------------------------------- */    
WITHEMES.header_search = function(){
    
    $('.li-search').click(function(){
        $('#header-search').slideToggle('fast','easeOutExpo').find('.s').focus();
    });
    
    $(document).on('click',function(e){
		var currentTarget = $(e.target);
		if( !currentTarget.is('#header-search') && 
           !currentTarget.is('.li-search') && 
            currentTarget.closest("#header-search").length == 0 && 
            currentTarget.closest(".li-search").length == 0 
          ) {
			$('#header-search').hide('fast','easeOutExpo');
		}
    }); // on click
    
}

/* Init functions
--------------------------------------------------------------------------------------------- */
$(document).ready(function() {
    WITHEMES.header_sticky();
    WITHEMES.fitvids();
	WITHEMES.flexslider();
    WITHEMES.slick();
    WITHEMES.colorbox();
    WITHEMES.masonry();
	WITHEMES.mobile_menu();
    WITHEMES.backtotop();
    WITHEMES.social_share();
    WITHEMES.tab();
    WITHEMES.retina();
    WITHEMES.header_search();
    
    WITHEMES.animation();
    
    $(window).resize(WITHEMES.masonry);
    
						   });
})(jQuery);	// EOF