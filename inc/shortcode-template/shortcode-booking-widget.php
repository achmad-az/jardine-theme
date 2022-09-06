<?php global $opt_settings;
$id = uniqid();
?>
<!-- DESKTOP FORM -->
<div class="booking-widget-wrapper hidden-xs">
  <div class="booking-widget">
    <h3><?php echo get_field('price', get_the_ID()) ?></h3>
    <?php echo do_shortcode('[contact-form-7 id="263" title="Booking Form"]'); ?>
    <a href="<?php echo $opt_settings['opt-booking-check-special-offer-link'];?>" class="check-special-offer"><?php echo $opt_settings['opt-booking-check-special-offer-link-text'];?></a>
  </div>
</div>

<!-- MOBILE FORM -->
<div class="booking-widget-wrapper visible-xs">
  <div class="booking-widget">
    <h3><?php echo $opt_settings['opt-booking-title'];?></h3>
    <?php echo do_shortcode('[contact-form-7 id="263" title="Booking Form"]'); ?>
    <a href="<?php echo $opt_settings['opt-booking-check-special-offer-link'];?>" class="check-special-offer"><?php echo $opt_settings['opt-booking-check-special-offer-link-text'];?></a>
  </div>
</div>
