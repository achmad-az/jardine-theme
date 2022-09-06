<?php

/*
Widget Name: IZE : post carousel
Description: Post Carousel Layout
Author: -
Author URI: -
*/

class SiteOrigin_Widget_post_carousel_layout extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'post-carousel-layout',
			__( 'IZE : post carousel', 'ize-theme-bundle' ),
			array(
				'description' => __( 'Post Carousel Layout', 'ize-theme-bundle' ),
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
		return array(
      'heading' => array(
        'type' => 'text',
        'label' => __( 'Heading', 'ize-theme-bundle' )
      ),
			'post_type' => array(
			  'type' => 'select',
			  'label' => __( 'Select Post Type', 'ize-theme-bundle' ),
			  'default' => array_merge($custom, $builtin)[0],
			  'options' => array_merge($custom, $builtin)
			),
      'content' => array(
        'type' => 'text',
        'label' => __( 'Meta Key', 'ize-theme-bundle' ),
        'description' => __( 'you can put any meta key as a description conten, Default is the_content()', 'ize-theme-bundle' )
      ),
      'item' => array(
        'type' => 'number',
        'label' => __( 'Content to display', 'ize-theme-bundle' ),
        'default' => '5'
      ),
      'link_text' => array(
        'type' => 'text',
        'label' => __( 'Link Text', 'ize-theme-bundle' ),
        'default' => 'Read More',
        'description' => __( 'default is Read More', 'ize-theme-bundle' )
      ),
      'show_more' => array(
        'type' => 'link',
        'label' => __( 'Show More Link', 'ize-theme-bundle' ),
      ),
      'show_more_text' => array(
        'type' => 'text',
        'label' => __( 'Show More Link Text', 'ize-theme-bundle' ),
        'default' => 'See all'
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

siteorigin_widget_register( 'post-carousel-layout', __FILE__, 'SiteOrigin_Widget_post_carousel_layout' );
