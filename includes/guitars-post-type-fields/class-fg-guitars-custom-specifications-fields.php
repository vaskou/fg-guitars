<?php

class FG_Guitars_Custom_Specifications_Fields extends FG_Guitars_Post_Type_Fields {

	private static $instance;

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->metabox_id    = 'specifications_group';
		$this->metabox_title = __( 'Specifications Groups', 'fg-guitars' );
		$this->fields        = [];

		$specs_groups = FG_Guitars_Specifications_Groups_Post_Type::instance()->get_items( [
			'order' => 'ASC'
		] );

		$current_lang = FG_Guitars_Helpers::get_current_language();

		foreach ( $specs_groups as $spec ) {

			$spec_title_translation = FG_Guitars_Specifications_Groups_Post_Type::get_specs_group_name_translation( $spec->ID, $current_lang );

			$spec_id    = $spec->ID;
			$spec_slug  = $spec->post_name;
			$spec_title = ! empty( $spec_title_translation ) ? $spec_title_translation : $spec->post_title;
			$fields     = FG_Guitars_Specifications_Groups_Post_Type::get_custom_specs_fields( $spec_id );

			$this->fields[ $spec_slug ] = [
				'name'       => $spec_title,
				'type'       => 'group',
				'fields'     => [],
				'repeatable' => false,
			];

			foreach ( $fields as $field ) {
				if ( empty( $field['name'] ) ) {
					continue;
				}
				$field_slug = sanitize_title( $field['name'] );

				if ( ! empty( $field["translation_{$current_lang}"] ) ) {
					$field['name'] = $field["translation_{$current_lang}"];
				}

				$this->fields[ $spec_slug ]['fields'][ $field_slug ] = is_array( $field ) ? $field : [];
			}
		}

	}

	public function getGroupLabel( $field_group ) {
		return $this->fields[ $field_group ]['name'];
	}

}