<!DOCTYPE html>
<html>
	<head>
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
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>"/>

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Bitter:400,400i,700|Montserrat:400,700" rel="stylesheet">

		<?php wp_head(); ?>

	</head>

	<body>
		<header class="header-text">
			<h1><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo('name'); ?></a></h1>
			<h4><?php bloginfo('description'); ?></h4>
		</header>

		<section class="header-image">
			<img src="<?php header_image(); ?>" alt="Header Image" />
		</section>

		<nav class="main-nav">
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
		</nav>

		<div class="content-wrapper">

			<main class="main-content">

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<article class="frontpage-article">
							<div class="article-title">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="article-meta"><?php the_time('d. F Y'); ?> von <?php the_author(); ?></p>
							</div>
							<div class="article-image">
								<?php if( has_post_thumbnail() ): ?>
									<?php the_post_thumbnail( 'medium' ); ?>
								<?php endif; ?>
							</div>
							<div class="article-content">
								<?php the_content(); ?>
							</div>
						</article>

					<?php endwhile; ?>
				<?php endif; ?>

			</main>

			<aside class="sidebar">
				<?php if( is_active_sidebar( 'aside-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'aside-sidebar' ); ?>
				<?php endif; ?>
			</aside>

		</div>

		<footer class="footer-menu">
			<nav class="footer-nav">
				<?php
					if ( has_nav_menu( 'footermenu' ) ) {
						wp_nav_menu(
							array('theme_location'  => 'footermenu')
						);
					}
				?>
			</nav>
		</footer>

		<?php wp_footer(); ?>

	</body>
</html>