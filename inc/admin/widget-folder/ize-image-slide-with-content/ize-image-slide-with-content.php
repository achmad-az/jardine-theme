<?php

/*
Widget Name: IZE : image slide with content
Description: image slide with content
Author: -
Author URI: -
*/

class SiteOrigin_Widget_image_slide_with_content extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'ize-image-slide-with-content',
			__( 'IZE : image slide with content', 'ize-theme-bundle' ),
			array(
				'description' => __( 'image slide with content', 'ize-theme-bundle' ),
        'panels_groups' => array('ize')
			),
			array(),
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	function get_widget_form() {
		return array(
      'heading' => array(
        'type' => 'text',
        'label' => __( 'Heading', 'ize-theme-bundle' )
      ),
      'content' => array(
        'type' => 'tinymce',
        'label' => __( 'Side Content', 'ize-theme-bundle' ),
        'default' => '',
        'rows' => 10,
        'default_editor' => 'html',
        'button_filters' => array(
            'mce_buttons' => array( $this, 'filter_mce_buttons' ),
            'mce_buttons_2' => array( $this, 'filter_mce_buttons_2' ),
            'mce_buttons_3' => array( $this, 'filter_mce_buttons_3' ),
            'mce_buttons_4' => array( $this, 'filter_mce_buttons_5' ),
            'quicktags_settings' => array( $this, 'filter_quicktags_settings' ),
        ),
      ),
      'link' => array(
        'type' => 'link',
        'label' => __( 'Link', 'ize-theme-bundle' ),
      ),
      'link_text' => array(
        'type' => 'text',
        'label' => __( 'Link Text', 'ize-theme-bundle' ),
        'default' => 'Explore More'
      ),
      'type' => array(
			  'type' => 'select',
			  'label' => __( 'Select Post Type', 'ize-theme-bundle' ),
			  'default' => 'content-right',
			  'options' => array(
          'content-right' => 'Content Right',
          'content-bottom' => 'Content Bottom'
        )
			),
      'section_loop' => array(
        'type' => 'repeater',
        'label' => __( 'Image Slider' , 'widget-form-fields-text-domain' ),
        'item_name'  => __( 'Image', 'siteorigin-widgets' ),
        'item_label' => array(
            'selector'     => "[id*='content_image']",
            'update_event' => 'change',
            'value_method' => 'val'
        ),
        'fields' => array(
            'content_image' => array(
                'type' => 'media',
                'label' => __( 'Image', 'widget-form-fields-text-domain' ),
                'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                'library' => 'image',
                'fallback' => true
            )
        )
    )
		);
	}


	function get_less_variables( $instance ) {
		return array();
	}

	/**
	 * Get the template variables for the headline
	 *
	 * @param $instance
	 * @param $args
	 *
	 * @return array
	 */
	function get_template_variables( $instance, $args ) {
		return array(

    );
	}
}

siteorigin_widget_register( 'ize-image-slide-with-content', __FILE__, 'SiteOrigin_Widget_image_slide_with_content' );
