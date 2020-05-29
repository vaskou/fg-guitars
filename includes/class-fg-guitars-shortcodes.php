<?php

defined( 'ABSPATH' ) or die();

class FG_Guitars_Shortcodes {

	const FEATURES_SHORTCODE_NAME = 'fg-guitar-features';
	const GUITAR_CATEGORIES_SHORTCODE_NAME = 'fg-guitar-categories';

	private static $instance = null;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		add_action( 'init', array( $this, 'register_shortcodes' ) );
	}

	public function register_shortcodes() {
		add_shortcode( self::FEATURES_SHORTCODE_NAME, array( $this, 'features_shortcode' ) );
		add_shortcode( self::GUITAR_CATEGORIES_SHORTCODE_NAME, array( $this, 'guitar_categories_shortcode' ) );
	}

	public function features_shortcode( $atts ) {

		$post_types = array();

		if ( class_exists( 'FG_Features_Post_Type' ) ) {
			$post_types[] = FG_Features_Post_Type::POST_TYPE_NAME;
		}

		if ( class_exists( 'FG_Pickups_Post_Type' ) ) {
			$post_types[] = FG_Pickups_Post_Type::POST_TYPE_NAME;
		}

		if ( empty( $post_types ) ) {
			return '';
		}

		$default = array(
			'is_shortcode'   => true,
			'post__in'       => '',
			'post_type'      => $post_types,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
			'orderby'        => 'post__in',
		);

		$args = shortcode_atts( $default, $atts );

		$args['post__in'] = ! empty( $args['post__in'] ) ? explode( ',', $args['post__in'] ) : array();

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
		endif;
		wp_reset_postdata();

		return ob_get_clean();

	}

	public function guitar_categories_shortcode( $atts ) {

		ob_start();

		$guitars           = FG_Guitars_Post_Type::getInstance();
		$guitar_categories = $guitars->get_categories();

		if ( ! empty( $guitar_categories ) ):
			?>
            <div class="uk-child-width-1-2@s uk-child-width-1-4@m" uk-grid>
				<?php
				foreach ( $guitar_categories as $category ):
					?>
                    <div class="uk-flex uk-child-width-1-1">
                        <div class="fg-box uk-text-center uk-flex uk-child-width-1-1 uk-flex-right uk-flex-column">
							<?php
							$link  = get_term_link( $category->term_id );
							$image = '';

							if ( function_exists( 'z_taxonomy_image' ) ) {
								$image = z_taxonomy_image( $category->term_id, 'full', null, false );
							}
							
							if ( ! empty( $image ) ):
								?>
                                <a href="<?php echo $link; ?>" class="uk-display-block ">
									<?php echo $image; ?>
                                </a>
							<?php
							endif;
							?>
                            <a href="<?php echo $link; ?>" class="uk-display-block ">
                                <h3 class="entry-title"><?php echo $category->name; ?></h3>
                            </a>
                        </div>
                    </div>
				<?php
				endforeach;

				?>
            </div>
		<?php
		endif;

		return ob_get_clean();
	}
}