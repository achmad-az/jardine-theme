<?php
global $post;

$title = get_field('title');
$textcolor = get_field('title_colour');
$award = get_field('award-logo');
$is_link = get_field('is_link');
$bg_color = (get_field('background_color')) ? get_field('background_color') : '#ffffff';
?>
<div class="wow fadeIn content-wrapper" style="background-color: <?php echo $bg_color; ?>">
    <div class="jardine-container">
        <div class="row">
            <div class="col-md-12">                
                <?php
                    if($title != ''){
                        echo '<h2 style="color:'.$textcolor.'" class="title-partner">'.$title.'<span class="smile"></span></h2>';
                    }

                    if (is_array($award)){
                        if(count($award) > 0) {
                            echo '<div class="award-logo-wrapper" >';
                                echo '<div class="row">';
                            foreach ($award as $key => $value) {
                                $image = $value['award_image'];
                                $title = $value['title_award'];
                                $desc = $value['award_descriptio'];
                                $loc = $value['location'];
                                
                                    echo '<div class="col-md-4" >';
                                        echo '<div class="award-logo-content" >';
                                            echo '<div class="award-logo"> <img src="'.$image['url'].'" alt=""></div>';
                                            echo '<h2 class="award">'.$title.'</h2>';
                                            echo '<div class="award-desc">'.$desc.'</div>';
                                            echo '<span class="award-location">'.$loc.'</span>';
                                        echo '</div>';
                                    echo '</div>';
                                
                            }
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    if($is_link == 1){
                        $link_text = get_field('link_text');
                        $url = get_field('url');
                        echo '<div class="award-link-wrapper"><a href="'.esc_url($url).'">'.$link_text.'</a></div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>