<?php

class FG_Guitars_Pricing_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'pricing';
		$this->metabox_title = __( 'Pricing', 'fg-guitars' );
		$this->fields        = array(
			'price'         => array(
				'name' => __( 'Base price', 'fg-guitars' ),
				'type' => 'text_money',
			),
			'price_text'    => array(
				'name' => __( 'Base price text', 'fg-guitars' ),
				'type' => 'wysiwyg',
			),
			'pricing_items' => array(
				'name'   => __( 'Extra options pricing', 'fg-guitars' ),
				'type'   => 'group',
				'fields' => array(
					'extra_option'       => array(
						'label' => __( 'Extra option', 'fg-guitars' ),
						'type'  => 'text',
					),
					'extra_option_price' => array(
						'label' => __( 'Extra option price', 'fg-guitars' ),
						'type'  => 'text_money',
					),
				)
			),
		);

	}

}