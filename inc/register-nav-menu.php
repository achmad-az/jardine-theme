<?php

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
  'menu-1' => esc_html__( 'Primary', 'jardine_Master_Theme' ),
  'menu-home' => esc_html__( 'Menu Home', 'jardine_Master_Theme' ),
  'menu-login' => esc_html__( 'Menu Login', 'jardine_Master_Theme' ),
) );
