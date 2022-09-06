<?php

/*
Widget Name: IZE : Wedding Text Layout
Description: Wedding Text Layout
Author: -
Author URI: -
*/

class SiteOrigin_Widget_ize_wedding_text_layout extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'ize-wedding-text-layout',
			__( 'IZE : Wedding Text Layout', 'ize-theme-bundle' ),
			array(
				'description' => __( 'Wedding Text Layout', 'ize-theme-bundle' ),
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
      'icon' => array(
          'type' => 'media',
          'label' => __( 'Icon', 'widget-form-fields-text-domain' ),
          'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
          'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
          'library' => 'image',
          'fallback' => true
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

siteorigin_widget_register( 'ize-wedding-text-layout', __FILE__, 'SiteOrigin_Widget_ize_wedding_text_layout' );
