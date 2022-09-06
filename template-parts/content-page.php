<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jardine_Master_Theme
 */

echo the_breadcrumb(); 
?>
<div class="page-title-single">
  <?php
    echo get_the_title(get_the_ID());
  ?>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
      the_content();
    ?>
     <div class="share-wrap">
     	Share on <div id="share"></div>
     </div>
</article>