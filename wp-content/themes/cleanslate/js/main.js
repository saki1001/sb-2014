jQuery(function($) {
    
    $(document).ready(function(){
        
        // Slideshow
        $('#gallery-home').slidesjs({
          width: 1200,
          height: 900,
          navigation: {
            effect: "fade"
          },
          pagination: {
            effect: "fade"
          },
          effect: {
            fade: {
              speed: 400
            }
          }
        });
    });
    
}); // End jQuery