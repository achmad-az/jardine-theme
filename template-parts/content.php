<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jardine_Master_Theme
 */

?>

<?php echo the_breadcrumb(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
      the_content();
    ?>
     <div class="share-wrap">
     	Share on <div id="share"></div>
     </div>
</article><!-- #post-## -->
