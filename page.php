<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jardine_Master_Theme
 */

get_header(); ?>

	<?php if(!is_front_page() && !is_home()): ?>
		<div class="jardine-container">
	<?php endif; ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				
				<?php
				
				while ( have_posts() ) : the_post();
				if(is_front_page()){
					get_template_part( 'template-parts/content', 'frontpage' );
				} else {
					if(get_post_type() === 'villa' || get_queried_object()->slug === 'accomodation') {
						get_template_part( 'template-parts/content', 'room_loop' );
					} else {
						get_template_part( 'template-parts/content', 'page' );
					}
				}
					

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	<?php if(!is_front_page() || !is_home()): ?>
	</div>
	<?php endif; ?>

<?php
get_footer();
