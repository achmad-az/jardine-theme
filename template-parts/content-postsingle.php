<?php
global $post;

$terms = get_the_terms($post->ID, 'category');
$term = '';

if ($terms) {
    $term = $terms[0]->name;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="post-date">
        <?php echo get_the_date('M d', get_the_ID()); ?>
    </div>

<div class="post-meta">
    <ul>
        <li>
            <i class="fa fa-user"></i> <?php the_author_meta('user_nicename', $post->post_author); ?>
        </li>
        <li>
            <i class="fa fa-file"></i> <?php echo $term ?>
        </li>
    </ul>
</div>
  <h2><?php the_title() ?></h2>
  
  <?php 
    the_content(); 
    
    if (comments_open()) {
    
        comments_template();
    }

    
    ?>
</article><!-- #post-## -->
