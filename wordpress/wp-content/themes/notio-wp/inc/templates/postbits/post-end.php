<?php if ( 'on' === ot_get_option( 'article_tags', 'on' ) ) { ?>
<footer class="article-tags entry-footer">
	<?php
	$posttags = get_the_tags();
	if ( ! empty( $posttags ) ) {
		$return = '';
		foreach ( $posttags as $thb_tag ) {
			?>
			<a href="<?php echo esc_url( get_tag_link( $thb_tag->term_id ) ); ?>" title="<?php echo esc_attr( get_tag_link( $thb_tag->name ) ); ?>" class="tag-link"><?php echo esc_html( $thb_tag->name ); ?></a>
			<?php
		}
	}
	?>
</footer>
<?php } ?>
<?php
if ( 'on' === ot_get_option( 'article_author', 'on' ) ) {
	do_action( 'thb_author' );
}
if ( 'on' === ot_get_option( 'article_related', 'on' ) ) {
	do_action( 'thb_related' );
}
