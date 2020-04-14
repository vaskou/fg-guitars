<?php

class FG_Guitars_Images_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->name          = 'images';
		$this->metabox_title = __( 'Images', 'fg-guitars' );
		$this->fields        = array(
			'featured_image' => array(
				'label'   => __( 'Featured Image', 'fg-guitars' ),
				'type'    => 'file',
				'options' => array(
					'url' => false
				),
				'text'    => array(
					'add_upload_file_text' => 'Add Image'
				),
				'preview_size'   => array( 200, 100 )
			),
			'image_gallery'  => array(
				'label' => __( 'Images', 'fg-guitars' ),
				'type'  => 'file_list'
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