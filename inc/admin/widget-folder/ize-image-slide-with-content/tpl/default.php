<?php

$id_section = substr( md5( json_encode( $instance['heading'].$instance['content'].$instance['link'].$instance['link_text'].$instance['section_loop'] ) ), 0, 10 );

$imageslider = '<div id="iswc-owl-'.$id_section.'" class="owl-carousel run-carousel owl-image-slider-with-content" data-owl="image-slider">';
foreach ($instance['section_loop'] as $key => $value) {
  $src = wp_get_attachment_image_src($value['content_image'], 'large')[0];
  $imageslider .= '<div class="item"><div class="image-slider-item" style="background-image:url('.$src.');"></div></div>';
}
$imageslider .= '</div>';

$contentnya = '<div class="content">'.$instance['content'].'<a href="'.sow_esc_url($instance['link']).'" class="button-more">'.$instance['link_text'].'</a></div>';

?>

<div id="iswc-<?php echo $id_section;?>" class="ize-image-slide-with-content image-slide-content-layout <?php echo $instance['type'];?>">
  <div class="wrapper">
  <div class="row">
    <div class="col-md-12">
      <h2><?php echo $instance['heading'];?></h2>
    </div>
    <?php
      if($instance['type'] == 'content-bottom'){
        echo '<div class="col-md-12 wrapper-image">'.$imageslider.'</div>';
        echo '<div class="col-md-12 wrapper-content">'.wpautop($contentnya).'</div>';
      } else {
        echo '<div class="col-md-8 wrapper-image">'.$imageslider.'</div>';
        echo '<div class="col-md-4 wrapper-content border-box">'.wpautop($contentnya).'</div>';
      }
     ?>
  </div>
  </div>
</div>
