<?php

class FG_Guitars_Available_Guitars_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		if ( ! class_exists( 'Fremediti_Guitars_Available_Guitars_Post_Type' ) ) {
			$this->enabled = false;

			return;
		}

		$this->metabox_id    = 'available_guitars';
		$this->metabox_title = __( 'Available Guitars', 'fg-guitars' );
		$this->fields        = array();

		$this->fields['guitars'] = array(
			'name'       => __( 'Guitars', 'fg-guitars' ),
			'type'       => 'select',
			'options'    => $this->_get_available_guitars_options(),
			'repeatable' => true,
		);

	}

	protected function _get_available_guitars_options() {
		$available_guitars = [];

		if ( class_exists( 'Fremediti_Guitars_Available_Guitars_Post_Type' ) ) {
			$items = Fremediti_Guitars_Available_Guitars_Post_Type::instance()->get_items();
		}

		$available_guitars[] = __( 'None', 'fg-guitars' );

		foreach ( $items as $item ) {
			$available_guitars[ $item->ID ] = $item->post_title;
		}

		return $available_guitars;
	}

}