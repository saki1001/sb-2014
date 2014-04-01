<?php
/**
* Plugin Name: Custom Post Type: Project
* Plugin URI: http://sakisato.com
* Description: Add a custom post type called "Project" to WordPress.
* Version: 1.0
* Author: Saki Sato
* Author URI: http://sakisato.com
* License: GPL2
*/

/*  Copyright 2014  Saki Sato  (email : saki.s.sato@gmail.com)
    
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


function custom_post_type_project() {
    
	$labels = array(
		'name'               => _x( 'Projects', 'post type general name' ),
		'singular_name'      => _x( 'Project', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'project' ),
		'add_new_item'       => __( 'Add New Project' ),
		'edit_item'          => __( 'Edit Project' ),
		'new_item'           => __( 'New Project' ),
		'all_items'          => __( 'All Projects' ),
		'view_item'          => __( 'View Project' ),
		'search_items'       => __( 'Search Projects' ),
		'not_found'          => __( 'No projects found' ),
		'not_found_in_trash' => __( 'No projects found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Projects'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds data about each project.',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
    
	register_post_type( 'project', $args );
}
add_action( 'init', 'custom_post_type_project' );

function project_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['project'] = array(
		0 => '', 
		1 => sprintf( __('Project updated. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Project updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Project published. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Product saved.'),
		8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'project_updated_messages' );

function custom_taxonomies_project() {
	$labels = array(
		'name'              => _x( 'Project Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Project Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Project Categories' ),
		'all_items'         => __( 'All Project Categories' ),
		'parent_item'       => __( 'Parent Project Category' ),
		'parent_item_colon' => __( 'Parent Project Category:' ),
		'edit_item'         => __( 'Edit Project Category' ), 
		'update_item'       => __( 'Update Project Category' ),
		'add_new_item'      => __( 'Add New Project Category' ),
		'new_item_name'     => __( 'New Project Category' ),
		'menu_name'         => __( 'Project Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'project_category', 'project', $args );
}
add_action( 'init', 'custom_taxonomies_project', 0 );

