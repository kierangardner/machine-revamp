<?php
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );

	$vars        = $wp_query->query_vars;
	$thb_columns = array_key_exists( 'thb_columns', $vars ) ? $vars['thb_columns'] : 'small-12 medium-6 large-4';
?>
<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( $thb_columns . ' post columns blog-style2' ); ?> id="post-<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'notio-general-x2' ); ?></a>
	</figure>
	<?php } ?>
	<header class="post-title">
		<?php get_template_part( 'inc/templates/postbits/post-meta' ); ?>
		<h3 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	</header>
	<div class="post-content">
		<?php the_excerpt(); ?>
		<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Read More', 'notio' ); ?></a>
	</div>
	<?php do_action( 'thb_PostMeta' ); ?>
</article>
