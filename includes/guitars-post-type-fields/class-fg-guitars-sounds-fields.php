<?php

class FG_Guitars_Sounds_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->name          = 'sounds';
		$this->metabox_title = __( 'Sounds', 'fg-guitars' );
		$this->fields        = array(
			'videos' => array(
				'label'      => __( 'Videos', 'fg-guitars' ),
				'type'       => 'text',
				'repeatable' => true,
			),
		);
	}

	public function add_metaboxes( $post_type ) {
		if ( ! function_exists( 'new_cmb2_box' ) ) {
			return;
		}

		$metabox = $this->_add_metabox( $post_type );

		$this->_add_metabox_fields( $metabox );
	}


}