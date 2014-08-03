jQuery(function($) {
      
      // Keep a mapping of url-to-container for caching purposes.
      var cache = {
        // If url is '' (no fragment), display this div's content.
        '': $('.bbq-default')
      };
      
      // Bind an event to window.onhashchange that, when the history state changes,
      // gets the url from the hash and displays either our cached content or fetches
      // new content to be displayed.
      $(window).bind( 'hashchange', function(e) {
          // console.log(cache);
        // Get the hash (fragment) as a string, with any leading # removed. Note that
        // in jQuery 1.4, you should use e.fragment instead of $.param.fragment().
        var url = $.param.fragment();
        
        // Remove .bbq-current class from any previously "current" link(s).
        $( 'a.bbq-current' ).removeClass( 'bbq-current' );
        
        // Hide any visible ajax content.
        $( '.bbq-content' ).children( ':visible' ).hide();
        
        // Add .bbq-current class to "current" nav link(s), only if url isn't empty.
        url && $( 'a[href="#' + url + '"]' ).addClass( 'bbq-current' );
        
        if ( cache[ url ] ) {
          // Since the element is already in the cache, it doesn't need to be
          // created, so instead of creating it again, let's just show it!
          cache[ url ].show();
      
        } else {
          // Show "loading" content while AJAX content loads.
          $( '.bbq-loading' ).show();
          
          var postID = $('.bbq-current').attr('data-id');
          
          // Create container for this url's content and store a reference to it in
          // the cache.
          cache[ url ] = $( '<div class="bbq-item"/>' )
        
            // Append the content container to the parent container.
            .appendTo( '.bbq-content' )
        
            // Load external content via AJAX. Note that in order to keep this
            // example streamlined, only the content in .infobox is shown. You'll
            // want to change this based on your needs.
            
            .load( templateDirectoryUrl + '/php/load-project.php', { post_id: postID }, function(){
              // Content loaded, hide "loading" content.
              $( '.bbq-loading' ).hide();
              
              // Unbind former ones
              // $(this).find('.media-toggle a').unbind( 'click', toggleMediaDisplay );
              
              // Rebind all + new ones
              $(this).find('.media-toggle a').bind( 'click', toggleMediaDisplay );
              
              var videoID = '#' + $(this).find('.video').attr('id');
              var galleryID = '#' + $(this).find('.photos').attr('id');
              
              // FitVid.js
              $(videoID).fitVids().hide();
              
              $(this).find('.photos').cycle();
              $(this).find('.photos').customSlideActions('bind');
              
              $(this).find('article').slideDown();
            });
        }
      })
  
      // Since the event is only triggered when the hash changes, we need to trigger
      // the event now, to handle the hash the page may have loaded with.
      $(window).trigger( 'hashchange' );
      
      var toggleMediaDisplay = function (e) {
          e.preventDefault();
          
          var currentContainer = $(this).parentsUntil('.bbq-item').find('.media');
          var currentDisplay = currentContainer.attr('data-toggle-state');
          var currentAction = $(this).attr('data-toggle-value');
          
          if( currentAction === 'show-video' && currentDisplay != 'video' ) {
              $(this).siblings('a').removeClass('active');
              $(this).addClass('active');
              
              currentContainer.attr('data-toggle-state', 'video');
              currentContainer.find('.active-display').hide().removeClass('active-display');
              currentContainer.find('.video').addClass('active-display').show();
              
          } else if ( currentAction === 'show-photos' && currentDisplay != 'photos' ) {
              $(this).siblings('a').removeClass('active');
              $(this).addClass('active');
              
              currentContainer.attr('data-toggle-state', 'photos');
              currentContainer.find('.active-display').hide().removeClass('active-display');
              currentContainer.find('.photos').addClass('active-display').show();
          }
          
          return false;
      };
      
  
}); // End jQuery