<?php
/**
 * Enqueue scripts and styles.
 */
function ize_master_theme_scripts() {
  global $opt_settings;

  /* CSS */

  if( isset($opt_settings) ) {

    if( $opt_settings['opt-enable-font-awesome'] == '1' ) {
      //Font Awesome
      wp_enqueue_style( 'font-awesome', B_URL .'/libraries/font awesome/css/font-awesome.min.css' );
    }

    if( $opt_settings['opt-enable-lazy-load'] == '1' ) {
      //Lazy Load
      wp_enqueue_script( 'lazy-load', B_URL . '/libraries/lazy-load/jquery.lazy.min.js', array('jquery'), '20151215', true );
	    wp_enqueue_script( 'lazy-load-plugins', B_URL . '/libraries/lazy-load/jquery.lazy.plugins.min.js', array('jquery'), '20151215', true );
    }
  }
  //theme font
  wp_enqueue_style(
    'theme-fonts',
    get_stylesheet_directory_uri() . '/assets/fonts/fonts.css'
  );

  // Bundle Style
  wp_enqueue_style( 'bundle', B_URL . '/dist/assets/css/bundle.css' );

  // Bundle Script

  wp_enqueue_script( 'jquery' );

  wp_enqueue_script( 'bootstrap-datepicker', B_URL . '/assets/js/bootstrap-datepicker.js', array('jquery'), '1.0.0', true );

  wp_enqueue_script( 'blueimp', B_URL . '/assets/blueimp-gallery.js', array('jquery'), '1.0.0', true );
  
  wp_enqueue_script( 'bundle', B_URL . '/dist/assets/js/main.js', array(), '1.0.0', true );

  wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key='.$opt_settings['opt-api-key-maps'].'&libraries=places', array(), '1.0.0', false );
  
  wp_localize_script( 'custom', 'ize_ajax', array( 'ajax_url' => admin_url('admin-ajax.php')) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Enqueue scripts and styles to Admin page
 */
function ize_master_theme_admin_scripts() {
  
}
