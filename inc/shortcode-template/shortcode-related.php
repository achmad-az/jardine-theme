<?php
  global $post;
  $item = '';
?>
<?php

if ($post->post_type === 'villa') {
    $args=array(
      'post_type' => 'villa',
      'post_parent' => $post->ID
    );
    $my_query = get_children($args);
} else {
  $args=array(
    'post_type' => 'villa',
    'order' => 'random',
    'post__not_in' => array($post->ID)
  );
  $my_query = new WP_Query($args);

  $my_query = $my_query->get_posts();
}
    if($my_query) {
      foreach ($my_query as $key => $value) {
        if($value->post_type === 'villa') {
          $term = '';
          $terms = get_the_terms($value->ID, 'villa_location');

          if ($terms) {
            $term = $terms[0]->name;
          }
          $permalink = get_permalink($value->ID);
          // $size = CFS()->get( 'room_size', $value->ID, array( 'format' => 'raw' ) );
          $src = wp_get_attachment_image_src(get_post_thumbnail_id( $value->ID ), 'large')[0];
          $item .= '<div class="item">';
          $item .= '<div class="room-list-related">';
          $item .= '<div class="room-list-wrapper">';
          $item .= '<a href="'.$permalink.'"><div class="image" style="background-image:url('.$src.');"><span class="button">Explore More</span></div></a>';
          $item .= '<div class="content">';
          $item .= '<span class="villa-category">'.$term.'</span>';
          $item .= '<h4>'.get_the_title($value->ID).'</h4>';
          $item .= '<span class="villa-price">'.get_field('price', $value->ID).'</span>';
          // $item .= '<span class="size-room">'.$size.'</span>';
          $item .= '<a href="'.$permalink.'" class="more-link">Explore More</a>';
          $item .= '</div>';
          $item .= '</div>';
          $item .= '</div>';
          $item .= '</div>';
        }
      }
      wp_reset_postdata();
    }
    ?>
<div class="relatedposts">
  <?php if($post->post_type === 'villa'): ?>
    <div class="related-title">
      <h2 class="title">Villa Properties</h2>
    </div>
  <?php endif; ?>
  <div id="relatedContent" class="owl-carousel run-carousel post-carousel">
    <?php echo $item;?>
  </div>
</div>
