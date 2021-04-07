<?php
class Thb_Theme_Admin {
	/**
	 *  Main instance
	 */
	private static $_instance;

	/**
	 *  Theme Name
	 */
	public static $thb_theme_name;

	/**
	 *  Theme Version
	 */
	public static $thb_theme_version;

	/**
	 *  Theme Slug
	 */
	public static $thb_theme_slug;

	/**
	 *  Theme Directory
	 */
	public static $thb_theme_directory;

	/**
	 *  Theme Directory URL
	 */
	public static $thb_theme_directory_uri;

	/**
	 *  Product Key
	 */
	public static $thb_product_key;

	/**
	 *  Product Key Expiration
	 */
	public static $thb_product_key_expired;

	/**
	 *  Theme Constructor executed only once per request
	 */
	public function __construct() {
		if ( self::$_instance ) {
			_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
		}
	}

	/**
	 * You cannot clone this class
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}

	/**
	 * You cannot unserialize instances of this class
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}

	public static function instance() {
		global $thb_Theme_Admin;
		if ( ! self::$_instance ) {
			self::$_instance = new self();
			$thb_Theme_Admin = self::$_instance;

			// Theme Variables
			$theme                         = wp_get_theme();
			self::$thb_theme_name          = $theme->get( 'Name' );
			self::$thb_theme_version       = $theme->parent() ? $theme->parent()->get( 'Version' ) : $theme->get( 'Version' );
			self::$thb_theme_slug          = $theme->template;
			self::$thb_theme_directory     = get_template_directory() . '/';
			self::$thb_theme_directory_uri = get_template_directory_uri() . '/';
			self::$thb_product_key         = get_option( 'thb_' . self::$thb_theme_slug . '_key' );
			self::$thb_product_key_expired = get_option( 'thb_' . self::$thb_theme_slug . '_key_expired' );

			// After Setup Theme
			add_action( 'after_setup_theme', array( self::$_instance, 'after_setup_theme' ) );

			// Setup Admin Menus
			if ( is_admin() ) {
				self::$_instance->initAdminPages();
			}
		}

		return self::$_instance;
	}
	/**
	 *  After Theme Setup
	 */
	public function after_setup_theme() {
		/* WooCommerce Support */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );

		/* WooCommerce Products per Page */
		add_filter( 'loop_shop_per_page', 'thb_shops_per_page', 20 );

		function thb_shops_per_page( $products_per_page ) {
			$products_per_page_get = filter_input( INPUT_GET, 'products_per_page', FILTER_VALIDATE_INT );
			$products_per_page     = isset( $products_per_page_get ) ? $products_per_page_get : ot_get_option( 'products_per_page' );
			return $products_per_page;
		}

		/* Gutenberg */
		add_theme_support( 'align-wide' );
		add_theme_support( 'align-full' );
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Accent Color', 'notio' ),
					'slug'  => 'thb-accent',
					'color' => ot_get_option( 'accent_color', '#1aa97f' ),
				),
			)
		);

		/* Text Domain */
		load_theme_textdomain( 'notio', get_stylesheet_directory() . '/inc/languages' );

		/* Add Support Support */
		add_theme_support( 'html5' );
		add_theme_support( 'nav-menus' );
		add_theme_support( 'automatic-feed-links' );

		/* Background Support */
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'f9f9f9',
			)
		);
		add_filter( 'use_default_gallery_style', '__return_false' );

		/* Title Support */
		add_theme_support( 'title-tag' );

		/* Required Settings */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1170;
		}
		add_theme_support( 'automatic-feed-links' );

		/* Image Settings */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 140, 120, true );

		$thb_image_sizes = self::$_instance->thb_image_sizes();

		// Register image size
		foreach ( $thb_image_sizes as $image_size ) {
			add_image_size( $image_size['slug'], $image_size['width'], $image_size['height'], $image_size['crop'] );
		}

		/* HTML5 Galleries */
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );

		/* Register Menus */
		register_nav_menus(
			array(
				'nav-menu' => esc_html__( 'Navigation Menu', 'notio' ),
			)
		);

		$sidebars = ot_get_option( 'sidebars' );
		if ( ! empty( $sidebars ) ) {
			foreach ( $sidebars as $sidebar ) {
				register_sidebar(
					array(
						'name'          => $sidebar['title'],
						'id'            => $sidebar['id'],
						'description'   => '',
						'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h6>',
						'after_title'   => '</h6>',
					)
				);
			}
		}
	}
	public function thb_image_sizes() {
		$thb_image_sizes = apply_filters(
			'thb_image_sizes_filter',
			array(
				array(
					'slug'   => 'notio-thumbnail',
					'width'  => 70,
					'height' => 60,
					'crop'   => true,
				),
				array(
					'slug'   => 'notio-single',
					'width'  => 400,
					'height' => 200,
					'crop'   => true,
				),
				array(
					'slug'   => 'notio-masonry',
					'width'  => 300,
					'height' => 9999,
					'crop'   => false,
				),
				array(
					'slug'   => 'notio-general',
					'width'  => 300,
					'height' => 200,
					'crop'   => true,
				),
				array(
					'slug'   => 'notio-square',
					'width'  => 380,
					'height' => 350,
					'crop'   => true,
				),
				array(
					'slug'   => 'notio-rectangle',
					'width'  => 380,
					'height' => 315,
					'crop'   => true,
				),
				array(
					'slug'   => 'notio-tall',
					'width'  => 380,
					'height' => 700,
					'crop'   => true,
				),
				array(
					'slug'   => 'notio-wide',
					'width'  => 760,
					'height' => 350,
					'crop'   => true,
				),
			)
		);

		function thb_calculate_image_orientation( $thb_image_sizes ) {
			if ( ! is_array( $thb_image_sizes ) ) {
				return;
			}
			$new_sizes = array();
			foreach ( $thb_image_sizes as $image_size ) {
				$new_sizes[] = array(
					'slug'   => $image_size['slug'] . '-small',
					'width'  => absint( $image_size['width'] / 2 ),
					'height' => $image_size['height'] === 9999 ? 9999 : absint( $image_size['height'] * 2 ),
					'crop'   => $image_size['crop'],
				);
				$new_sizes[] = array(
					'slug'   => $image_size['slug'] . '-x2',
					'width'  => $image_size['width'] * 2,
					'height' => $image_size['height'] === 9999 ? 9999 : $image_size['height'] * 2,
					'crop'   => $image_size['crop'],
				);
				$new_sizes[] = array(
					'slug'   => $image_size['slug'] . '-x3',
					'width'  => $image_size['width'] * 3,
					'height' => $image_size['height'] === 9999 ? 9999 : $image_size['height'] * 3,
					'crop'   => $image_size['crop'],
				);
				$new_sizes[] = array(
					'slug'   => $image_size['slug'] . '-mini',
					'width'  => 20,
					'height' => $image_size['height'] === 9999 ? 9999 : absint( ( $image_size['height'] * 20 ) / $image_size['width'] ),
					'crop'   => $image_size['crop'],
				);
			}
			return $new_sizes;
		}
		$new_sizes = thb_calculate_image_orientation( $thb_image_sizes );
		foreach ( $new_sizes as $new_size ) {
			$thb_image_sizes[] = $new_size;
		}
		return $thb_image_sizes;
	}
	public function thbDemos() {
		return array(
			array(
				'import_file_name'         => 'Notio',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/notio/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/notio/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/notio.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net',
			),
			array(
				'import_file_name'         => 'Adam Warlock',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/adamwarlock/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/adamwarlock/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/adam_warlock.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/adamwarlock',
			),
			array(
				'import_file_name'         => 'Brielle',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/brielle/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/brielle/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/brielle.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/brielle',
			),
			array(
				'import_file_name'         => 'Broadwick',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/broadwick/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/broadwick/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/broadwick.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/broadwick',
			),
			array(
				'import_file_name'         => 'Burttton',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/burttton/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/burttton/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/burttton.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/burttton',
			),
			array(
				'import_file_name'         => 'Nordic',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/nordic/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/nordic/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/nordic.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/nordic',
			),
			array(
				'import_file_name'         => 'Orwell',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/orwell/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/orwell/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/orwell.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/orwell',
			),
			array(
				'import_file_name'         => 'Quasar',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/quasar/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/quasar/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/quasar.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/quasar',
			),
			array(
				'import_file_name'         => 'Sam Dunn',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/samdunn/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/samdunn/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/sam_dunn.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/samdunn',
			),
			array(
				'import_file_name'         => 'Taneleer',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/taneleer/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/taneleer/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/taneleer.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/taneleer',
			),
			array(
				'import_file_name'         => 'Space',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/space/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/space/theme-options.txt',
				'import_widget_file_url'   => 'https://themes.fuelthemes.net/theme-demo-files/notio/space/widget_data.json',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/space.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/space',
			),
			array(
				'import_file_name'         => 'Canvas',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/canvas/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/canvas/theme-options.txt',
				'import_widget_file_url'   => 'https://themes.fuelthemes.net/theme-demo-files/notio/canvas/widget_data.json',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/canvas.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/canvas',
			),
			array(
				'import_file_name'         => 'Morrisward',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/morrisward/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/morrisward/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/morris.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/morrisward',
			),
			array(
				'import_file_name'         => 'Shanua',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/shanua/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/shanua/theme-options.txt',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/shanua.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/shanua',
			),
			array(
				'import_file_name'         => 'Perfectus',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/perfectus/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/perfectus/theme-options.txt',
				'import_widget_file_url'   => 'https://themes.fuelthemes.net/theme-demo-files/notio/perfectus/widget_data.json',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/perfectus.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/perfectus',
			),
			array(
				'import_file_name'         => 'Oracle',
				'import_file_url'          => 'https://themes.fuelthemes.net/theme-demo-files/notio/oracle/democontent.xml',
				'import_theme_options_url' => 'https://themes.fuelthemes.net/theme-demo-files/notio/oracle/theme-options.txt',
				'import_widget_file_url'   => 'https://themes.fuelthemes.net/theme-demo-files/notio/oracle/widget_data.json',
				'import_image'             => self::$thb_theme_directory_uri . 'assets/img/admin/demos/homepages/oracle.jpg',
				'import_demo_url'          => 'https://newnotio.fuelthemes.net/oracle',
			),
		);
	}
	/**
	 *  Inintialize Admin Pages
	 */
	public function initAdminPages() {
		global $pagenow;

		// Script and styles
		add_action( 'admin_enqueue_scripts', array( & $this, 'adminPageEnqueue' ) );

		// Menu Pages
		add_action( 'admin_menu', array( & $this, 'adminSetupMenu' ), 1 );

		// Theme Options Redirect
		if ( isset( $_GET['page'] ) ) {
			if ( 'admin.php' == $pagenow && 'thb-theme-options' == $_GET['page'] ) {
				if ( ! ( defined( 'WP_CLI' ) && WP_CLI ) ) {
					wp_redirect( admin_url( 'themes.php?page=ot-theme-options' ) );
					die();
				}
			}
		}

		// Redirect to Main Page
		add_action( 'after_switch_theme', array( & $this, 'thb_activation_redirect' ) );

		// Ajax Option Update
		add_action( 'wp_ajax_thb_update_options', array( & $this, 'thb_update_options' ) );
		add_action( 'wp_ajax_nopriv_thb_update_options', array( & $this, 'thb_update_options' ) );

		// Admin Notices
		add_action( 'admin_notices', array( & $this, 'thb_admin_notices' ) );

		// Theme Updates
		add_action( 'admin_init', array( & $this, 'thb_theme_update' ) );

		// Plugin Update Nonce
		add_action( 'register_sidebar', array( & $this, 'thb_theme_admin_init' ) );

	}
	function thb_admin_notices() {
		$remote_ver = get_option( 'thb_' . self::$thb_theme_slug . '_remote_ver' ) ? get_option( 'thb_' . self::$thb_theme_slug . '_remote_ver' ) : self::$thb_theme_version;
		$local_ver  = self::$thb_theme_version;

		if ( version_compare( $local_ver, $remote_ver, '<' ) ) {
			if (
				( ! self::$thb_product_key && ( self::$thb_product_key_expired == 0 ) ) ||
				( self::$thb_product_key && ( self::$thb_product_key_expired == 1 ) )
			) {
				echo '<div class="notice is-dismissible error thb_admin_notices">
				<p>There is an update available for the <strong>' . esc_html( self::$thb_theme_name ) . '</strong> theme. Go to <a href="' . esc_url( admin_url( 'admin.php?page=thb-product-registration' ) ) . '">Product Registration</a> to enable theme updates.</p>
				</div>';
			}

			if ( ( self::$thb_product_key && ( self::$thb_product_key_expired == 0 ) ) ) {
				echo '<div class="notice is-dismissible error thb_admin_notices">
				<p>There is an update available for the <strong>' . esc_html( self::$thb_theme_name ) . '</strong> theme. <a href="' . esc_url( admin_url() ) . 'update-core.php">Update now</a>.</p>
				</div>';
			}
		}
	}
	public function thb_update_options() {
		check_ajax_referer( 'thb_register_ajax', 'security' );
		$key     = filter_input( INPUT_POST, 'key', FILTER_SANITIZE_STRING );
		$expired = filter_input( INPUT_POST, 'expired', FILTER_VALIDATE_BOOLEAN );
		update_option( 'thb_' . self::$thb_theme_slug . '_key', $key );
		update_option( 'thb_' . self::$thb_theme_slug . '_key_expired', $expired );
		wp_die();
	}
	public function thb_theme_update() {
		add_filter( 'pre_set_site_transient_update_themes', array( & $this, 'thb_check_for_update' ) );
		add_filter( 'upgrader_pre_download', array( $this, 'thb_upgradeFilter' ), 10, 4 );
	}
	public function thb_check_for_update_plugins() {
		$name = 'thb_' . self::$thb_theme_slug . '_plugin_transient';
		$data = get_transient( $name );
		if ( ! $data ) {
			$args = array(
				'timeout' => 30,
				'body'    => array(
					'item_ids'    => '242431,2751380',
					'product_key' => self::$thb_product_key,
				),
			);

			$request = wp_remote_get( self::$_instance->thb_dashboard_url( 'plugin/version' ), $args );

			$data = '';
			if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
				$data = json_decode( wp_remote_retrieve_body( $request ) );
			}
			set_transient( $name, $data, 6 * HOUR_IN_SECONDS );
		}
		return $data;
	}
	public function thb_check_for_update( $transient ) {
		global $wp_filesystem;
		$args = array(
			'timeout' => 30,
			'body'    => array(
				'theme_name'  => self::$thb_theme_name,
				'product_key' => self::$thb_product_key,
			),
		);

		$request = wp_remote_get( self::$_instance->thb_dashboard_url( 'version' ), $args );

		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			$data = json_decode( wp_remote_retrieve_body( $request ) );
			update_option( 'thb_' . self::$thb_theme_slug . '_key_expired', 0 );

			if ( isset( $data->success ) && $data->success == false ) {
				self::$thb_product_key_expired = 1;
				update_option( 'thb_' . self::$thb_theme_slug . '_key_expired', 1 );
			} else {
				if ( version_compare( self::$thb_theme_version, $data->version, '<' ) ) {
					$transient->response[ self::$thb_theme_slug ] = array(
						'new_version' => $data->version,
						'package'     => $data->download_url,
						'url'         => 'https://fuelthemes.net',
					);

					update_option( 'thb_' . self::$thb_theme_slug . '_remote_ver', $data->version );
				}
			}
		}
		return $transient;
	}
	public function thb_upgradeFilter( $reply, $package, $updater ) {
		global $wp_filesystem;
		$cond = ( ! self::$thb_product_key || ( self::$thb_product_key_expired == 1 ) );

		if ( isset( $updater->skin->theme_info ) && $updater->skin->theme_info['Name'] == self::$thb_theme_name ) {
			if ( $cond ) {
				return new WP_Error( 'no_credentials', sprintf( __( 'To receive automatic updates, registration is required. Please visit <a href="%1$s" target="_blank">Product Registration</a> to activate your theme.', 'notio' ), admin_url( 'admin.php?page=thb-product-registration' ) ) );
			}
		}

		// VisualComposer
		if ( ( isset( $updater->skin->plugin ) ) && ( $updater->skin->plugin == 'js_composer/js_composer.php' ) ) {
			if ( $cond ) {
				return new WP_Error( 'no_credentials', sprintf( __( 'To receive automatic updates, registration is required. Please visit <a href="%1$s" target="_blank">Product Registration</a> to activate your theme.', 'notio' ), admin_url( 'admin.php?page=thb-product-registration' ) ) );
			}
		}
		return $reply;
	}
	public function thb_plugins_install( $item ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$installed_plugins = get_plugins();

		$item['sanitized_plugin'] = $item['name'];

		// WordPress Repository
		if ( ! $item['version'] ) {
			$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
		}

		// Install Link
		if ( ! isset( $installed_plugins[ $item['file_path'] ] ) ) {
			$actions = array(
				'install' => sprintf(
					'<a href="%1$s" class="button" title="Install %2$s">Install Now</a>',
					esc_url(
						wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'tgmpa-install' => 'install-plugin',
									'return_url'    => network_admin_url( 'admin.php?page=thb-plugins' ),
								),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
							),
							'tgmpa-install',
							'tgmpa-nonce'
						)
					),
					$item['sanitized_plugin']
				),
			);
		}
		// Activate Link
		elseif ( is_plugin_inactive( $item['file_path'] ) ) {
			$actions = array(
				'activate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
					esc_url(
						add_query_arg(
							array(
								'plugin'             => urlencode( $item['slug'] ),
								'plugin_name'        => urlencode( $item['sanitized_plugin'] ),
								'thb-activate'       => 'activate-plugin',
								'thb-activate-nonce' => wp_create_nonce( 'thb-activate' ),
								'return_url'         => network_admin_url( 'admin.php?page=thb-plugins' ),
							),
							admin_url( 'admin.php?page=thb-plugins' )
						)
					),
					$item['sanitized_plugin']
				),
			);
		}
		// Update Link

		elseif ( version_compare( $installed_plugins[ $item['file_path'] ]['Version'], $item['version'], '<' ) ) {
			$actions = array(
				'update' => sprintf(
					'<a href="%1$s" class="button button-update" title="Install %2$s"><span class="dashicons dashicons-update"></span> Update</a>',
					wp_nonce_url(
						add_query_arg(
							array(
								'page'         => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'       => urlencode( $item['slug'] ),
								'tgmpa-update' => 'update-plugin',
								'version'      => urlencode( $item['version'] ),
								'return_url'   => network_admin_url( 'admin.php?page=thb-plugins' ),
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-update',
						'tgmpa-nonce'
					),
					$item['sanitized_plugin']
				),
			);
		} elseif ( self::$_instance->thb_ispluginactive( $item['file_path'] ) ) {
			$actions = array(
				'deactivate' => sprintf(
					'<a href="%1$s" class="button" title="Deactivate %2$s">Deactivate</a>',
					esc_url(
						add_query_arg(
							array(
								'plugin'               => urlencode( $item['slug'] ),
								'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
								// 'plugin_source'          => urlencode( $item['source'] ),
								'thb-deactivate'       => 'deactivate-plugin',
								'thb-deactivate-nonce' => wp_create_nonce( 'thb-deactivate' ),
							),
							admin_url( 'admin.php?page=thb-plugins' )
						)
					),
					$item['sanitized_plugin']
				),
			);
		}

		return $actions;
	}
	public function thb_theme_admin_init() {
		$get_name = filter_input( INPUT_GET, 'plugin_name', FILTER_SANITIZE_STRING );

		if ( isset( $_GET['thb-deactivate'] ) && $_GET['thb-deactivate'] == 'deactivate-plugin' ) {

			check_admin_referer( 'thb-deactivate', 'thb-deactivate-nonce' );

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			foreach ( $plugins as $plugin_name => $plugin ) {

				if ( $plugin['Name'] == $get_name ) {
						deactivate_plugins( $plugin_name );
				}
			}
		}

		if ( isset( $_GET['thb-activate'] ) && $_GET['thb-activate'] == 'activate-plugin' ) {

			check_admin_referer( 'thb-activate', 'thb-activate-nonce' );

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			foreach ( $plugins as $plugin_name => $plugin ) {
				if ( $plugin['Name'] == $get_name ) {
					activate_plugin( $plugin_name );
				}
			}
		}

	}
	public function thb_activation_redirect() {
		if ( ! ( defined( 'WP_CLI' ) && WP_CLI ) ) {
			$notio_installed = 'notio_installed';

			if ( false == get_option( $notio_installed, false ) ) {
				update_option( $notio_installed, true );
				wp_redirect( admin_url( 'admin.php?page=thb-product-registration' ) );
				die();
			}

			delete_option( $notio_installed );
		}
	}
	public function adminPageEnqueue() {
		wp_enqueue_script( 'thb-admin-meta', self::$thb_theme_directory_uri . 'assets/js/admin-meta.min.js', array( 'jquery' ), esc_attr( self::$thb_theme_version ) );
		wp_enqueue_style( 'thb-admin-css', self::$thb_theme_directory_uri . 'assets/css/admin.css', null, esc_attr( self::$thb_theme_version ) );
		wp_enqueue_style( 'thb-admin-vs-css', self::$thb_theme_directory_uri . 'assets/css/admin_vc.css', null, esc_attr( self::$thb_theme_version ) );

		if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
			wp_enqueue_style( 'vc_extra_css', self::$thb_theme_directory_uri . 'assets/css/vc_extra.css' );
			wp_enqueue_script( 'thb-admin-vc', self::$thb_theme_directory_uri . 'assets/js/admin-vc.min.js', array( 'jquery' ), esc_attr( self::$thb_theme_version ) );
		}
	}
	public function adminSetupMenu() {

		// Product Registration
		add_menu_page( self::$thb_theme_name, self::$thb_theme_name, 'edit_theme_options', 'thb-product-registration', array( & $this, 'thb_Product_Registration' ), self::$thb_theme_directory_uri . 'assets/img/admin/fuelthemes-icon.svg', 3 );

		// Product Registration
		add_submenu_page( 'thb-product-registration', 'Registration', 'Registration', 'edit_theme_options', 'thb-product-registration', array( & $this, 'thb_Product_Registration' ) );

		// Plugins
		add_submenu_page( 'thb-product-registration', 'Plugins', 'Plugins', 'edit_theme_options', 'thb-plugins', array( & $this, 'thb_Plugins' ) );

		// Demo Import
		add_submenu_page( 'thb-product-registration', 'Demo Import', 'Demo Import', 'edit_theme_options', 'thb-demo-import', array( & $this, 'thb_Demo_Import' ) );

		// Theme Options
		add_submenu_page( 'thb-product-registration', 'Theme Options', 'Theme Options', 'edit_theme_options', 'thb-theme-options', '__return_false' );

	}
	public function thb_Plugins() {
		get_template_part( 'inc/admin/welcome/pages/plugins' );
	}
	public function thb_Product_Registration() {
		get_template_part( 'inc/admin/welcome/pages/registration' );
	}
	public function thb_Demo_Import() {
		get_template_part( 'inc/admin/welcome/pages/demo-import' );
	}
	public function thb_ispluginactive( $value ) {
		$func = 'is_plugin' . '_active';
		return $func( $value );
	}
	/**
	 *  Inintialize API
	 */
	public function thb_dashboard_url( $type = null ) {
		$url = 'https://my.fuelthemes.net';
		switch ( $type ) {
			case 'verify':
				$url .= '/api/verify';
				break;
			case 'verify-by-purchase':
				$url .= '/api/verify-by-purchase';
				break;
			case 'version':
				$url .= '/api/version';
				break;
			case 'plugin/version':
				$url .= '/api/plugin/version';
				break;
			case 'demo':
				$url .= '/api/demo';
				break;
		}
		return $url;
	}
}
// Main instance shortcut
function thb_Theme_Admin() {
	global $thb_Theme_Admin;
	return $thb_Theme_Admin;
}
Thb_Theme_Admin::instance();
