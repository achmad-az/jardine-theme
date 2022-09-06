<?php

namespace jardine\Util;

class CPT {
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
        add_action('init', array($this, 'registerPostTypes'));
        add_action('init', array($this, 'registerTaxonomies'));
    }

    public function registerPostTypes()
    {
        /**
         * Post Type: Rooms.
         */

        $labels = array(
            "name" => __( "Villas", "jardine_Master_Theme" ),
            "singular_name" => __( "Villa", "jardine_Master_Theme" ),
            "menu_name" => __( "Villas", "jardine_Master_Theme" ),
            "all_items" => __( "All Villas", "jardine_Master_Theme" ),
            "add_new" => __( "Add Villa", "jardine_Master_Theme" ),
            "add_new_item" => __( "Add new villa", "jardine_Master_Theme" ),
            "edit_item" => __( "Edit villa", "jardine_Master_Theme" ),
            "new_item" => __( "New villa", "jardine_Master_Theme" ),
            "view_item" => __( "View villa", "jardine_Master_Theme" ),
            "view_items" => __( "View villas", "jardine_Master_Theme" ),
            "search_items" => __( "search villa", "jardine_Master_Theme" ),
            "not_found" => __( "No villa found", "jardine_Master_Theme" ),
            "not_found_in_trash" => __( "no villa in the trash", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Villas", "jardine_Master_Theme" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => true,
            "show_in_menu" => true,
            "exclude_from_search" => true,
            "capability_type" => "page",
            "map_meta_cap" => true,
            "hierarchical" => true,
            "rewrite" => array( "slug" => "villas", "with_front" => true ),
            "query_var" => true,
            "menu_position" => 5,
            "supports" => array( "title", "editor", "thumbnail", "excerpt", "page-attributes" ),
        );

        register_post_type( "villa", $args );

        /**
         * Post Type: Special Offers.
         */

        $labels = array(
            "name" => __( "Special Offers", "jardine_Master_Theme" ),
            "singular_name" => __( "Special Offer", "jardine_Master_Theme" ),
            "menu_name" => __( "Special Offers", "jardine_Master_Theme" ),
            "all_items" => __( "All Special Offers", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Special Offers", "jardine_Master_Theme" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => false,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array( "slug" => "special_offer", "with_front" => true ),
            "query_var" => true,
            "menu_position" => 6,
            "supports" => array( "title", "editor", "thumbnail", "excerpt" ),
        );

        register_post_type( "special_offer", $args );

        
        /**
         * Post Type: Brands.
         */

        $labels = array(
            "name" => __( "Brands", "jardine_Master_Theme" ),
            "singular_name" => __( "Brands", "jardine_Master_Theme" ),
            "menu_name" => __( "Brands", "jardine_Master_Theme" ),
            "all_items" => __( "All Brands", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "BrandsBrands", "jardine_Master_Theme" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => false,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array( "slug" => "Brand", "with_front" => true ),
            "query_var" => true,
            "menu_position" => 6,
            "supports" => array( "title", "editor", "thumbnail", "excerpt" ),
        );

        register_post_type( "Brand", $args );

        /**
         * Post Type: Galleries.
         */

        $labels = array(
            "name" => __( "Galleries", "jardine_Master_Theme" ),
            "singular_name" => __( "Gallery", "jardine_Master_Theme" ),
            "menu_name" => __( "Gallery", "jardine_Master_Theme" ),
            "all_items" => __( "All Images", "jardine_Master_Theme" ),
            "add_new" => __( "Add Image", "jardine_Master_Theme" ),
            "add_new_item" => __( "Add new image", "jardine_Master_Theme" ),
            "edit_item" => __( "Edit Image", "jardine_Master_Theme" ),
            "new_item" => __( "New Image", "jardine_Master_Theme" ),
            "view_item" => __( "View Image", "jardine_Master_Theme" ),
            "view_items" => __( "View Images", "jardine_Master_Theme" ),
            "search_items" => __( "Search Images", "jardine_Master_Theme" ),
            "not_found" => __( "No Images found", "jardine_Master_Theme" ),
            "not_found_in_trash" => __( "No image on the trash buddy", "jardine_Master_Theme" ),
            "featured_image" => __( "Image", "jardine_Master_Theme" ),
            "set_featured_image" => __( "Set Image", "jardine_Master_Theme" ),
            "remove_featured_image" => __( "Remove Image", "jardine_Master_Theme" ),
            "use_featured_image" => __( "Use Image", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Galleries", "jardine_Master_Theme" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => false,
            "show_in_menu" => true,
            "exclude_from_search" => true,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array( "slug" => "ize_gallery", "with_front" => true ),
            "query_var" => true,
            "menu_position" => 7,
            "supports" => array( "title", "thumbnail", "editor" ),
        );

        register_post_type( "ize_gallery", $args );

        /**
         * Post Type: Location.
         */

        $labels = array(
            "name" => __( "Location", "jardine_Master_Theme" ),
            "singular_name" => __( "Location", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Location", "jardine_Master_Theme" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => false,
            "show_in_menu" => true,
            "exclude_from_search" => true,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array( "slug" => "location_custom", "with_front" => false ),
            "query_var" => true,
            "supports" => array( "title" ),
        );

        register_post_type( "location_custom", $args );
    }

    public function registerTaxonomies()
    {
        /**
         * Taxonomy: Room Categories.
         */

        $labels = array(
            "name" => __( "Villa Categories", "jardine_Master_Theme" ),
            "singular_name" => __( "Villa Category", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Villa Categories", "jardine_Master_Theme" ),
            "labels" => $labels,
            "public" => true,
            "hierarchical" => true,
            "label" => "Villa Categories",
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'villa_category', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => false,
            "rest_base" => "",
            "show_in_quick_edit" => false,
        );
        register_taxonomy( "villa_category", array( "villa" ), $args );

        // Taxonomy : Villa Location
        $labels = array(
            "name" => __( "Villa Locations", "jardine_Master_Theme" ),
            "singular_name" => __( "Villa Location", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Villa Location", "jardine_Master_Theme" ),
            "labels" => $labels,
            "public" => true,
            "hierarchical" => true,
            "label" => "Villa Location",
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'villa_location', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => false,
            "rest_base" => "",
            "show_in_quick_edit" => false,
        );
        register_taxonomy( "villa_location", array( "villa" ), $args );

        /**
         * Taxonomy: Categories.
         */

        $labels = array(
            "name" => __( "Categories", "jardine_Master_Theme" ),
            "singular_name" => __( "Category", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Categories", "jardine_Master_Theme" ),
            "labels" => $labels,
            "public" => true,
            "hierarchical" => false,
            "label" => "Categories",
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'special_offer_category', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => false,
            "rest_base" => "",
            "show_in_quick_edit" => false,
        );
        register_taxonomy( "special_offer_category", array( "special_offer" ), $args );

        /**
         * Taxonomy: Gallery Categories.
         */

        $labels = array(
            "name" => __( "Gallery Categories", "jardine_Master_Theme" ),
            "singular_name" => __( "Gallery Category", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Gallery Categories", "jardine_Master_Theme" ),
            "labels" => $labels,
            "public" => true,
            "hierarchical" => true,
            "label" => "Gallery Categories",
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'gallery_cat', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => false,
            "rest_base" => "",
            "show_in_quick_edit" => false,
        );
        register_taxonomy( "gallery_cat", array( "ize_gallery" ), $args );

        /**
         * Taxonomy: Category Location.
         */

        $labels = array(
            "name" => __( "Category Location", "jardine_Master_Theme" ),
            "singular_name" => __( "Category Location", "jardine_Master_Theme" ),
        );

        $args = array(
            "label" => __( "Category Location", "jardine_Master_Theme" ),
            "labels" => $labels,
            "public" => true,
            "hierarchical" => true,
            "label" => "Category Location",
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'loc_category', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => false,
            "rest_base" => "",
            "show_in_quick_edit" => false,
        );
        register_taxonomy( "loc_category", array( "location_custom" ), $args );
    }
}