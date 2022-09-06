<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jardine_Master_Theme
 */
global $opt_settings, $post;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<?php
if($opt_settings['opt-enable-pace-js'] == '1') {
?>
<script type="text/javascript" data-pace-options='{ "ajax": false }' src="<?php echo get_template_directory_uri() .'/libraries/pace/pace.min.js' ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $opt_settings['opt-subdomain'];?>/bookcore/static/loyalty/builds/loyalty.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() .'/libraries/pace/pace.css' ?>">
<?php } ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
<link rel="shortcut icon" href="<?php echo $opt_settings['opt-favicon']['url']; ?>" type="image/x-icon">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
<?php do_action('ize_head_hooks'); ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K7MZP5L"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php
do_action('theme_options_js_plugin');
?>

<div id="page" class="site-wrapper">
	<div class="header-menu-mobile">
		<div class="top-bar-mobile">
			<div class="wpml-wrapper" style="margin: auto;">
				<?php
					if ( has_nav_menu( 'menu-login' ) ) { ?>
						<div class="user-menu">
					     <span class='lnr lnr-chevron-down' id='user-menu' style='margin-right: 5px; font-size: 14px;'></span>
					     <?php
							wp_nav_menu( array(
								'theme_location'  => 'menu-login',
								'menu_id' 			  => 'user-menu-ul',
								'container'				=> 'ul',
								'menu_class' 			=> 'sub-menu'
							) );

							echo $opt_settings['opt-login-code'];
					?> 
						</div>
					<?php } ?>
			</div>
		</div>
		<div class="logo-wrapper">
			<button id="toggle-menu" class="toggle-menu-mobile">
				<span class="bar-icon"></span>
				<span class="bar-icon"></span>
				<span class="bar-icon"></span>
			</button>
			<a class="logo" href="<?php echo get_home_url(); ?>">
				 <img src="<?php echo $opt_settings['opt-navbar-logo']['url']; ?>" alt="thesantai-logo">
			</a>
			<button id="search-mobile" class="toggle-menu-mobile seacrh-icon">
				<span class="fa fa-search"></span>
			</button>
		</div>
		<div class="mobile-menu-wrapper">
			<?php
			if(is_front_page()){
				wp_nav_menu( array(
					'theme_location'  => 'menu-home',
					'container_class' => 'main-navbar',
					'menu_id' 			  => 'primary-menu',
					'container'				=> 'ul',
					'menu_class' 			=> 'ize-menu-nav'
				) );
			} else {
				wp_nav_menu( array(
					'theme_location'  => 'menu-1',
					'container_class' => 'main-navbar',
					'menu_id' 			  => 'primary-menu',
					'container'				=> 'ul',
					'menu_class' 			=> 'ize-menu-nav'
				) );
			}
			?>
			<div class="mobile-button-wrapper hidden-sm hidden-xs">
			    <?php if ($opt_settings['opt-set-booking']==1){
        			?>
        			<div class="button-wrapper">
        				<a href="<?php echo $opt_settings['opt-simple-booking-url'];?>" target="_blank" class="mobile-button-book-now" style="color:<?php echo $opt_settings['opt-btnbook-color'];?>;background-color:<?php echo $opt_settings['opt-btnbook-backcolor'];?>;">Book Now</a>
        			</div>
        			<?php
        		} else {
        			?>
				<a href="#" id="button-book-now" class="mobile-button-book-now" style="color:<?php echo $opt_settings['opt-btnbook-color'];?>;background-color:<?php echo $opt_settings['opt-btnbook-backcolor'];?>;">Book Now</a>

        			<?php
        		} ?>
			</div>
			<div class="logo-menu-bottom">
				<?php if($opt_settings['opt-footer-logo-1']){ echo ''.(($opt_settings['opt-footer-logo-link-1'])?'<a href="'.$opt_settings['opt-footer-logo-link-1'].'" target="_blank">':'').'<img src="'.$opt_settings['opt-footer-logo-1']['url'].'" alt="" class="single-member" >'.(($opt_settings['opt-footer-logo-link-1'])?'</a>':'').'';} ?>
			</div>
		</div>
	</div>
	<?php if ( has_nav_menu( 'menu-login' ) ) { ?>
	<div class="topbarMenu">
		<div class="container">
			<div id="headerMenu" class="ize-side-menu ize-menu-wrapper">
				<div class="header-right">
					<div class="top-menu">
						<div class="menu-wrapper">
							<?php 
							wp_nav_menu( array(
								'theme_location'  	=> 'menu-login',
								'container_class' 	=> 'main-navbar',
								'menu_id' 			=> 'topbar-menu',
								'container'			=> 'ul',
								'menu_class' 		=> 'mobile-ize-menu-nav'
							) );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="sticky-holder"></div>
		<div id="headerMenu" class="stiki">
			<div class="container">
				<div id="headerMenu" class="ize-side-menu ize-menu-wrapper">
					<div class="logo-wrapper">
						<a class="logo" href="<?php echo get_home_url(); ?>">
							<img src="<?php echo $opt_settings['opt-navbar-logo']['url']; ?>" alt="logo">
						</a>
					</div>
					<div class="header-right">
						<div class="top-menu">
							<div class="menu-wrapper">
								<?php
								if(is_front_page()) {
									wp_nav_menu( array(
										'theme_location'  => 'menu-home',
										'container_class' => 'main-navbar',
										'menu_id' 			  => 'primary-menu',
										'container'				=> 'ul',
										'menu_class' 			=> 'mobile-ize-menu-nav'
									) );
								} else {
									wp_nav_menu( array(
										'theme_location'  => 'menu-1',
										'container_class' => 'main-navbar',
										'menu_id' 			  => 'primary-menu',
										'container'				=> 'ul',
										'menu_class' 			=> 'mobile-ize-menu-nav'
									) );
								}
								?>
				
							</div>
						</div>
						<div id="bottomMenu">
							<a class="logo" href="<?php echo get_home_url(); ?>">
								<img src="<?php echo $opt_settings['opt-navbar-logo']['url']; ?>" alt="logo">
							</a>
							<?php echo do_shortcode('[booking-header]'); ?>
							<div class="social-media">
								<?php echo do_shortcode('[social-media-icon]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	

	<div id="contentSection" class="site-content">
		<?php if(is_singular('special_offer') || is_singular('villa')) {
				?>
				<div id="gallery-grid" class="header-wrapper" style="height: 416px">
					<div class="row" style="margin-left: 0px; margin-right: 0px">
						<div class="col-md-6" style="padding: 0px">
							<header class="banner-header">
								<?php
									$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
									echo '<a href="'.$src.'"><div class="layer-1"></div><div class="banner-image-single" style="background-image:url('.$src.')"></div></a>';
								?>
							</header>
						</div>
						<div class="col-md-6" style="padding: 0px">
							<?php 
								$termgal = get_field( 'gallery_select',  $post->ID );
								echo show_gallery_room_square($termgal);
							?>
						</div>
					</div>
				</div>
				<?php
			} else if (is_front_page()) {
				?>
				<header class="banner-header">
					<?php echo do_shortcode('[banner-image]'); ?>
				</header>
				<?php
			} else {
				$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
				?>

				<?php if($src): ?>
				<header class="banner-header">
					<div class="layer-1"></div>
					<?php	
						echo '<div class="banner-image-single" style="background-image:url('.$src.')"></div>';
					?>
				</header>
				<?php
				endif;
			}
		 ?>
		<div class="arrow-top">
			<span class="fa fa-chevron-up"></span>	
		</div>
