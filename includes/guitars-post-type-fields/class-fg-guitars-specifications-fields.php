<?php

class FG_Guitars_Specifications_Fields extends FG_Guitars_Post_Type_Fields {

	private $has_variations = false;

	private static $instance;

	public static function instance() {
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
					'configuration_image' => array(
						'name'         => __( 'Configuration Image', 'fg-guitars' ),
						'type'         => 'file',
						'options'      => array(
							'url' => false,
						),
						'text'         => array(
							'add_upload_file_text' => __( 'Add Image', 'fg-slider' )
						),
						'preview_size' => 'thumbnail',
					),
					'body'                => array(
						'name' => __( 'Body', 'fg-guitars' ),
						'type' => 'text'
					),
					'body_top'            => array(
						'name' => __( 'Body Top', 'fg-guitars' ),
						'type' => 'text'
					),
					'top'                 => array(
						'name'    => __( 'Top', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'back'                => array(
						'name'    => __( 'Back', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'sides'               => array(
						'name' => __( 'Sides', 'fg-guitars' ),
						'type' => 'text'
					),
					'inside'              => array(
						'name' => __( 'Inside', 'fg-guitars' ),
						'type' => 'text'
					),
					'bracing'             => array(
						'name' => __( 'Bracing', 'fg-guitars' ),
						'type' => 'text'
					),
					'neck_joint'          => array(
						'name'    => __( 'Neck Joint', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'neck'                => array(
						'name' => __( 'Neck', 'fg-guitars' ),
						'type' => 'text'
					),
					'headstock'           => array(
						'name' => __( 'Headstock', 'fg-guitars' ),
						'type' => 'textarea'
					),
					'fingerboard'         => array(
						'name' => __( 'Fingerboard', 'fg-guitars' ),
						'type' => 'text'
					),
					'binding'             => array(
						'name'    => __( 'Binding', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'f_holes'             => array(
						'name' => __( 'F-Hole', 'fg-guitars' ),
						'type' => 'text'
					),
					'width_at_nut'        => array(
						'name' => __( 'Width At Nut', 'fg-guitars' ),
						'type' => 'text'
					),
					'scale'               => array(
						'name' => __( 'Scale', 'fg-guitars' ),
						'type' => 'text'
					),
					'frets'               => array(
						'name' => __( 'Frets', 'fg-guitars' ),
						'type' => 'text'
					),
					'bridge'              => array(
						'name'    => __( 'Bridge', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'tailpiece'           => array(
						'name'    => __( 'Tailpiece', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'pickups'             => array(
						'name'    => __( 'Pickups', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'controls'            => array(
						'name'    => __( 'Controls', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'hardware'            => array(
						'name' => __( 'Hardware', 'fg-guitars' ),
						'type' => 'textarea'
					),
					'pickguard'           => array(
						'name' => __( 'Pickguard', 'fg-guitars' ),
						'type' => 'textarea'
					),
					'fingerrest'          => array(
						'name' => __( 'Fingerrest', 'fg-guitars' ),
						'type' => 'text'
					),
					'htp_veneer_set'          => array(
						'name' => __( 'H.T.P. Veneer set', 'fg-guitars' ),
						'type' => 'text'
					),
					'htp_ebony_set'          => array(
						'name' => __( 'H.T.P. Ebony set', 'fg-guitars' ),
						'type' => 'text'
					),
					'finish'              => array(
						'name' => __( 'Finish', 'fg-guitars' ),
						'type' => 'text'
					),
					'color'               => array(
						'name' => __( 'Color', 'fg-guitars' ),
						'type' => 'text'
					),
					'strings'             => array(
						'name' => __( 'Strings', 'fg-guitars' ),
						'type' => 'text'
					),
					'case'                => array(
						'name'    => __( 'Case', 'fg-guitars' ),
						'type'    => 'wysiwyg',
						'options' => array(
							'media_buttons' => false,
							'textarea_rows' => 10,
							'teeny'         => true,
							'quicktags'     => false
						),
					),
					'asterisk'            => array(
						'name' => __( '*', 'fg-guitars' ),
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

	public function getFieldType( $field ) {
		return $this->fields['specs']['fields'][ $field ]['type'];
	}

	public function getPostMeta( $post_id ) {
		$post_meta = parent::getPostMeta( $post_id );

		$specs = ! empty( $post_meta['specifications']['specs'] ) ? $post_meta['specifications']['specs'] : array();

		$this->has_variations = count( $specs ) > 1;

		return $specs;
	}
}