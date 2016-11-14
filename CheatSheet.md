# style.css
```
/*
Theme Name: Twenty Seventeen
Theme URI: http://wordpress.org/themes/twentythirteen
Author: the WordPress team
Author URI: http://wordpress.org/
Description: The 2013 theme for WordPress takes us back to the blog, featuring a full range of post formats, each displayed beautifully in their own unique way. Design details abound, starting with a vibrant color scheme and matching header images, beautiful typography and icons, and a flexible layout that looks great on any device, big or small.
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: black, brown, orange, tan, white, yellow, light, one-column, two-columns, right-sidebar, flexible-width, custom-header, custom-menu, editor-style, featured-images, microformats, post-formats, rtl-language-support, sticky-post, translation-ready
Text Domain: twentythirteen

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/
```

# index.php and functions.php
## HTML Head
* Titel dynamisch machen

```
<title><?php
/*
 * Print the <title> tag based on what is being viewed.
 */
global $page, $paged;

wp_title( '|', true, 'right' );

// Add the blog name.
bloginfo( 'name' );

// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
	echo " | $site_description";

?></title>
```
* Charset (Zeichensatz)

```
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
```
* Stylesheet

```
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>"/>
```

* WP-Head

```
<?php wp_head(); ?>
```

## Header
* Sitename (Seitenname)

```
<a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo('name'); ?></a>
```

* Tagline (Untertitel)

```
<?php bloginfo('description'); ?>
```

* Header Hero-Image

```
<?php header_image(); ?>
```

* Activation of Header-Image in **functions.php**

```
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
```

## Navigation

* Menu Display (Anzeige des Menüs)

```
<?php
	if ( has_nav_menu( 'mainmenu' ) ) {
		wp_nav_menu(
			array(
				'theme_location'  => 'mainmenu',
				'menu'            => '',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 1
			)
		);
	}
?>
```
*short:*
```

```
<?php
	if ( has_nav_menu( 'mainmenu' ) ) {
		wp_nav_menu(
			array('theme_location'  => 'mainmenu')
		);
	}
?>
```

* Menu Registration in **functions.php**

```
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
```

## Content – The Loop
* Loop

```
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
	...
	<?php endwhile; ?>
<?php endif; ?>
```

* Article title (Titel des Artikels)

```
<?php the_title(); ?>
```

* Article content (Inhalt des Artikels)

```
<?php the_content(); ?>
```

* Article permalink (Link zum Artikel)

```
<?php the_permalink(); ?>
```

* Article date (Datum des Artikels) / Format: 1. November 2016

```
<?php the_time('d. F Y'); ?>
```

* Article author (Autor des Artikels)

```
<?php the_author(); ?>
```

* Thumbnail

```
<?php if( has_post_thumbnail() ): ?>
	<?php the_post_thumbnail( 'medium' ); ?>
<?php endif; ?>
```

## Sidebar
* Registration in **functions.php**

```
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
```

* Display of sidebar

```
<?php if( is_active_sidebar( 'aside-sidebar' ) ) : ?>
	<?php dynamic_sidebar( 'aside-sidebar' ); ?>
<?php endif; ?>
```

## Footer
* Navigation

```
<?php
	if ( has_nav_menu( 'footermenu' ) ) {
		wp_nav_menu(
			array('theme_location'  => 'footermenu')
		);
	}
?>
```

* WP Footer

```
<?php wp_footer(); ?>
```