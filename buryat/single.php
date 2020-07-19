<?php get_header(); ?>

<main>
	<div class="container">
		<div class="row">
			<?php get_sidebar(); ?>
			
			<div class="col">
			
			<?php while ( have_posts() ) : the_post();	
				get_template_part( 'template-parts/content', get_post_type() ); 
				the_post_navigation( array( 'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'buryat' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'buryat' ) . '</span> <span class="nav-title">%title</span>', ));

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

			</div>
		</div>
	<?php endwhile; // End of the loop. ?>

</main><!-- #main -->

<?php get_footer();
