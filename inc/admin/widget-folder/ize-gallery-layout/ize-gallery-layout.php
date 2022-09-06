<?php

/*
Widget Name: IZE : Gallery Layout
Description: Gallery Layout
Author: -
Author URI: -
*/

class SiteOrigin_Widget_gallery_layout extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'gallery-layout',
			__( 'IZE : Gallery Layout', 'ize-theme-bundle' ),
			array(
				'description' => __( 'Gallery Layout', 'ize-theme-bundle' ),
        'panels_groups' => array('ize')
			),
			array(),
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	function get_widget_form() {
		$builtin = get_post_types( array('_builtin' => true,'public' => true) );
		$custom = get_post_types( array('_builtin' => false,'public' => true) );
    $selectall = array( 'select-all' => 'All Post');
		return array(
      'heading' => array(
        'type' => 'text',
        'label' => __( 'Heading', 'ize-theme-bundle' )
      ),
			'post_type' => array(
			  'type' => 'select',
			  'label' => __( 'Select Post Type', 'ize-theme-bundle' ),
			  'default' => 'select-all',
			  'options' => array_merge($selectall, $custom, $builtin)
			),
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

siteorigin_widget_register( 'gallery-layout', __FILE__, 'SiteOrigin_Widget_gallery_layout' );
