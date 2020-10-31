<?php

class FG_Guitars_Features_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		if ( ! class_exists( 'FG_Features_CMB2_Field_Dropdown' ) && ! class_exists( 'FG_Pickups_CMB2_Field_Dropdown' ) ) {
			$this->enabled = false;

			return;
		}

		$this->metabox_id    = 'features';
		$this->metabox_title = __( 'Features', 'fg-guitars' );
		$this->fields        = array();

		$this->fields['feature'] = array(
			'name'       => __( 'Feature & Pickup', 'fg-guitars' ),
			'type'       => 'fg_guitars_cmb2_features_field_dropdown',
			'repeatable' => true,
		);

	}

}