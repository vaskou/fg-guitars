<?php

class FG_Guitars_Pricing_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'pricing';
		$this->metabox_title = __( 'Pricing', 'fg-guitars' );
		$this->fields        = apply_filters( 'fg_guitars_pricing_fields', array(
			'price'               => array(
				'name'       => __( 'Base price', 'fg-guitars' ),
				'type'       => apply_filters( 'fg_guitars_pricing_price_field_type', 'text_small' ),
				'attributes' => array(
					'type' => apply_filters( 'fg_guitars_pricing_price_field_type', 'number' ),
				)
			),
			'show_contact_button' => array(
				'name'        => __( 'Show "Contact Us" button', 'fg-guitars' ),
				'type'        => 'checkbox',
				'description' => __( 'Show "Contact Us" button instead of "Base Price" in Greek IPs', 'fg-guitars' ),
			),
			'price_text'          => array(
				'name'    => __( 'Base price text', 'fg-guitars' ),
				'type'    => 'wysiwyg',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 10,
					'teeny'         => true,
					'quicktags'     => false
				),
			),
			'pricing_items'       => array(
				'name'   => __( 'Extra options', 'fg-guitars' ),
				'type'   => 'group',
				'fields' => array(
					'extra_option'       => array(
						'name'    => __( 'Extra option', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'extra_option_price' => array(
						'name'       => __( 'Extra option price', 'fg-guitars' ),
						'type'       => 'text_small',
						'attributes' => array(
							'type' => 'number'
						)
					),
				)
			),
		) );
	}

	public function getPrice( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'price', true );
	}

	public function getPriceLabel() {
		return $this->getFieldLabel( 'price' );
	}

	public function getPriceText( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'price_text', true );
	}

	public function getPriceTextLabel() {
		return $this->getFieldLabel( 'price_text' );
	}

	public function getShowContactButton( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'show_contact_button', true );
	}

	public function getPricingItems( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'pricing_items', true );
	}

	public function getPricingItemsLabel() {
		return $this->getFieldLabel( 'pricing_items' );
	}

}