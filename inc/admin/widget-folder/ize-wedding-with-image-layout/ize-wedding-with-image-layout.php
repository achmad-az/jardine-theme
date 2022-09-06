<?php

/*
Widget Name: IZE : Wedding With Image Layout
Description: Wedding With Image Layout
Author: -
Author URI: -
*/

class SiteOrigin_Widget_ize_wedding_image_layout extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'ize-wedding-with-image',
			__( 'IZE : Wedding With Image Layout', 'ize-theme-bundle' ),
			array(
				'description' => __( 'Wedding With Image Layout', 'ize-theme-bundle' ),
        'panels_groups' => array('ize')
			),
			array(),
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	function get_widget_form() {
		return array(
      'title' => array(
        'type' => 'text',
        'label' => __( 'Title', 'ize-theme-bundle' )
      ),
      'subtitle' => array(
        'type' => 'textarea',
        'label' => __( 'Subtitle', 'ize-theme-bundle' ),
        'default' => ''
      ),
      'layout' => array(
			  'type' => 'select',
			  'label' => __( 'Select Layout', 'ize-theme-bundle' ),
			  'default' => '',
			  'options' => array(
          'right' => 'Image Right',
          'left' => 'Image Left',
        )
			),
      'image' => array(
          'type' => 'media',
          'label' => __( 'Image', 'widget-form-fields-text-domain' ),
          'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
          'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
          'library' => 'image',
          'fallback' => true
      ),
      'description' => array(
        'type' => 'tinymce',
        'label' => __( 'Description', 'ize-theme-bundle' ),
        'default' => '',
        'rows' => 8,
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
      'text_link' => array(
        'type' => 'text',
        'label' => __( 'Text Link', 'ize-theme-bundle' ),
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

siteorigin_widget_register( 'ize-wedding-with-image', __FILE__, 'SiteOrigin_Widget_ize_wedding_image_layout' );
