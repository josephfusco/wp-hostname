<?php
/**
 * Plugin Name:        WP Hostname
 * Description:        Show network hostname in the admin toolbar.
 * Version:            1.0
 * Author:             Joseph Fusco
 * Author URI:         https://josephfus.co/
 * License:            GPLv2 or later
 * License URI:        http://www.gnu.org/licenses/gpl-2.0.html
 * GitHub Plugin URI:  josephfusco/wp-hostname
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WP_Hostname {

	function __construct() {
		$this->load_menu();
	}

	function load_menu() {
		add_action( 'admin_bar_menu', array( $this, 'create_menu' ), 900 );
	}

	function create_menu( $wp_admin_bar ) {
		$shell_info = $this->get_shell_info();

		$args = array(
			'id'    => 'wp-hostname',
			'title' => '<span class="ab-icon dashicons dashicons-networking" style="top:1px"></span><span class="ab-label">Hostname: ' . esc_html( $shell_info ) . '</span>',
		);

		$wp_admin_bar->add_node( $args );
	}

	private function get_shell_info() {
		return shell_exec( 'uname -n' );
	}
}

$wp_hostname = new WP_Hostname();
