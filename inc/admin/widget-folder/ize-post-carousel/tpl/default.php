<?php

$post_type = $instance['post_type'];
  $id_section = substr( md5( json_encode( $instance['post_type'].$instance['item'].$instance['link_text'] ) ), 0, 10 );
$argst = array(
  'post_type' => $post_type,
  'post_status' => 'publish',
  'posts_per_page' => $instance['item'],
);
$postcarousel = new WP_Query($argst);
if($postcarousel->have_posts()){
  echo '<div class="post-carousel-layout">';
  echo '<h2>'.$instance['heading'].'</h2>';
  echo '<div id="postCar-'.$id_section.'" class="owl-carousel run-carousel post-carousel">';
  $var = $postcarousel->get_posts();
  foreach ($var as $key => $value) {
    if(get_post_type($value->ID) == 'special_offer'){
      $src = wp_get_attachment_image_src(get_post_thumbnail_id( $value->ID ), 'large')[0];
      $link = CFS()->get('special_offer_link', $value->ID);
      $post_content = get_post_field('post_content', $value->ID);
      //$json = json_encode($post_content);
      echo '<div class="item">';
      echo '<div class="wrapper-item-carousel">';
      echo '<a href="'.(($link && $link['url'] !== '')?$link['url']:'#').'" '.((($link && $link['target'] !== '')?'target="'.$link['target'].'"':'')).'><div class="image" style="background-image:url('.$src.')">';
      echo '<span class="button-image">'.$instance['link_text'].'</span>';
      echo '</div></a>';
      echo '<div class="content">';
      echo '<h3>'.get_the_title($value->ID).'</h3>';
      echo '<p class="description">'.izeTruncate(get_excerpt_by_id($value->ID) , 170, ' ', '').' <a href="#" class="open-modal-special-offer" data-index="'.$key.'">full details</a></p>';
      echo '<a href="'.(($link && $link['url'] !== '')?$link['url']:'#').'" '.((($link && $link['target'] !== '')?'target="'.$link['target'].'"':'')).' class="button-link">'.$instance['link_text'].'</a>';

      echo '<input type="hidden" value="'.htmlspecialchars(wpautop($post_content)).'" data-index="'.$key.'">';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    } else {
      $src = wp_get_attachment_image_src(get_post_thumbnail_id( $value->ID ), 'large')[0];
      echo '<div class="item">';
      echo '<div class="wrapper-item-carousel">';
      echo '<a href="'.get_permalink($value->ID).'"><div class="image" style="background-image:url('.$src.')">';
      echo '<span class="button-image">'.$instance['link_text'].'</span>';
      echo '</div></a>';
      echo '<div class="content">';
      echo '<h3>'.get_the_title($value->ID).'</h3>';
      echo '<p class="description">'.izeTruncate(wp_trim_words(get_post_field('post_content', $value->ID), 40, ''), 150, ' ', '... <a href="'.get_permalink($value->ID).'">full details</a>').'</p>';
      echo '<a href="'.get_permalink($value->ID).'" class="button-link">'.$instance['link_text'].'</a>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }

  }
  echo '</div>';
  if($instance['show_more'] !== ''){
    echo '<a href="'.sow_esc_url($instance['show_more']).'" class="show-more-link">'.$instance['show_more_text'].'</a>';
  }
  echo '</div>';
}
