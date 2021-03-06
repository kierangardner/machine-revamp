<?php $blog_pagination_style = is_home() ? ot_get_option( 'blog_pagination_style', 'style1' ) : 'style1'; ?>
<div class="blog-padding">
	<section class="blog-section row <?php echo esc_attr( 'pagination-' . $blog_pagination_style ); ?>" data-count="<?php echo esc_attr( get_option( 'posts_per_page' ) ); ?>" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_blog_ajax' ) ); ?>">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'inc/templates/blogbit/style3' );
			endwhile; else :
				get_template_part( 'inc/templates/blog/notfound' );
			endif;
			?>
	</section>
</div>
<?php do_action( 'thb_blog_pagination' ); ?>
