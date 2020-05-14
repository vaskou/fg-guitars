<?php

defined( 'ABSPATH' ) or die();

class FG_Guitars_CMB2_Features_Field_Dropdown {

	private $field_type;

	private static $instance;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->field_type = 'fg_guitars_cmb2_features_field_dropdown';
		add_action( "cmb2_render_{$this->field_type}", array( $this, 'render' ), 10, 5 );
//		add_action( "cmb2_sanitize_{$this->field_type}", array( $this, 'sanitize' ), 10, 2 );
//		add_action( "cmb2_types_esc_{$this->field_type}", array( $this, 'escape_value' ), 10, 2 );
	}

	/**
	 * @param $field         CMB2_Field
	 * @param $escaped_value mixed
	 * @param $object_id     int
	 * @param $object_type   string
	 * @param $field_type    CMB2_Types
	 */
	public function render( $field, $escaped_value, $object_id, $object_type, $field_type ) {

		$items    = array();
		$features = array();
		$pickups  = array();

		if ( class_exists( 'FG_Features_Post_Type' ) ) {
			$features = FG_Features_Post_Type::getInstance()->get_items();
		}

		if ( class_exists( 'FG_Pickups_Post_Type' ) ) {
			$pickups = FG_Pickups_Post_Type::getInstance()->get_items();
		}

		$items = array_merge( $features, $pickups );


		$options = array( __( 'None', 'fg-guitars' ) );

		foreach ( $items as $item ) {
			$options[ $item->ID ] = $item->post_title;
		}

		$field->args['options'] = $options;

		$args = array(
			'class'   => 'cmb2_select',
			'name'    => $field_type->_name(),
			'id'      => $field_type->_id(),
			'desc'    => $field_type->_desc( true ),
			'options' => $field_type->concat_items(),
		);

		echo $field_type->select( $args );

	}

}