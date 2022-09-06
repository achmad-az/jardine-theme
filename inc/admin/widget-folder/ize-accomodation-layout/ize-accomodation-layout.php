<?php

/*
Widget Name: IZE : accomodation layout
Description: Accomodation Layout
Author: -
Author URI: -
*/

class SiteOrigin_Widget_accomodation_layout_widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'accomodation-layout',
			__( 'iZE : accomodation layout', 'ize-theme-bundle' ),
			array(
				'description' => __( 'Accomodation Layout', 'ize-theme-bundle' ),
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
      // 'show_checked' => array(
      //   'type' => 'checkbox',
      //   'label' => __( 'Show checked room only', 'ize-theme-bundle' ),
      //   'description' => __('if checked, the room with checked on promote to homepage only will show, if not sort by default / the last post will show'),
      // ),
      'link' => array(
        'type' => 'link',
        'label' => __( 'Link Show More', 'ize-theme-bundle' ),
        'default' => '\/rooms\/'
      ),
      'link_text' => array(
        'type' => 'text',
        'label' => __( 'Link Text', 'ize-theme-bundle' ),
        'default' => 'Show More Rooms'
      ),
			'number_show' => array(
				'type' => 'slider',
        'label' => __( 'Number of Room to Show', 'widget-form-fields-text-domain' ),
        'default' => 4,
        'min' => 0,
        'max' => 4,
        'integer' => true
      ),
      'section_1' => array(
          'type' => 'section',
          'label' => __( 'Section 1 *Hotel Information' , 'widget-form-fields-text-domain' ),
          'hide' => true,
          'fields' => array(
              'heading_1' => array(
                'type' => 'text',
                'label' => __( 'Heading', 'ize-theme-bundle' ),
                'default' => 'Hotel Information'
              ),
              'content_1' => array(
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
              'link_1' => array(
                'type' => 'link',
                'label' => __( 'Link', 'ize-theme-bundle' ),
              ),
              'link_text_1' => array(
                'type' => 'text',
                'label' => __( 'Link Text', 'ize-theme-bundle' ),
              ),
          ),
        ),
        'section_2' => array(
            'type' => 'section',
            'label' => __( 'Section 2 *Hotel Feature' , 'widget-form-fields-text-domain' ),
            'hide' => true,
            'fields' => array(
                'heading_2' => array(
                  'type' => 'text',
                  'label' => __( 'Heading', 'ize-theme-bundle' ),
                  'default' => 'Hotel Feature'
                ),
                'content_2' => array(
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
                'link_2' => array(
                  'type' => 'link',
                  'label' => __( 'Link', 'ize-theme-bundle' ),
                ),
                'link_text_2' => array(
                  'type' => 'text',
                  'label' => __( 'Link Text', 'ize-theme-bundle' ),
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

siteorigin_widget_register( 'accomodation-layout', __FILE__, 'SiteOrigin_Widget_accomodation_layout_widget' );
