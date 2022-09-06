<?php
global $post;

$title = get_field('section_title');
$changecolor = get_field('titlecolor');
$description = get_field('section_description');
$is_link = get_field('is_link');
$bg_color = (get_field('background_color')) ? get_field('background_color') : '#ffffff';
$cssid = get_field('cssid');
?>
<div class="wow fadeIn content-wrapper" style="background-color: <?php echo $bg_color; ?>">
    <div class="jardine-container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="home-intro-content">
                <?php
                    if($title != ''){
                        echo '<h2 id="jardine-block-'.$cssid.'" data-text="'.$changecolor.'" class="title-intro">'.$title.'<span class="smile"></span></h2>';
                    }

                    if($description != ''){
                        echo '<div class="description">'.wpautop($description).'</div>';
                    }

                    if($is_link == 1){
                        $link_text = get_field('link_text');
                        $url = get_field('url');
                        echo '<div class="link-wrapper"><a href="'.esc_url($url).'">'.$link_text.'</a></div>';
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>