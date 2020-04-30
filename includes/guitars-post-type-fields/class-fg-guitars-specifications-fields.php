<?php

class FG_Guitars_Specifications_Fields extends FG_Guitars_Post_Type_Fields {

	private $has_variations = false;

	private static $instance;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'specifications';
		$this->metabox_title = __( 'Specifications', 'fg-guitars' );
		$this->fields        = array(
			'specs' => array(
				'name'   => __( 'Guitar Type', 'fg-guitars' ),
				'type'   => 'group',
				'fields' => array(
					'body'         => array(
						'name' => __( 'Body', 'fg-guitars' ),
						'type' => 'text'
					),
					'top'          => array(
						'name' => __( 'Top', 'fg-guitars' ),
						'type' => 'text'
					),
					'back'         => array(
						'name' => __( 'Back', 'fg-guitars' ),
						'type' => 'text'
					),
					'sides'        => array(
						'name' => __( 'Sides', 'fg-guitars' ),
						'type' => 'text'
					),
					'inside'       => array(
						'name' => __( 'Inside', 'fg-guitars' ),
						'type' => 'text'
					),
					'bracing'      => array(
						'name' => __( 'Bracing', 'fg-guitars' ),
						'type' => 'text'
					),
					'neck'         => array(
						'name' => __( 'Neck', 'fg-guitars' ),
						'type' => 'text'
					),
					'headstock'    => array(
						'name' => __( 'Headstock', 'fg-guitars' ),
						'type' => 'textarea'
					),
					'fingerboard'  => array(
						'name' => __( 'Fingerboard', 'fg-guitars' ),
						'type' => 'text'
					),
					'binding'      => array(
						'name' => __( 'Binding', 'fg-guitars' ),
						'type' => 'text'
					),
					'f_holes'      => array(
						'name' => __( 'F-Hole', 'fg-guitars' ),
						'type' => 'text'
					),
					'width_at_nut' => array(
						'name' => __( 'Width At Nut', 'fg-guitars' ),
						'type' => 'text'
					),
					'scale'        => array(
						'name' => __( 'Scale', 'fg-guitars' ),
						'type' => 'text'
					),
					'frets'        => array(
						'name' => __( 'Frets', 'fg-guitars' ),
						'type' => 'text'
					),
					'bridge'       => array(
						'name' => __( 'Bridge', 'fg-guitars' ),
						'type' => 'text'
					),
					'tailpiece'    => array(
						'name' => __( 'Tailpiece*', 'fg-guitars' ),
						'type' => 'text'
					),
					'tailpiece2'   => array(
						'name' => __( 'Tailpiece', 'fg-guitars' ),
						'type' => 'text'
					),
					'pickup'       => array(
						'name' => __( 'Pickup', 'fg-guitars' ),
						'type' => 'text'
					),
					'controls'     => array(
						'name' => __( 'Controls', 'fg-guitars' ),
						'type' => 'textarea'
					),
					'hardware'     => array(
						'name' => __( 'Hardware', 'fg-guitars' ),
						'type' => 'textarea'
					),
					'pickguard'    => array(
						'name' => __( 'Pickguard', 'fg-guitars' ),
						'type' => 'textarea'
					),
					'fingerrest'   => array(
						'name' => __( 'Fingerrest*', 'fg-guitars' ),
						'type' => 'text'
					),
					'finish'       => array(
						'name' => __( 'Finish', 'fg-guitars' ),
						'type' => 'text'
					),
					'color'        => array(
						'name' => __( 'Color', 'fg-guitars' ),
						'type' => 'text'
					),
					'strings'      => array(
						'name' => __( 'Strings', 'fg-guitars' ),
						'type' => 'text'
					),
					'case'         => array(
						'name' => __( 'Case', 'fg-guitars' ),
						'type' => 'text'
					),
					'asterisk'     => array(
						'name' => __( 'Asterisk', 'fg-guitars' ),
						'type' => 'textarea'
					),
				),
			)
		);
	}

	/**
	 * @return bool
	 */
	public function hasVariations() {
		return $this->has_variations;
	}

	public function getFieldLabel( $field ) {
		return $this->fields['specs']['fields'][ $field ]['name'];
	}

	public function getPostMeta( $post_id ) {
		$post_meta = parent::getPostMeta( $post_id );

		$specs = ! empty( $post_meta['specifications']['specs'] ) ? $post_meta['specifications']['specs'] : array();

		$this->has_variations = count( $specs ) > 1;

		return $specs;
	}
}