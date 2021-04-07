<?php

/* Custom Language Switcher */
function thb_language_switcher() {
	$thb_ls = ot_get_option( 'menu_ls', 'on' );
	if ( 'off' !== $thb_ls ) {
		if ( function_exists( 'icl_get_languages' ) || defined( 'THB_DEMO_SITE' ) || function_exists( 'icl_get_languages' ) ) {
			$permalink = get_permalink();
			?>
			<div class="select-wrapper">
				<?php
				if ( defined( 'THB_DEMO_SITE' ) ) {
					$languages = array(
						'en' => array(
							'code'        => 'en',
							'active'      => 1,
							'url'         => $permalink,
							'native_name' => 'English',
						),
						'fr' => array(
							'code'        => 'fr',
							'active'      => 0,
							'url'         => $permalink,
							'native_name' => 'Français',
						),
						'de' => array(
							'code'        => 'de',
							'active'      => 0,
							'url'         => $permalink,
							'native_name' => 'Deutsch',
						),
					);
				} elseif ( function_exists( 'icl_get_languages' ) ) {
					$languages = icl_get_languages( 'skip_missing=0' );
				} elseif ( function_exists( 'pll_the_languages' ) ) {
					$languages = pll_the_languages( array( 'raw' => 1 ) );
				}

				?>
				<select id="thb_language_selector">
				<?php
				if ( 0 < count( $languages ) ) {
					foreach ( $languages as $l ) {
						if ( function_exists( 'pll_the_languages' ) ) {
							$selected = $l['current_lang'] ? ' selected' : '';
							echo '<option value="' . esc_attr( $l['url'] ) . '" ' . esc_attr( $selected ) . '>' . esc_attr( $l['name'] ) . '</option>';
						} else {
							$selected = $l['active'] ? ' selected' : '';
							echo '<option value="' . esc_attr( $l['url'] ) . '" ' . esc_attr( $selected ) . '>' . esc_attr( $l['native_name'] ) . '</option>';
						}
					}
				} else {
					echo '<option value="">' . esc_html__( 'Please Add Languages', 'notio' ) . '</option>';
				}
				?>
				</select>
			</div>
			<?php
		}
	}
}
add_action( 'thb_language_switcher', 'thb_language_switcher' );
