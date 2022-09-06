<?php
global $post, $opt_settings;
$class = 'banner-homepage';
$homepage =  'true';


if ($opt_settings['opt-slider-type'] == 1) {
  # code...
  $images = $opt_settings['opt-images-slider'];
  if($images) {
    if(count($images) > 1) {
      echo '<div id="bannerImage-'.$post->ID.'" class="owl-carousel run-carousel '.$class.'" data-homepage="'.$homepage.'" data-banner-carousel="true">';
      foreach ($images as $key => $value) {
        $text = '';
        if($value['description'] !== '' && is_front_page()){
          $text = '<div class="text-slider"><span class="text-slider-content">'.$value['description'].'</span></div>';
        }
        echo '<div class="item">';
        echo '<div class="image-slider" style="background-image:url('.$value['image'].')">'.$text.'</div>';
        echo '</div>';
      }
      echo '</div>';
    }
  }

} else {
  echo '<div id="bannerImage-'.$post->ID.'" class="'.$class.'" style="padding-left: 239px">';
  if ($opt_settings['opt-video-type'] == '1') {
    $video_source = $opt_settings['opt-video-source']['url'];
    echo "<video width='100%' height='100%' autoplay>";
    echo "<source src='$video_source'>";
    echo "</video>";
  } else {
    $video_source = $opt_settings['opt-video-youtube'] . '?autoplay=true';
    echo "
    <iframe width='100%' height='100%' src='$video_source' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
    ";
  }
  echo "</div>";
}
?>
