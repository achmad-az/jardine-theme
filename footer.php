<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jardine_Master_Theme
 */
	global $opt_settings;
?>
		<footer class="jardine-footer">
			 <div class="footer-bottom" style="background: <?php echo $opt_settings['opt-footer-bottom-bgcolor'] ?>">
				 <div class="jardine-container">
					 <div class="footer-menu">
						<div class="row">
							<div class="col-sm-2">
								<?php dynamic_sidebar( 'footer-menu-1' ); ?>
							</div>
							<div class="col-sm-2 col-xs-6">
								<?php dynamic_sidebar( 'footer-menu-2' ); ?>
							</div>
							<div class="col-sm-2 col-xs-6">
								<?php dynamic_sidebar( 'footer-menu-3' ); ?>
							</div>
							<div class="col-sm-2 col-xs-6">
								<?php dynamic_sidebar( 'footer-menu-4' ); ?>
							</div>
							<div class="col-sm-2 col-xs-6">
								<?php $footer = dynamic_sidebar( 'footer-menu-5' ); ?>
							</div>
							<div class="col-sm-2 col-xs-6">
								<?php $footer2 = dynamic_sidebar( 'footer-menu-6' ); ?>
							</div>
						</div>
					 </div>
					 <div class="copyright">
						 <?php echo do_shortcode('[copyright-text]'); ?>
					 </div>
				 </div>
			 </div>
		</footer>
	</div><!-- #contentSection -->
</div><!-- #page -->
<!-- Modal -->
<div id="specialOfferModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">

      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="bookingModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<button type="button" class="close" data-dismiss="modal" style="margin: 10px;">&times;</button>
      <?php echo do_shortcode('[booking-widget]');?>
    </div>

  </div>
</div>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
		<div class="description"></div>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<?php wp_footer(); ?>
<?php
if( $opt_settings['opt-footer-code'] != '' ) {
	echo '<!-- code below are generated dynamically by theme options -->';
	echo $opt_settings['opt-footer-code'];
	echo '<!-- // -->';
}
?>
</body>
</html>
