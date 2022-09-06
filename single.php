<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package jardine_Master_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="content-wrapper">
				<div class="jardine-container">
					<?php
					while ( have_posts() ) : the_post();
					if(get_post_type() === 'villa'){
						get_template_part( 'template-parts/content', 'page_villa' );
					} elseif(get_post_type() === 'special_offer'){
						get_template_part( 'template-parts/content', 'special_offer' );
					} elseif(get_post_type() === 'post'){
						?>
							<div class="row">
								<div class="col-md-8">
									<?php
										get_template_part( 'template-parts/content', 'postsingle' );
									?>
								</div>
								<div class="col-md-4">
									<?php
										get_sidebar();
									?>
								</div>
							</div>
						<?php


					} else {
						get_template_part( 'template-parts/content', get_post_format() );
						// If comments are open or we have at least one comment, load up the comment template.

					}
						//the_post_navigation();
					endwhile; // End of the loop.
					?>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//
get_footer();
