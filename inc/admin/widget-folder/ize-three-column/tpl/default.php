<?php
  $id_section = substr( md5( json_encode( $instance['title'].$instance['description'].$instance['section_loop'] ) ), 0, 10 );
  $count = sizeof($instance['section_loop']);
?>
<div class="three-column-wrapper" id="tc-<?php echo $id_section;?>">
  <div class="top-content-wrapper">
    <div class="title"><h2><?php echo $instance['title'];?></h2></div>
    <div class="content"><?php echo wpautop($instance['description']);?></div>
  </div>
  <div class="loop-content-wrapper row auto-clear">
    <?php
    if($instance['section_loop'] !== '' && $count > 0){
      foreach ($instance['section_loop'] as $key => $value) {
        $class = 'col-xs-12 loop-three-wrapper ';
        $src = wp_get_attachment_image_src($value['column_image'], 'large')[0];
        if($count == 1){
          $class .= 'col-md-12 col-sm-12 col-lg-12';
        } elseif($count == 2){
          $class .= 'col-md-6 col-sm-6 col-lg-6';
        } elseif($count == 3){
          $class .= 'col-md-4 col-sm-4 col-lg-4';
        } elseif($count == 4){
          $class .= 'col-md-3 col-sm-6 col-lg-3';
        } elseif($count > 4){
          $class .= 'col-md-3 col-sm-6 col-lg-3';
        }
        ?>
          <div class="<?php echo $class;?>">
            <div class="content-wrapper-three">
              <div class="image-wrapper">
                <a href="<?php echo sow_esc_url($value['column_link']);?>"><div class="image" style="background-image:url(<?php echo $src; ?>);"></div></a>
              </div>
              <div class="content-desc">
                <a href="<?php echo sow_esc_url($value['column_link']);?>"><h3><?php echo $value['column_title'];?></h3></a>
                <?php echo wpautop($value['column_desc']); ?>
              </div>
            </div>
          </div>
        <?php
      }
    }
    ?>
  </div>
</div>
