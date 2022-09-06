<?php

require_once get_template_directory() . '/libraries/TGM-Plugin-Activation/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'ize_master_theme_register_required_plugins' );

function ize_master_theme_register_required_plugins() {

  $plugins = array(

    array(
      'name'      => 'Contact Form 7',
      'slug'      => 'contact-form-7',
      'required'  => true,
    ),

    array(
      'name'      => 'Custom Post Type UI',
      'slug'      => 'custom-post-type-ui',
      'required'  => false,
      'force_activation' => true
    ),

    array(
      'name'      => 'Custom Field Suite',
      'slug'      => 'custom-field-suite',
      'required'  => true,
      'force_activation' => true
    ),

    array(
      'name'      => 'MailChimp for WordPress',
      'slug'      => 'mailchimp-for-wp',
      'required'  => true,
      'force_activation' => true
    ),

    array(
      'name'      => 'Advanced Custom Fields',
      'slug'      => 'advanced-custom-fields',
      'required'  => true,
    ),

    array(
      'name'      => 'Yoast SEO',
      'slug'      => 'wordpress-seo',
      'required'  => true,
    ),

    array(
      'name'      => 'BackWP-UP',
      'slug'      => 'backwpup',
      'required'  => false,
    ),

    array(
      'name'      => 'Private Blog',
      'slug'      => 'password-protect-wordpress',
      'required'  => false,
    ),

    array(
      'name'      => 'Site Origin Website Builder',
      'slug'      => 'siteorigin-panels',
      'required'  => true,
    ),

    array(
      'name'      => 'Site Origin Widgets Bundle',
      'slug'      => 'so-widgets-bundle',
      'required'  => true,
    ),

    array(
      'name'      => 'W3 Total Cache',
      'slug'      => 'w3-total-cache',
      'required'  => false,
    ),

    array(
      'name'      => 'Redux Framework',
      'slug'      => 'redux-framework',
      'required'  => true,
      'force_activation' => true
    ),

    array(
      'name'      => 'Social Media and Share Icons (Ultimate Social Media)',
      'slug'      => 'ultimate-social-media-icons',
      'required'  => true,
      'force_activation' => true
    ),

    array(
      'name'      => 'Wordpress Importer',
      'slug'      => 'wordpress-importer',
      'required'  => true,
    ),

    array(
      'name'      => 'Auto Optimize',
      'slug'      => 'autoptimize',
      'required'  => false,
    ),

    array(
			'name'               => 'Redux Vendor Support',
			'slug'               => 'redux-vendor-support',
			'source'             => get_template_directory() . '/plugins/redux vendor support.zip',
			'required'           => true,
			'force_activation'   => true,
		),

    array(
			'name'               => 'WPML',
			'slug'               => 'sitepress-multilingual-cms',
			'source'             => get_template_directory() . '/plugins/wpml.zip',
			'required'           => true,
			'force_activation'   => true,
		),



  );

  /*
   * Array of configuration settings. Amend each line as needed.
   *
   * TGMPA will start providing localized text strings soon. If you already have translations of our standard
   * strings available, please help us make TGMPA even better by giving us access to these translations or by
   * sending in a pull-request with .po file(s) with the translations.
   *
   * Only uncomment the strings in the config array if you want to customize the strings.
   */
  $config = array(
    'id'           => 'jardine_Master_Theme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.

    /*
    'strings'      => array(
      'page_title'                      => __( 'Install Required Plugins', 'jardine_Master_Theme' ),
      'menu_title'                      => __( 'Install Plugins', 'jardine_Master_Theme' ),
      /* translators: %s: plugin name. * /
      'installing'                      => __( 'Installing Plugin: %s', 'jardine_Master_Theme' ),
      /* translators: %s: plugin name. * /
      'updating'                        => __( 'Updating Plugin: %s', 'jardine_Master_Theme' ),
      'oops'                            => __( 'Something went wrong with the plugin API.', 'jardine_Master_Theme' ),
      'notice_can_install_required'     => _n_noop(
        /* translators: 1: plugin name(s). * /
        'This theme requires the following plugin: %1$s.',
        'This theme requires the following plugins: %1$s.',
        'jardine_Master_Theme'
      ),
      'notice_can_install_recommended'  => _n_noop(
        /* translators: 1: plugin name(s). * /
        'This theme recommends the following plugin: %1$s.',
        'This theme recommends the following plugins: %1$s.',
        'jardine_Master_Theme'
      ),
      'notice_ask_to_update'            => _n_noop(
        /* translators: 1: plugin name(s). * /
        'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
        'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
        'jardine_Master_Theme'
      ),
      'notice_ask_to_update_maybe'      => _n_noop(
        /* translators: 1: plugin name(s). * /
        'There is an update available for: %1$s.',
        'There are updates available for the following plugins: %1$s.',
        'jardine_Master_Theme'
      ),
      'notice_can_activate_required'    => _n_noop(
        /* translators: 1: plugin name(s). * /
        'The following required plugin is currently inactive: %1$s.',
        'The following required plugins are currently inactive: %1$s.',
        'jardine_Master_Theme'
      ),
      'notice_can_activate_recommended' => _n_noop(
        /* translators: 1: plugin name(s). * /
        'The following recommended plugin is currently inactive: %1$s.',
        'The following recommended plugins are currently inactive: %1$s.',
        'jardine_Master_Theme'
      ),
      'install_link'                    => _n_noop(
        'Begin installing plugin',
        'Begin installing plugins',
        'jardine_Master_Theme'
      ),
      'update_link' 					  => _n_noop(
        'Begin updating plugin',
        'Begin updating plugins',
        'jardine_Master_Theme'
      ),
      'activate_link'                   => _n_noop(
        'Begin activating plugin',
        'Begin activating plugins',
        'jardine_Master_Theme'
      ),
      'return'                          => __( 'Return to Required Plugins Installer', 'jardine_Master_Theme' ),
      'plugin_activated'                => __( 'Plugin activated successfully.', 'jardine_Master_Theme' ),
      'activated_successfully'          => __( 'The following plugin was activated successfully:', 'jardine_Master_Theme' ),
      /* translators: 1: plugin name. * /
      'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'jardine_Master_Theme' ),
      /* translators: 1: plugin name. * /
      'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'jardine_Master_Theme' ),
      /* translators: 1: dashboard link. * /
      'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'jardine_Master_Theme' ),
      'dismiss'                         => __( 'Dismiss this notice', 'jardine_Master_Theme' ),
      'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'jardine_Master_Theme' ),
      'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'jardine_Master_Theme' ),

      'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
    ),
    */
  );

  tgmpa( $plugins, $config );
}
