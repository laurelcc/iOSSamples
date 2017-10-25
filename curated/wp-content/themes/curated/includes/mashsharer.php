<?php
/**
 * Mashshare plugin functions
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Return share count from Mashsharer
 *
 * @return int
 */
function bimber_mashsharer_get_share_count() {
	$url    = mashsb_get_url();
	$number = getSharedcount( $url );

	return $number;
}

/**
 * Check whether to show or now share count
 *
 * @param bool $show            Current state.
 * @param int  $share_count     Number of shares.
 *
 * @return bool
 */
function bimber_mashsharer_show_share_count( $show, $share_count ) {
	$settings = mashsb_get_settings();

	$share_count_threshold = isset( $settings['hide_sharecount'] ) ? $settings['hide_sharecount'] : 0;

	if ( absint( $share_count ) < absint( $share_count_threshold ) ) {
		$show = false;
	}

	return $show;
}


/**
 * Get query arguments for the most shared collection
 *
 * @param array $query_args Query arguments.
 *
 * @return array
 */
function bimber_mashsharer_get_most_shared_query_args( $query_args ) {
	$defaults = array(
		'posts_per_page'      => 10,
		'ignore_sticky_posts' => true,
		'meta_key'            => 'mashsb_shares',
		'orderby'             => 'meta_value_num',
		'order'               => 'DESC',
		// This way we can be sure that only "shared" posts will be used.
		'meta_query'          => array(
			array(
				'key'     => 'mashsb_shares',
				'compare' => '>',
				'value'   => 0,
			),
		),
	);

	$query_args = wp_parse_args( $query_args, $defaults );

	return $query_args;
}

/**
 * Add custom newtworks for Mashsharer
 *
 * @param array $networks       Available network list.
 *
 * @return array
 */
function bimber_mashsharer_array_networks( $networks ) {
	$image     = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
	$image_url = $image ? $image[0] : '';

	$networks['pinterest'] = 'https://www.pinterest.com/pin/create/bookmarklet/?pinFave=1&url=' . $networks['url'] . '&media=' . $image_url . '&description=' . $networks['title'];
	$networks['google']    = 'https://plus.google.com/share?url=' . $networks['url'];

	return $networks;
}

/**
 * Init custom caching rules.
 */
function bimber_mashsharer_init_custom_caching_rules() {
	if ( false === apply_filters( 'bimber_mashsharer_custom_cache', true ) ) {
		return;
	}

	global $mashsb_options;

	if ( isset( $mashsb_options ) ) {
		// Store default and new values for further use.
		$mashsb_options['mashsharer_default_cache'] = $mashsb_options['mashsharer_cache'];
		$mashsb_options['mashsharer_custom_cache'] = 2592000; // One month.

		bimber_mashsharer_enable_custom_caching_rules();
	}
}

/**
 * Enable custom caching rules.
 */
function bimber_mashsharer_enable_custom_caching_rules() {
	bimber_mashsharer_switch_cache( 'mashsharer_custom_cache' );
}

/**
 * Enable custom caching rules.
 */
function bimber_mashsharer_disable_custom_caching_rules() {
	bimber_mashsharer_switch_cache( 'mashsharer_default_cache' );
}

/**
 * Change cache value by type
 *
 * @param string $type         Cache type: mashsharer_custom_cache | mashsharer_default_cache.
 */
function bimber_mashsharer_switch_cache( $type ) {
	global $mashsb_options;

	if ( isset( $mashsb_options ) && isset( $mashsb_options[ $type ] ) ) {
		$mashsb_options['mashsharer_cache'] = $mashsb_options[ $type ];
	}
}

/**
 * Activate remote calls (for fetching current shares count) when entering singe post content.
 *
 * @param string $content           Post content.
 *
 * @return string
 */
function bimber_mashsharer_activate_curl( $content ) {
	if ( apply_filters( 'bimber_mashsharer_custom_cache', true ) && is_single() ) {
		bimber_mashsharer_disable_custom_caching_rules();
	}

	return $content;
}

/**
 * Deactivate remote calls when leaving singe post content.
 *
 * @param string $content           Post content.
 *
 * @return string
 */
function bimber_mashsharer_deactivate_curl( $content ) {
	if ( apply_filters( 'bimber_mashsharer_custom_cache', true ) && is_single() ) {
		bimber_mashsharer_enable_custom_caching_rules();
	}

	return $content;
}

/**
 * Register custom networks
 */
function bimber_mashsharer_register_new_networks() {
	$networks = get_option( 'mashsb_networks' );

	if ( ! in_array( 'Pinterest', $networks, true ) ) {
		$networks[] = 'Pinterest';
	}

	if ( ! in_array( 'Google', $networks, true ) ) {
		$networks[] = 'Google';
	}

	update_option( 'mashsb_networks', $networks );
}

if ( ! class_exists( 'MashshareNetworks' ) ) {
	/**
	 * Class MashshareNetworks
	 */
	class MashshareNetworks {
		// This class is required to enable custom networks counting.
		// It won't be used if "MashshareNetworks" add-on is installed.
	}
}

/**
 * Disable MashShare welcome page redirect.
 *
 * We use TGM Plugin Activation to install some plugins.
 * We must be sure there are no redirects during the activation queue.
 */
function bimber_mashsharer_disable_welcome_redirect() {
	delete_transient( '_mashsb_activation_redirect' );
}

/**
 * Set default option values for fresh MashShare plugin installations.
 */
function bimber_mashsharer_set_defaults() {
	$settings = get_option( 'mashsb_settings', array() );

	// Skip if already set.
	if ( ! empty( $settings ) ) {
		return;
	}

	$defaults = array(
		'mashsharer_cache'    => '21600', // 6 hours.
		'hide_sharecount'     => '1',
		'mashsharer_round'    => '1',
		'subscribe_behavior'  => 'link',
		'mashsharer_position' => 'both',
		'post_types'          => array(
			'post' => 'post',
		),
		'visible_services'    => '1',
		'networks'            => array(
			// Facebook.
			array(
				'id'     => 'facebook',
				'status' => '1',
				'name'   => '',
			),
			// Twitter.
			array(
				'id'     => 'twitter',
				'status' => '1',
				'name'   => '',
			),
			// Subscribe.
			array(
				'id'     => 'subscribe',
				'status' => '1',
				'name'   => '',
			),
			// Pinterest.
			array(
				'id'     => 'pinterest',
				'status' => '1',
				'name'   => '',
			),
			// Google.
			array(
				'id'     => 'google',
				'status' => '1',
				'name'   => '',
			),
		),
	);

	update_option( 'mashsb_settings', $defaults );
}
