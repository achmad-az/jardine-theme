<?php

/*
Widget Name: IZE : Homepage Intro Layout
Description: Homepage Intro layout
Author: -
Author URI: -
*/

class SiteOrigin_Widget_homepage_intro_layout extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'homepage-intro-layout',
			__( 'IZE : Homepage Intro Layout', 'ize-theme-bundle' ),
			array(
				'description' => __( 'Homepage Intro layout', 'ize-theme-bundle' ),
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
        'label' => __( 'Content', 'ize-theme-bundle' ),
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
        'label' => __('Read More Link', 'ize-theme-bundle'),
      ),
      'link_text' => array(
        'type' => 'text',
        'label' => __( 'Text link', 'ize-theme-bundle' ),
        'default' => 'Read More >>'
      ),
			'include_widget_box' => array(
        'type' => 'checkbox',
        'label' => __( 'Include booking widget?', 'widget-form-fields-text-domain' ),
        'default' => true
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
      'heading' => $instance['heading'],
      'content' => $instance['content'],
      'link' => $instance['link'],
      'linktext' => $instance['link_text'],
			'booking_widget' => $instance['include_widget_box']
    );
	}
}

siteorigin_widget_register( 'homepage-intro-layout', __FILE__, 'SiteOrigin_Widget_homepage_intro_layout' );
