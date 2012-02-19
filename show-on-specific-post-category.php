<?php
/**
 * For use with Jared Atch's custom metaboxes Wordpress plugin.
 * @link https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/
 * 
 * Show on specific post category
 * @author Maxim McNair
 * @link www.maximmcnair.com
 *
 */
	
// Add for Post Category
function add_for_post_category( $display, $meta_box ) {
	if( 'post-category' !== $meta_box['show_on']['key'] )
		return $display;
	
	//Get the current ID
	if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
	elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	if( !isset( $post_id ) )
		return false;
	
	$post_cat = get_the_category($post_id);
	$post_cat = $post_cat[0]->category_nicename;

	// If value isn't an array, turn it into one	
	$meta_box['show_on']['value'] = !is_array( $meta_box['show_on']['value'] ) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];
	
	if ( in_array( $post_cat, $meta_box['show_on']['value'] ) )
		return true;
	else
		return false;
}
add_filter( 'cmb_show_on', 'add_for_post_category', 10, 2 );
