<?php
global $post;

$items = get_field('posts');

if($items != ''){
echo '<div class="brand-list-wrapper">';
    echo '<div class="jardine-container">';
        echo '<div class="row">';
            foreach ($items as $key => $value) {
                if(get_post_type($value->ID) == 'brand'){
                $src = wp_get_attachment_image_src(get_post_thumbnail_id( $value->ID ), 'large')[0];
                $link = get_the_permalink($value->ID);
                $logo = get_field('add_logo', $value->ID);
                $title = get_the_title($value->ID);
                $post_content = $value->post_content; 
                echo '<div class="col-md-4">';
                    echo '<a href="'.$link.'">';
                        echo '<div class="brand-logo-wrapper">';
                            echo '<div class="brand-image hidden-xs" style="background-image:url('.$src.');"><span class="button">Explore</span></div>';
                            echo '<div class="brand-logo">';
                                echo '<img src="'.$logo.'" alt="'.$title.'">';
                            echo '</div>'; 
                        echo '</div>'; 
                    echo '</a>';
                echo '</div>';
                }else {
                echo 'No Brand Available';
                }
            }
            echo '</div>';
        echo '</div>';
    echo '</div>';
}else {
echo 'No Brand Available';
}
wp_reset_postdata();
?>