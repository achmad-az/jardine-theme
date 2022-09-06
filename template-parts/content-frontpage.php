<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jardine_Master_Theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
      the_content();
    ?>
</article>