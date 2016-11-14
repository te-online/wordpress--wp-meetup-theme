<?php
/**
 * Adds menu position to the backend to choose from.
 *
 * By Thomas Ebert, te-online.net
 *
 */
if( !function_exists( 'meetup_register_menus' ) ) {
	function meetup_register_menus() {
		register_nav_menus(
        array(
            'mainmenu' => __('Hauptmenü', 'meetup'),
            'footermenu' => __('Menü im unteren Bereich (Footer)', 'meetup')
        )
		);
	}
}
add_action( 'init', 'meetup_register_menus' );

/**
 * Adds sidebar position to the backend to place widgets in.
 *
 * By Thomas Ebert, te-online.net
 *
 */
if( !function_exists( 'meetup_register_sidebars' ) ) {
	function meetup_register_sidebars() {
		register_sidebar(
      array(
       	'name'          => __( 'Seitenbereich', 'meetup' ),
				'id'            => 'aside-sidebar',
				'description'   => __( 'Bereich für interessante Details auf der rechten Seite.', 'meetup' ),
				'before_widget' => '',
				'after_widget'  => ''
      )
		);
	}
}
add_action( 'init', 'meetup_register_sidebars' );

/**
 * Adds theme support for modern features.
 *
 * By Thomas Ebert, te-online.net
 *
 */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );
	// Add support for a custom header image.
	$args = array(
		'width'         => 980,
		'height'        => 245,
		'uploads'       => true
	);
	add_theme_support( 'custom-header', $args );
}

?>