<?php
global $post;

$title = get_field('title');
$textcolor = get_field('title_colour');
$partner = get_field('partner-logo');
$is_link = get_field('is_link');
$bg_color = (get_field('background_color')) ? get_field('background_color') : '#ffffff';
?>
<div class="wow fadeIn content-wrapper" style="background-color: <?php echo $bg_color; ?>">
    <div class="jardine-container">
        <div class="row">
            <div class="col-md-12">
                <div class="partner-logo-wrapp">
                    <?php
                        if($title != ''){
                            echo '<h2 style="color:'.$textcolor.'" class="title-partner">'.$title.'<span class="smile"></span></h2>';
                        }

                        if (is_array($partner)){
                            if(count($partner) > 0) {
                                echo '<div class="partner-logo-content" >';
                                    echo '<div class="row">';
                                foreach ($partner as $key => $value) {
                                    $image = $value['partner_image'];
                                    
                                        echo '<div class="col-lg-2 col-xs-4" >';
                                            echo '<div class="brand-logo"> <img src="'.$image['url'].'" alt=""></div>';
                                        echo '</div>';
                                    
                                }
                                    echo '</div>';
                                echo '</div>';
                            }
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