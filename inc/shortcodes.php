<?php
global $opt_settings;
$GLOBALS['opt_settings'] = $opt_settings;

/**
* Company Name
*/
function company_name() {
  return $GLOBALS['opt_settings']['opt-company-name'];
}

/**
* Email Address
*/
function email_address() {
  return $GLOBALS['opt_settings']['opt-email'];
}

/**
 * Phone Number
 */
function phone_number() {
 return $GLOBALS['opt_settings']['opt-phone'];
}


/**
* Location Address
*/
function location_address() {
  return wpautop($GLOBALS['opt_settings']['opt-address']);
}

/**
* Location Address
*/
function contact_menu_list() {
  return $GLOBALS['opt_settings']['opt-menu-list'];
}


/**
* Copyright Text
*/
function copyright_text() {
  $copyright_text = $GLOBALS['opt_settings']['opt-copyright-text'];
  if (strpos($copyright_text, '[current-year]') !== false) {
    $copyright_text = str_replace('[current-year]', date('Y'), $copyright_text );
  }
  return '<p class="copyright-text">'.$copyright_text.'</p>';
}

/**
* Developer Signature
*/
function developer_signature() {
  if( is_front_page() ) {
      return '<p class="developer-signature">'.$GLOBALS['opt_settings']['opt-developer-signature'].'</p>';
  }
}

/**
* Banner Image
*/
function banner_image() {
  ob_start();
  get_template_part( 'inc/shortcode-template/shortcode', 'bannerimage' );
  return ob_get_clean();
}

/**
* Booking Widget
*/
function booking_widget() {
  ob_start();
  get_template_part( 'inc/shortcode-template/shortcode', 'booking-widget' );
  return ob_get_clean();
}
function booking_header() {
  ob_start();
  get_template_part( 'inc/shortcode-template/shortcode', 'booking-header' );
  return ob_get_clean();
}

/**
* Related Post
*/
function relatedPost_carousel($atts) {
  ob_start();
  require get_template_directory() . '/inc/shortcode-template/shortcode-related.php';
  return ob_get_clean();
}

/**
* special
*/
function SpecialOffer_content($atts) {
  ob_start();
  require get_template_directory() . '/inc/shortcode-template/shortcode-special-offer.php';
  return ob_get_clean();
}

/**
* special
*/
function roomshortcode_content($atts) {
  ob_start();
  require get_template_directory() . '/inc/shortcode-template/shortcode-listroom.php';
  return ob_get_clean();
}

/**
* special
*/
function location_content($atts) {
  ob_start();
  require get_template_directory() . '/inc/shortcode-template/shortcode-location.php';
  return ob_get_clean();
}
function social_media_shortcode(){
  ob_start();
  echo '<ul class="social-media-icon">';
  if($GLOBALS['opt_settings']['opt-enable-facebook'] == true &&  $GLOBALS['opt_settings']['opt-facebook-url'] !== ''){
    echo '<li class="facebook-icon"><a href="'.$GLOBALS['opt_settings']['opt-facebook-url'].'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
  }
  if($GLOBALS['opt_settings']['opt-enable-twitter'] == true &&  $GLOBALS['opt_settings']['opt-twitter-url'] !== ''){
    echo '<li class="twitter-icon"><a href="'.$GLOBALS['opt_settings']['opt-twitter-url'].'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
  }
  if($GLOBALS['opt_settings']['opt-enable-google-plus'] == true &&  $GLOBALS['opt_settings']['opt-google-plus-url'] !== ''){
    echo '<li class="google-plus-icon"><a href="'.$GLOBALS['opt_settings']['opt-google-plus-url'].'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
  }
  if($GLOBALS['opt_settings']['opt-enable-instagram'] == true &&  $GLOBALS['opt_settings']['opt-instagram-url'] !== ''){
    echo '<li class="instagram-icon"><a href="'.$GLOBALS['opt_settings']['opt-instagram-url'].'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
  }
  if($GLOBALS['opt_settings']['opt-enable-youtube'] == true &&  $GLOBALS['opt_settings']['opt-youtube-url'] !== ''){
    echo '<li class="youtube-icon"><a href="'.$GLOBALS['opt_settings']['opt-youtube-url'].'" target="_blank"><i class="fa fa-youtube"></i></a></li>';
  }
  if($GLOBALS['opt_settings']['opt-enable-linkedin'] == true &&  $GLOBALS['opt_settings']['opt-linkedin-url'] !== ''){
    echo '<li class="linkedin-icon"><a href="'.$GLOBALS['opt_settings']['opt-linkedin-url'].'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
  }
  if($GLOBALS['opt_settings']['opt-enable-pinterest'] == true &&  $GLOBALS['opt_settings']['opt-pinterest-url'] !== ''){
    echo '<li class="pinterest-icon"><a href="'.$GLOBALS['opt_settings']['opt-pinterest-url'].'" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
  }
  echo '</ul>';

  return ob_get_clean();
}
add_shortcode('social-media-icon', 'social_media_shortcode');

add_shortcode('ize-location', 'location_content');
add_shortcode('room-content', 'roomshortcode_content');
add_shortcode('special-offer-content', 'SpecialOffer_content');
add_shortcode('related', 'relatedPost_carousel');
add_shortcode('booking-widget', 'booking_widget');
add_shortcode('booking-header', 'booking_header');
add_shortcode('banner-image', 'banner_image');
add_shortcode('copyright-text', 'copyright_text');
add_shortcode('developer-signature', 'developer_signature');
add_shortcode('location-address', 'location_address');
add_shortcode('phone-number', 'phone_number');
add_shortcode('company-name', 'company_name');
add_shortcode('email-address', 'email_address');
add_shortcode('contact-menu-list', 'contact_menu_list');
