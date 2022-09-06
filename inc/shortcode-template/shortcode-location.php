<?php
  global $opt_settings;
  $id = uniqid('ize-');
  $argsloc = array(
    'post_type' => 'location_custom',
    'posts_per_page' => -1,
    'post_status' => 'publish'
  );
  $termsloc = get_terms([
      'taxonomy' => 'loc_category',
      'hide_empty' => false,
  ]);
  $queryloc = new WP_Query($argsloc);
  $result = array();
  $result1 = array(
    'place_name' => $opt_settings['opt-loc-title'],
    'location' => array($opt_settings['opt-loc-lat'],$opt_settings['opt-loc-long']),
    'description' => $opt_settings['opt-loc-description'],
    'dirlink' => urlencode($opt_settings['opt-loc-link']),
    'icon' => $opt_settings['opt-location-icon']['url']
  );
  if($queryloc->have_posts()){
    foreach ($queryloc->get_posts() as $key => $value) {
      $name = CFS()->get('place_name', $value->ID, array('format' => 'raw'));
      $lat = CFS()->get('latitude', $value->ID, array('format' => 'raw'));
      $long = CFS()->get('longtitude', $value->ID, array('format' => 'raw'));
      $desc = CFS()->get('place_description', $value->ID, array('format' => 'raw'));
      $dirlink = CFS()->get('get_direction', $value->ID, array('format' => 'raw'));
      $cat = array();
      foreach (get_the_terms( $value->ID, 'loc_category' ) as $key => $value) {
        array_push($cat, $value->slug);
      }
      array_push($result, array(
        'place_name' => $name,
        'category' => $cat,
        'location' => array($lat,$long),
        'description' => $desc,
        'dirlink' => urlencode($dirlink)
      ));
    }
  }
  wp_reset_postdata();
?>

<div class="location-wrapper" id="loc-<?php echo $id; ?>">
<div class="row">
<div class="col-md-8">
<div id="map-<?php echo $id; ?>" class="run-map-custom location-map">
</div>
<div class="config-data"><input type="hidden" id="config-1-<?php echo $id; ?>" name="config-1-<?php echo $id; ?>" value="<?php echo htmlspecialchars(json_encode($result1)); ?>"><input type="hidden" id="config-<?php echo $id; ?>" name="config-<?php echo $id; ?>" value="<?php echo htmlspecialchars(json_encode($result)); ?>"></div>
</div>
<div class="col-md-4">
<div class="location-content same-height-1">
<h3><?php echo $opt_settings['opt-location-title-content'];?></h3>
<p><?php echo $opt_settings['opt-location-desc-content'];?></p>
<h3><?php echo $opt_settings['opt-location-discover-title'];?></h3>
<div class="select-location"><select name="location-select">
  <option value="all" selected>Select Filter</option>
  <?php
    foreach ($termsloc as $key => $value) {
      echo '<option value="'.$value->slug.'">'.$value->name.'</option>';
    }
  ?>
</select></div>
<ol id="list-<?php echo $id; ?>" class="list-wrapper" style="height:100px; overflow-y:scroll;">
 	<?php
    $count = 1;
    foreach ($result as $key => $value) {
      $category = '';
      foreach ($value['category'] as $k => $v) {
        $category .= $v;
        $category .= ', ';
      }
      echo '<li class="list-marker" data-id="'.$key.'" data-category="'.$category.'" data-location="'.$value['location'][0].','.$value['location'][1].'" style="cursor:pointer;">'.$value['place_name'].'</li>';
      $count++;
    }
  ?>
</ol>
</div>
</div>
</div>
</div>
