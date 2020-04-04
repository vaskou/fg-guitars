<?php

class FG_Guitars_Specifications_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->name          = 'specifications';
		$this->metabox_title = __( 'Specifications', 'fg-guitars' );
		$this->fields        = array(
			'specs' => array(
				'label'  => __( 'Guitar Type', 'fg-guitars' ),
				'type'   => 'group',
				'fields' => array(
					'body'         => array(
						'label' => __( 'Body', 'fg-guitars' ),
						'type'  => 'text'
					),
					'top'          => array(
						'label' => __( 'Top', 'fg-guitars' ),
						'type'  => 'text'
					),
					'back'         => array(
						'label' => __( 'Back', 'fg-guitars' ),
						'type'  => 'text'
					),
					'sides'        => array(
						'label' => __( 'Sides', 'fg-guitars' ),
						'type'  => 'text'
					),
					'inside'       => array(
						'label' => __( 'Inside', 'fg-guitars' ),
						'type'  => 'text'
					),
					'bracing'      => array(
						'label' => __( 'Bracing', 'fg-guitars' ),
						'type'  => 'text'
					),
					'neck'         => array(
						'label' => __( 'Neck', 'fg-guitars' ),
						'type'  => 'text'
					),
					'headstock'    => array(
						'label' => __( 'Headstock', 'fg-guitars' ),
						'type'  => 'textarea'
					),
					'fingerboard'  => array(
						'label' => __( 'Fingerboard', 'fg-guitars' ),
						'type'  => 'text'
					),
					'binding'      => array(
						'label' => __( 'Binding', 'fg-guitars' ),
						'type'  => 'text'
					),
					'f_holes'      => array(
						'label' => __( 'F-Hole', 'fg-guitars' ),
						'type'  => 'text'
					),
					'width_at_nut' => array(
						'label' => __( 'Width At Nut', 'fg-guitars' ),
						'type'  => 'text'
					),
					'scale'        => array(
						'label' => __( 'Scale', 'fg-guitars' ),
						'type'  => 'text'
					),
					'frets'        => array(
						'label' => __( 'Frets', 'fg-guitars' ),
						'type'  => 'text'
					),
					'bridge'       => array(
						'label' => __( 'Bridge', 'fg-guitars' ),
						'type'  => 'text'
					),
					'tailpiece'    => array(
						'label' => __( 'Tailpiece*', 'fg-guitars' ),
						'type'  => 'text'
					),
					'tailpiece2'   => array(
						'label' => __( 'Tailpiece', 'fg-guitars' ),
						'type'  => 'text'
					),
					'pickup'       => array(
						'label' => __( 'Pickup', 'fg-guitars' ),
						'type'  => 'text'
					),
					'controls'     => array(
						'label' => __( 'Controls', 'fg-guitars' ),
						'type'  => 'textarea'
					),
					'hardware'     => array(
						'label' => __( 'Hardware', 'fg-guitars' ),
						'type'  => 'textarea'
					),
					'pickguard'    => array(
						'label' => __( 'Pickguard', 'fg-guitars' ),
						'type'  => 'textarea'
					),
					'fingerrest'   => array(
						'label' => __( 'Fingerrest*', 'fg-guitars' ),
						'type'  => 'text'
					),
					'finish'       => array(
						'label' => __( 'Finish', 'fg-guitars' ),
						'type'  => 'text'
					),
					'color'        => array(
						'label' => __( 'Color', 'fg-guitars' ),
						'type'  => 'text'
					),
					'strings'      => array(
						'label' => __( 'Strings', 'fg-guitars' ),
						'type'  => 'text'
					),
					'case'         => array(
						'label' => __( 'Case', 'fg-guitars' ),
						'type'  => 'text'
					),
					'asterisk'     => array(
						'label' => __( 'Asterisk', 'fg-guitars' ),
						'type'  => 'textarea'
					),
				),
			)
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