<?php
  $id = substr( md5( json_encode( $instance['title'].$instance['description'].$instance['icon'].$instance['link_text'].$instance['link'] ) ), 0, 10 );
?>
<div class="wedding-text-wrapper" id="wt-<?php echo $id;?>">
  <div class="content-wrapper">
    <div class="title">
      <h2><?php echo $instance['title'];?></h2>
    </div>
    <div class="content">
      <?php
        if($instance['description'] !== ''){
            echo wpautop($instance['description']);
        }
      ?>
    </div>
    <div class="link">
      <?php
      if($instance['link'] !== ''){
        if($instance['icon'] !== ''){
          $src = wp_get_attachment_image_src($instance['icon'], 'large')[0];
        } else {
          $src = '';
        }
        echo '<a href="'.sow_esc_url($instance['link']).'" class="link-more"><span class="icon"><img src="'.$src.'"></span>'.(($instance['text_link'] !== '')?$instance['text_link']:'Learn More').'</a>';
      }
      ?>
    </div>
  </div>
</div>
