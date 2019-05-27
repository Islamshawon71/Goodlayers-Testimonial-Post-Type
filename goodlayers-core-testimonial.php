<?php

/*

Plugin Name: Goodlayers Testimonial Post Type

Plugin URI: http://www.devshawon.com/Goodlayers-Testimonial-Post-Type/

Description: A custom post type plugin to use with "Goodlayers Core" plugin

Version: 1.0

Author: Dev Shawon

Author URI: http://www.devshawon.com

License: 

*/



include(dirname(__FILE__) . '/pb-element-testimonial.php');





// create post type

add_action('init', 'gdlr_core_testimonial_init');

if( !function_exists('gdlr_core_testimonial_init') ){

    function gdlr_core_testimonial_init() {

        

        // custom post type

        $slug = apply_filters('gdlr_core_custom_post_slug', 'testimonial', 'testimonial');

        $supports = apply_filters('gdlr_core_custom_post_support', array('title', 'editor', 'author', 'thumbnail', 'excerpt'), 'testimonial');



        $labels = array(

            'name'               => esc_html__('Testimonial', 'goodlayers-core-testimonial'),

            'singular_name'      => esc_html__('Testimonial', 'goodlayers-core-testimonial'),

            'menu_name'          => esc_html__('Testimonial', 'goodlayers-core-testimonial'),

            'name_admin_bar'     => esc_html__('Testimonial', 'goodlayers-core-testimonial'),

            'add_new'            => esc_html__('Add New', 'goodlayers-core-testimonial'),

            'add_new_item'       => esc_html__('Add New Testimonial', 'goodlayers-core-testimonial'),

            'new_item'           => esc_html__('New Testimonial', 'goodlayers-core-testimonial'),

            'edit_item'          => esc_html__('Edit Testimonial', 'goodlayers-core-testimonial'),

            'view_item'          => esc_html__('View Testimonial', 'goodlayers-core-testimonial'),

            'all_items'          => esc_html__('All Testimonial', 'goodlayers-core-testimonial'),

            'search_items'       => esc_html__('Search Testimonial', 'goodlayers-core-testimonial'),

            'parent_item_colon'  => esc_html__('Parent Testimonial:', 'goodlayers-core-testimonial'),

            'not_found'          => esc_html__('No Testimonial found.', 'goodlayers-core-testimonial'),

            'not_found_in_trash' => esc_html__('No Testimonial found in Trash.', 'goodlayers-core-testimonial')

        );

        $args = array(

            'labels'             => $labels,

            'description'        => esc_html__('Description.', 'goodlayers-core-testimonial'),

            'public'             => true,

            'publicly_queryable' => true,

            'exclude_from_search'=> false,

            'show_ui'            => true,

            'show_in_menu'       => true,

            'query_var'          => true,

            'rewrite'            => array('slug' => $slug),

            'map_meta_cap'		 => false,

            'has_archive'        => false,

            'hierarchical'       => false,

            'menu_position'      => null,

            'supports'           => $supports

        );

        register_post_type('ms_testimonial', $args);



        // custom taxonomy

        $slug = apply_filters('gdlr_core_custom_post_slug', 'testimonial_category', 'testimonial_category');

        $args = array(

            'hierarchical'      => true,

            'label'             => esc_html__('Testimonial Category', 'goodlayers-core-testimonial'),

            'show_ui'           => true,

            'show_admin_column' => true,

            'query_var'         => true,

            'rewrite'           => array('slug' => $slug)

        );

        register_taxonomy('testimonial_category', array('ms_testimonial'), $args);

        register_taxonomy_for_object_type('testimonial_category', 'ms_testimonial');



        $slug = apply_filters('gdlr_core_custom_post_slug', 'testimonial_tag', 'testimonial_tag');

        $args = array(

            'hierarchical'      => false,

            'label'             => esc_html__('Testimonial Tag', 'goodlayers-core-testimonial'),

            'show_ui'           => true,

            'show_admin_column' => true,

            'query_var'         => true,

            'rewrite'           => array('slug' => $slug),

            'capabilities' 		=> array(

                'manage_terms' => 'edit_testimonial',

                'edit_terms' => 'edit_testimonial',

                'delete_terms' => 'delete_testimonial',

                'assign_terms' => 'edit_testimonial',

            )

        );

        register_taxonomy('testimonial_tag', array('testimonial'), $args);

        register_taxonomy_for_object_type('testimonial_tag', 'testimonial');

        

        // apply single template filter

        add_filter('single_template', 'gdlr_core_testimonial_template');

    }

} // gdlr_core_personnel_init





// add page builder to testimonial

if( is_admin() ){ add_filter('gdlr_core_page_builder_post_type', 'gdlr_core_testimonial_add_page_builder'); }

if( !function_exists('gdlr_core_testimonial_add_page_builder') ){

    function gdlr_core_testimonial_add_page_builder( $post_type ){

        $post_type[] = 'ms_testimonial';

        return $post_type;

    }

}

 

 