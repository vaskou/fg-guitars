<?php

class FG_Guitars_Features_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function getInstance() {
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

		if ( class_exists( 'FG_Features_CMB2_Field_Dropdown' ) ) {
			$this->fields['feature'] = array(
				'name'       => __( 'Feature', 'fg-guitars' ),
				'type'       => 'fg_features_cmb2_field_dropdown',
				'repeatable' => true,
			);
		}

		if ( class_exists( 'FG_Pickups_CMB2_Field_Dropdown' ) ) {
			$this->fields['pickup'] = array(
				'name'       => __( 'Pickup', 'fg-guitars' ),
				'type'       => 'fg_pickups_cmb2_field_dropdown',
				'repeatable' => true,
			);
		}
	}

}