<?php

defined( 'ABSPATH' ) or die();

class FG_Guitars_Post_Type {

	const POST_TYPE_NAME = 'fg_guitars';
	const TAXONOMY_NAME = 'fg_guitars_cat';
	const SLUG = 'guitars';

	private $short_description;
	private $specifications;

	private static $instance = null;

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
//		add_filter( 'cmb2_can_save', array( $this, 'can_save' ) );
//		add_action( 'do_meta_boxes', array( $this, 'remove_external_metaboxes' ) );
//		add_action( 'admin_notices', array( $this, 'customer_not_saved_message' ) );
//		add_filter( 'wp_insert_post_empty_content', array( $this, 'check_serial_number_exists' ), 10, 2 );
	}

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
			'public'        => false,
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

	public function add_metaboxes() {

		FG_Guitars_Short_Description_Fields::getInstance()->add_metaboxes( self::POST_TYPE_NAME );

		FG_Guitars_Specifications_Fields::getInstance()->add_metaboxes( self::POST_TYPE_NAME );
	}

	public function display_customer_column_cb( $field_args, $field ) {
		$user_id      = $field->escaped_value();
		$name_company = $this->_get_user_name_and_company( $user_id );
		?>
        <div class="customer">
            <p><?php echo $name_company; ?></p>
        </div>
		<?php
	}

	/**
	 * @param $can_save
	 * @param $cmb CMB2
	 *
	 * @return mixed
	 */
	public function can_save( $can_save ) {
		$this->_clear_admin_messages();

		if ( empty( $_POST['post_type'] ) || self::POST_TYPE_NAME != $_POST['post_type'] || empty( $_POST[ self::CUSTOMER_META_KEY ] ) ) {
			return $can_save;
		}

		if ( empty( $_POST[ self::CUSTOMER_META_KEY ] ) ) {
			return $can_save;
		}

		$user_id = $_POST[ self::CUSTOMER_META_KEY ];

		$serial_number_id = $this->get_serial_number_id_by_user_id( $user_id );

		if ( ! empty( $serial_number_id ) && ( ! empty( $_POST['post_ID'] ) && $serial_number_id != $_POST['post_ID'] ) ) {
			$can_save = false;

			$user_name  = $this->_get_user_name_and_company( $user_id );
			$messages[] = sprintf( __( 'User <b>%s</b> is assigned in another FG Guitar.', 'fg-guitars' ), $user_name );
			$this->_set_admin_messages( $messages );
		}

		return $can_save;
	}

	public function remove_external_metaboxes() {
		remove_meta_box( 'astra_settings_meta_box', self::POST_TYPE_NAME, 'side' );
	}

	public function customer_not_saved_message() {
		$this->_print_admin_messages();
	}

	public function check_serial_number_exists( $maybe_empty, $postarr ) {
		$this->_clear_admin_messages();

		$exists = $this->get_serial_number_id( $postarr['post_title'] );

		if ( $exists && $postarr['ID'] != $exists ) {
			$messages[] = sprintf( __( 'FG Guitar <b>%s</b> exists.', 'fg-guitars' ), $postarr['post_title'] );
			$this->_set_admin_messages( $messages );

			return true;
		}

		return $maybe_empty;
	}

	public function get_user_id_by_serial_number( $serial_number ) {
		$user_id = '';

		$serial_numbers = $this->_get_items_by_title( $serial_number );

		if ( ! empty( $serial_numbers ) ) {
			$user_id = get_post_meta( $serial_numbers[0]->ID, self::CUSTOMER_META_KEY, true );
		}

		return $user_id;
	}

	public function get_serial_number_id( $serial_number ) {
		$serial_number_id = '';

		$serial_numbers = $this->_get_items_by_title( $serial_number );

		if ( ! empty( $serial_numbers ) ) {
			$serial_number_id = $serial_numbers[0]->ID;
		}

		return $serial_number_id;
	}


	/**
	 * @param $serial_number_id
	 *
	 * @return bool|int[]|WP_Post[]
	 */
	public function get_serial_number_by_id( $serial_number_id ) {

		if ( empty( $serial_number_id ) ) {
			return false;
		}

		$serial_number = $this->_get_items_by_id( $serial_number_id );

		return $serial_number;
	}

	/**
	 * @param $serial_number_id
	 *
	 * @return bool|WP_User
	 */
	public function get_user_by_serial_number_id( $serial_number_id ) {
		$user = false;

		if ( empty( $serial_number_id ) ) {
			return false;
		}
		$serial_number = $this->_get_items_by_id( $serial_number_id );

		if ( ! empty( $serial_number ) ) {
			$user_id = get_post_meta( $serial_number[0]->ID, self::CUSTOMER_META_KEY, true );
		}
		if ( ! empty( $user_id ) ) {
			$user = get_user_by( 'id', $user_id );
		}

		return $user;
	}

	public function get_serial_number_id_by_user_id( $user_id ) {
		$serial_number_id = '';

		$serial_numbers = $this->_get_items( $user_id, self::CUSTOMER_META_KEY );

		if ( ! empty( $serial_numbers ) ) {
			$serial_number_id = $serial_numbers[0]->ID;
		}

		return $serial_number_id;
	}

	public function get_product_price( $serial_number_id, $product_id ) {
		$product_prices = get_post_meta( $serial_number_id, self::PRODUCTS_META_KEY, true );

		$price = ! empty( $product_prices[ $product_id ] ) ? $product_prices[ $product_id ] : '';

		return $price;
	}

	private function _get_items( $meta_value = '', $meta_key = self::SERIAL_NUMBER_META_KEY ) {

		$args = array(
			'post_type'      => self::POST_TYPE_NAME,
			'meta_key'       => $meta_key,
			'meta_value'     => $meta_value,
			'post_status'    => 'publish',
			'posts_per_page' => 1,
		);

		$serial_numbers_query = new WP_Query( $args );
		$serial_numbers       = $serial_numbers_query->get_posts();

		return $serial_numbers;
	}

	/**
	 * @param $post_id
	 *
	 * @return bool|int[]|WP_Post[]
	 */
	private function _get_items_by_id( $post_id ) {
		if ( empty( $post_id ) ) {
			return false;
		}

		$args = array(
			'post_type'      => self::POST_TYPE_NAME,
			'p'              => $post_id,
			'post_status'    => 'publish',
			'posts_per_page' => 1,
		);

		$serial_numbers_query = new WP_Query( $args );
		$serial_numbers       = $serial_numbers_query->get_posts();

		return $serial_numbers;
	}

	private function _get_items_by_title( $title ) {
		if ( empty( $title ) ) {
			return array();
		}

		$args = array(
			'post_type'      => self::POST_TYPE_NAME,
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'title'          => $title,
		);

		$serial_numbers_query = new WP_Query( $args );
		$serial_numbers       = $serial_numbers_query->get_posts();

		return $serial_numbers;

	}

	private function _get_users() {
		$user_list = array();

		if ( ! class_exists( 'WC_Customer' ) ) {
			return $user_list;
		}

		$users = get_users( array(
			'role' => 'customer'
		) );

		foreach ( $users as $user ) {
			$name_company = $this->_get_user_name_and_company( $user->ID );

			$user_list[ $user->ID ] = $name_company;
		}


		return $user_list;
	}

	private function _get_products() {
		$product_list = array();

		$args     = array(
			'posts_per_page' => - 1,
			'status'         => 'publish',
			'orderby'        => 'name',
			'order'          => 'ASC'
		);
		$products = function_exists( 'wc_get_products' ) ? wc_get_products( $args ) : array();

		foreach ( $products as $product ) {
			$product_list[ $product->get_id() ] = array(
				'name'  => $product->get_name(),
				'sku'   => $product->get_sku(),
				'price' => $product->get_price()
			);
		}

		return $product_list;
	}

	private function _get_user_name_and_company( $user_id ) {
		if ( empty( $user_id ) || ! class_exists( 'WC_Customer' ) ) {
			return '';
		}

		$customer = new WC_Customer( $user_id );
		$company  = ! empty( $customer->get_billing_company() ) ? ' - ' . $customer->get_billing_company() : '';

		return $customer->get_display_name() . $company;
	}

	private function _set_admin_messages( $messages ) {
		$_messages = get_transient( self::TRANSIENT_MESSAGE_KEY );

		$messages = ! empty( $_messages ) ? array_merge( $_messages, $messages ) : $messages;

		set_transient( self::TRANSIENT_MESSAGE_KEY, $messages, 5 );
	}

	private function _print_admin_messages() {
		$messages = get_transient( self::TRANSIENT_MESSAGE_KEY );

		if ( empty( $messages ) ) {
			return;
		}

		foreach ( $messages as $message ):
			if ( ! empty( $message ) ):
				?>
                <div class="notice notice-error is-dismissible">
                    <p><?php echo $message; ?></p>
                </div>
			<?php
			endif;
		endforeach;
	}

	private function _clear_admin_messages() {
		set_transient( self::TRANSIENT_MESSAGE_KEY, array(), 5 );
	}
}