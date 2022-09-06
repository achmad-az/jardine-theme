<?php

/*
Widget Name: IZE : homepage restaurant layout
Description: homepage restaurant layout
Author: -
Author URI: -
*/

class SiteOrigin_Widget_restaurant_layout extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'restaurant-layout',
			__( 'IZE : homepage restaurant layout', 'ize-theme-bundle' ),
			array(
				'description' => __( 'homepage restaurant layout', 'ize-theme-bundle' ),
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
      'section_loop' => array(
        'type' => 'repeater',
        'label' => __( 'Tab Content' , 'widget-form-fields-text-domain' ),
        'item_name'  => __( 'Content item', 'siteorigin-widgets' ),
        'item_label' => array(
            'selector'     => "[id*='content_title']",
            'update_event' => 'change',
            'value_method' => 'val'
        ),
        'fields' => array(
            'content_title' => array(
                'type' => 'text',
                'label' => __( 'Title Content', 'widget-form-fields-text-domain' )
            ),
            'content_image' => array(
                'type' => 'media',
                'label' => __( 'Image', 'widget-form-fields-text-domain' ),
                'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                'library' => 'image',
                'fallback' => true
            ),
            'content_desc' => array(
              'type' => 'tinymce',
              'label' => __( 'Description', 'ize-theme-bundle' ),
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
            'content_link' => array(
              'type' => 'link',
              'label' => __( 'Link Show More', 'ize-theme-bundle' ),
            ),
            'content_link_text' => array(
              'type' => 'text',
              'label' => __( 'Link Text', 'ize-theme-bundle' ),
              'default' => 'Show More Rooms'
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

siteorigin_widget_register( 'restaurant-layout', __FILE__, 'SiteOrigin_Widget_restaurant_layout' );
