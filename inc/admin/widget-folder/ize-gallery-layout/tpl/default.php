<?php
  $loop = get_posts(array(
    'numberposts' => '-1',
    'post_type' => array('page', 'room', 'special_offer')
  ));
  $post_id = array();
  $loopimage = array();
  foreach ($loop as $key => $value) {
    //$loopimage = CFS()->get('images', $value->ID);
    $image = CFS()->get('images', $value->ID, array('format' => 'raw'));
    if(!empty($image)){
      if(!empty($image)){
        $loopimage = array_merge($loopimage, CFS()->get('images', $value->ID, array('format' => 'raw')));
      } else {
        $loopimage = CFS()->get('images', $value->ID, array('format' => 'raw'));
      }
    }
  }
  //let's do shuffle
  $keys = array_keys($loopimage);
  shuffle($keys);
  foreach($keys as $key) {
      $new[$key] = $loopimage[$key];
  }
  $loopimage = $new;
  echo '<div class="ize-masonry-wrapper" >';
  echo '<h2>GALLERY</h2>';

  ?>
  <div id="gallery-grid">
    <div class="ms-sizer"></div>
    <?php echo show_gallery_image_home();?>
  </div>
  <?php
  $count = 0;
  // foreach ($loopimage as $key => $value) {
  //   if($count == 0){
  //     $src = wp_get_attachment_image_src($value['image'], 'large')[0];
  //     echo '<div class="grid-item width-30"><a href="'.$src.'" data-toggle="lightbox" data-gallery="gallery-home" data-type="image"><div class="the-image" style="background-image:url('.$src.');"></div></a></div>';
  //   }
  //   if($count == 1 || $count == 2){
  //     $src = wp_get_attachment_image_src($value['image'], 'large')[0];
  //     echo '<div class="grid-item width-70"><a href="'.$src.'" data-toggle="lightbox" data-gallery="gallery-home" data-type="image"><div class="the-image" style="background-image:url('.$src.');"></div></a></div>';
  //   }
  //   if($count == 3){
  //     $src = wp_get_attachment_image_src($value['image'], 'large')[0];
  //     echo '<div class="grid-item width-30"><div class="grid-item-child"><a href="'.$src.'" data-toggle="lightbox" data-gallery="gallery-home" data-type="image"><div class="the-image" style="background-image:url('.$src.');"></div></a></div>';
  //   }
  //   if($count == 4){
  //     $src = wp_get_attachment_image_src($value['image'], 'large')[0];
  //     echo '<div class="grid-item-child the-last"><a href="#">EXPLORE GALLERY</a><div class="the-image" style="background-image:url('.$src.');"></div></div></div>';
  //   }
  //   $count ++;
  // }
  // echo '<div class="grid-item width-30"><a href="http://ize.gaintheme.com/wp-content/uploads/2017/09/e6ef77c7-9b36-4c1d-91ab-025443b084a1.jpg" data-toggle="lightbox" data-gallery="gallery-home" data-type="image"><div class="the-image" style="background-image:url(http://ize.gaintheme.com/wp-content/uploads/2017/09/e6ef77c7-9b36-4c1d-91ab-025443b084a1.jpg);"></div></a></div>';
  // echo '<div class="grid-item width-70"><a href="http://ize.gaintheme.com/wp-content/uploads/2017/09/6f29695b-4bf9-4022-8ec6-5055a71f8ea4.jpg" data-toggle="lightbox" data-gallery="gallery-home" data-type="image"><div class="the-image" style="background-image:url(http://ize.gaintheme.com/wp-content/uploads/2017/09/6f29695b-4bf9-4022-8ec6-5055a71f8ea4.jpg);"></div></a></div>';
  // echo '<div class="grid-item width-70"><a href="http://ize.gaintheme.com/wp-content/uploads/2017/09/414837e0-72f2-4530-961e-d262306327ca.jpg" data-toggle="lightbox" data-gallery="gallery-home" data-type="image"><div class="the-image" style="background-image:url(http://ize.gaintheme.com/wp-content/uploads/2017/09/414837e0-72f2-4530-961e-d262306327ca.jpg);"></div></a></div>';
  // echo '<div class="grid-item width-30"><div class="grid-item-child"><a href="http://ize.gaintheme.com/wp-content/uploads/2017/09/3f24fa08-eb7f-4227-b15e-8cca6cf8752e.jpg" data-toggle="lightbox" data-gallery="gallery-home" data-type="image"><div class="the-image" style="background-image:url(http://ize.gaintheme.com/wp-content/uploads/2017/09/3f24fa08-eb7f-4227-b15e-8cca6cf8752e.jpg);"></div></a></div>';
  // echo '<div class="grid-item-child the-last"><a href="#">EXPLORE GALLERY</a><div class="the-image" style="background-image:url(http://ize.gaintheme.com/wp-content/uploads/2017/09/3f24fa08-eb7f-4227-b15e-8cca6cf8752e.jpg);"></div></div></div>';
  // echo '</div>';
  echo '</div>';
  //$loopimage = CFS()->find_fields( array( 'field_type' => 'loop' ) );
  // print_r('<pre>');
  // print_r($loopimage);
  // print_r('</pre>');
  // print_r('<pre>');
  // print_r($loopimage);
  // print_r('</pre>');
