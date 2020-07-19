<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<p><?php bloginfo( 'name' );echo "</p>";
				$buryat_description = get_bloginfo( 'description', 'display' );
			if ( $buryat_description || is_customize_preview() ) :
				?>
				<small class="site-description"><?php echo $buryat_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></small>
			<?php endif; ?>
			</a>

			 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			   <span class="navbar-toggler-icon"></span>
			 </button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">

				<?php
					wp_nav_menu( array(
						'theme_location'  => 'navbar',
						'menu'            => 'navbar',
						'container'       => 'ul',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarSupportedContent',
						'menu_class'      => 'navbar-nav ml-auto',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => '',
					) );
				?>

			</div>

		</nav><!-- #site-navigation -->
	</div>
</header><!-- #masthead -->
