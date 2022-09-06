<?php

namespace jardine\Util;

class Widget {
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
        add_action( 'widgets_init', array($this, 'registerWidgets') );
    }

    public function registerWidgets()
    {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'jardine_Master_Theme' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'jardine_Master_Theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    
    
      /**
      * Register new widget here
      */
        register_sidebar( array(
            'name'          => esc_html__( 'Footer : Contact Information', 'jardine_Master_Theme' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Footer : Contact Information Widget section', 'jardine_Master_Theme' ),
            'before_widget' => '<div id="%1$s" class="widget-footer-contact %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Footer : Bottom', 'jardine_Master_Theme' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Footer : Bottom Widget section', 'jardine_Master_Theme' ),
            'before_widget' => '<div id="%1$s" class="widget-footer-bottom %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Footer : Footer Menu 1', 'jardine_Master_Theme' ),
            'id'            => 'footer-menu-1',
            'description'   => esc_html__( 'Footer : Left footer menu in all pages with custom template', 'jardine_Master_Theme' ),
            'before_widget' => '<div id="%1$s" class="widget-footer-bottom %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Footer : Footer Menu 2', 'jardine_Master_Theme' ),
            'id'            => 'footer-menu-2',
            'description'   => esc_html__( 'Footer : Center footer menu in all pages with custom template', 'jardine_Master_Theme' ),
            'before_widget' => '<div id="%1$s" class="widget-footer-bottom %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Footer : Footer Menu 3', 'jardine_Master_Theme' ),
            'id'            => 'footer-menu-3',
            'description'   => esc_html__( 'Footer : Right footer menu in all pages with custom template', 'jardine_Master_Theme' ),
            'before_widget' => '<div id="%1$s" class="widget-footer-bottom %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Footer : Footer Menu 4', 'jardine_Master_Theme' ),
            'id'            => 'footer-menu-4',
            'description'   => esc_html__( 'Footer : Left footer menu in all pages with custom template', 'jardine_Master_Theme' ),
            'before_widget' => '<div id="%1$s" class="widget-footer-bottom %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Footer : Footer Menu 5', 'jardine_Master_Theme' ),
            'id'            => 'footer-menu-5',
            'description'   => esc_html__( 'Footer : Center footer menu in all pages with custom template', 'jardine_Master_Theme' ),
            'before_widget' => '<div id="%1$s" class="widget-footer-bottom %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Footer : Footer Menu 6', 'jardine_Master_Theme' ),
            'id'            => 'footer-menu-6',
            'description'   => esc_html__( 'Footer : Right footer menu in all pages with custom template', 'jardine_Master_Theme' ),
            'before_widget' => '<div id="%1$s" class="widget-footer-bottom %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
    }
}