<?php
/**
 * @package snow-monkey-bbpress-support
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\Plugin\bbPressSupport\App;

class Avatar {

	public function __construct() {
		add_action( 'get_avatar', [ $this, '_get_avatar' ], 10, 5 );
	}

	/**
	 * If using facebook of Gianism, facebook user picture is used as avatar.
	 *
	 * @param  [string] $img
	 * @param  [string] $id_or_email
	 * @param  [int]    $size
	 * @param  [string] $default
	 * @param  [string] $atl
	 * @return [string]
	 */
	public function _get_avatar( $img, $id_or_email, $size, $default, $alt ) {
		$_wpg_facebook_id = get_the_author_meta( '_wpg_facebook_id', $id_or_email );
		if ( ! $_wpg_facebook_id ) {
			return $img;
		}

		$img = sprintf(
			'<img src="https://graph.facebook.com/%1$s/picture?type=square" alt="%2$s" width="%3$s" height="%3$s" class="avatar photo" />',
			esc_attr( $_wpg_facebook_id ),
			esc_attr( $alt ),
			esc_attr( $size )
		);

		return $img;
	}
}
