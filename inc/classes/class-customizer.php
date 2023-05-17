<?php
/**
 * Customizing the default WP items
 *
 * @package muslimsticino
 */

namespace Muslimsticino_Theme\Inc;

use Muslimsticino_Theme\Inc\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Customizer {
	
	use Singleton;
	
	protected function __construct() {
		$this->setup_hooks();
	}
	
	protected function setup_hooks() {
		
		/**
		 * Actions and Filters
		 */
		add_action( 'wp_default_scripts', [ $this, 'muslimsticino_remove_jquery_migrate' ] );
		add_filter( 'wp_prepare_attachment_for_js', [ $this, 'muslimsticino_change_empty_alt' ] );
		
		/**
		 * После обновления WP до 5.8 сломались виджеты
		 * отключаем новый вариант и возвращаем старый
		 */
		// Disables the block editor from managing widgets in the Gutenberg plugin.
		//add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
		// Disables the block editor from managing widgets.
		add_filter( 'use_widgets_block_editor', '__return_false' );
		add_filter( 'body_class',[$this, 'muslimsticino_body_classes'] );
		
		//add_filter(‘rest_enabled’, ‘__return_false’);
	}
	
	/**
	 * Removing JQuery migrate.
	 */
	function muslimsticino_remove_jquery_migrate( $scripts ) {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			
			if ( $script->deps ) { // Check whether the script has any dependencies
				$script->deps = array_diff( $script->deps, array(
					'jquery-migrate',
				) );
			}
		}
	}
	
	/**
	 * Adding class to body
	 * @return array
	 */
	function muslimsticino_body_classes( $class ) {
		
		global $wp_query;
		
		$classes = [];
		
		$page_type = [
			is_front_page(),
			is_single(),
			is_archive(),
			is_404(),
		];
		
		$is_search_class = '';
		
		if ( is_search() ) {
			$is_search_class = $wp_query->posts ? 'lmt_search' : 'lmt_search-no-results';
		}
		
		switch ( true ) {
			case $page_type == is_front_page():
				$classes[] = 'lmt_home';
				break;
			case $page_type == is_single():
				$classes[] = 'lmt_single';
				break;
			case $page_type == is_archive():
				$classes[] = 'lmt_archive';
				break;
			case $page_type == is_search():
				$classes[] = $is_search_class;
				break;
			case $page_type == is_404():
				$classes[] = 'lmt_404';
				break;
			default:
				$classes[] = 'lmt_page';
		}
		
		return array_merge( $class, $classes );
	}
	
	
	/**
	 * Filling img alt with Post title.
	 *
	 * @param $response
	 *
	 * @return mixed
	 */
	function muslimsticino_change_empty_alt( $response ) {
		if ( ! $response['alt'] ) {
			$response['alt'] = sanitize_text_field( $response['uploadedToTitle'] );
		}
		
		return $response;
	}
	
}
