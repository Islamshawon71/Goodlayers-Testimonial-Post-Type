<?php
/*
Plugin Name: Goodlayers Testimonial Post Type
Plugin URI: http://www.devshawon.com/Goodlayers-Testimonial-Post-Type/
Description: A custom post type plugin to use with "Goodlayers Core" plugin
Version: 1.0
Author: Dev Shawon
Author URI: http://www.devshawon.com
License: GPLv2
Text Domain: goodlayer-ms-testimonial
*/

include(dirname(__FILE__) . '/pb-element-testimonial.php');

add_action('init', 'gdlr_core_testimonial_init');
if( !function_exists('gdlr_core_testimonial_init') ){
    function gdlr_core_testimonial_init() {
          
        $labels = array(
            'name'               => esc_html__('MS Testimonial', 'goodlayer-ms-testimonial'),
            'singular_name'      => esc_html__('MS Testimonial', 'goodlayer-ms-testimonial'),
            'menu_name'          => esc_html__('MS Testimonial', 'goodlayer-ms-testimonial'),
            'name_admin_bar'     => esc_html__('MS Testimonial', 'goodlayer-ms-testimonial'),
            'add_new'            => esc_html__('Add New', 'goodlayer-ms-testimonial'),
            'add_new_item'       => esc_html__('Add MS Testimonial', 'goodlayer-ms-testimonial'),
            'new_item'           => esc_html__('New MS Testimonial', 'goodlayer-ms-testimonial'),
            'edit_item'          => esc_html__('Edit MS Testimonial', 'goodlayer-ms-testimonial'),
            'view_item'          => esc_html__('View MS Testimonial', 'goodlayer-ms-testimonial'),
            'all_items'          => esc_html__('All MS Testimonial', 'goodlayer-ms-testimonial'),
            'search_items'       => esc_html__('Search MS Testimonial', 'goodlayer-ms-testimonial'),
            'parent_item_colon'  => esc_html__('Parent MS Testimonial:', 'goodlayer-ms-testimonial'),
            'not_found'          => esc_html__('No MS Testimonial found.', 'goodlayer-ms-testimonial'),
            'not_found_in_trash' => esc_html__('No MS Testimonial found in Trash.', 'goodlayer-ms-testimonial')
        );
        $args = array(
            'labels'             => $labels,
            'description'        => esc_html__('Description.', 'goodlayer-ms-testimonial'),
            'public'             => true,
            'publicly_queryable' => true,
            'exclude_from_search'=> false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'ms_testimonial'),
            'capabilities'    	 => array(
                'edit_post'          => 'edit_ms_testimonial',
                'read_post'          => 'read_ms_testimonial',
                'delete_post'        => 'delete_ms_testimonial',
                'edit_posts'         => 'edit_ms_testimonials',
                'edit_others_posts'  => 'edit_others_ms_testimonial',
                'publish_posts'      => 'publish_ms_testimonial',
                'read_private_posts' => 'read_private_ms_testimonial',
                'delete_posts'       => 'delete_ms_testimonials',
            ),
            'map_meta_cap'		 => false,
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
        );
        register_post_type('ms_testimonial', $args); 

        			// custom taxonomy
			$slug = apply_filters('gdlr_core_custom_post_slug', 'ms_testimonial_category', 'ms_testimonial_category');
			$args = array(
				'hierarchical'      => true,
				'label'             => esc_html__('Testimonial Category', 'goodlayer-ms-testimonial'),
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'capabilities' 		=> array(
					'manage_terms' => 'edit_ms_testimonial',
					'edit_terms' => 'edit_ms_testimonial',
					'delete_terms' => 'delete_ms_testimonial',
					'assign_terms' => 'edit_ms_testimonial',
				)
			);
			register_taxonomy('ms_testimonial_category', array('ms_testimonial'), $args);
            register_taxonomy_for_object_type('ms_testimonial_category', 'ms_testimonial');
            

        $admins = get_role( 'administrator' ); 
        $admins->add_cap( 'edit_ms_testimonial' ); 
        $admins->add_cap( 'edit_ms_testimonials' ); 
        $admins->add_cap( 'read_ms_testimonial' ); 
        $admins->add_cap( 'delete_ms_testimonial' ); 
        $admins->add_cap( 'edit_others_ms_testimonial' ); 
        $admins->add_cap( 'publish_ms_testimonial' ); 
        $admins->add_cap( 'read_private_ms_testimonial' ); 
        $admins->add_cap( 'delete_ms_testimonials' ); 
    }
}

 