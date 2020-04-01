<?php

abstract class FG_Guitars_Post_Type_Fields {

	protected $name;
	protected $metabox_title;
	protected $fields;

	public function getFields() {
		return $this->fields;
	}

	abstract public function add_metaboxes( $post_type );

	protected function _add_metabox( $post_type ) {
		return new_cmb2_box( array(
			'id'           => 'fg_guitars_' . $this->name,
			'title'        => $this->metabox_title,
			'object_types' => array( $post_type ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
		) );
	}
}