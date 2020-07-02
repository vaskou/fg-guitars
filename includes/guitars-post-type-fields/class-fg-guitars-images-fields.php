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
		$this->metabox_id    = 'images';
		$this->metabox_title = __( 'Images', 'fg-guitars' );
		$this->fields        = array(
			'menu_image'    => array(
				'name'         => __( 'Menu Image', 'fg-guitars' ),
				'type'         => 'file',
				'options'      => array(
					'url' => false
				),
				'text'         => array(
					'add_upload_file_text' => 'Add Image'
				),
				'preview_size' => array( 200, 100 )
			),
			'image_gallery' => array(
				'name' => __( 'Images', 'fg-guitars' ),
				'type' => 'file_list'
			),
		);
	}

	public function getMenuImage( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'menu_image', true );
	}

	public function getMenuImageID( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'menu_image_id', true );
	}

	public function getImageGallery( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'image_gallery', true );
	}
}