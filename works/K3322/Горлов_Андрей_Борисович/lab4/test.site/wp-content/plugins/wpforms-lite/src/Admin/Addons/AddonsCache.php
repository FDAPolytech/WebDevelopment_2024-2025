<?php

namespace WPForms\Admin\Addons;

use WPForms\Helpers\CacheBase;

/**
 * Addons cache handler.
 *
 * @since 1.6.6
 */
class AddonsCache extends CacheBase {

	/**
	 * Remote source URL.
	 *
	 * @since 1.8.9
	 *
	 * @var string
	 */
	const REMOTE_SOURCE = 'https://wpforms.com/wp-content/addons.json';

	/**
	 * Determine if the class is allowed to load.
	 *
	 * @since 1.6.8
	 *
	 * @return bool
	 */
	protected function allow_load() {

		if ( wp_doing_cron() || wpforms_doing_wp_cli() ) {
			return true;
		}

		$has_permissions  = wpforms_current_user_can( [ 'create_forms', 'edit_forms' ] );
		$allowed_requests = wpforms_is_admin_ajax() || wpforms_is_admin_page() || wpforms_is_admin_page( 'builder' );

		return $has_permissions && $allowed_requests;
	}

	/**
	 * Provide settings.
	 *
	 * @since 1.6.6
	 *
	 * @return array Settings array.
	 */
	protected function setup() {

		return [

			// Remote source URL.
			'remote_source' => $this->get_remote_source(),

			// Addons cache file name.
			'cache_file'    => 'addons.json',

			/**
			 * Time-to-live of the addons cache file in seconds.
			 *
			 * This applies to `uploads/wpforms/cache/addons.json` file.
			 *
			 * @since 1.6.8
			 *
			 * @param integer $cache_ttl Cache time-to-live, in seconds.
			 *                           Default value: WEEK_IN_SECONDS.
			 */
			'cache_ttl'     => (int) apply_filters( 'wpforms_admin_addons_cache_ttl', WEEK_IN_SECONDS ),

			// Scheduled update action.
			'update_action' => 'wpforms_admin_addons_cache_update',
		];
	}

	/**
	 * Get remote source URL.
	 *
	 * @since 1.8.9
	 *
	 * @return string
	 */
	protected function get_remote_source(): string {

		return defined( 'WPFORMS_ADDONS_REMOTE_SOURCE' ) ? WPFORMS_ADDONS_REMOTE_SOURCE : self::REMOTE_SOURCE;
	}

	/**
	 * Prepare addons data to store in a local cache -
	 * generate addons icon image file name for further use.
	 *
	 * @since 1.6.6
	 *
	 * @param array $data Raw addons data.
	 *
	 * @return array Prepared data for caching (with icons).
	 */
	protected function prepare_cache_data( $data ): array {

		if ( empty( $data ) || ! is_array( $data ) ) {
			return [];
		}

		$addons_cache = [];

		foreach ( $data as $addon ) {

			// Addon icon.
			$addon['icon'] = str_replace( 'wpforms-', 'addon-icon-', $addon['slug'] ) . '.png';

			// Special case for Sendinblue addon. The service was renamed to Brevo, but we keep the old slug for compatibility.
			if ( $addon['slug'] === 'wpforms-sendinblue' ) {
				$addon['icon'] = str_replace( 'sendinblue', 'brevo', $addon['icon'] );
			}

			// Use slug as a key for further usage.
			$addons_cache[ $addon['slug'] ] = $addon;
		}

		return $addons_cache;
	}
}
