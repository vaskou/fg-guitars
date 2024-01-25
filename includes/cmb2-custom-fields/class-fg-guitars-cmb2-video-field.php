<?php

defined( 'ABSPATH' ) or die();

class FG_Guitars_CMB2_Video_Field {

	private $field_type;

	private static $instance;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->field_type = 'fg_guitars_cmb2_video_field';
		add_action( "cmb2_render_{$this->field_type}", array( $this, 'render' ), 10, 5 );
		add_action( "cmb2_sanitize_{$this->field_type}", array( $this, 'sanitize' ), 10, 2 );
		add_action( "cmb2_types_esc_{$this->field_type}", array( $this, 'escape_value' ), 10, 2 );
	}

	/**
	 * @param $field         CMB2_Field
	 * @param $escaped_value mixed
	 * @param $object_id     int
	 * @param $object_type   string
	 * @param $field_type    CMB2_Types
	 */
	public function render( $field, $escaped_value, $object_id, $object_type, $field_type ) {

		$video_url_value = ! is_array( $escaped_value ) ? $escaped_value : ( ! empty( $escaped_value['url'] ) ? $escaped_value['url'] : '' );
		$video_url_args  = [
			'type'  => 'text',
			'id'    => $field_type->_id( '_url' ),
			'name'  => $field_type->_name( '[url]' ),
			'value' => $video_url_value,
		];

		$video_title_value = ! empty( $escaped_value['title'] ) ? $escaped_value['title'] : '';
		$video_title_args  = [
			'type'  => 'text',
			'id'    => $field_type->_id( '_title' ),
			'name'  => $field_type->_name( '[title]' ),
			'value' => $video_title_value,
		];

		ob_start();
		?>
        <div class="fg-guitars-cmb2-video-field">
            <div class="video-url cmb-row">
                <div class="cmb-th">
                    <label><?php echo __( 'Video code', 'fg-guitars' ); ?></label>
                </div>
                <div class="cmb-td">
					<?php echo $field_type->input( $video_url_args ); ?>
                </div>
            </div>

            <div class="video-title cmb-row">
                <div class="cmb-th">
                    <label><?php echo __( 'Video title', 'fg-guitars' ); ?></label>
                </div>
                <div class="cmb-td">
					<?php echo $field_type->input( $video_title_args ); ?>
                </div>
            </div>
        </div>
		<?php
		$html = ob_get_clean();

		echo $html;

	}

	public function sanitize( $sanitized_val, $val ) {
		if ( ! is_array( $val ) ) {
			return array();
		}

		foreach ( $val as $key => $value ) {

			$has_value = false;
			$sanitized = [];

			foreach ( $value as $k => $v ) {
				$v = ! empty( $v ) ? $v : '';

				$sanitized[ $k ] = sanitize_text_field( $v );

				if ( ! $has_value ) {
					$has_value = ! empty( $sanitized[ $k ] );
				}
			}

			if ( $has_value ) {
				$sanitized_val[ $key ] = $sanitized;
			}

		}

		return $sanitized_val;
	}

	public function escape_value( $escaped_value, $val ) {

        if ( ! is_array( $val ) ) {
			return array();
		}

		foreach ( $val as $key => $value ) {

			if ( ! is_array( $value ) ) {
				$escaped_value[ $key ]['url']   = esc_attr( $value );
				$escaped_value[ $key ]['title'] = '';
				continue;
			}

			foreach ( $value as $k => $v ) {
				$v = ! empty( $v ) ? $v : '';

				$escaped_value[ $key ][ $k ] = esc_attr( $v );
			}


		}

		return $escaped_value;
	}

}