<?php

defined( 'ABSPATH' ) or die();

class FG_Guitars_Specifications_Post_Type {

	const POST_TYPE_NAME = 'fg_guitars_specs';
	const POST_TYPE_SLUG = 'guitars_specs';

	private static $instance = null;

	/**
	 * FG_Guitars_Specifications_Post_Type constructor.
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_metaboxes' ) );
	}

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Registers post type
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'FG Guitar Specifications', 'FG Guitar Specifications General Name', 'fg-guitars' ),
			'singular_name'         => _x( 'FG Guitar Specifications', 'FG Guitar Specifications Singular Name', 'fg-guitars' ),
			'menu_name'             => __( 'FG Guitar Specifications', 'fg-guitars' ),
			'name_admin_bar'        => __( 'FG Guitar Specifications', 'fg-guitars' ),
			'archives'              => __( 'FG Guitar Specifications Archives', 'fg-guitars' ),
			'attributes'            => __( 'FG Guitar Specifications Attributes', 'fg-guitars' ),
			'parent_item_colon'     => __( 'Parent FG Guitar Specifications:', 'fg-guitars' ),
			'all_items'             => __( 'All FG Guitar Specifications', 'fg-guitars' ),
			'add_new_item'          => __( 'Add New FG Guitar Specifications', 'fg-guitars' ),
			'add_new'               => __( 'Add New', 'fg-guitars' ),
			'new_item'              => __( 'New FG Guitar Specifications', 'fg-guitars' ),
			'edit_item'             => __( 'Edit FG Guitar Specifications', 'fg-guitars' ),
			'update_item'           => __( 'Update FG Guitar Specifications', 'fg-guitars' ),
			'view_item'             => __( 'View FG Guitar Specifications', 'fg-guitars' ),
			'view_items'            => __( 'View FG Guitar Specifications', 'fg-guitars' ),
			'search_items'          => __( 'Search FG Guitar Specifications', 'fg-guitars' ),
			'not_found'             => __( 'Not found', 'fg-guitars' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fg-guitars' ),
			'featured_image'        => __( 'Featured Image', 'fg-guitars' ),
			'set_featured_image'    => __( 'Set Featured Image', 'fg-guitars' ),
			'remove_featured_image' => __( 'Remove Featured Image', 'fg-guitars' ),
			'use_featured_image'    => __( 'Use as Featured Image', 'fg-guitars' ),
			'insert_into_item'      => __( 'Insert into FG Guitar Specifications', 'fg-guitars' ),
			'uploaded_to_this_item' => __( 'Uploaded to this FG Guitar Specifications', 'fg-guitars' ),
			'items_list'            => __( 'FG Guitar Specifications list', 'fg-guitars' ),
			'items_list_navigation' => __( 'FG Guitar Specifications list navigation', 'fg-guitars' ),
			'filter_items_list'     => __( 'Filter FG Guitar Specifications list', 'fg-guitars' ),
		);

		$rewrite = array(
			'slug'       => self::POST_TYPE_SLUG,
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);

		$args = array(
			'label'         => __( 'FG Guitar Specifications', 'fg-guitars' ),
			'description'   => __( 'FG Guitar Specifications Description', 'fg-guitars' ),
			'labels'        => $labels,
			'supports'      => array( 'title' ),
			'taxonomies'    => array(),
			'hierarchical'  => false,
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => 'edit.php?post_type=fg_guitars',
			'menu_icon'     => 'dashicons-admin-post',
			'menu_position' => 30,
			'can_export'    => true,
			'rewrite'       => $rewrite,
			'map_meta_cap'  => true,
			'show_in_rest'  => false,
		);
		register_post_type( self::POST_TYPE_NAME, $args );
	}

	public function add_metaboxes() {
		$cmb = new_cmb2_box( array(
			'id'           => 'fg_guitars_specs',
			'title'        => __( 'FG Guitars Specifications', 'fg-guitars' ),
			'object_types' => array( self::POST_TYPE_NAME, ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true,
		) );

		$group_field_id = $cmb->add_field( array(
			'name'    => __( 'Test Text', 'fg-guitars' ),
			'desc'    => __( 'field description (optional)', 'fg-guitars' ),
			'id'      => 'fgg_specs',
			'type'    => 'group',
			'options' => [
				'group_title'   => __( 'Spec {#}', 'fg-guitars' ),
				'add_button'    => __( 'Add Another Spec', 'fg-guitars' ),
				'remove_button' => __( 'Remove Spec', 'fg-guitars' ),
				'sortable'      => true,
			]
		) );

		$cmb->add_group_field( $group_field_id, array(
			'name' => __( 'Spec Title', 'fg-guitars' ),
			'id'   => 'name',
			'type' => 'text',
		) );

		$cmb->add_group_field( $group_field_id, array(
			'name'    => __( 'Spec Field Type', 'fg-guitars' ),
			'id'      => 'type',
			'type'    => 'select',
			'options' => [
				'text'    => __( 'Text', 'fg-guitars' ),
				'wysiwyg' => __( 'Editor', 'fg-guitars' ),
			]
		) );
	}

	/**
	 * @param array $args
	 *
	 * @return int[]|WP_Post[]
	 */
	public function get_items( $args = array() ) {
		return $this->_get_items( $args );
	}

	public static function get_custom_specs_fields( $post_id ) {
		return get_post_meta( $post_id, 'fgg_specs', true );
	}

	/**
	 * @param array $args
	 *
	 * @return int[]|WP_Post[]
	 */
	private function _get_items( $args = array() ) {

		$default = array(
			'post_type'      => self::POST_TYPE_NAME,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
		);

		$args = wp_parse_args( $args, $default );

		$query = new WP_Query( $args );

		return $query->get_posts();
	}

}