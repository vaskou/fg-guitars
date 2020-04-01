<?php

/**
 * @wordpress-plugin
 * Plugin Name:       FremeditiGuitars - Guitars
 * Description:       FremeditiGuitars - Guitars Post Type
 * Version:           1.0.0
 * Author:            Vasilis Koutsopoulos
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fg-guitars
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die();

define( 'FG_GUITARS_VERSION', '1.0.0' );
define( 'FG_GUITARS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'FG_GUITARS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'FG_GUITARS_PLUGIN_DIR_NAME', basename( FG_GUITARS_PLUGIN_DIR_PATH ) );
define( 'FG_GUITARS_PLUGIN_URL', plugins_url( FG_GUITARS_PLUGIN_DIR_NAME ) );

include 'vendor/autoload.php';
include 'includes/class-fg-guitars.php';
include 'includes/class-fg-guitars-post-type.php';

include 'includes/guitars-post-type-fields/abstract-class-fg-guitars-post-type-fields.php';
include 'includes/guitars-post-type-fields/class-fg-guitars-short-description-fields.php';
include 'includes/guitars-post-type-fields/class-fg-guitars-specifications-fields.php';

FG_Guitars::getInstance()->init();

