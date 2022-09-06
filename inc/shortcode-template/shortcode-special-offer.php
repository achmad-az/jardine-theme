<?php global $post; ?>
<div class="jardine-container">

  <?php echo the_breadcrumb(); ?>
  <?php 
    if ($post->post_title !== '' && $post->post_excerpt) {
      echo "<div class='special-offer-intro'>";
      echo "<h1>".$post->post_title."</h1>";
      echo "<p>".$post->post_excerpt."</p>";
      echo "</div>";
    }
  ?>
  <div class="special-offer-content-wrapper">
    <div class="special-offer-navigation">
      <ul>
        <li><a href="#" class="so-nav active" data-target="no_cat">Featured</a></li>
        <?php
          $terms = get_terms( 'special_offer_category', array(
            'hide_empty' => false,
          ) );
          foreach ($terms as $key => $value) {
            echo '<li><a href="#" class="so-nav" data-target="'.$value->slug.'">'.$value->name.'</a></li>';
          }
        ?>
      </ul>
    </div>
    <div class="special-offer-content-loop">
      <?php
        $args = array(
          'post_type' => 'special_offer',
          'posts_per_page' => -1,
          'post_status' => 'publish'
        );
        $wpquery = new WP_Query($args);
        if($wpquery->have_posts()){
          $category = '';
          $name = array();
          foreach ($wpquery->get_posts() as $key => $value) {
            $terms = get_the_terms( $value->ID, 'special_offer_category' );
            $link = get_the_permalink($value->ID);
            if ( $terms && ! is_wp_error( $terms ) ) :
              $cat = array();
              $name = array();
              foreach ( $terms as $term ) {
                  $cat[] = $term->slug;
                  $name[] = $term->name;
              }
              $category = join( ", ", $cat );
            endif;
              $src = wp_get_attachment_image_src(get_post_thumbnail_id( $value->ID ), 'large')[0];
              $post_excerpt = get_post_field('post_excerpt', $value->ID);
              $post_content = get_post_field('post_content', $value->ID);
            ?>
              <div class="special-offer-loop" data-target="<?php if ( $category == null ){ echo 'no_cat';}else{echo $category;}?>" data-id="<?php echo $value->ID;?>" <?php if ( $category == null ){ echo 'style="display:block;"';} else { echo 'style="display:none;"';}?>>
                <div class="special-image">
                  <div class="the-image" style="background-image:url(<?php echo $src;?>);">
  
                  </div>
                </div>
                <div class="special-content">
                  <span class="special-cat"><?php echo join( ", ", $name );?></span>
                  <h2><?php echo get_the_title($value->ID);?></h2>
                  <div class="description">
                    <?php echo izeTruncate(wp_trim_words($post_excerpt, 40, ''), 170, ' ').'<br><a href="#" class="open-modal-special-offer-1 page-special" data-index="'.$key.'">full details</a>';?>
                    <input type="hidden" value="<?php echo htmlspecialchars(wpautop($post_content)); ?>" data-index="<?php echo $key;?>">
                  </div>
                  <a href="<?php echo (($link !== '')?$link:'#'); ?>" class="button-link"><?php echo __('Reserve Now', 'jardine') ?></a>
                </div>
              </div>
  
            <?php
          }
        }
  
      ?>
    </div>
  </div>
</div>
