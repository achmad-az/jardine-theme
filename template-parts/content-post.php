<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <div class="post-thumbnail">
    <div class="post-date">
      <?php echo get_the_date('M d', get_the_ID()); ?>
    </div>
    <a href="<?php echo the_permalink() ?>">

        <?php the_post_thumbnail() ?>
    </a>
  </div>

  <h2><?php the_title() ?></h2>
  <?php the_excerpt(); ?>
  <a href="<?php echo the_permalink() ?>"><?php echo __('See More...') ?></a>
</article><!-- #post-## -->
