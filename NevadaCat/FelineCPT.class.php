<?php

namespace NevadaCat;

class FelineCPT{
	
	public function __construct(){
		// adding the function to the Wordpress init
		add_action( 'init', array ($this, 'feline_CPT'));
	}
	
	function feline_CPT() {
		$labels = array(
				'name'                  => _x( 'Felines', 'Post Type General Name', 'NevadaCatHouseTextDomain' ),
				'singular_name'         => _x( 'Feline', 'Post Type Singular Name', 'NevadaCatHouseTextDomain' ),
				'menu_name'             => __( 'Felines', 'NevadaCatHouseTextDomain' ),
				'name_admin_bar'        => __( 'Feline', 'NevadaCatHouseTextDomain' ),
				'archives'              => __( 'Feline Archives', 'NevadaCatHouseTextDomain' ),
				'attributes'            => __( 'Feline Attributes', 'NevadaCatHouseTextDomain' ),
				'parent_item_colon'     => __( 'Parent Feline:', 'NevadaCatHouseTextDomain' ),
				'all_items'             => __( 'All Felines', 'NevadaCatHouseTextDomain' ),
				'add_new_item'          => __( 'Add New Feline', 'NevadaCatHouseTextDomain' ),
				'add_new'               => __( 'Add New Feline', 'NevadaCatHouseTextDomain' ),
				'new_item'              => __( 'New Feline', 'NevadaCatHouseTextDomain' ),
				'edit_item'             => __( 'Edit Feline', 'NevadaCatHouseTextDomain' ),
				'update_item'           => __( 'Update Feline', 'NevadaCatHouseTextDomain' ),
				'view_item'             => __( 'View Feline', 'NevadaCatHouseTextDomain' ),
				'view_items'            => __( 'View Felines', 'NevadaCatHouseTextDomain' ),
				'search_items'          => __( 'Search Feline', 'NevadaCatHouseTextDomain' ),
				'not_found'             => __( 'Not found', 'NevadaCatHouseTextDomain' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'NevadaCatHouseTextDomain' ),
				'featured_image'        => __( 'Featured Image', 'NevadaCatHouseTextDomain' ),
				'set_featured_image'    => __( 'Set featured image', 'NevadaCatHouseTextDomain' ),
				'remove_featured_image' => __( 'Remove featured image', 'NevadaCatHouseTextDomain' ),
				'use_featured_image'    => __( 'Use as featured image', 'NevadaCatHouseTextDomain' ),
				'insert_into_item'      => __( 'Insert into item', 'NevadaCatHouseTextDomain' ),
				'uploaded_to_this_item' => __( 'Uploaded to this item', 'NevadaCatHouseTextDomain' ),
				'items_list'            => __( 'Items list', 'NevadaCatHouseTextDomain' ),
				'items_list_navigation' => __( 'Items list navigation', 'NevadaCatHouseTextDomain' ),
				'filter_items_list'     => __( 'Filter items list', 'NevadaCatHouseTextDomain' ),
		);
		$args = array(
				'label'                 => __( 'Feline', 'NevadaCatHouseTextDomain' ),
				'description'           => __( 'A cool cat', 'NevadaCatHouseTextDomain' ),
				'labels'                => $labels,
				'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', ),
				'taxonomies'            => array( 'category', 'post_tag' ),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'page',
		);
		register_post_type( 'feline', $args );
	}	
}