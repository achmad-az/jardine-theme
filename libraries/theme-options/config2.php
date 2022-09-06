<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "opt_settings";

    $theme_url = get_template_directory_uri();

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'ize-theme-options' ),
        'page_title'           => __( 'Theme Options', 'ize-theme-options' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyAe1nnol5eXwBwiby-nt3u2__PJ_mP9PmU',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'ize-theme-options' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'ize-theme-options' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'ize-theme-options' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'ize-theme-options' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'ize-theme-options' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'ize-theme-options' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'ize-theme-options' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'ize-theme-options' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'ize-theme-options' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'ize-theme-options' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'ize-theme-options' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*
    * Navigation
    */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Navigation', 'ize-theme-options' ),
        'id'               => 'opt-navigation',
        'customizer_width' => '400px',
        'icon'             => 'el el-lines',
        'fields'           => array(
            array(
                'id'       => 'opt-navbar-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Navigation Logo', 'ize-theme-options' ),
                'subtitle' => __( 'opt-navbar-logo', 'ize-theme-options' ),
                'compiler' => 'true',
                'default'  => array( 'url' => $theme_url . '/assets/images/logo.png' ),
            ),
            array(
                'id'       => 'opt-navbar-logo-loader',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo preloader', 'ize-theme-options' ),
                'subtitle' => __( 'opt-navbar-logo-loader', 'ize-theme-options' ),
                'compiler' => 'true',
                'default'  => array( 'url' => $theme_url . '/assets/images/logo.png' ),
            ),
            array(
                'id'       => 'opt-favicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Favicon Logo', 'ize-theme-options' ),
                'subtitle' => __( 'opt-favicon', 'ize-theme-options' ),
                'compiler' => 'true',
                'default'  => array( 'url' => $theme_url . '/assets/images/favicon.ico' ),
            ),
            array(
                'id'       => 'opt-btnbook-color',
                'type'     => 'color',
                'title'    => __('Button Book Now Text Color', 'redux-framework-demo'),
                'subtitle' => __('opt-btnbook-color', 'redux-framework-demo'),
                'default'  => '#00a1da',
                'validate' => 'color',
            ),
            array(
                'id'       => 'opt-btnbook-backcolor',
                'type'     => 'color',
                'title'    => __('Button Book Now Background Color', 'redux-framework-demo'),
                'subtitle' => __('opt-btnbook-backcolor', 'redux-framework-demo'),
                'default'  => 'transparent',
                'validate' => 'color',
                'transparent' => true
            ),
        )

    ) );

    // /*
    // * Typography
    // */
    // Redux::setSection( $opt_name, array(
    //     'title'            => __( 'Typography', 'ize-theme-options' ),
    //     'id'               => 'opt-typography',
    //     'customizer_width' => '400px',
    //     'icon'             => 'el el-fontsize',
    //     'fields'           => array(
    //         array(
    //             'id'       => 'opt-typography-body',
    //             'type'     => 'typography',
    //             'title'    => __( 'Body Font', 'ize-theme-options' ),
    //             'subtitle' => __( 'Specify the body font properties.', 'ize-theme-options' ),
    //             'google'   => false,
    //             'ext-font-css' => $theme_url . '/libraries/theme-options/webfonts/stylesheet.css',
    //             'default'  => array(
    //                 'color'       => '#333333',
    //                 'font-size'   => '14px',
    //                 'font-family' => 'Open Sans',
    //                 'font-weight' => 'Normal 400',
    //             ),
    //             'output'   => array(
    //                 'color'         => 'p',
    //                 'font-size'     => 'p',
    //                 'font-family'   => 'body,a',
    //                 'font-weight'   => 'body'
    //             )
    //         ),
    //         array(
    //             'id'       => 'opt-header-link-color',
    //             'type'     => 'link_color',
    //             'title'    => __('Header Links Color Option', 'ize-theme-options'),
    //             'subtitle' => __('Header links color each state', 'ize-theme-options'),
    //             'default'  => array(
    //                 'regular'  => '#ffffff',
    //                 'hover'    => '#13617C',
    //                 'active'   => '#13617C',
    //                 'visited'  => '#13617C',
    //             ),
    //             'output'   => array(
    //                 'regular'       => 'nav a',
    //                 'hover'         => 'nav a:hover',
    //                 'visited'       => 'nav a:visited',
    //                 'active'        => 'nav a:active'
    //             )
    //         ),
    //         array(
    //             'id'       => 'opt-body-link-color',
    //             'type'     => 'link_color',
    //             'title'    => __('Body Links Color Option', 'ize-theme-options'),
    //             'subtitle' => __('Body links color each state', 'ize-theme-options'),
    //             'default'  => array(
    //                 'regular'  => '#13617C',
    //                 'hover'    => '#1984a8',
    //                 'active'   => '#1984a8',
    //                 'visited'  => '#1984a8',
    //             ),
    //             'output'   => array(
    //                 'regular'       => 'a',
    //                 'hover'         => 'a:hover',
    //                 'visited'       => 'a:visited',
    //                 'active'        => 'a:active'
    //             )
    //         ),
    //         array(
    //             'id'       => 'opt-footer-link-color',
    //             'type'     => 'link_color',
    //             'title'    => __('Footer Links Color Option', 'ize-theme-options'),
    //             'subtitle' => __('Footer links color each state', 'ize-theme-options'),
    //             'default'  => array(
    //                 'regular'  => '#ffffff',
    //                 'hover'    => '#13617C',
    //                 'active'   => '#13617C',
    //                 'visited'  => '#13617C',
    //             ),
    //             'output'   => array(
    //                 'regular'       => 'footer a',
    //                 'hover'         => 'footer a:hover',
    //                 'visited'       => 'footer a:visited',
    //                 'active'        => 'footer a:active'
    //             )
    //         )
    //     )
    // ) );

    /*
    * Social Media
    */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social Media', 'ize-theme-options' ),
        'id'               => 'opt-social-media',
        'customizer_width' => '400px',
        'icon'             => 'el el-facebook',
        'fields'           => array(
            array(
                'id'       => 'opt-enable-facebook',
                'type'     => 'switch',
                'title'    => __('Enable Facebook', 'ize-theme-options'),
                'subtitle' => __('opt-enable-facebook', 'ize-theme-options'),
                'default'  => false
            ),
            array(
                'id'       => 'opt-facebook-url',
                'type'     => 'text',
                'title'    => __('Facebook URL', 'ize-theme-options'),
                'subtitle' => __('opt-facebook-url', 'ize-theme-options'),
                'default'  => 'https://facebook.com',
                'required' => array( 'opt-enable-facebook', '=', true )
            ),
            array(
                'id'       => 'opt-enable-twitter',
                'type'     => 'switch',
                'title'    => __('Enable Twitter', 'ize-theme-options'),
                'subtitle' => __('opt-enable-twitter', 'ize-theme-options'),
                'default'  => false
            ),
            array(
                'id'       => 'opt-twitter-url',
                'type'     => 'text',
                'title'    => __('Twitter URL', 'ize-theme-options'),
                'subtitle' => __('opt-twitter-url', 'ize-theme-options'),
                'default'  => 'https://twitter.com',
                'required' => array( 'opt-enable-twitter', '=', true )
            ),
            array(
                'id'       => 'opt-enable-google-plus',
                'type'     => 'switch',
                'title'    => __('Enable Google+', 'ize-theme-options'),
                'subtitle' => __('opt-enable-google-plus', 'ize-theme-options'),
                'default'  => false
            ),
            array(
                'id'       => 'opt-google-plus-url',
                'type'     => 'text',
                'title'    => __('Google+ URL', 'ize-theme-options'),
                'subtitle' => __('opt-google-plus-url', 'ize-theme-options'),
                'default'  => 'https://plus.google.com',
                'required' => array( 'opt-enable-google-plus', '=', true )
            ),
            array(
                'id'       => 'opt-enable-instagram',
                'type'     => 'switch',
                'title'    => __('Enable Instagram', 'ize-theme-options'),
                'subtitle' => __('opt-enable-instagram', 'ize-theme-options'),
                'default'  => false
            ),
            array(
                'id'       => 'opt-instagram-url',
                'type'     => 'text',
                'title'    => __('Instagram URL', 'ize-theme-options'),
                'subtitle' => __('opt-instagram-url', 'ize-theme-options'),
                'default'  => 'https://instagram.com',
                'required' => array( 'opt-enable-instagram', '=', true )
            ),
            array(
                'id'       => 'opt-enable-youtube',
                'type'     => 'switch',
                'title'    => __('Enable Youtube', 'ize-theme-options'),
                'subtitle' => __('opt-enable-youtube', 'ize-theme-options'),
                'default'  => false
            ),
            array(
                'id'       => 'opt-youtube-url',
                'type'     => 'text',
                'title'    => __('Youtube URL', 'ize-theme-options'),
                'subtitle' => __('opt-youtube-url', 'ize-theme-options'),
                'default'  => 'https://youtube.com',
                'required' => array( 'opt-enable-youtube', '=', true )
            ),
            array(
                'id'       => 'opt-enable-linkedin',
                'type'     => 'switch',
                'title'    => __('Enable Linkedin', 'ize-theme-options'),
                'subtitle' => __('opt-enable-linkedin', 'ize-theme-options'),
                'default'  => false
            ),
            array(
                'id'       => 'opt-linkedin-url',
                'type'     => 'text',
                'title'    => __('Linkedin URL', 'ize-theme-options'),
                'subtitle' => __('opt-linkedin-url', 'ize-theme-options'),
                'default'  => 'https://linkedin.com',
                'required' => array( 'opt-enable-linkedin', '=', true )
            ),
            array(
                'id'       => 'opt-enable-pinterest',
                'type'     => 'switch',
                'title'    => __('Enable Pinterest', 'ize-theme-options'),
                'subtitle' => __('opt-enable-pinterest', 'ize-theme-options'),
                'default'  => false
            ),
            array(
                'id'       => 'opt-pinterest-url',
                'type'     => 'text',
                'title'    => __('Pinterest URL', 'ize-theme-options'),
                'subtitle' => __('opt-pinterest-url', 'ize-theme-options'),
                'default'  => 'https://pinterest.com',
                'required' => array( 'opt-enable-pinterest', '=', true )
            ),
        )

    ) );

    /*
    * Home Page
    */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Homepage', 'ize-theme-options' ),
        'id'               => 'opt-homepage-contetn',
        'customizer_width' => '400px',
        'icon'             => 'el el-address-book',
        'fields'           => array(
            array(
                'id'       => 'opt-intro-text',
                'type'     => 'text',
                'title'    => __('Intro Text', 'ize-theme-options'),
                'subtitle' => __('opt-intro-text', 'ize-theme-options'),
                'desc'     => 'homepage intro text'
            ),
        )

    ) );

    /*
    * Booking Details
    */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Booking Details', 'ize-theme-options' ),
        'id'               => 'opt-booking-details',
        'customizer_width' => '400px',
        'icon'             => 'el el-address-book',
        'fields'           => array(
            array(
                'id'       => 'opt-booking-title',
                'type'     => 'text',
                'title'    => __('Booking Title', 'ize-theme-options'),
                'subtitle' => __('opt-booking-title', 'ize-theme-options'),
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-booking-btntext',
                'type'     => 'text',
                'title'    => __('Booking Button Text', 'ize-theme-options'),
                'subtitle' => __('opt-booking-btntext', 'ize-theme-options'),
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-booking-btnsubtext',
                'type'     => 'text',
                'title'    => __('Booking Button Sub Text', 'ize-theme-options'),
                'subtitle' => __('opt-booking-btnsubtext', 'ize-theme-options'),
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-booking-childvalid',
                'type'     => 'text',
                'title'    => __('Booking Button Child Valid', 'ize-theme-options'),
                'subtitle' => __('opt-booking-childvalid', 'ize-theme-options'),
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-booking-check-special-offer-link',
                'type'     => 'text',
                'title'    => __('Booking Check Special Offer Link', 'ize-theme-options'),
                'subtitle' => __('opt-booking-check-special-offer-link', 'ize-theme-options'),
                'desc'     => '#specialoffer'
            ),
            array(
                'id'       => 'opt-booking-check-special-offer-link-text',
                'type'     => 'text',
                'title'    => __('Booking Check Special Offer Text Link', 'ize-theme-options'),
                'subtitle' => __('opt-booking-check-special-offer-link-text', 'ize-theme-options'),
                'desc'     => 'Check Special Offers'
            ),
        )

    ) );



    /*
    * Contact Details
    */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Contact Details', 'ize-theme-options' ),
        'id'               => 'opt-contact-details',
        'customizer_width' => '400px',
        'icon'             => 'el el-address-book',
        'fields'           => array(
            array(
                'id'       => 'opt-company-name',
                'type'     => 'text',
                'title'    => __('Company Name', 'ize-theme-options'),
                'subtitle' => __('opt-company-name', 'ize-theme-options'),
                'desc'     => 'Shortcode: [company-name]'
            ),
            array(
                'id'       => 'opt-email',
                'type'     => 'text',
                'title'    => __('Email Address', 'ize-theme-options'),
                'subtitle' => __('opt-email', 'ize-theme-options'),
                'desc'     => 'Shortcode: [email-address]'
            ),
            array(
                'id'       => 'opt-phone',
                'type'     => 'text',
                'title'    => __('Phone Number', 'ize-theme-options'),
                'subtitle' => __('opt-phone', 'ize-theme-options'),
                'desc'     => 'Shortcode: [phone-number]'
            ),
             array(
                'id'       => 'opt-address',
                'type'     => 'textarea',
                'title'    => __('Location Address', 'ize-theme-options'),
                'subtitle' => __('opt-address', 'ize-theme-options'),
                'desc'     => 'Shortcode: [location-address]'
            ),
            array(
                'id'       => 'opt-menu-list',
                'type'     => 'textarea',
                'title'    => __('Menu List', 'ize-theme-options'),
                'subtitle' => __('opt-menu-list', 'ize-theme-options'),
                'desc'     => 'Shortcode: [contact-menu-list]'
            ),
        )

    ) );


    /*
    * Custom Code
    */
    Redux::setSection( $opt_name, array(
      'title'             => __( 'Custom Code', 'ize-theme-options' ),
      'id'                => 'opt-custom-code',
      'customizer_width' => '400px',
      'icon'             => 'el el-edit',
      'fields'           => array(
          array(
              'id'       => 'opt-custom-css',
              'type'     => 'ace_editor',
              'mode'     => 'css',
              'title'    => __( 'Custom CSS code', 'ize-theme-options' ),
              'subtitle' => __( 'opt-custom-css', 'ize-theme-options' ),
              'desc'     => 'Add any css code to customize website',
              'compiler' => true
          ),
          array(
              'id'       => 'opt-head-code',
              'type'     => 'ace_editor',
              'mode'     => 'html',
              'title'    => __( 'Add code to head tag', 'ize-theme-options' ),
              'subtitle' => __( 'opt-head-code', 'ize-theme-options' ),
              'desc'     => 'Add any html code that will rendered inside head tag',
          ),
          array(
              'id'       => 'opt-footer-code',
              'type'     => 'ace_editor',
              'mode'     => 'html',
              'title'    => __( 'Add code to before closing body tag', 'ize-theme-options' ),
              'subtitle' => __( 'opt-footer-code', 'ize-theme-options' ),
              'desc'     => 'Add any html code that will rendered before closing body tag.<br>
                            You can also add some javascript code with JQuery supported'
          ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'JS & CSS Plugins', 'ize-theme-options' ),
        'id'               => 'opt-js-css-plugin',
        'customizer_width' => '400px',
        'icon'             => 'el el-puzzle',
        'fields'           => array(
          array(
              'id'       => 'opt-enable-bootstrap',
              'type'     => 'switch',
              'title'    => __('Enable Bootstrap Library globally', 'ize-theme-options'),
              'subtitle' => __('opt-enable-bootstrap', 'ize-theme-options'),
              'desc'     => 'Documentation: <a href="http://getbootstrap.com/" target="_blank">http://getbootstrap.com/</a>',
              'default'  => true
          ),
          array(
              'id'       => 'opt-enable-font-awesome',
              'type'     => 'switch',
              'title'    => __('Enable Font Awesome Icon globally', 'ize-theme-options'),
              'subtitle' => __('opt-enable-font-awesome', 'ize-theme-options'),
              'desc'     => 'Documentation: <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>',
              'default'  => true
          ),
          array(
              'id'       => 'opt-enable-lazy-load',
              'type'     => 'switch',
              'title'    => __('Enable Images Lazy Load', 'ize-theme-options'),
              'subtitle' => __('opt-enable-lazy-load', 'ize-theme-options'),
              'desc'     => 'Documentation: <a href="http://jquery.eisbehr.de/lazy/" target="_blank">http://jquery.eisbehr.de/lazy/</a>',
              'default'  => false
          ),
          array(
              'id'       => 'opt-lazy-load-blur',
              'type'     => 'switch',
              'title'    => __('Use Blur Image for Placeholder', 'ize-theme-options'),
              'subtitle' => __('opt-lazy-load-blur', 'ize-theme-options'),
              'desc'     => 'Default placeholder will apply if blurry version of image not available',
              'default'  => true,
              'required' => array('opt-enable-lazy-load', '=', true)
          ),
          array(
              'id'       => 'opt-enable-pace-js',
              'type'     => 'switch',
              'title'    => __('Enable Pace JS (Page Preloader)', 'ize-theme-options'),
              'subtitle' => __('opt-enable-pace-js', 'ize-theme-options'),
              'desc'     => 'Documentation: <a href="http://github.hubspot.com/pace/docs/welcome/" target="_blank">http://github.hubspot.com/pace/docs/welcome/</a>
                              <br />Preloader stylesheet: <a href="'.$theme_url.'/libraries/pace/pace.css" target="_blank">/libraries/pace/pace.css</a>',
              'default'  => false
          ),
          array(
              'id'       => 'opt-enable-animate-css',
              'type'     => 'switch',
              'title'    => __('Enable Animate CSS globally', 'ize-theme-options'),
              'subtitle' => __('opt-enable-animate-css', 'ize-theme-options'),
              'desc'     => 'Documentation: <a href="https://daneden.github.io/animate.css/" target="_blank">https://daneden.github.io/animate.css/</a>',
              'default'  => false
          ),
          array(
              'id'       => 'opt-enable-owl-carousel',
              'type'     => 'switch',
              'title'    => __('Enable Owl Carousel', 'ize-theme-options'),
              'subtitle' => __('opt-enable-owl-carousel', 'ize-theme-options'),
              'desc'     => 'Documentation: <a href="http://owlcarousel2.github.io/OwlCarousel2/" target="_blank">http://owlcarousel2.github.io/OwlCarousel2/</a>',
              'default'  => false,
          ),
          array(
              'id'       => 'opt-owl-carousel',
              'type'     => 'switch',
              'title'    => __('Where to enable?', 'ize-theme-options'),
              'subtitle' => __('opt-owl-carousel', 'ize-theme-options'),
              'default'  => false,
              'on'       => 'partial',
              'off'      => 'global',
              'required' => array( 'opt-enable-owl-carousel', '=', true )
          ),
          array(
              'id'       => 'opt-owl-carousel-page',
              'type'     => 'select',
              'multi'    => true,
              'data'     => 'pages',
              'args' => array(
                  'posts_per_page' => -1,
              ),
              'title'    => __('Select Pages', 'ize-theme-options'),
              'subtitle' => __('opt-owl-carousel-page', 'ize-theme-options'),
              'required' => array( 'opt-owl-carousel', '=', true )
          ),
          array(
              'id'       => 'opt-owl-carousel-custom-post',
              'type'     => 'select',
              'multi'    => true,
              'data'     => 'post_types',
              'args' => array(
                  'public'         => true,
                  '_builtin'       => false
              ),
              'title'    => __('Select Custom Post', 'ize-theme-options'),
              'subtitle' => __('opt-owl-carousel-custom-post', 'ize-theme-options'),
              'required' => array( 'opt-owl-carousel', '=', true )
          ),
          array(
              'id'       => 'opt-enable-js-match-height',
              'type'     => 'switch',
              'title'    => __('Enable JS Match Height', 'ize-theme-options'),
              'subtitle' => __('opt-enable-js-match-height', 'ize-theme-options'),
              'desc'     => 'Documentation: <a href="http://brm.io/jquery-match-height/" target="_blank">http://brm.io/jquery-match-height/</a>',
              'default'  => enable
          ),
          array(
            'id'         => 'opt-js-match-height-selector',
            'type'       => 'multi_text',
            'title'      => __( 'CSS Selector', 'ize-theme-options' ),
            'subtitle'   => __('opt-js-match-height-selector', 'ize-theme-options'),
            'required'   => array( 'opt-enable-js-match-height', '=', true ),
            'desc'       => 'All css selector listed here will have same height'
          )
        )
    ) );
    /*
    * Loaction
    */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Location Master', 'ize-theme-options' ),
        'id'               => 'opt-location',
        'customizer_width' => '400px',
        'icon'             => 'el el-quote-right',
        'fields'           => array(
            array(
                'id'       => 'opt-location-title-content',
                'type'     => 'text',
                'title'    => __('Title Content', 'ize-theme-options'),
                'subtitle' => __('opt-location-title-content', 'ize-theme-options'),
                'default'  => 'Our Location',
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-location-desc-content',
                'type'     => 'textarea',
                'title'    => __('Description Content', 'ize-theme-options'),
                'subtitle' => __('opt-location-desc-content', 'ize-theme-options'),
                'default'  => '',
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-location-discover-title',
                'type'     => 'text',
                'title'    => __('Discover Title', 'ize-theme-options'),
                'subtitle' => __('opt-location-discover-title', 'ize-theme-options'),
                'default'  => 'Discover Bali',
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-loc-lat',
                'type'     => 'text',
                'title'    => __('Location Latitude', 'ize-theme-options'),
                'subtitle' => __('opt-loc-lat', 'ize-theme-options'),
                'default'  => '',
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-loc-long',
                'type'     => 'text',
                'title'    => __('Location Longtitude', 'ize-theme-options'),
                'subtitle' => __('opt-loc-long', 'ize-theme-options'),
                'default'  => '',
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-loc-title',
                'type'     => 'text',
                'title'    => __('Location Title', 'ize-theme-options'),
                'subtitle' => __('opt-loc-title', 'ize-theme-options'),
                'default'  => '',
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-loc-description',
                'type'     => 'text',
                'title'    => __('Location Description', 'ize-theme-options'),
                'subtitle' => __('opt-loc-description', 'ize-theme-options'),
                'default'  => '',
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-loc-link',
                'type'     => 'text',
                'title'    => __('Location Link', 'ize-theme-options'),
                'subtitle' => __('opt-loc-link', 'ize-theme-options'),
                'default'  => '',
                'desc'     => ''
            ),
            array(
                'id'       => 'opt-location-icon',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Icon Location', 'ize-theme-options' ),
                'subtitle' => __( 'opt-location-icon', 'ize-theme-options' ),
                'compiler' => 'true',
                'default'  => '',
            ),
        )

    ) );

    /*
    * Footer
    */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer', 'ize-theme-options' ),
        'id'               => 'opt-footer',
        'customizer_width' => '400px',
        'icon'             => 'el el-quote-right',
        'fields'           => array(
            array(
                'id'       => 'opt-footer-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Footer Logo', 'ize-theme-options' ),
                'subtitle' => __( 'opt-footer-logo', 'ize-theme-options' ),
                'compiler' => 'true',
                'default'  => array( 'url' => $theme_url . '/assets/images/logo.png' ),
            ),
            array(
                'id'       => 'opt-copyright-text',
                'type'     => 'text',
                'title'    => __('Copyright Text', 'ize-theme-options'),
                'subtitle' => __('opt-copyright-text', 'ize-theme-options'),
                'default'  => 'Copyright &copy; [current-year]. All rights reserved.',
                'desc'     => 'Shortcode: [copyright-text]'
            ),
            array(
                'id'       => 'opt-developer-signature',
                'type'     => 'text',
                'title'    => __('Developer Signature', 'ize-theme-options'),
                'subtitle' => __('opt-developer-signature', 'ize-theme-options'),
                'default'  => '',
                'desc'     => 'Shortcode: [developer-signature]<br>Only show up on front page'
            ),
        )

    ) );

    /*
    * Footer
    */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer Logo Member', 'ize-theme-options' ),
        'id'               => 'opt-footer-logo-wrapper',
        'customizer_width' => '400px',
        'icon'             => 'el el-quote-right',
        'fields'           => array(
            array(
                'id'       => 'opt-footer-logo-1',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo 1', 'ize-theme-options' ),
                'subtitle' => __( 'opt-footer-logo', 'ize-theme-options' ),
                'compiler' => 'true',
            ),
            array(
                'id'       => 'opt-footer-logo-link-1',
                'type'     => 'text',
                'url'      => true,
                'title'    => __( 'Logo Link 1', 'ize-theme-options' ),
                'subtitle' => __( 'opt-footer-logo-link-1', 'ize-theme-options' )
            ),
            array(
                'id'       => 'opt-member-list',
                'type'     => 'slides',
                'url'      => true,
                'title'    => __( 'Member List', 'ize-theme-options' ),
                'subtitle' => __( 'opt-member-list', 'ize-theme-options' ),
                'compiler' => 'true',
            ),
            // array(
            //     'id'       => 'opt-footer-logo-2',
            //     'type'     => 'media',
            //     'url'      => true,
            //     'title'    => __( 'Logo 2', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo', 'ize-theme-options' ),
            //     'compiler' => 'true',
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-link-2',
            //     'type'     => 'text',
            //     'url'      => true,
            //     'title'    => __( 'Logo Link 2', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo-link-2', 'ize-theme-options' )
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-3',
            //     'type'     => 'media',
            //     'url'      => true,
            //     'title'    => __( 'Logo 3', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo', 'ize-theme-options' ),
            //     'compiler' => 'true',
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-link-3',
            //     'type'     => 'text',
            //     'url'      => true,
            //     'title'    => __( 'Logo Link 3', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo-link-3', 'ize-theme-options' )
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-4',
            //     'type'     => 'media',
            //     'url'      => true,
            //     'title'    => __( 'Logo 4', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo', 'ize-theme-options' ),
            //     'compiler' => 'true',
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-link-4',
            //     'type'     => 'text',
            //     'url'      => true,
            //     'title'    => __( 'Logo Link 4', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo-link-4', 'ize-theme-options' )
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-5',
            //     'type'     => 'media',
            //     'url'      => true,
            //     'title'    => __( 'Logo 5', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo', 'ize-theme-options' ),
            //     'compiler' => 'true',
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-link-5',
            //     'type'     => 'text',
            //     'url'      => true,
            //     'title'    => __( 'Logo Link 5', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo-link-5', 'ize-theme-options' )
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-6',
            //     'type'     => 'media',
            //     'url'      => true,
            //     'title'    => __( 'Logo 6', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo', 'ize-theme-options' ),
            //     'compiler' => 'true',
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-link-6',
            //     'type'     => 'text',
            //     'url'      => true,
            //     'title'    => __( 'Logo Link 6', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo-link-6', 'ize-theme-options' )
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-7',
            //     'type'     => 'media',
            //     'url'      => true,
            //     'title'    => __( 'Logo 7', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo', 'ize-theme-options' ),
            //     'compiler' => 'true',
            // ),
            // array(
            //     'id'       => 'opt-footer-logo-link-7',
            //     'type'     => 'text',
            //     'url'      => true,
            //     'title'    => __( 'Logo Link 7', 'ize-theme-options' ),
            //     'subtitle' => __( 'opt-footer-logo-link-7', 'ize-theme-options' )
            // ),
        )

    ) );

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'ize-theme-options' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
          global $wp_filesystem;

          $filename = dirname(__FILE__) . '/custom.css';

          if( empty( $wp_filesystem ) ) {
              require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
          }

          if( $wp_filesystem ) {
              $wp_filesystem->put_contents(
                  $filename,
                  $options['opt-custom-css'],
                  FS_CHMOD_FILE // predefined mode settings for WP files
              );
          }
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'ize-theme-options' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'ize-theme-options' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }
