<?php
	$menu_social_link = ot_get_option( 'menu_social_link' );
?>
<nav id="mobile-menu" class="<?php echo esc_attr( ot_get_option( 'mobile_menu_style', 'style1' ) ); ?>" data-behaviour="<?php echo esc_attr( ot_get_option( 'submenu_behaviour', 'thb-submenu' ) ); ?>">
	<div class="spacer"></div>
	<div class="menu-container custom_scroll">
		<a href="#" class="panel-close"><?php get_template_part( 'assets/svg/arrows_remove.svg' ); ?></a>
		<div class="menu-holder">
			<?php if ( has_nav_menu( 'nav-menu' ) ) { ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'nav-menu',
						'depth'          => 3,
						'container'      => false,
						'menu_class'     => 'mobile-menu',
						'walker'         => new thb_mobileDropdown(),
					)
				);
				?>
			<?php } ?>
		</div>

		<div class="menu-footer">
			<?php echo do_shortcode( ot_get_option( 'menu_footer' ) ); ?>
			<div class="social-links">
				<?php do_action( 'thb_social_links', $menu_social_link, false ); ?>
			</div>
			<?php
			if ( 'on' === ot_get_option( 'menu_ls' ) ) {
				do_action( 'thb_language_switcher' );
			}
			?>
		</div>
	</div>
</nav>
