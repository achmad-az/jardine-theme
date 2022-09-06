<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package jardine_Master_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ize_master_theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'ize_master_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ize_master_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ize_master_theme_pingback_header' );

/**
* Customize Post Table
*/
function bs_event_table_head( $defaults ) {
	$new = array();
	$new['thumbnail'] = 'Thumbnail';
	$new['title_image'] = 'Title';
	$new['category'] = 'Category';
  return $new;
}

add_filter('manage_ize_gallery_posts_columns', 'bs_event_table_head');

/**
* Add Content to Custom Column
*/
function bs_event_table_content( $column_name, $post_id ) {
		$image_id = get_post_thumbnail_id( $post_id );
    if ($column_name == 'thumbnail') {
			$image_url = get_template_directory_uri() . '/assets/images/placeholder.jpg';
			if( (int)$image_id != 0 ) {
				$image_url = wp_get_attachment_image_src( (int)$image_id, 'thumbnail' )[0];
			}
			echo '<img src="'.$image_url.'" width="75" height="75" />';
    }
		if ($column_name == 'title_image') {
			echo (get_the_title($post_id) != '' ) ? get_the_title($post_id) : get_the_title($image_id);
    }

		if( $column_name == 'category' ) {
			echo get_the_terms( $post_id, 'gallery_cat' ) ? get_the_terms( $post_id, 'gallery_cat' )[0]->name : '-';
		}
	// 	if ($column_name == 'type') {

	// 		foreach ( $just as $key => $label ) {
	// 		    echo $label;
	// 		}
    // }
		// if($column_name == 'image_size') {
		// 	$image_size = '-';
		// 	if( (int)$image_id != 0 ) {
		// 		$image_size = wp_get_attachment_image_src( (int)$image_id, 'full' )[1].'x'.wp_get_attachment_image_src( (int)$image_id, 'full' )[2];
		// 	}
		// 	echo $image_size;
		// }

}

add_action( 'manage_ize_gallery_posts_custom_column', 'bs_event_table_content', 10, 2 );

// To make column sortable
add_filter( 'manage_ize_gallery_sortable_columns', 'bs_event_table_sorting' );
function bs_event_table_sorting( $columns ) {
    $columns['category'] = 'Category';
    return $columns;
}

function custom_ize_group($tabs) {
    $tabs[] = array(
        'title' => __('IZE Widget', 'ize'),
        'filter' => array(
            'groups' => array('ize')
        )
    );

    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'custom_ize_group', 20);

// Function that outputs the contents of the dashboard widget
function dashboard_widget_function( $post, $callback_args ) {
	ob_start();
	?>
		<p>
			Setting up the THEME
		</p>
		<ol>
			<li>Make sure wordpress instalation is fresh / delete all post, page, menu before doing setup</li>
			<li>Make sure you have installed all plugin required by the theme</li>
			<li>install manualy plugin WPML, we can't do this automatically because of pro version plugin and need license</li>
			<li>Click <a href="#" class="import-cfs-button">this</a> once, and wait an alert say "Succesfull Import"
				<input type="hidden" name="importCFS" value="[{&quot;post_title&quot;:&quot;Page Images&quot;,&quot;post_name&quot;:&quot;page-images&quot;,&quot;cfs_extras&quot;:{&quot;order&quot;:&quot;0&quot;,&quot;context&quot;:&quot;normal&quot;,&quot;hide_editor&quot;:&quot;0&quot;},&quot;cfs_fields&quot;:[{&quot;id&quot;:14,&quot;name&quot;:&quot;show_header_image&quot;,&quot;label&quot;:&quot;Show Header Image&quot;,&quot;type&quot;:&quot;true_false&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:0,&quot;options&quot;:{&quot;message&quot;:&quot;Check this to show header image&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;1&quot;,&quot;name&quot;:&quot;images&quot;,&quot;label&quot;:&quot;Images&quot;,&quot;type&quot;:&quot;loop&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:1,&quot;options&quot;:{&quot;row_display&quot;:&quot;0&quot;,&quot;row_label&quot;:&quot;Image&quot;,&quot;button_label&quot;:&quot;Add an Image&quot;,&quot;limit_min&quot;:&quot;0&quot;,&quot;limit_max&quot;:&quot;10&quot;}},{&quot;id&quot;:&quot;2&quot;,&quot;name&quot;:&quot;image&quot;,&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;file&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:1,&quot;weight&quot;:2,&quot;options&quot;:{&quot;file_type&quot;:&quot;image&quot;,&quot;return_value&quot;:&quot;id&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:15,&quot;name&quot;:&quot;image_text&quot;,&quot;label&quot;:&quot;Image Text&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;Leave this empty to not showing any text into the header image, only worked on homepage.&quot;,&quot;parent_id&quot;:1,&quot;weight&quot;:3,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}}],&quot;cfs_rules&quot;:{&quot;post_types&quot;:{&quot;operator&quot;:&quot;==&quot;,&quot;values&quot;:[&quot;post&quot;,&quot;page&quot;,&quot;room&quot;,&quot;special_offer&quot;]}}},{&quot;post_title&quot;:&quot;Room Fields&quot;,&quot;post_name&quot;:&quot;room-fields&quot;,&quot;cfs_extras&quot;:{&quot;order&quot;:&quot;-1&quot;,&quot;context&quot;:&quot;normal&quot;,&quot;hide_editor&quot;:&quot;0&quot;},&quot;cfs_fields&quot;:[{&quot;id&quot;:&quot;3&quot;,&quot;name&quot;:&quot;room_size&quot;,&quot;label&quot;:&quot;Room Size&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;*40sqm&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:0,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;9&quot;,&quot;name&quot;:&quot;floor_plan&quot;,&quot;label&quot;:&quot;Floor Plan&quot;,&quot;type&quot;:&quot;file&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:1,&quot;options&quot;:{&quot;file_type&quot;:&quot;image&quot;,&quot;return_value&quot;:&quot;url&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;10&quot;,&quot;name&quot;:&quot;gallery_select&quot;,&quot;label&quot;:&quot;Gallery Select&quot;,&quot;type&quot;:&quot;term&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:2,&quot;options&quot;:{&quot;taxonomies&quot;:[&quot;gallery_cat&quot;],&quot;limit_min&quot;:&quot;&quot;,&quot;limit_max&quot;:&quot;&quot;}},{&quot;id&quot;:&quot;6&quot;,&quot;name&quot;:&quot;special_offer&quot;,&quot;label&quot;:&quot;Special Offer&quot;,&quot;type&quot;:&quot;wysiwyg&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:3,&quot;options&quot;:{&quot;formatting&quot;:&quot;default&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;13&quot;,&quot;name&quot;:&quot;booking_button&quot;,&quot;label&quot;:&quot;Booking Button&quot;,&quot;type&quot;:&quot;hyperlink&quot;,&quot;notes&quot;:&quot;leave empty to not showing this button&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:4,&quot;options&quot;:{&quot;format&quot;:&quot;php&quot;}},{&quot;id&quot;:&quot;4&quot;,&quot;name&quot;:&quot;room_features&quot;,&quot;label&quot;:&quot;Room Features&quot;,&quot;type&quot;:&quot;loop&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:5,&quot;options&quot;:{&quot;row_display&quot;:&quot;0&quot;,&quot;row_label&quot;:&quot;Room Features&quot;,&quot;button_label&quot;:&quot;Add New&quot;,&quot;limit_min&quot;:&quot;&quot;,&quot;limit_max&quot;:&quot;&quot;}},{&quot;id&quot;:&quot;11&quot;,&quot;name&quot;:&quot;icon&quot;,&quot;label&quot;:&quot;icon&quot;,&quot;type&quot;:&quot;file&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:4,&quot;weight&quot;:6,&quot;options&quot;:{&quot;file_type&quot;:&quot;image&quot;,&quot;return_value&quot;:&quot;id&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;12&quot;,&quot;name&quot;:&quot;text&quot;,&quot;label&quot;:&quot;text&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:4,&quot;weight&quot;:7,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;5&quot;,&quot;name&quot;:&quot;amenities&quot;,&quot;label&quot;:&quot;Amenities&quot;,&quot;type&quot;:&quot;loop&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:8,&quot;options&quot;:{&quot;row_display&quot;:&quot;0&quot;,&quot;row_label&quot;:&quot;Amenities Content&quot;,&quot;button_label&quot;:&quot;Add New&quot;,&quot;limit_min&quot;:&quot;&quot;,&quot;limit_max&quot;:&quot;&quot;}},{&quot;id&quot;:&quot;7&quot;,&quot;name&quot;:&quot;icon&quot;,&quot;label&quot;:&quot;icon&quot;,&quot;type&quot;:&quot;file&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:5,&quot;weight&quot;:9,&quot;options&quot;:{&quot;file_type&quot;:&quot;image&quot;,&quot;return_value&quot;:&quot;id&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;8&quot;,&quot;name&quot;:&quot;text&quot;,&quot;label&quot;:&quot;text&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:5,&quot;weight&quot;:10,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}}],&quot;cfs_rules&quot;:{&quot;post_types&quot;:{&quot;operator&quot;:&quot;==&quot;,&quot;values&quot;:[&quot;room&quot;]}}},{&quot;post_title&quot;:&quot;special offer link&quot;,&quot;post_name&quot;:&quot;special-offer-link&quot;,&quot;cfs_extras&quot;:{&quot;order&quot;:&quot;0&quot;,&quot;context&quot;:&quot;normal&quot;,&quot;hide_editor&quot;:&quot;0&quot;},&quot;cfs_fields&quot;:[{&quot;id&quot;:&quot;16&quot;,&quot;name&quot;:&quot;special_offer_link&quot;,&quot;label&quot;:&quot;Special Offer Link&quot;,&quot;type&quot;:&quot;hyperlink&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:0,&quot;options&quot;:{&quot;format&quot;:&quot;php&quot;}}],&quot;cfs_rules&quot;:{&quot;post_types&quot;:{&quot;operator&quot;:&quot;==&quot;,&quot;values&quot;:[&quot;special_offer&quot;]}}},{&quot;post_title&quot;:&quot;Location&quot;,&quot;post_name&quot;:&quot;location&quot;,&quot;cfs_extras&quot;:{&quot;order&quot;:&quot;0&quot;,&quot;context&quot;:&quot;normal&quot;,&quot;hide_editor&quot;:&quot;0&quot;},&quot;cfs_fields&quot;:[{&quot;id&quot;:17,&quot;name&quot;:&quot;place_name&quot;,&quot;label&quot;:&quot;Place Name&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:0,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:18,&quot;name&quot;:&quot;latitude&quot;,&quot;label&quot;:&quot;Latitude&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:1,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:19,&quot;name&quot;:&quot;longtitude&quot;,&quot;label&quot;:&quot;longtitude&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:2,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:20,&quot;name&quot;:&quot;place_description&quot;,&quot;label&quot;:&quot;Place Description&quot;,&quot;type&quot;:&quot;wysiwyg&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:3,&quot;options&quot;:{&quot;formatting&quot;:&quot;default&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:21,&quot;name&quot;:&quot;get_direction&quot;,&quot;label&quot;:&quot;Get Direction Link&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:4,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}}],&quot;cfs_rules&quot;:{&quot;post_types&quot;:{&quot;operator&quot;:&quot;==&quot;,&quot;values&quot;:[&quot;location_custom&quot;]}}},{&quot;post_title&quot;:&quot;gallery&quot;,&quot;post_name&quot;:&quot;gallery&quot;,&quot;cfs_extras&quot;:{&quot;order&quot;:&quot;0&quot;,&quot;context&quot;:&quot;normal&quot;,&quot;hide_editor&quot;:&quot;0&quot;},&quot;cfs_fields&quot;:[{&quot;id&quot;:&quot;22&quot;,&quot;name&quot;:&quot;alt_image&quot;,&quot;label&quot;:&quot;alt&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:0,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;23&quot;,&quot;name&quot;:&quot;description_image&quot;,&quot;label&quot;:&quot;description&quot;,&quot;type&quot;:&quot;textarea&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:1,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;formatting&quot;:&quot;auto_br&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;24&quot;,&quot;name&quot;:&quot;type&quot;,&quot;label&quot;:&quot;type&quot;,&quot;type&quot;:&quot;select&quot;,&quot;notes&quot;:&quot;&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:2,&quot;options&quot;:{&quot;choices&quot;:{&quot;image&quot;:&quot;Image&quot;,&quot;video&quot;:&quot;Video&quot;,&quot;html&quot;:&quot;HTML&quot;},&quot;multiple&quot;:&quot;0&quot;,&quot;select2&quot;:&quot;0&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;25&quot;,&quot;name&quot;:&quot;video_link&quot;,&quot;label&quot;:&quot;Video Link&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;make sure the video source is from youtube, just insert the link.\r\nexample : https:\/\/www.youtube.com\/watch?v=3tmd-ClpJxA&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:3,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;27&quot;,&quot;name&quot;:&quot;video_thumbnail&quot;,&quot;label&quot;:&quot;Video Thumbnail&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;leave this empty, it will generate thumbnail automatically after this item is published&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:4,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:28,&quot;name&quot;:&quot;id_video&quot;,&quot;label&quot;:&quot;ID Video&quot;,&quot;type&quot;:&quot;text&quot;,&quot;notes&quot;:&quot;keep this empty, it will generate automatically&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:5,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;required&quot;:&quot;0&quot;}},{&quot;id&quot;:&quot;26&quot;,&quot;name&quot;:&quot;html&quot;,&quot;label&quot;:&quot;HTML&quot;,&quot;type&quot;:&quot;textarea&quot;,&quot;notes&quot;:&quot;you can insert html here, like iframe or custom html element.&quot;,&quot;parent_id&quot;:0,&quot;weight&quot;:6,&quot;options&quot;:{&quot;default_value&quot;:&quot;&quot;,&quot;formatting&quot;:&quot;none&quot;,&quot;required&quot;:&quot;0&quot;}}],&quot;cfs_rules&quot;:{&quot;post_types&quot;:{&quot;operator&quot;:&quot;==&quot;,&quot;values&quot;:[&quot;ize_gallery&quot;]}}}]">
			</li>
			<li>Download <a href="/wp-content/themes/jardine_Master_Theme/plugins/import.xml" class="import-xml-button">this</a> file, and go to Tools -> Import -> wordpress importer -> run import -> upload the file -> check "Download Media and Attachment" </li>
			<li>
				Copy this code below to Theme Option -> Export Import -> import from file, and fill the field with the code. *make sure you copy all of the code below
				<textarea readonly style="width:100%;height:200px;resize:none;">{"last_tab":"1","opt-navbar-logo":{"url":"/wp-content/uploads/2017/08/logo-ize.png","id":"28","height":"543","width":"800","thumbnail":"/wp-content/uploads/2017/08/logo-ize-150x150.png"},"opt-navbar-logo-loader":{"url":"/wp-content/uploads/2017/09/ize-seminyak.jpeg","id":"410","height":"300","width":"300","thumbnail":"/wp-content/uploads/2017/09/ize-seminyak-150x150.jpeg"},"opt-favicon":{"url":"/wp-content/uploads/2017/08/favicon-ize.png","id":"30","height":"27","width":"50","thumbnail":"/wp-content/uploads/2017/08/favicon-ize-10x10.png"},"opt-btnbook-color":"#00a1da","opt-btnbook-backcolor":"transparent","opt-use-custom-body-paragrap-font":"","opt-typography-body":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"Normal 400","font-style":"","subsets":"","text-align":"","font-size":"15px","color":"#464646"},"opt-use-custom-body-heading-font":"","opt-typography-heading":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"Normal 400","font-style":"","subsets":"","color":"#464646"},"opt-use-custom-body-link-font":"","opt-typography-link":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"Normal 400","font-style":"","subsets":""},"opt-enable-facebook":"1","opt-facebook-url":"https://www.facebook.com/IzeSeminyak","opt-enable-twitter":"","opt-twitter-url":"https://twitter.com","opt-enable-google-plus":"","opt-google-plus-url":"https://plus.google.com","opt-enable-instagram":"1","opt-instagram-url":"https://www.instagram.com/lifestyleretreats/","opt-enable-youtube":"1","opt-youtube-url":"https://youtube.com","opt-enable-linkedin":"","opt-linkedin-url":"https://linkedin.com","opt-enable-pinterest":"","opt-pinterest-url":"https://pinterest.com","opt-intro-text":"","opt-booking-title":"Book Now","opt-booking-btntext":"CHECK AVAILABILITY","opt-booking-btnsubtext":"BEST PRICE GUARANTEED","opt-booking-childvalid":"Valid for age > 16","opt-booking-check-special-offer-link":"#specialoffer","opt-booking-check-special-offer-link-text":"Check Special Offers","opt-company-name":"IZE SEMINYAK","opt-email":"bliss@ize-seminyak.com","opt-phone":"+62-361 84 66 999","opt-address":"Jalan Kayu Aya (Laksmana - Oberoi) No. 68\r\nSeminyak, Bali - Indonesia","opt-menu-list":"<ul class=\"menu-footer\">\r\n<li><a href=\"/about-us/\">ABOUT</a></li>\r\n<li><a href=\"#\">REWARDS</a></li>\r\n<li><a href=\"#\">CAREERS</a></li>\r\n<li><a href=\"/contact\">CONTACT US</a></li>\r\n</ul>","opt-custom-css":"","opt-head-code":"","opt-footer-code":"","opt-enable-bootstrap":"1","opt-enable-font-awesome":"1","opt-enable-lazy-load":"","opt-lazy-load-blur":"1","opt-enable-pace-js":"1","opt-enable-animate-css":"1","opt-enable-owl-carousel":"1","opt-owl-carousel":"","opt-enable-js-match-height":"enable","opt-js-match-height-selector":[""],"opt-location-title-content":"Our Location","opt-location-desc-content":"Lorem ipsum dolor sit amet, quaeque aliquid vim ex. Eu doming dolorem vel, te corpora dignissim interesset pri. Mea ut vidisse labores intellegebat, qui everti urbanitas intellegam ei","opt-location-discover-title":"Discover Bali","opt-loc-lat":"-8.684196","opt-loc-long":"115.1584383","opt-loc-title":"IZE SEMINYAK","opt-loc-description":"Jalan Kayu Aya (Laksmana – Oberoi) No. 68 Seminyak, Bali – Indonesia","opt-loc-link":"https://goo.gl/maps/EWRvDzgMtx12","opt-location-icon":{"url":"/wp-content/uploads/2017/10/ize-map-pin-small.png","id":"487","height":"64","width":"45","thumbnail":"/wp-content/uploads/2017/10/ize-map-pin-small-10x10.png"},"opt-footer-logo":{"url":"/wp-content/uploads/2017/08/logo-ize.png","id":"28","height":"543","width":"800","thumbnail":"/wp-content/uploads/2017/08/logo-ize-150x150.png"},"opt-copyright-text":"©[current-year] Lifestyle Retreats Pte Ltd. All rights reserved.","opt-developer-signature":"2017","opt-footer-logo-1":{"url":"/wp-content/uploads/2017/09/logo-lifestyle.png","id":"248","height":"23","width":"152","thumbnail":"/wp-content/uploads/2017/09/logo-lifestyle-150x23.png"},"opt-footer-logo-link-1":"http://www.lifestyleretreats.com","opt-footer-logo-2":{"url":"/wp-content/uploads/2017/09/logo-thebale.png","id":"247","height":"26","width":"101","thumbnail":"/wp-content/uploads/2017/09/logo-thebale-10x10.png"},"opt-footer-logo-link-2":"http://www.thebale.com","opt-footer-logo-3":{"url":"/wp-content/uploads/2017/09/logo-theamalia.png","id":"246","height":"25","width":"128","thumbnail":"/wp-content/uploads/2017/09/logo-theamalia-10x10.png"},"opt-footer-logo-link-3":"http://www.theamala.com/","opt-footer-logo-4":{"url":"/wp-content/uploads/2017/09/logo-themenjangan.png","id":"245","height":"25","width":"185","thumbnail":"/wp-content/uploads/2017/09/logo-themenjangan-150x25.png"},"opt-footer-logo-link-4":"http://www.themenjangan.com/","opt-footer-logo-5":{"url":"/wp-content/uploads/2017/09/logo-ize.png","id":"244","height":"30","width":"44","thumbnail":"/wp-content/uploads/2017/09/logo-ize-10x10.png"},"opt-footer-logo-link-5":"http://www.ize-seminyak.com/","opt-footer-logo-6":{"url":"/wp-content/uploads/2017/09/logo-thesantai.png","id":"243","height":"24","width":"123","thumbnail":"/wp-content/uploads/2017/09/logo-thesantai-10x10.png"},"opt-footer-logo-link-6":"http://www.thesantai.com/","opt-footer-logo-7":{"url":"/wp-content/uploads/2017/09/logo-thesamata.png","id":"242","height":"24","width":"137","thumbnail":"/wp-content/uploads/2017/09/logo-thesamata-10x10.png"},"opt-footer-logo-link-7":"http://www.thesamata.com/","opt-owl-carousel-page":"","opt-owl-carousel-custom-post":"","redux_import_export":"","redux-backup":1}</textarea>
			</li>
		</ol>
	<?php
	echo ob_get_clean();
}

// Function used in the action hook
function add_dashboard_widgets() {
	wp_add_dashboard_widget('dashboard_widget', 'SETUP THEME', 'dashboard_widget_function');
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'add_dashboard_widgets' );
