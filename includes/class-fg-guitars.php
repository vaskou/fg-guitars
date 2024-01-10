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

		add_action( 'plugins_loaded', array( $this, 'includes' ) );

		add_action( 'plugins_loaded', array( $this, 'init_classes' ) );

		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );

	}

	public function includes() {

		include 'class-fg-guitars-dependencies.php';
		include 'class-fg-guitars-post-type.php';
		include 'class-fg-guitars-settings.php';
		include 'class-fg-guitars-shortcodes.php';

		include 'guitars-post-type-fields/abstract-class-fg-guitars-post-type-fields.php';
		include 'guitars-post-type-fields/class-fg-guitars-custom-specifications-fields.php';
		include 'guitars-post-type-fields/class-fg-guitars-available-guitars-fields.php';
		include 'guitars-post-type-fields/class-fg-guitars-images-fields.php';
		include 'guitars-post-type-fields/class-fg-guitars-short-description-fields.php';
		include 'guitars-post-type-fields/class-fg-guitars-specifications-fields.php';
		include 'guitars-post-type-fields/class-fg-guitars-sounds-fields.php';
		include 'guitars-post-type-fields/class-fg-guitars-features-fields.php';
		include 'guitars-post-type-fields/class-fg-guitars-pricing-fields.php';

		include 'cmb2-custom-fields/class-fg-guitars-cmb2-features-field-dropdown.php';

		include 'specifications-groups/class-fg-guitars-specifications-groups-post-type.php';
	}

	public function init_classes() {
		FG_Guitars_Dependencies::instance();
		FG_Guitars_Post_Type::instance();
		FG_Guitars_Shortcodes::instance();
		FG_Guitars_CMB2_Features_Field_Dropdown::instance();
		FG_Guitars_Settings::instance();

		FG_Guitars_Specifications_Groups_Post_Type::instance();
	}

	public function on_plugins_loaded() {
		load_plugin_textdomain( 'fg-guitars', false, FG_GUITARS_PLUGIN_DIR_NAME . '/languages/' );
	}

}