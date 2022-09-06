<?php

$id_section = substr( md5( json_encode( $instance['title'].$instance['content'].$instance['layout'].$instance['image'].$instance['description'] ) ), 0, 10 );
  $src = wp_get_attachment_image_src($instance['image'], 'large')[0];
?>
<div id="wwi-<?php echo $id_section;?>" class="ize-wedding-with-image <?php echo $instance['layout'];?>">
  <div class="top-content-wrapper">
    <div class="title"><h2><?php echo $instance['title'];?></h2></div>
    <div class="content"><?php echo wpautop($instance['subtitle']);?></div>
  </div>
  <div class="wedding-content-wrapper">
    <div class="row auto-clear">
      <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 same-height-123">
        <div class="image-wrapper">
          <div class="image" style="background-image:url(<?php echo $src;?>);"></div>
        </div>
      </div>
      <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 same-height-123">
        <div class="content-wrapper">
          <?php echo wpautop($instance['description']);?>
          <a href="<?php echo sow_esc_url($instance['link']); ?>" class="link-more position-bottom"><?php echo $instance['text_link'];?></a>
        </div>
      </div>
    </div>
  </div>
</div>
