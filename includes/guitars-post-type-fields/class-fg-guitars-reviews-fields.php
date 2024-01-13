<?php

class FG_Guitars_Reviews_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'reviews';
		$this->metabox_title = __( 'Reviews', 'fg-guitars' );
		$this->fields        = array(
			'reviews' => array(
				'name'   => __( 'Reviews', 'fg-guitars' ),
				'type'   => 'group',
				'fields' => [
					'name' => array(
						'name' => __( 'Name', 'fg-guitars' ),
						'type' => 'text'
					),
					'text' => array(
						'name' => __( 'Text', 'fg-guitars' ),
						'type' => 'wysiwyg'
					),
				]
			),
		);
	}

	public function getPostMeta( $post_id ) {
		$post_meta = parent::getPostMeta( $post_id );

		$reviews = ! empty( $post_meta['reviews']['reviews'] ) ? $post_meta['reviews']['reviews'] : array();

		return $reviews;
	}

}