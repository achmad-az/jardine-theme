<?php
  $id_section = substr( md5( json_encode( $instance['heading'].$instance['content'].$instance['section_loop'] ) ), 0, 10 );
  $navigation = '';
  $contentnya = '';
  $count = 0;
  if($instance['section_loop'] !== ''){
    foreach ($instance['section_loop'] as $key => $value) {
      if($count == 0){
        $class = "active";
      } else {
        $class = "";
      }
      ob_start();
      ?>
        <li><a href="#tab-<?php echo $id_section;?>-<?php echo $key;?>" class="navigation-link tab-link <?php echo $class;?>" data-index="<?php echo $key;?>"><?php echo $value['content_title'];?></a></li>
      <?php
      $navigation .= ob_get_clean();

      ob_start();
      $src = wp_get_attachment_image_src($value['content_image'], 'large')[0];
      ?>
        <div id="tab-<?php echo $id_section;?>-<?php echo $key;?>" class="tab-item <?php echo $class;?>">
          <div class="tab-wrapper" style="background-image:url(<?php echo $src;?>)">
            <div class="tab-content">
              <?php
                if($value['content_title'] !== ''){
                  echo '<h3>'.$value['content_title'].'</h3>';
                }
                if($value['content_desc'] !== ''){
                  echo wpautop($value['content_desc']);
                }
                if($value['content_link'] !== ''){
                  echo '<a href="'.sow_esc_url($value['content_link']).'" class="button-more">'.$value['content_link_text'].'</a>';
                }
              ?>
            </div>
          </div>
        </div>
      <?php
      $contentnya .= ob_get_clean();
      $count++;
    }
?>
<div id="hrl-<?php echo $id_section;?>" class="homepage-restaurant-layout tab-layout">
  <div class="row">
    <div class="col-md-12">
      <h2><?php echo $instance['heading'];?></h2>
    </div>
    <div class="col-md-4">
      <div class="side-content">
        <?php echo $instance['content'];?>
      </div>
      <div class="navigation-tab">
        <ul>
          <?php echo $navigation;?>
        </ul>
      </div>
    </div>
    <div class="col-md-8">
      <div class="tab-content">
        <?php echo $contentnya;?>
      </div>
    </div>
  </div>
</div>
<?php
  }
?>
