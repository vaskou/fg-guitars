<?php

class FG_Guitars_Helpers {

	public static function get_current_language() {

		$current_lang = '';

		if ( function_exists( 'wpml_get_current_language' ) ) {
			$current_lang = wpml_get_current_language();
		}

		return $current_lang;
	}

	/**
	 * @return array
	 */
	public static function get_active_languages() {
		return apply_filters( 'wpml_active_languages', [], [] );
	}

	public static function get_default_language() {
		return apply_filters( 'wpml_default_language', '' );
	}
}