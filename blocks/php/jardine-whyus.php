<?php
global $post;

$items = get_field('why_us');
if (is_array($items)){
    if(count($items) > 0) {
        echo '<div class="whyus-wrapper">';
        echo '<div class="jardine-container">';
            echo '<div class="row">';
                echo '<div id="relatedContent" class="owl-carousel run-carousel post-carousel owl-loaded owl-drag">';
                    foreach ($items as $key => $value) {
                        $number = $value['number'];
                        $title = $value['title'];
                        $desc = $value['short_description'];
                            echo '<div class="whyus-item" >';
                                echo '<span class="number">'.$number.'</span>';
                                echo '<span class="title">'.$title.'</span>';
                                echo '<span class="desc">'.$desc.'</span>';
                            echo '</div>'; 
                        
                    }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}else {
echo 'No Item Available';
}
wp_reset_postdata();
?>