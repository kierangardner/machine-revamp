<?php

/**
 * Custom Walker - Mobile Menu
 *
 * @access      public
 * @since       1.0
 * @return      void
 */
class thb_mobileDropdown extends Walker_Nav_Menu {
	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 * @since 4.4.0 'nav_menu_item_args' filter was added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = ! empty( $item->menuanchor ) ? 'has-hash' : '';
		/**
		 * Filter the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param array  $args  An array of arguments.
		 * @param object $item  Menu item data object.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of wp_nav_menu() arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$menubg      = ! empty( $item->menubg ) ? $item->menubg : '';
		$menu_anchor = ! empty( $item->menuanchor ) ? '#' . esc_attr( $item->menuanchor ) : '';

		$attributes = '';

		if ( $menubg ) {
			$atts['data-menubg'] = $menubg;
		}
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value . $menu_anchor ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filter a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string $title The menu item's title.
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of wp_nav_menu() arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= ( in_array( 'menu-item-has-children', $item->classes ) ? '<div class="thb-arrow"></div>' : '' ) . '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0
 * @return      void
 */
class thb_MegaMenu extends Walker_Nav_Menu {

	var $active_megamenu = 0;

	/**
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
			$menubg_class = $args->menubg != '' ? 'has_bg' : '';
			$menubg_style = $args->menubg != '' ? 'style="background-image:url(' . $args->menubg . ');"' : '';

			$indent  = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul class=\"sub-menu " . $menubg_class . '{locate_class}" ' . $menubg_style . ">\n";
	}

	/**
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "$indent</ul>\n";

		if ( $this->active_megamenu && $depth === 1 ) {
				$output = str_replace( '{locate_class}', ' thb_mega_menu', $output );
		} else {
				$output = str_replace( '{locate_class}', '', $output );
		}
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
			$item_output = $column_class = '';

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			/**
			 * Filter the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

		if ( $depth === 0 ) {
				$this->active_megamenu = get_post_meta( $item->ID, '_menu_item_megamenu', true );

			if ( $this->active_megamenu ) {
				$class_names .= ' menu-item-mega-parent '; }
		}
		if ( $depth === 1 ) {
			if ( $this->active_megamenu ) {
				$class_names .= ' menu-item-mega-child '; }
		}
		if ( $depth === 2 ) {
			if ( $this->active_megamenu ) {
				$class_names .= ' menu-item-mega-link '; }
		}

			$title = apply_filters( 'the_title', $item->title, $item->ID );

		if ( $title != '-' && $title != '"-"' ) {

				$atts           = array();
				$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
				$atts['target'] = ! empty( $item->target ) ? $item->target : '';
				$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
				$atts['href']   = ! empty( $item->url ) ? $item->url : '';
				$menu_icon_tag  = ! empty( $item->menuicon ) ? '<i class="fa ' . esc_attr( $item->menuicon ) . '"></i>' : '';
				$menu_anchor    = ! empty( $item->menuanchor ) ? '#' . esc_attr( $item->menuanchor ) : '';
				$menu_bg        = ! empty( $item->menubg ) ? '#' . esc_attr( $item->menubg ) : '';

				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

				$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value . $menu_anchor ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

				$item_output = $args->before;
			if ( $depth === 1 && $this->active_megamenu ) {
				$item_output .= '<div class="megamenu-title">';
			}
				$item_output .= '<a' . $attributes . '>';
				/** This filter is documented in wp-includes/post-template.php */
				$item_output .= $menu_icon_tag;
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= '</a>';
			if ( $depth === 1 && $this->active_megamenu ) {
				$item_output .= '</div>';
			}
				$item_output .= $args->after;
		}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $class_names . '>';
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

			apply_filters( 'walker_nav_menu_start_lvl', $item_output, $depth, $args->menubg = $item->menubg );
	}
}

/* Custom Menu Fields */
$GLOBALS['thb_custom_menu'] = new rc_thb_custom_menu();

class rc_thb_custom_menu {

		/*
		--------------------------------------------*
		 * Constructor
		 *--------------------------------------------*/

		/**
		 * Initializes the plugin by setting localization, filters, and administration functions.
		 */
	function __construct() {
			// add custom menu fields to menu
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'rc_scm_add_custom_nav_fields' ) );

			// save menu custom fields
			add_action( 'wp_update_nav_menu_item', array( $this, 'rc_scm_update_custom_nav_fields' ), 10, 3 );

	} // end constructor


		/**
		 * Add custom fields to $item nav object
		 * in order to be used in custom Walker
		 *
		 * @access      public
		 * @since       1.0
		 * @return      void
		 */
	function rc_scm_add_custom_nav_fields( $menu_item ) {

			$menu_item->menuicon   = get_post_meta( $menu_item->ID, '_menu_item_menuicon', true );
			$menu_item->menuanchor = get_post_meta( $menu_item->ID, '_menu_item_menuanchor', true );
			$menu_item->menubg     = get_post_meta( $menu_item->ID, '_menu_item_menubg', true );
			$menu_item->megamenu   = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
			return $menu_item;

	}

		/**
		 * Save menu custom fields
		 *
		 * @access      public
		 * @since       1.0
		 * @return      void
		 */
	function rc_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

			// Check if element is properly sent

		if ( ! empty( $_REQUEST['edit-menu-item-menuicon'] ) && is_array( $_REQUEST['edit-menu-item-menuicon'] ) ) {
				$menu_icon_value = $_REQUEST['edit-menu-item-menuicon'][ $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, '_menu_item_menuicon', $menu_icon_value );
		}
		if ( ! empty( $_REQUEST['edit-menu-item-menubg'][ $menu_item_db_id ] ) ) {
				$menu_bg_value = $_REQUEST['edit-menu-item-menubg'][ $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, '_menu_item_menubg', $menu_bg_value );
		}

		if ( ! empty( $_REQUEST['edit-menu-item-menuanchor'][ $menu_item_db_id ] ) ) {
				$menu_anchor_value = $_REQUEST['edit-menu-item-menuanchor'][ $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, '_menu_item_menuanchor', $menu_anchor_value );
		}

		if ( ! isset( $_REQUEST['edit-menu-item-megamenu'][ $menu_item_db_id ] ) ) {
				$_REQUEST['edit-menu-item-megamenu'][ $menu_item_db_id ] = '';
		}
			$menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][ $menu_item_db_id ];
			update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );
	}
}

function thb_custom_nav_fields_action( $item_id, $item, $depth, $args, $id ) {
	$thb_icons = thb_getIconArray();
	?>
	<div class="thb_menu_options">
		<h2><?php esc_html_e( 'Fuel Themes Menu Options', 'notio' ); ?></h2>
		<div class="thb-field-link description description-thin">
			<h3><?php esc_html_e( 'Menu Item Icon', 'notio' ); ?></h3>
			<?php $saved = get_post_meta( $item_id, '_menu_item_menuicon', true ); ?>
			<select id="edit-menu-item-menuicon-<?php echo esc_attr( $item_id ); ?>" name="edit-menu-item-menuicon[<?php echo esc_attr( $item_id ); ?>]">
				<?php foreach ( $thb_icons as $key => $value ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $saved ); ?>><?php echo esc_html( $value ); ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="thb-field-link description description-thin">
			<h3><?php esc_html_e( 'Menu Item Anchor', 'notio' ); ?></h3>
			<?php $savedanchor = get_post_meta( $item_id, '_menu_item_menuanchor', true ); ?>
			<input type="text" id="edit-menu-item-menuanchor-<?php echo esc_attr( $item_id ); ?>" name="edit-menu-item-menuanchor[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $savedanchor ); ?>"/>
		</div>
		<div class="thb-field-link-mega description description-thin">
			<h3><?php esc_html_e( 'Mega Menu', 'notio' ); ?></h3>
				<?php $value = get_post_meta( $item_id, '_menu_item_megamenu', true ); ?>
				<label for="edit-menu-item-megamenu-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" value="enabled" id="edit-menu-item-megamenu-<?php echo esc_attr( $item_id ); ?>" name="edit-menu-item-megamenu[<?php echo esc_attr( $item_id ); ?>]" <?php checked( $value, 'enabled' ); ?> />
						<?php esc_html_e( 'Enable', 'notio' ); ?>
				</label>
		</div>
		<div class="thb-field-link description description-thin">
			<h3><?php esc_html_e( 'Menu Background', 'notio' ); ?></h3>
			<?php $savedanchor = get_post_meta( $item_id, '_menu_item_menubg', true ); ?>
			<input type="text" id="edit-menu-item-menubg-<?php echo esc_attr( $item_id ); ?>" name="edit-menu-item-menubg[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $savedanchor ); ?>"/>
		</div>
	</div>
	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'thb_custom_nav_fields_action', 10, 5 );
