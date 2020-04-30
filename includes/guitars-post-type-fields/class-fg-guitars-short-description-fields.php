<?php

class FG_Guitars_Short_Description_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'short_description';
		$this->metabox_title = __( 'Short Description', 'fg-guitars' );
		$this->fields        = array(
			'title' => array(
				'name' => __( 'Title', 'fg-guitars' ),
				'type' => 'text'
			),
			'name'  => array(
				'name' => __( 'Model Name', 'fg-guitars' ),
				'type' => 'text'
			),
			'type'  => array(
				'name' => __( 'Guitar Type', 'fg-guitars' ),
				'type' => 'text'
			),
			'style' => array(
				'name' => __( 'Guitar Style', 'fg-guitars' ),
				'type' => 'text'
			),
			'photo' => array(
				'name' => __( 'Photo', 'fg-guitars' ),
				'type' => 'text'
			),
		);
	}

	public function getTitle( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'title', true );
	}

	public function getTitleLabel() {
		return $this->getFieldLabel( 'title' );
	}

	public function getName( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'name', true );
	}

	public function getNameLabel() {
		return $this->getFieldLabel( 'name' );
	}

	public function getType( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'type', true );
	}

	public function getTypeLabel() {
		return $this->getFieldLabel( 'type' );
	}

	public function getStyle( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'style', true );
	}

	public function getStyleLabel() {
		return $this->getFieldLabel( 'style' );
	}

	public function getPhoto( $post_id ) {
		return get_post_meta( $post_id, $this->getFieldMetaKeyPrefix() . 'photo', true );
	}

	public function getPhotoLabel() {
		return $this->getFieldLabel( 'photo' );
	}

}