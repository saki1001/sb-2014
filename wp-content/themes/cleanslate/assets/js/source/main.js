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
        $('.photos').cycle();
        $('.photos').customSlideActions('bind');
        
        // Columns for Films Page
        if( $('body').hasClass('page-id-18') ) {
          
          var index = 1;
          $('body.page-id-18 .projects .project').each( function() {
            if( index % 5 === 0 && index != 1 ) {
              $(this).addClass('last');
            }
            
            index++;
          });
        }
        
        // Columns for Commercials Page
        if( $('body').hasClass('page-id-20') ) {
          
          var index = 1;
          $('body.page-id-20 .projects .project').each( function() {
            if( index % 4 === 0 && index != 1 ) {
              $(this).addClass('last');
            }
            
            index++;
          });
        }
        
        if( $('body').hasClass('single') ) {
          // $('.photos').cycle();
          // $('.photos').customSlideActions('bind');
          //
          // $('.video').fitVids();
          //
          // // Set toggles
          // if( $('.photos').length > 0 && $('.video').length === 0 ) {
          //   $('.photos').addClass('active-display');
          //   $('#media').attr('data-toggle-state','photos');
          //   $('.media-toggle .toggle-photos').addClass('active');
          // } else {
          //   $('.video').addClass('active-display');
          //   $('#media').attr('data-toggle-state','video');
          //   $('.media-toggle .toggle-video').addClass('active');
          // }
          
          // var toggleMediaDisplay = function (e) {
          //     e.preventDefault();
          //
          //     var currentContainer = $(this).parentsUntil('.bbq-item').find('.media');
          //     var currentDisplay = currentContainer.attr('data-toggle-state');
          //     var currentAction = $(this).attr('data-toggle-value');
          //
          //     if( currentAction === 'show-video' && currentDisplay != 'video' ) {
          //         $(this).siblings('a').removeClass('active');
          //         $(this).addClass('active');
          //
          //         currentContainer.attr('data-toggle-state', 'video');
          //         currentContainer.find('.active-display').hide().removeClass('active-display');
          //         currentContainer.find('.video').addClass('active-display').show();
          //
          //     } else if ( currentAction === 'show-photos' && currentDisplay != 'photos' ) {
          //         $(this).siblings('a').removeClass('active');
          //         $(this).addClass('active');
          //
          //         currentContainer.attr('data-toggle-state', 'photos');
          //         currentContainer.find('.active-display').hide().removeClass('active-display');
          //         currentContainer.find('.photos').addClass('active-display').show();
          //     }
          //
          //     return false;
          // };
          // $(this).find('.media-toggle a').bind( 'click', toggleMediaDisplay );
        }
    });
    
}); // End jQuery