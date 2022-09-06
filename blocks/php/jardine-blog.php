<?php
global $post;

$items = get_field('posts');

if($items != ''){?>
<div class="blog-list-wrapper">
    <div class="container-fluid nopadding">
            <?php foreach ($items as $key => $value) {
                if(get_post_type($value->ID) == 'post'){
                $src = wp_get_attachment_image_src(get_post_thumbnail_id( $value->ID ), 'large')[0];
                $link = get_the_permalink($value->ID);
                $title = get_the_title($value->ID);
                $post_content = $value->post_content;?>
                <div class="blog-loop-wrapper nopadding">   
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="item-text-blog .blog-content-wrapper">
                                    <h2><?php echo $title?></h2>
                                    <a href="<?php echo $link?>"><span class="button">Explore</span></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="item-image-blog">
                            <a href="<?php echo $link?>">
                                <div class="blog-image" style="background-image:url(<?php echo $src?>);"></div></a>
                            </div>
                        </div>
                    </div>
                </div><?php
                }else {
                echo 'No Brand Available';
                }
            }?>
            </div>
    </div><?php
}else {
echo 'No Brand Available';
}
wp_reset_postdata();
?>