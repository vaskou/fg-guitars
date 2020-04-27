<?php

class FG_Guitars_Short_Description_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'short_description';
		$this->metabox_title = __( 'Short Description', 'fg-guitars' );
		$this->fields        = array(
			'name'  => array(
				'name' => __( 'Name', 'fg-guitars' ),
				'type' => 'text'
			),
			'type'  => array(
				'name' => __( 'Type', 'fg-guitars' ),
				'type' => 'text'
			),
			'style' => array(
				'name' => __( 'Style', 'fg-guitars' ),
				'type' => 'text'
			),
		);
	}

}