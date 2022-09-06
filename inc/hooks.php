<?php
/**
 * Check actiovation status for js plugins in theme options
 */
function theme_options_js_plugin() {
  global $opt_settings;
  echo '<!-- code below are generated dynamically by theme options -->';
  $match_height_selector = $opt_settings['opt-js-match-height-selector'];
  $match_height = $opt_settings['opt-enable-js-match-height'];
  $lazy_load = $opt_settings['opt-enable-lazy-load'];
  $owl_carousel = $opt_settings['opt-enable-owl-carousel'];

  $js_plugin = array(
    'match_height'  => $match_height,
  	'lazy_load' 		=> $lazy_load,
  	'owl_carousel'	=> $owl_carousel,
  );

  if( count($match_height_selector) > 0 && $match_height == '1' ) {
  	echo '<!-- Match height selectors -->';
  	echo '<input type="hidden" value="'.htmlspecialchars(json_encode($match_height_selector,JSON_FORCE_OBJECT)).'" id="match-height-selector">';
  }
  //Check enabled JS plugin in theme option
  echo '<input type="hidden" value="'.htmlspecialchars(json_encode($js_plugin, JSON_FORCE_OBJECT)).'" id="js-plugins">';
  echo '<!-- // -->';
}

/**
* Check activation status for pace js plugin
*/
function pace_js_init() {
  global $opt_settings;
  if( $opt_settings['opt-head-code'] != '' ) {
    echo '<!-- code below are generated dynamically by theme options -->';
    echo $opt_settings['opt-head-code'];
    echo '<!-- // -->';
  }
}

/**
* Get image attachment id from url
*/
function get_image_id( $attachment_url = '' ) {

	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url )
		return;

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}

/**
 * Replace all images src to data-src in the_content
 */
function replace_images_src( $content ) {
  global $opt_settings;
	if( $opt_settings['opt-enable-lazy-load'] == '1' ) {
		$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
	  $dom = new DOMDocument();
	  @$dom->loadHTML($content);

	  // Convert Images
	  $images = [];

	  foreach ($dom->getElementsByTagName('img') as $node) {
	    $images[] = $node;
	  }

	  foreach ($images as $node) {
	    $fallback = $node->cloneNode(true);

	    $oldsrc = $node->getAttribute('src');
      $image_id = get_image_id( $oldsrc );
      $placeholder = wp_get_attachment_image_src( $image_id, 'image-placeholder' )[0];
	    $node->setAttribute('data-src', $oldsrc );
	    $newsrc = get_template_directory_uri() . '/assets/images/placeholder.jpg';

      if( !$placeholder || $opt_settings['opt-lazy-load-blur'] != '1' ) {
        $placeholder = $newsrc;
      }

      $node->setAttribute('src', $placeholder);

	    $oldsrcset = $node->getAttribute('srcset');
	    $node->setAttribute('data-srcset', $oldsrcset );
	    $newsrcset = '';
	    $node->setAttribute('srcset', $newsrcset);

	    $classes = $node->getAttribute('class');
	    $newclasses = $classes . ' lazy';
	    $node->setAttribute('class', $newclasses);
      $node->setAttribute('style', 'background-color:#E8E8E8');

	    $noscript = $dom->createElement('noscript', '');
	    $node->parentNode->insertBefore($noscript, $node);
	    $noscript->appendChild($fallback);
	  }

	 $newHtml = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));
	 return $newHtml;
 }else {
   return $content;
 }
}

/**
* Compress CSS Code
*/
function compress($code) {
    $code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code);
    $code = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $code);
    $code = str_replace('{ ', '{', $code);
    $code = str_replace(' }', '}', $code);
    $code = str_replace('; ', ';', $code);

    return $code;
}

/**
* Add Custom CSS per page to header
*/
function render_custom_css() {
  echo '<style media="screen" type="text/css">';
  echo compress( custom_css_get_meta( 'custom-css-code' ) );
  echo '</style>';
}

add_filter( 'the_content', 'replace_images_src', 20 );
add_action('ize_head_hooks', 'pace_js_init');
add_action('ize_head_hooks', 'render_custom_css');
add_action('theme_options_js_plugin', 'theme_options_js_plugin');

function theme_add_widget_folders( $folders ){
    $folders[] = get_template_directory() . '/inc/admin/widget-folder/';
    return $folders;
}
add_action('siteorigin_widgets_widget_folders', 'theme_add_widget_folders');

function show_gallery_room_square($term) {
  $args = array(
    'post_type' => 'ize_gallery',
    'post_status' => 'publish',
    'posts_per_page' => '4',
    'tax_query' => array(
      array(
        'taxonomy' => 'gallery_cat',
        'field' => 'id',
        'terms' => $term
      )
    )
  );
  $cat = '';
  if (count($term) > 0) {
    foreach ($term as $key => $value) {
      $cat = get_term_by('id', $value, 'gallery_cat')->slug;
    }
  }
  $result = '';
  $postquery = new WP_Query($args);
  $count = 0;
  if($postquery->have_posts()) {
    $result .= '<div class="gallery-square" id="room-gallery">';
    foreach ($postquery->get_posts() as $key => $value) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($value->ID), 'full');
      $description = $value->post_content;
      $result .= '<a href="'.$image[0].'"  title="'.get_the_title($value->ID).'" data-description="'.$description.'" class="gr-item"><div style="background-image:url('.$image[0].');" class="ms-image"><div class="layer-1"></div></div></a>';
    }
    $result .= '</div>';
    $result .= '<div class="gallery-link">';
    $result .= '</div>';
    wp_reset_postdata();
  }
  return $result;
}

function show_gallery_image_home($type = 'all', $start = '0', $ppp = 5){
  $args = array(
    'post_type' => 'ize_gallery',
    'post_status' => 'publish',
    'posts_per_page' => $ppp,
    'offset' => $start
  );
  $result = '';
  $postquery = new WP_Query($args);
  $layout = array('square', 'landscape', 'landscape', 'square-65', 'square-35');
  $count = 0;
  if($postquery->have_posts()){

    foreach ($postquery->get_posts() as $key => $value) {
      
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($value->ID), 'full');
        $image_w = $image[1];
        $image_h = $image[2];
        if($count == 4) {
          $result .= '<div class="last-item ms-item ms-size--'.$layout[$count].' the-last"><div style="background-image:url('.$image[0].');" class="ms-image"><a href="'.get_home_url().'/gallery" class="explore-more">EXPLORE GALLERY</a></div></div>';
        }else {
          $result .= '<a href="'.$image[0].'"  title="'.get_the_title($value->ID).'" class="ms-item ms-size--'.$layout[$count].'"><div style="background-image:url('.$image[0].');" class="ms-image"></div></a>';
        }
        $count++;
        if(count($layout) == $count){
          $count = 0;
        }
      }
      
    wp_reset_postdata();
  }
  return $result;
}

function show_gallery_image($type = 'all', $start = '0', $ppp = 9){
  $args = array(
    'post_type' => 'ize_gallery',
    'post_status' => 'publish',
    'posts_per_page' => $ppp,
    'offset' => $start,
  );
  if($type !== 'all'){
    $args['tax_query'] = array(
        array(
          'taxonomy' => 'gallery_cat',
          'field' => 'slug',
          'terms' => $type
        )
      );
  }
  $result = '';
  $qpostquery = new WP_Query($args);
  $layout = array('square', 'landscape', 'landscape', 'potrait', 'square', 'potrait', 'square', 'potrait','landscape');
  $count = $start;
  if($qpostquery->have_posts()){
    foreach ($qpostquery->get_posts() as $key => $value) {
      
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($value->ID), 'full');
      $result .= '<a href="'.$image[0].'" title="'.get_the_title($value->ID).'" data-description="'.$value->post_description.'" data-alt="'.$value->post_title.'" class="ms-item ms-size--'.$layout[$count].'"><img src="'.$image[0].'" style="display:none;" alt="'.$value->post_title.'"><div style="background-image:url('.$image[0].');" class="ms-image"></div></a>';

      $count++;
      if(count($layout) == $count){
        $count = 0;
      }
    }
    wp_reset_postdata();
  }
  return $result;
}
add_action( 'wp_ajax_nopriv_show_gallery_ajax', 'show_gallery_ajax' );
add_action( 'wp_ajax_show_gallery_ajax', 'show_gallery_ajax' );

function show_gallery_ajax() {
  if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		echo show_gallery_image($_POST['data']['type'], $_POST['data']['offset'], 9);
	}
	die();
}
function izeTruncate( $string, $limit, $break=" ", $pad="...") {

 // return with no change if string is shorter than $limit
 if(strlen($string) <= $limit){
    return $string;
 }

 $string = substr($string, 0, $limit);
 if(false !== ($breakpoint = strrpos($string, $break))){
    $string = substr($string, 0, $breakpoint);
 }
 return $string . $pad;
}
function get_excerpt_by_id($post_id){
    if (has_excerpt($post_id)) {
      $the_excerpt = apply_filters( 'the_excerpt', get_the_excerpt($post_id) );
    } else {
      $the_excerpt = '';
    }
    return $the_excerpt;
}

// Get ACF registered Gutenberg blocks
add_action('acf/init', 'jardine_gt_acf_init');
function jardine_gt_acf_init() {
    if( !function_exists('acf_register_block') ) return;

    foreach (glob(get_template_directory().'/blocks/md/*.md') as $file) {
        $content = file_get_contents($file);
        $content = str_replace(['\r\n', '\r'], '\n', $content);
        $content = explode('=====', $content);
        $content = $content[0];
        $content = explode(PHP_EOL, $content);

        $arg = [];
        foreach ($content as $config){
            $opt = explode(':', $config);
            switch ($opt[0]){
                case 'slug':
                    if(isset($opt[1])) {
                        $arg['name'] = strtolower( str_replace(' ', '_', trim($opt[1])) );
                    }
                    break;
                case 'title':
                    if(isset($opt[1])) {
                        $arg['title'] = trim($opt[1]);
                    }
                    break;
                case 'description':
                    if(isset($opt[1])) {
                        $arg['description'] = trim($opt[1]);
                    }
                    break;
                case 'category':
                    if(isset($opt[1])) {
                        $arg['category'] = trim($opt[1]);
                    }
                    break;
                case 'icon':
                    if(isset($opt[1])) {
                        $arg['icon'] = trim($opt[1]);
                    }
                    break;
                case 'keywords':
                    if(isset($opt[1])) {
                        $arg['keywords'] = explode(',', trim($opt[1]));
                    }
                    break;
                case 'multiple':
                    if(isset($opt[1])) {
                        $multiple_opt = true;

                        if(trim($opt[1]) == 'false'){
                            $multiple_opt = false;
                        }

                        $arg['supports']['multiple'] = $multiple_opt;
                    }
                    break;
            }
        }
        if(!isset($arg['name'])) return;

        $arg['render_callback'] = 'jardine_block_render_callback';

        acf_register_block($arg);
    }
}

function jardine_block_render_callback($block){
  $slug = str_replace('acf/', '', $block['name']);

  if(file_exists(get_template_directory()."/blocks/php/{$slug}.php")) {
      if (is_admin()) {
        $php = '<div style="background: #0473aa; color: #fff; padding: 20px;position: relative;">'.ucwords(str_replace('-',' ', $slug)).' Content<span style="position: absolute;bottom: 0; right: 10px;padding: 5px 10px;font-size: 8px;background:#f5f5f5; color: #232323;">change template by editing file '.$slug.'.php</span></div>';
        echo $php;
      } else {
        include( get_template_directory()."/blocks/php/{$slug}.php" );
      }
  } else {
      $file = get_template_directory()."/blocks/php/".$slug.".php";
      $php = '<div style="background: #eee;padding: 20px;position: relative;">'.ucwords(str_replace('-',' ', $slug)).' Content<span style="position: absolute;bottom: 0; right: 10px;padding: 5px 10px;font-size: 8px;background:#ddd;">change template by editing file '.$slug.'.php</span></div>';
      if(!file_put_contents($file, $php)){
          die("Error: failed to write data to ".$slug.".php");
      }

  }
}

