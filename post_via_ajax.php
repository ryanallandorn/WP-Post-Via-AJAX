<?php

/**
* Plugin Name: Post via Ajax
 */

/* Enqueue JS
----- */

function pva_scripts() {
	wp_register_script( 'pva-js', plugin_dir_url( __FILE__ ) . 'pva.js', array( 'jquery' ), '', true );
	wp_localize_script( 'pva-js', 'pva_params', array( 'pva_ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'pva-js' );
};

add_action('wp_enqueue_scripts', 'pva_scripts');

// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_pva_create', 'pva_create' );
add_action( 'wp_ajax_pva_create', 'pva_create' );

/* WP Insert Post Function
----- */

function pva_create()
{
	$results = '';

	$post_title = $_POST['post_title'];

	// Create post object
	$new_pva_post = array(
		'post_type'		=> 'page',
		'post_title'	=> $post_title,
		'post_status'	=> 'publish',
		'post_author'	=> 1,
	);

	// Insert the post into the database
	wp_insert_post( $new_pva_post );
	die($results);
};



/* Form Shortcode
----- */

function pva_shortcode( $atts, $content = null ) {
	ob_start();
	include(plugin_dir_path( __FILE__ ) . 'post_via_ajax_field.php');
	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
	//pva();
};

add_shortcode( 'pva', 'pva_shortcode' );
