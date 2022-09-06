<div class="home-intro home-intro-widget homepage-intro-layout">
  <div class="row">
    <?php
      if($booking_widget == true){
        ?>
        <div class="col-md-7 col-lg-7">
          <div class="home-intro-content">
            <?php
              if($heading !== ''){
                echo '<h1 class="title-home-intro">'.$heading.'</h1>';
              }
              if($content !== ''){
                echo '<div class="description">'.wpautop($content).'</div>';
              }
              if($link !== ''){
                echo '<div class="link-wrapper"><a href="'.sow_esc_url($link).'">'.$linktext.'</a></div>';
              }
            ?>
          </div>
        </div>
        <div class="col-md-5 col-lg-5">
          <div class="home-intro-booking-widget">[booking-widget]</div>
        </div>
        <?php
      }else {
        ?>
        <div class="col-md-12 col-lg-12">
          <div class="home-intro-content">
            <?php
              if($heading !== ''){
                echo '<h1 class="title-home-intro">'.$heading.'</h1>';
              }
              if($content !== ''){
                echo '<div class="description">'.wpautop($content).'</div>';
              }
              if($link !== ''){
                echo '<div class="link-wrapper"><a href="'.sow_esc_url($link).'">'.$linktext.'</a></div>';
              }
            ?>
          </div>
        </div>
        <?php
      }
    ?>

  </div>
</div>
