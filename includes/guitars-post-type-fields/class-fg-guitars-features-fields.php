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
		$this->name          = 'features';
		$this->metabox_title = __( 'Features', 'fg-guitars' );
		$this->fields        = array(
			'feature' => array(
				'label'      => __( 'Feature', 'fg-guitars' ),
				'type'       => 'fg_features_cmb2_field_dropdown',
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