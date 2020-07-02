<?php

class FG_Guitars_Sounds_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'sounds';
		$this->metabox_title = __( 'Sounds', 'fg-guitars' );
		$this->fields        = array(
			'videos' => array(
				'name'       => __( 'Videos', 'fg-guitars' ),
				'type'       => 'text',
				'repeatable' => true,
			),
		);
	}

	public function getPostMeta( $post_id ) {
		$post_meta = parent::getPostMeta( $post_id );

		return ! empty( $post_meta['sounds']['videos'] ) ? $post_meta['sounds']['videos'] : array();
	}

}