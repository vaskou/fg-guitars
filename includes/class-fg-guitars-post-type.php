<?php

defined( 'ABSPATH' ) or die();

class FG_Guitars_Post_Type {

	const POST_TYPE_NAME = 'fg_guitars';
	const TAXONOMY_NAME = 'fg_guitars_cat';
	const SLUG = 'guitars';

	private static $instance = null;

	/**
	 * FG_Guitars_Post_Type constructor.
	 */
	private function __construct() {
	}

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_metaboxes' ) );
	}

	/**
	 * Registers post type
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'FG Guitars', 'FG Guitars General Name', 'fg-guitars' ),
			'singular_name'         => _x( 'FG Guitar', 'FG Guitar Singular Name', 'fg-guitars' ),
			'menu_name'             => __( 'FG Guitars', 'fg-guitars' ),
			'name_admin_bar'        => __( 'FG Guitars', 'fg-guitars' ),
			'archives'              => __( 'FG Guitar Archives', 'fg-guitars' ),
			'attributes'            => __( 'FG Guitar Attributes', 'fg-guitars' ),
			'parent_item_colon'     => __( 'Parent FG Guitar:', 'fg-guitars' ),
			'all_items'             => __( 'All FG Guitars', 'fg-guitars' ),
			'add_new_item'          => __( 'Add New FG Guitar', 'fg-guitars' ),
			'add_new'               => __( 'Add New', 'fg-guitars' ),
			'new_item'              => __( 'New FG Guitar', 'fg-guitars' ),
			'edit_item'             => __( 'Edit FG Guitar', 'fg-guitars' ),
			'update_item'           => __( 'Update FG Guitar', 'fg-guitars' ),
			'view_item'             => __( 'View FG Guitar', 'fg-guitars' ),
			'view_items'            => __( 'View FG Guitars', 'fg-guitars' ),
			'search_items'          => __( 'Search FG Guitar', 'fg-guitars' ),
			'not_found'             => __( 'Not found', 'fg-guitars' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fg-guitars' ),
			'featured_image'        => __( 'Featured Image', 'fg-guitars' ),
			'set_featured_image'    => __( 'Set Featured Image', 'fg-guitars' ),
			'remove_featured_image' => __( 'Remove Featured Image', 'fg-guitars' ),
			'use_featured_image'    => __( 'Use as Featured Image', 'fg-guitars' ),
			'insert_into_item'      => __( 'Insert into FG Guitar', 'fg-guitars' ),
			'uploaded_to_this_item' => __( 'Uploaded to this FG Guitar', 'fg-guitars' ),
			'items_list'            => __( 'FG Guitars list', 'fg-guitars' ),
			'items_list_navigation' => __( 'FG Guitars list navigation', 'fg-guitars' ),
			'filter_items_list'     => __( 'Filter FG Guitars list', 'fg-guitars' ),
		);

		$rewrite = array(
			'slug'       => self::SLUG,
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);

		$args = array(
			'label'         => __( 'FG Guitar', 'fg-guitars' ),
			'description'   => __( 'FG Guitar Description', 'fg-guitars' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor' ),
			'taxonomies'    => array( self::TAXONOMY_NAME ),
			'hierarchical'  => false,
			'public'        => true,
			'show_ui'       => true,
			'menu_icon'     => 'dashicons-admin-post',
			'menu_position' => 30,
			'can_export'    => true,
			'rewrite'       => $rewrite,
			'map_meta_cap'  => true,
			'show_in_rest'  => false,
		);
		register_post_type( self::POST_TYPE_NAME, $args );
	}

	/**
	 * Registers taxonomy
	 */
	public function register_taxonomy() {

		$labels = array(
			'name'              => __( 'FG Guitar Categories', 'fg-guitars' ),
			'singular_name'     => __( 'FG Guitar Category', 'fg-guitars' ),
			'search_items'      => __( 'Search FG Guitar Categories', 'fg-guitars' ),
			'all_items'         => __( 'All FG Guitar Categories', 'fg-guitars' ),
			'parent_item'       => __( 'Parent FG Guitar Category', 'fg-guitars' ),
			'parent_item_colon' => __( 'Parent FG Guitar Category:', 'fg-guitars' ),
			'edit_item'         => __( 'Edit FG Guitar Category', 'fg-guitars' ),
			'update_item'       => __( 'Update FG Guitar Category', 'fg-guitars' ),
			'add_new_item'      => __( 'Add New FG Guitar Category', 'fg-guitars' ),
			'new_item_name'     => __( 'New FG Guitar Category Name', 'fg-guitars' ),
			'menu_name'         => __( 'FG Guitar Categories', 'fg-guitars' ),
		);
		$args   = array(
			'hierarchical'       => true, // make it hierarchical (like categories)
			'labels'             => $labels,
			'public'             => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
			'show_in_quick_edit' => false,
			'query_var'          => true,
			'meta_box_cb'        => 'post_categories_meta_box',
			'rewrite'            => true,
		);

		register_taxonomy( self::TAXONOMY_NAME, array( self::POST_TYPE_NAME ), $args );
	}

	/**
	 * Adds metaboxes
	 */
	public function add_metaboxes() {

		FG_Guitars_Images_Fields::getInstance()->add_metaboxes(self::POST_TYPE_NAME);
		FG_Guitars_Short_Description_Fields::getInstance()->add_metaboxes( self::POST_TYPE_NAME );
		FG_Guitars_Specifications_Fields::getInstance()->add_metaboxes( self::POST_TYPE_NAME );
		FG_Guitars_Sounds_Fields::getInstance()->add_metaboxes( self::POST_TYPE_NAME );
		FG_Guitars_Features_Fields::getInstance()->add_metaboxes( self::POST_TYPE_NAME );
		FG_Guitars_Pricing_Fields::getInstance()->add_metaboxes( self::POST_TYPE_NAME );

	}

	/**
	 * @return int[]|WP_Post[]
	 */
	public function get_items() {
		return $this->_get_items();
	}

	/**
	 * @return int|WP_Error|WP_Term[]
	 */
	public function get_categories() {
		return $this->_get_categories();
	}

	public function get_categories_items_array() {

		$categories_items_array = array();

		$categories = $this->_get_categories();

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$cat_id    = $category->term_id;
				$post_args = array(
					'tax_query' => array(
						array(
							'taxonomy'         => self::TAXONOMY_NAME,
							'terms'            => $cat_id,
							'include_children' => false // Remove if you need posts from term 7 child terms
						),
					),
				);

				$items = $this->_get_items( $post_args );

				$categories_items_array[ $cat_id ] = array(
					'cat_id'   => $cat_id,
					'cat_name' => $category->name,
					'items'    => array()
				);

				foreach ( $items as $item ) {
					$categories_items_array[ $cat_id ]['items'][ $item->ID ] = array(
						'id'   => $item->ID,
						'title' => $item->post_title
					);
				}
			}
		}

		return $categories_items_array;

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

	/**
	 * @param array $args
	 *
	 * @return int|WP_Error|WP_Term[]
	 */
	private function _get_categories( $args = array() ) {

		$default = array(
			'taxonomy' => self::TAXONOMY_NAME,
			'orderby'  => 'name',
			'order'    => 'ASC'
		);

		$args = wp_parse_args( $args, $default );

		return get_terms( $args );
	}

}