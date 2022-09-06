(function($) {

$(document).ready(function() {
  match_height();
  lazy_load_images();
  navbar_fixed_scroll();
  close_popup_overlay();
  fullscreen_search_form();
});

var js_plugins = JSON.parse( $('#js-plugins').val() );

/**
* Popup Overlay Template
*/
function popup_overlay_template( __content ) {
  __content = __content || '';
  var popup_template = '<div id="popup-overlay"><a href="#" class="popup-close"><i class="dashicons dashicons-no-alt"></i></a><div class="content-wrapper absolute-center">'+ __content +'</div></div>';
  return popup_template;
}

/**
* Close Popup Overlay
*/
function close_popup_overlay() {
  $('body').on('click', '#popup-overlay .popup-close', function(e) {
    $('#popup-overlay').fadeOut('fast', function() {
      $(this).remove();
    });
  });
}

/**
* Jquery Match Height
*/
function match_height() {
  if( js_plugins.match_height == '1' && $('#match-height-selector').length > 0 ) {
    $('.nav-same-height').matchHeight();
    var selector = $('#match-height-selector').val();
    $.each( JSON.parse(selector) , function(i, val) {
      $(val).matchHeight();
    });
  }
}

/**
 * Lazy Load
 */
function lazy_load_images() {
  if(js_plugins.lazy_load == '1') {
    $('.lazy').lazy({
      effect: 'fadeIn',
      effectTime: 300,
      threshold: 0
    });
  }
}

/**
* Hide navbar when scroll down, show when scroll top and if reached bottom of the page
*/
function navbar_fixed_scroll() {
   var position = $(window).scrollTop();
   var navbar = $('header');

   $(window).scroll(function () {
       var scroll = $(window).scrollTop();

       if( scroll + $(window).height() == $(document).height() || scroll < position ) {
         navbar.removeClass('scroll-top');
       } else {
         navbar.addClass('scroll-top');
       }

       position = scroll;
   });
}

/**
* Fullscreen Search Form
*/
function fullscreen_search_form() {
  $('.fullscreen-search-button').click(function(e) {
    e.preventDefault();
    var search_form_template = '<form class="search-form"><input type="text" placeholder="Type here & hit enter..."></form>';
    $( popup_overlay_template(search_form_template) ).hide().prependTo('body').fadeIn('fast');
    $('#popup-overlay').find('input[type="text"]').val('');
    $('#popup-overlay').find('input[type="text"]').focus();
  });
}

})( jQuery );
