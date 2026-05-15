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
		$this->fields        = apply_filters( 'fg_guitars_some_versions_fields', array(
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
			'price_range_from' => [
				'name' => __( 'Price Range From', 'fg-guitars' ),
				'type' => 'text_small',
			],
			'price_range_to'   => [
				'name' => __( 'Price Range to', 'fg-guitars' ),
				'type' => 'text_small',
			],
			'has_available_products'  => [
				'name'             => __( 'Has available products', 'fg-guitars' ),
				'type'             => 'checkbox',
			],
			'approximate_time' => [
				'name' => __( 'New order approximate time', 'fg-guitars' ),
				'type' => 'text',
			],
		) );
	}

	public function getPriceRangeFrom( $post_id ) {
		$price = get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'price_range_from', true );

		return apply_filters( 'fg_guitars_some_versions__price_range_from', $price, $post_id );
	}

	public function getPriceRangeTo( $post_id ) {
		$price = get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'price_range_to', true );

		return apply_filters( 'fg_guitars_some_versions__price_range_to', $price, $post_id );
	}

	public function getApproximateTime( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'approximate_time', true );
	}

	public function getVersions( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'versions', true );
	}

	public function getHasAvailableProducts( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'has_available_products', true );
	}
}