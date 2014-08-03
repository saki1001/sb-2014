jQuery(function($) {
    
    $.fn.customSlideActions = function( action ) {
        
        if ( action === 'bind' ) {
            return $(this).on('hover', function () {
                var slideNav = $(this).find('.slide-nav');
                
                if( slideNav.hasClass('active') != true ) {
                    slideNav.addClass('active');
                    slideNav.fadeIn();
                } else {
                    slideNav.removeClass('active');
                    slideNav.fadeOut();
                }
            });
        }
    };
    
    $(document).ready(function(){
        
        // Slideshow
        // $('#gallery-home').slidesjs({
        //   width: 1200,
        //   height: 900,
        //   navigation: {
        //       active: false,
        //       effect: "fade"
        //   },
        //   pagination: false,
        //   effect: {
        //     fade: {
        //       speed: 400
        //     }
        //   }
        // });
        
        $('.photos').customSlideActions('bind');
        
        if( $('body').hasClass('page-id-18') ) {
          
          var index = 1;
          $('body.page-id-18 .projects .project').each( function() {
            console.log(index);
            if( index % 5 === 0 && index != 1 ) {
              $(this).addClass('last');
            }
            
            index++;
          });
        }
    });
    
}); // End jQuery