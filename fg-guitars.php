<?php

/**
 * @wordpress-plugin
 * Plugin Name:       FremeditiGuitars - Guitars
 * Description:       FremeditiGuitars - Guitars Post Type
 * Version:           1.0.2
 * Author:            Vasilis Koutsopoulos
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fg-guitars
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die();

define( 'FG_GUITARS_VERSION', '1.0.2' );
define( 'FG_GUITARS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'FG_GUITARS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'FG_GUITARS_PLUGIN_DIR_NAME', basename( FG_GUITARS_PLUGIN_DIR_PATH ) );
define( 'FG_GUITARS_PLUGIN_URL', plugins_url( FG_GUITARS_PLUGIN_DIR_NAME ) );

include 'includes/class-fg-guitars.php';
include 'includes/class-fg-guitars-dependencies.php';
include 'includes/class-fg-guitars-post-type.php';
include 'includes/class-fg-guitars-shortcodes.php';

include 'includes/guitars-post-type-fields/abstract-class-fg-guitars-post-type-fields.php';
include 'includes/guitars-post-type-fields/class-fg-guitars-images-fields.php';
include 'includes/guitars-post-type-fields/class-fg-guitars-short-description-fields.php';
include 'includes/guitars-post-type-fields/class-fg-guitars-specifications-fields.php';
include 'includes/guitars-post-type-fields/class-fg-guitars-sounds-fields.php';
include 'includes/guitars-post-type-fields/class-fg-guitars-features-fields.php';
include 'includes/guitars-post-type-fields/class-fg-guitars-pricing-fields.php';

include 'includes/cmb2-custom-fields/class-fg-guitars-cmb2-features-field-dropdown.php';

FG_Guitars::instance();

