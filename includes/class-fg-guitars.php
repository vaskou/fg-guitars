<?php

defined( 'ABSPATH' ) or die();

class FG_Guitars {

	private static $instance = null;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		FG_Guitars_Post_Type::getInstance()->init();
	}
}