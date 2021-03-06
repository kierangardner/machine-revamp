<?php get_header(); ?>
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
			<?php if ( post_password_required() ) { ?>
				<?php get_template_part( 'inc/templates/blog/password' ); ?>
			<?php } else { ?>
				<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'post blog-post' ); ?> id="post-<?php the_ID(); ?>" role="article">
							<?php if ( has_post_thumbnail() ) { ?>
							<figure class="post-gallery parallax">
								<div class="parallax_bg">
									<?php the_post_thumbnail( 'notio-single-x3' ); ?>
								</div>
							</figure>
						<?php } ?>
						<div class="row max_width">
							<div class="small-12 medium-10 large-8 medium-centered columns">
								<header class="post-title">
									<?php get_template_part( 'inc/templates/postbits/post-meta' ); ?>
									<h1 itemprop="headline"><?php the_title(); ?></h1>
								</header>
								<div class="post-content">
									<?php the_content(); ?>
									<?php
									if ( is_single() ) {
										wp_link_pages(); }
									?>
								</div>
								<?php get_template_part( 'inc/templates/postbits/post-end' ); ?>
							</div>
						</div>
						<?php do_action( 'thb_PostMeta' ); ?>
				</article>
				<!-- Start #comments -->
				<section id="comments">
						<?php comments_template( '', true ); ?>
				</section>
				<!-- End #comments -->
				<?php do_action( 'thb_post_navigation' ); ?>
	<?php } ?>
		<?php
	endwhile;
endif;

get_footer();
