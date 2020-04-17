<?php

abstract class FG_Guitars_Post_Type_Fields {

	private $prefix_metabox_id = 'fg_guitars_';
	private $prefix_field_id = 'fgg_';

	protected $name;
	protected $metabox_title;
	protected $group_title;
	protected $fields;

	public function getFields() {
		return $this->fields;
	}

	/**
	 * @return string
	 */
	public function getPrefixMetaboxId() {
		return $this->prefix_metabox_id;
	}

	/**
	 * @return string
	 */
	public function getPrefixFieldId() {
		return $this->prefix_field_id;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return mixed
	 */
	public function getMetaboxTitle() {
		return $this->metabox_title;
	}

	/**
	 * @return mixed
	 */
	public function getGroupTitle() {
		return $this->group_title;
	}

	public function getFieldMetaKeyPrefix() {
		return $this->getPrefixFieldId() . $this->getName() . '_';
	}

	abstract public function add_metaboxes( $post_type );

	protected function _add_metabox( $post_type ) {
		return new_cmb2_box( array(
			'id'           => $this->prefix_metabox_id . $this->name,
			'title'        => $this->metabox_title,
			'object_types' => array( $post_type ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
		) );
	}

	/**
	 * @param $metabox CMB2
	 */
	protected function _add_metabox_fields( $metabox ) {
		if ( empty( $metabox ) ) {
			return;
		}

		foreach ( $this->fields as $id => $values ) {

			$defaults = array(
				'id'   => $this->getFieldMetaKeyPrefix() . $id,
				'name' => $values['label'],
			);

			$args = wp_parse_args( $values, $defaults );

			if ( 'group' == $values['type'] ) {
				$this->_add_metabox_group_field( $metabox, $args );
			} else {
				$metabox->add_field( $args );
			}

		}
	}

	/**
	 * @param $metabox CMB2
	 */
	private function _add_metabox_group_field( $metabox, $args ) {
		if ( empty( $metabox ) ) {
			return;
		}

		$group_title = $args['name'];

		$group_id = $metabox->add_field( array(
			'id'      => $args['id'],
			'type'    => 'group',
			'options' => array(
				'group_title'   => $group_title . ' {#}',
				'add_button'    => sprintf( __( 'Add Another %s', 'cmb2' ), $group_title ),
				'remove_button' => sprintf( __( 'Remove %s', 'cmb2' ), $group_title ),
				'sortable'      => true,
				// 'closed'         => true, // true to have the groups closed by default
				// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
			),
		) );

		$this->_add_metabox_group_fields( $metabox, $group_id, $args );
	}

	/**
	 * @param $metabox CMB2
	 * @param $group_id integer
	 */
	private function _add_metabox_group_fields( $metabox, $group_id, $args ) {
		if ( empty( $metabox ) ) {
			return;
		}

		foreach ( $args['fields'] as $id => $values ) {

			$defaults = array(
				'id'   => $id,
				'name' => $values['label'],
			);

			$args = wp_parse_args( $values, $defaults );

			$metabox->add_group_field( $group_id, $args );

		}

	}


}