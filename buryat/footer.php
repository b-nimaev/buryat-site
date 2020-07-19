<footer>
	<div class="container">
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'buryat' ) ); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( 'Proudly powered by %s', 'buryat' ), 'WordPress' );
			?>
		</a>
		<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'buryat' ), 'buryat', '<a href="http://vk.com/arcp3">alexandr balzhinimaev</a>' );
			?>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
