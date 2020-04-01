<?php

class FG_Guitars_Specifications_Fields {

	private $name;
	private $metabox_title;
	private $fields;

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
		);
	}

	public function getFields() {
		return $this->fields;
	}

	public function add_metaboxes( $post_type ) {
		if ( ! function_exists( 'new_cmb2_box' ) ) {
			return;
		}

		$cmb = new_cmb2_box( array(
			'id'           => 'fg_guitars_' . $this->name,
			'title'        => __( 'Specifications', 'fg-guitars' ),
			'object_types' => array( $post_type ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
		) );

		$group_id = $cmb->add_field( array(
			'id'      => 'fgg_' . $this->name . '_group',
			'type'    => 'group',
			'options' => array(
				'group_title'   => __( 'Guitar Type {#}', 'cmb2' ),
				'add_button'    => __( 'Add Another Guitar Type', 'cmb2' ),
				'remove_button' => __( 'Remove Guitar Type', 'cmb2' ),
				'sortable'      => true,
				// 'closed'         => true, // true to have the groups closed by default
				// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
			),
		) );

		foreach ( $this->fields as $id => $values ) {
			$cmb->add_group_field( $group_id, array(
				'id'   => 'fgg_' . $this->name . '_' . $id,
				'name' => $values['label'],
				'type' => $values['type'],
			) );
		}
	}


}