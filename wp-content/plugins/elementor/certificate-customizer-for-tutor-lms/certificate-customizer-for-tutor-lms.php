<?php
/*

*/

if ( ! defined( 'ABSPATH' ) ){
	exit;
}

define('DHORITRY_FILE', __FILE__);

/**
 * Filter name of certificate bank.
 */
add_filter('tutor_certificate_templates', 'tutor_new_certificate_template');

/**
 * @param $templates
 *
 * @return mixed
 *
 * Pass array of certificate information, key is certificate name in slug format
 */

if ( ! function_exists('tutor_new_certificate_template')) {
	function tutor_new_certificate_template( $templates ) {
		$templates['dhoritry'] = array(
			'name'        => __( 'Dhoritry', 'dhoritry-cert' ),
			'orientation' => 'landscape', //landscape, portrait
			'path'        => trailingslashit( plugin_dir_path( DHORITRY_FILE ) . 'templates/dhoritry' ),
			'url'         => trailingslashit( plugin_dir_url( DHORITRY_FILE ) . 'templates/dhoritry' ),
			'preview_src' => trailingslashit( plugin_dir_url( DHORITRY_FILE ) . 'templates/dhoritry' ).'preview.png',
			'preview_src' => trailingslashit( plugin_dir_url( DHORITRY_FILE ) . 'templates/dhoritry' ).'background.png'
		);
		/*
		$templates['certificado'] = array(
			'name'        => __( 'certificado', 'certificado-cert' ),
			'orientation' => 'landscape', //landscape, portrait
			'path'        => trailingslashit( plugin_dir_path( DHORITRY_FILE ) . 'templates/certificado' ),
			'url'         => trailingslashit( plugin_dir_url( DHORITRY_FILE ) . 'templates/certificado' ),
			'preview_src' => trailingslashit( plugin_dir_url( DHORITRY_FILE ) . 'templates/certificado' ).'preview.png',
			'preview_src' => trailingslashit( plugin_dir_url( DHORITRY_FILE ) . 'templates/certificado' ).'background.png'
		);
*/
		return $templates;
	}
}