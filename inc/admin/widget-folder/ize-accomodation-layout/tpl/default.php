<?php
  $id_section = substr( md5( json_encode( $instance['heading'].$instance['section_1'].$instance['section_2'].$instance['show_checked'].$instance['link'] ) ), 0, 10 );
?>
<div id="accrooms-<?php echo $id_section;?>" class="home-accomodation-layout">
  <div class="accomodation-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="accomodation-heading-wrapper">
          <?php
          if($instance['heading'] !== ''){
            echo '<h2>'.$instance['heading'].'</h2>';
          }
          ?>
        </div>
      </div>
      <?php
        if($instance['number_show'] == 0){
          $classwrapper = 'col-md-12 col-sm-12';
        } else {
          $classwrapper = 'col-md-4 col-sm-12';
        }
      ?>
      <div class="<?php echo $classwrapper;?>">
        <div class="accomodation-section-1">
          <div class="content">
            <?php
              if($instance['section_1']['heading_1'] !== ''){
                echo '<h3>'.$instance['section_1']['heading_1'].'</h3>';
              }
            ?>
            <?php echo $instance['section_1']['content_1'];?>
            <?php
              if($instance['section_1']['link_1'] !== ''){
                echo '<a href="'.sow_esc_url($instance['section_1']['link_1']).'" class="more-link">'.$instance['section_1']['link_text_1'].'</a>';
              }
            ?>
          </div>
        </div>
        <div class="accomodation-section-2">
          <div class="content">
            <?php
              if($instance['section_2']['heading_2'] !== ''){
                echo '<h3>'.$instance['section_2']['heading_2'].'</h3>';
              }
            ?>
            <?php echo $instance['section_2']['content_2'];?>
            <?php
              if($instance['section_2']['link_2'] !== ''){
                echo '<a href="'.sow_esc_url($instance['section_2']['link_2']).'" class="more-link">'.$instance['section_2']['link_text_2'].'</a>';
              }
            ?>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="accomodation-list-wrapper">
          <ul class="accomodation-list">
            <?php
              $argst = array(
                'post_type' => 'room',
                'post_status' => 'publish',
                'posts_per_page' => $instance['number_show']
              );
              if($instance['number_show'] == 1 || $instance['number_show'] == 2){
                $class = 'width-100';
              } elseif ($instance['number_show'] == 3 || $instance['number_show'] == 4) {
                $class = 'width-50';
              } else {
                $class = 'width-50';
              }
              $roomlists = new WP_Query($argst);
              if($roomlists->have_posts()){
                $var = $roomlists->get_posts();
                foreach ($var as $key => $value) {
                  $size = CFS()->get( 'room_size', $value->ID, array( 'format' => 'raw' ) );
                  $src = wp_get_attachment_image_src(get_post_thumbnail_id( $value->ID ), 'large')[0];
                  echo '<li class="room '.$class.'" data-room="'.$key.'">';
                  echo '<div class="room-list-wrapper">';
                  echo '<a href="'.get_permalink($value->ID).'"><div class="image" style="background-image:url('.$src.');"><span class="button">Explore More</span></div></a>';
                  echo '<div class="content">';
                  echo '<h4>'.get_the_title($value->ID).'</h4>';
                  echo '<span class="size-room">'.$size.'</span>';
                  echo '<a href="'.get_permalink($value->ID).'" class="more-link">Explore More</a>';
                  echo '</div>';
                  echo '</div>';
                  echo '</li>';
                }
              } else {
                echo '<li class="no-room">No Room Available</li>';
              }
              wp_reset_postdata();
            ?>
          </ul>
        </div>
      </div>
      <div class="col-md-8 pull-right">
        <div class="accomodation-button-wrapper">
          <a href="<?php echo sow_esc_url($instance['link']); ?>" class="button-more"><?php echo $instance['link_text']; ?></a>
        </div>
      </div>
    </div>
  </div>
</div>
