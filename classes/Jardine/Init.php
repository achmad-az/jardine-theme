<?php

namespace jardine;

use jardine\Util\CPT;
use jardine\Util\Extras;
use jardine\Util\Hook;
use jardine\Util\Metabox;
use jardine\Util\Shortcode;
use jardine\Util\Widget;

class Init {

    private static $instance;

    public static function loadInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function __construct()
    {
        $this->loadRedux();
        $this->themeInit();

        CPT::loadInstance();
        Extras::loadInstance();
        Hook::loadInstance();
        Metabox::loadInstance();
        Shortcode::loadInstance();
        Widget::loadInstance();
    }

    public function themeInit()
    {
        add_action( 'after_setup_theme', array($this, 'setupTheme') );

        add_filter('widget_text','do_shortcode');

        add_action( 'after_setup_theme', array($this, 'setupContentWidth'), 0 );

        add_image_size( 'image-placeholder', 10, 10, true );

        add_action( 'wp_enqueue_scripts', array($this, 'enqueueScripts') );
        add_action( 'admin_enqueue_scripts', array($this, 'enqueueAdminScripts') );
    }

    public function setupTheme()
    {
        load_theme_textdomain( 'jardine_master_theme', B_BASEDIR . '/languages' );

        add_theme_support( 'automatic-feed-links' );

        
        add_theme_support( 'title-tag' );

        
        add_theme_support( 'post-thumbnails' );

        
        require B_BASEDIR . '/inc/register-nav-menu.php';

        
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        add_theme_support( 'customjardine-selective-refresh-widgets' );
    }

    public function setupContentWidth()
    {
        $GLOBALS['content_width'] = apply_filters( 'jardine_master_theme_content_width', 640 );
    }

    public function loadRedux()
    {
        require_once B_BASEDIR . '/libraries/theme-options/redux-functions.php';
    }

    public function enqueueScripts()
    {
        global $opt_settings;

        /* CSS */

        if( isset($opt_settings) ) {

            if( $opt_settings['opt-enable-font-awesome'] == '1' ) {
            //Font Awesome
            wp_enqueue_style( 'font-awesome', B_URL .'/libraries/font awesome/css/font-awesome.min.css' );
            }

            if( $opt_settings['opt-enable-lazy-load'] == '1' ) {
            //Lazy Load
            wp_enqueue_script( 'lazy-load', B_URL . '/libraries/lazy-load/jquery.lazy.min.js', array('jquery'), '20151215', true );
                wp_enqueue_script( 'lazy-load-plugins', B_URL . '/libraries/lazy-load/jquery.lazy.plugins.min.js', array('jquery'), '20151215', true );
            }
        }
        //theme font
        wp_enqueue_style(
            'theme-fonts',
            get_stylesheet_directory_uri() . '/assets/fonts/fonts.css'
        );

        // Bundle Style
        wp_enqueue_style( 'bundle', B_URL . '/dist/assets/css/bundle.css' );

        // Bundle Script

        wp_enqueue_script( 'jquery' );

        wp_enqueue_script( 'bootstrap-datepicker', B_URL . '/assets/js/bootstrap-datepicker.js', array('jquery'), '1.0.0', true );
        
        wp_enqueue_script( 'blueimp', B_URL . '/assets/js/blueimp-gallery.js', array('jquery'), '1.0.0', true );
        
        wp_enqueue_script( 'bundle', B_URL . '/dist/assets/js/main.js', array(), '1.0.0', true );

        wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key='.$opt_settings['opt-api-key-maps'].'&libraries=places', array(), '1.0.0', false );
        
        wp_localize_script( 'bundle', 'ize_ajax', array( 'ajax_url' => admin_url('admin-ajax.php')) );

            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
    }

    public function enqueueAdminScripts()
    {
        wp_enqueue_style( 'codemirror', B_URL . '/libraries/codemirror/lib/codemirror.css' );
        wp_enqueue_style( 'codemirror-fullscreen', B_URL . '/libraries/codemirror/addon/display/fullscreen.css' );
        wp_enqueue_style( 'codemirror-monokai', B_URL . '/libraries/codemirror/theme/monokai.css' );
        wp_enqueue_style( 'admin-custom', B_URL . '/assets/admin/admin.css' );
        wp_enqueue_style( 'admin-option', B_URL . '/assets/css/admin.css' );

        wp_enqueue_script( 'codemirror', B_URL . '/libraries/codemirror/lib/codemirror.js', array(), '1.0.0', true );
        wp_enqueue_script( 'codemirror-close-bracket', B_URL . '/libraries/codemirror/addon/edit/closebrackets.js', array(), '1.0.0', true );
        wp_enqueue_script( 'codemirror-fullscreen', B_URL . '/libraries/codemirror/addon/display/fullscreen.js', array(), '1.0.0', true );
        wp_enqueue_script( 'codemirror-css-mode', B_URL . '/libraries/codemirror/mode/css/css.js', array(), '1.0.0', true );
        wp_enqueue_script( 'admin-custom', B_URL . '/assets/admin/admin.js', array('jquery'), '1.0.0', true );
    }

}