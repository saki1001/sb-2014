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


// Add to admin_init function
add_filter('manage_edit-project_columns', 'add_new_project_columns');

function add_new_project_columns($project_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
     
    $new_columns['title'] = _x('Gallery Name', 'column name');
    $new_columns['featured_image'] = __('Featured Image');
    $new_columns['project_categories'] = __('Categories');
    $new_columns['author'] = __('Author');
    $new_columns['date'] = _x('Date', 'column name');
 
    return $new_columns;
}

// Add Columns to Project Admin Page
add_action('manage_project_posts_custom_column', 'manage_project_columns', 10, 2);
 
function manage_project_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
    case 'project_categories' :
        $terms = get_the_terms( $id, 'project_category' );
        if ($terms && ! is_wp_error($terms)) :
        	$term_slugs_arr = array();
        	foreach ($terms as $term) {
        	    $term_slugs_arr[] = $term->name;
        	}
        	$terms_slug_str = join( " ", $term_slugs_arr);
        endif;
        echo $terms_slug_str;
    break;
    case 'featured_image':
        // Get the thumbnail
        $post_thumbnail_id = get_post_thumbnail_id($id);
        
        if ($post_thumbnail_id) {  
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'small-thumbnail');  
            echo '<img src="' . $post_thumbnail_img[0] . '" width="115" height ="115" alt="image-' . $id . '" >';  
        }  
    break;
    default:
        break;
    } // end switch
}   
