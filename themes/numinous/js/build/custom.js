jQuery(document).ready(function($) {
    var rtl, nrtl, slider_auto, slider_loop, slider_control;
    if( numinous_data.rtl == '1' ){
        rtl = true;
        nrtl = 'rtl';
    }else{
        rtl = false;
        nrtl = 'ltr';
    }
    /** Breaking News Ticker */
    $('#news-ticker').ticker({
        controls: false,        // Whether or not to show the jQuery News Ticker controls
        titleText: '',
        direction: nrtl,
    });            
            
    /** Search Form */
    $('html').click(function() {
        $('.example').hide(); 
    });

    $('.form-section').click(function(event){
        event.stopPropagation();
    });
    
    $("#search-btn").click(function(){
	   $(".example").slideToggle();
	   return false; 
    });            
            
    /** Responsive Menu */
    $('#responsive-menu-button').sidr({
      name: 'sidr-main',
      source: '#site-navigation',
      side: 'left'
    });        
            
    /** Footer Slider */
    /** Variables from Customizer for Slider settings */
    if( numinous_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( numinous_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( numinous_data.control == '1' ){
        slider_control = true;
    }else{
        slider_control = false;
    }

    if( numinous_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }
            
    $("#lightSlider").owlCarousel({
        items        : 4,
        margin : 0,
        autoplay        : false, //slider_auto,
        loop        : slider_loop,
        mouseDrag  :false,
        nav    : slider_control,
        rtl         : rtl,
        responsive : {
            0 : {
                items: 1,
            },
            // breakpoint from 480 up
            481 : {
                items: 3,
            },
            // breakpoint from 768 up
            801 : {
                items: 4,
            }
        }
    });
    
    $('.newsticker-wrapper').fadeIn('slow');            
});