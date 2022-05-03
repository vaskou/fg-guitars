<?php

use WordpressCustomSettings\SettingsSetup;
use WordpressCustomSettings\SettingSection;
use WordpressCustomSettings\SettingField;

class FG_Guitars_Settings extends SettingsSetup {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	protected function __construct() {

		$this->set_submenu_parent_slug( 'options-general.php' );

		$this->set_page_title( __( 'FG Guitars Settings', 'fg-guitars' ) );
		$this->set_menu_title( __( 'FG Guitars Settings', 'fg-guitars' ) );
		$this->set_menu_slug( 'fg-guitars' );
		$this->add_settings_link( FG_GUITARS_PLUGIN_BASENAME );

		$this->add_section( new SettingSection( 'general', __( 'General', 'fg-guitars' ) ) );

		$settings = array(
			new SettingField( 'fg_guitars_contact_page', __( '"Contact Us" Page', 'fg-guitars' ), 'pages', 'general' ),
		);

		foreach ( $settings as $setting ) {
			$this->add_setting_field( $setting );
		}

		parent::__construct();
	}

	public static function get_contact_page() {
		return self::instance()->get_setting( 'fg_guitars_contact_page' );
	}
}