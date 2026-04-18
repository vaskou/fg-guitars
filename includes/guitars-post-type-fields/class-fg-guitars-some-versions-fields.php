<?php

class FG_Guitars_Some_Versions_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'some_versions';
		$this->metabox_title = __( 'Some Versions', 'fg-guitars' );
		$this->fields        = array(
			'price_range_from' => [
				'name' => __( 'Price Range From', 'fg-guitars' ),
				'type' => 'text_small',
			],
			'price_range_to'   => [
				'name' => __( 'Price Range to', 'fg-guitars' ),
				'type' => 'text_small',
			],
			'approximate time' => [
				'name' => __( 'New order approximate time', 'fg-guitars' ),
				'type' => 'text',
			],
			'versions'         => array(
				'name'   => __( 'Some Versions', 'fg-guitars' ),
				'type'   => 'group',
				'fields' => [
					'main_image' => array(
						'name'         => __( 'Main Image', 'fg-guitars' ),
						'type'         => 'file',
						'options'      => array(
							'url' => false
						),
						'text'         => array(
							'add_upload_file_text' => 'Add Image'
						),
						'preview_size' => array( 200, 100 )
					),
					'alt_image'  => array(
						'name'         => __( 'Alternative Image', 'fg-guitars' ),
						'type'         => 'file',
						'options'      => array(
							'url' => false
						),
						'text'         => array(
							'add_upload_file_text' => 'Add Image'
						),
						'preview_size' => array( 200, 100 )
					),
				]
			),
		);
	}
}