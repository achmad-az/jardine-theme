<?php

/*
Widget Name: IZE : Three Column layout
Description: Three Column layout
Author: -
Author URI: -
*/

class SiteOrigin_Widget_ize_three_column extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'three-column-layout',
			__( 'IZE : Three Column layout', 'ize-theme-bundle' ),
			array(
				'description' => __( 'Three Column layout', 'ize-theme-bundle' ),
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
      'section_loop' => array(
        'type' => 'repeater',
        'label' => __( 'Column Content' , 'widget-form-fields-text-domain' ),
        'item_name'  => __( 'Column item', 'siteorigin-widgets' ),
        'item_label' => array(
            'selector'     => "[id*='column_title']",
            'update_event' => 'change',
            'value_method' => 'val'
        ),
        'fields' => array(
            'column_title' => array(
                'type' => 'text',
                'label' => __( 'Title', 'widget-form-fields-text-domain' )
            ),
            'column_image' => array(
                'type' => 'media',
                'label' => __( 'Image', 'widget-form-fields-text-domain' ),
                'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                'library' => 'image',
                'fallback' => true
            ),
            'column_desc' => array(
              'type' => 'textarea',
              'label' => __( 'Description', 'ize-theme-bundle' ),
              'default' => ''
            ),
            'column_link' => array(
              'type' => 'link',
              'label' => __( 'Link', 'ize-theme-bundle' ),
            ),
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

siteorigin_widget_register( 'three-column-layout', __FILE__, 'SiteOrigin_Widget_ize_three_column' );
