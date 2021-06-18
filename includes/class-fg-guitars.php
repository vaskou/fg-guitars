<?php

defined( 'ABSPATH' ) or die();

class FG_Guitars {

	private static $instance = null;

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * FG_Guitars constructor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );

		FG_Guitars_Dependencies::instance();
		FG_Guitars_Post_Type::instance();
		FG_Guitars_Shortcodes::instance();
		FG_Guitars_CMB2_Features_Field_Dropdown::instance();
		FG_Guitars_Settings::instance();
	}

	public function on_plugins_loaded() {
		load_plugin_textdomain( 'fg-guitars', false, FG_GUITARS_PLUGIN_DIR_NAME . '/languages/' );
	}

}