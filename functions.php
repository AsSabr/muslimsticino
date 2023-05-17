<?php
/**
 * muslimsticino functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package muslimsticino
 */

if ( ! defined( 'MUSLIMSTICINO_DIR_PATH' ) ) {
	define( 'MUSLIMSTICINO_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'MUSLIMSTICINO_DIR_URI' ) ) {
	define( 'MUSLIMSTICINO_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'MUSLIMSTICINO_BUILD_PATH' ) ) {
	define( 'MUSLIMSTICINO_BUILD_PATH', untrailingslashit( get_template_directory() ) . '/build' );
}

if ( ! defined( 'MUSLIMSTICINO_BUILD_URI' ) ) {
	define( 'MUSLIMSTICINO_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/build' );
}

if ( ! defined( 'MUSLIMSTICINO_CSS_URI' ) ) {
	define( 'MUSLIMSTICINO_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/build/css' );
}

if ( ! defined( 'MUSLIMSTICINO_CSS_PATH' ) ) {
	define( 'MUSLIMSTICINO_CSS_PATH', untrailingslashit( get_template_directory() ) . '/build/css' );
}

if ( ! defined( 'MUSLIMSTICINO_JS_URI' ) ) {
	define( 'MUSLIMSTICINO_JS_URI', untrailingslashit( get_template_directory_uri() ) . '/build/js' );
}

if ( ! defined( 'MUSLIMSTICINO_JS_PATH' ) ) {
	define( 'MUSLIMSTICINO_JS_PATH', untrailingslashit( get_template_directory() ) . '/build/js' );
}

require_once MUSLIMSTICINO_DIR_PATH . '/inc/helpers/autoloader.php';
require_once MUSLIMSTICINO_DIR_PATH . '/inc/helpers/template-tags.php';

function muslimsticino_get_theme_instance() {
	\Muslimsticino_Theme\Inc\Muslimsticino_Theme::get_instance();
}
muslimsticino_get_theme_instance();