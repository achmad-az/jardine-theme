<div class="room-content-wrapper">
  <div class="room-title">
    <div class="title">
      <span></span>
    </div>
    <div class="select-wrapper">
      <?php
      $terms = get_terms([
          'taxonomy' => 'room_category',
          'hide_empty' => false,
      ]);
      ?>
      <select class="room-select" name="room-select">
        <option value="all" selected>All Rooms</option>
        <?php
          foreach ($terms as $key => $value) {
            echo '<option value="'.$value->slug.'">'.$value->name.'</option>';
          }
        ?>
      </select>
    </div>
  </div>
  <div class="room-content">
    <?php
      $args = array(
        'post_type' => 'room',
        'posts_per_page' => -1,
        'post_status' => 'publish'
      );
      $wpquery = new WP_Query($args);
      if($wpquery->have_posts()){
        foreach ($wpquery->get_posts() as $kunci => $hasil) {
          $category = '';
          $terms = get_the_terms( $hasil->ID, 'room_category' );
          if ( $terms && ! is_wp_error( $terms ) ) :
            $cat = array();
            $name = array();
            foreach ( $terms as $term ) {
                $cat[] = $term->slug;
                $name[] = $term->name;
            }
            $category = join( ", ", $cat );
          endif;
          ?>
          <div class="room-loop-wrapper room-id-<?php echo $hasil->ID;?>" data-category="<?php echo $category; ?>">
            <div class="row">
              <div class="col-md-6">
                <?php
                  $imagesliderdata = CFS()->get('images', $hasil->ID, array('format' => 'raw'));
                  $imageslider = '<div id="room-'.$hasil->ID.'" class="owl-carousel run-carousel room-owl-slider" data-owl="image-slider">';
                  foreach ($imagesliderdata as $key => $value) {
                    $src = wp_get_attachment_image_src($value['image'], 'large')[0];
                    $imageslider .= '<div class="item"><div class="image-slider-item" style="background-image:url('.$src.');"></div></div>';
                  }
                  $imageslider .= '</div>';
                  echo $imageslider ;
                ?>
              </div>
              <div class="col-md-6">
                <div class="room-content-wrapper">
                  <h2><?php echo get_the_title($hasil->ID);?></h2>
                  <span class="size-room"><?php echo CFS()->get('room_size', $hasil->ID, array('format' => 'raw'));?></span>
                  <div class="description"><?php echo get_the_excerpt($hasil->ID);?></div>
                  <div class="custom-desc">
                    <?php
                      if(CFS()->get('amenities', $hasil->ID)){
                        echo '<ul class="amenities-list list-room-amenities">';
                        $amenities = CFS()->get('amenities', $hasil->ID, array( 'format' => 'raw' ));
                        $count = 0;
                        foreach ($amenities as $key => $value) {
                          if($count < 4){
                              echo '<li><image class="icon" src="'.wp_get_attachment_image_src($value['icon'], 'full')[0].'"><span>'.$value['text'].'</span></li>';
                          }
                          $count++;
                        }
                        echo '</ul>';
                      }
                    ?>
                  </div>
                  <a href="<?php echo get_the_permalink($hasil->ID);?>" class="link-more">Explore More</a>
                </div>
              </div>
            </div>
          </div>

          <?php
        }
      }

    ?>
  </div>
</div>
