<?php
global $post, $opt_settings;

  /**
  * Template Name: Contact Us
  */
  get_header();
  echo '<div class="jardine-container">';
  echo the_breadcrumb();
      echo $post->post_content;
      echo do_shortcode($opt_settings['opt-contact-form']);
  echo '</div>';
  echo $opt_settings['opt-map-embed'];
get_footer();
?>

