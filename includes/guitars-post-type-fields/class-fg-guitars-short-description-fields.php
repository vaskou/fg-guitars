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
		$this->name          = 'short_description';
		$this->metabox_title = __( 'Short Description', 'fg-guitars' );
		$this->fields        = array(
			'name'  => array(
				'label' => __( 'Name', 'fg-guitars' ),
				'type'  => 'text'
			),
			'type'  => array(
				'label' => __( 'Type', 'fg-guitars' ),
				'type'  => 'text'
			),
			'style' => array(
				'label' => __( 'Style', 'fg-guitars' ),
				'type'  => 'text'
			),
			'photo' => array(
				'label' => __( 'Photo', 'fg-guitars' ),
				'type'  => 'text'
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

	/**
	 * @param $metabox CMB2
	 */
	private function _add_metabox_fields( $metabox ) {
		if ( empty( $metabox ) ) {
			return;
		}

		foreach ( $this->fields as $id => $values ) {
			$metabox->add_field( array(
				'id'   => 'fgg_' . $this->name . '_' . $id,
				'name' => $values['label'],
				'type' => $values['type'],
			) );
		}
	}


}