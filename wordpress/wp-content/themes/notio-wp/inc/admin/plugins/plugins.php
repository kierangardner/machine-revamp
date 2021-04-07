<?php

if ( ! is_admin() ) {
	return;
}

require Thb_Theme_Admin::$thb_theme_directory . 'inc/admin/plugins/class-tgm-plugin-activation.php';

function thb_register_required_plugins() {
	$data = thb_Theme_Admin()->thb_check_for_update_plugins();
	if ( isset( $data->plugins ) ) {
		foreach ( $data->plugins as $plugin ) {
			switch ( $plugin->plugin_name ) {
				case 'WPBakery Visual Composer':
				case 'WPBakery Page Builder':
					$slug = 'js_composer';
					break;
				case 'Slider Revolution':
					$slug = 'revslider';
					break;
			}
			$plugins[] = array(
				'name'         => $plugin->plugin_name,
				'slug'         => $slug,
				'source'       => $plugin->download_url,
				'version'      => $plugin->version,
				'required'     => true,
				'external_url' => '',
				'image_url'    => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/plugins/' . esc_attr( $slug ) . '.png',
			);
		}
	} else {
		$plugins[] = array(
			'name'      => 'WPBakery Visual Composer',
			'slug'      => 'js_composer',
			'source'    => get_template_directory() . '/inc/admin/plugins/plugins/codecanyon-NbzyMfMB-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip',
			'version'   => '6.6.0',
			'required'  => true,
			'image_url' => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/plugins/js_composer.png',
		);
	}
	$plugins[] = array(
		'name'               => 'WooCommerce',
		'slug'               => 'woocommerce',
		'required'           => true,
		'force_activation'   => false,
		'force_deactivation' => false,
		'image_url'          => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/plugins/woo.png',
	);
	$plugins[] = array(
		'name'               => esc_html__( 'Notio - Required Plugin', 'notio' ),
		'slug'               => 'notio-plugin',
		'source'             => get_template_directory() . '/inc/plugins/notio-plugin.zip',
		'version'            => '1.4.0',
		'required'           => true,
		'force_activation'   => false,
		'force_deactivation' => false,
		'image_url'          => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/plugins/notio.png',
	);

	$config = array(
		'domain'       => 'notio',
		'default_path' => '',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'return' => esc_html__( 'Return to Theme Plugins', 'notio' ),
		),
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'thb_register_required_plugins' );
