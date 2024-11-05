<?php
/**
 * Helper functions to perform various checks across the core plugin and addons.
 *
 * @since 1.8.0
 */

// phpcs:disable Generic.Commenting.DocComment.MissingShort
/** @noinspection PhpUndefinedNamespaceInspection */
/** @noinspection PhpUndefinedClassInspection */
// phpcs:enable Generic.Commenting.DocComment.MissingShort

use WPForms\Vendor\TrueBV\Punycode;

/**
 * Check if a string is a valid URL.
 *
 * @since 1.0.0
 * @since 1.5.8 Changed the pattern used to validate the URL.
 *
 * @param string $url Input URL.
 *
 * @return bool
 * @noinspection RegExpUnnecessaryNonCapturingGroup
 * @noinspection RegExpRedundantEscape
 */
function wpforms_is_url( $url ): bool {

	// The pattern taken from https://gist.github.com/dperini/729294.
	// It is the best choice according to the https://mathiasbynens.be/demo/url-regex.
	$pattern = '%^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z0-9\x{00a1}-\x{ffff}][a-z0-9\x{00a1}-\x{ffff}_-]{0,62})?[a-z0-9\x{00a1}-\x{ffff}]\.)+(?:[a-z\x{00a1}-\x{ffff}]{2,}\.?))(?::\d{2,5})?(?:[/?#]\S*)?$%iu';

	if ( preg_match( $pattern, trim( $url ) ) ) {
		return true;
	}

	return false;
}

/**
 * Verify that an email is valid.
 * See the linked RFC.
 *
 * @see https://www.rfc-editor.org/rfc/inline-errata/rfc3696.html
 *
 * @since 1.7.3
 *
 * @param string $email Email address to verify.
 *
 * @return string|false Returns a valid email address on success, false on failure.
 */
function wpforms_is_email( $email ) { // phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh, Generic.Metrics.CyclomaticComplexity.MaxExceeded

	static $punycode;

	// Do not allow callables, arrays, and objects.
	if ( ! is_scalar( $email ) ) {
		return false;
	}

	// Allow smart tags in the email address.
	if ( preg_match( '/{.+?}/', $email ) ) {
		return $email;
	}

	// Email can't be longer than 254 octets,
	// otherwise it can't be used to send an email address (limitation in the MAIL and RCPT commands).
	// 1 octet = 8 bits = 1 byte.
	if ( strlen( $email ) > 254 ) {
		return false;
	}

	$email_arr = explode( '@', $email );

	if ( count( $email_arr ) !== 2 ) {
		return false;
	}

	list( $local, $domain ) = $email_arr;

	/**
	 * RFC requires local part to be no longer than 64 octets.
	 * Punycode library checks for 63 octets.
	 *
	 * @link https://github.com/true/php-punycode/blob/master/src/Punycode.php#L182.
	 */
	if ( strlen( $local ) > 63 ) {
		return false;
	}

	$domain_arr = explode( '.', $domain );

	foreach ( $domain_arr as $domain_label ) {
		$domain_label = trim( $domain_label );

		if ( ! $domain_label ) {
			return false;
		}

		// The RFC says: 'A DNS label may be no more than 63 octets long'.
		if ( strlen( $domain_label ) > 63 ) {
			return false;
		}
	}

	if ( ! $punycode ) {
		$punycode = new Punycode();
	}

	/**
	 * The wp_mail() uses phpMailer, which uses is_email() as verification callback.
	 * For verification, phpMailer sends the email address where the domain part is punycode encoded only.
	 * We follow here the same principle.
	 */
	$email_check = $local . '@' . $punycode->encode( $domain );

	// Other limitations are checked by the native WordPress function is_email().
	return is_email( $email_check ) ? $local . '@' . $domain : false;
}

/**
 * Check whether the string is json-encoded.
 *
 * @since 1.7.5
 *
 * @param string $value A string.
 *
 * @return bool
 */
function wpforms_is_json( $value ): bool {

	return (
		is_string( $value ) &&
		is_array( json_decode( $value, true ) ) &&
		json_last_error() === JSON_ERROR_NONE
	);
}

/**
 * Check whether the current page is in AMP mode or not.
 * We need to check for specific functions, as there is no special AMP header.
 *
 * @since 1.4.1
 *
 * @param bool $check_theme_support Whether theme support should be checked. Defaults to true.
 *
 * @return bool
 */
function wpforms_is_amp( $check_theme_support = true ): bool {

	$is_amp = false;

	// Check for AMP by AMP Project Contributors.
	if ( function_exists( 'amp_is_request' ) && amp_is_request() ) {
		$is_amp = true;
	}

	if ( $is_amp && $check_theme_support ) {
		$is_amp = current_theme_supports( 'amp' );
	}

	/**
	 * Filters AMP flag.
	 *
	 * @since 1.4.1
	 *
	 * @param bool $is_amp Current page AMP status.
	 *
	 * @return bool
	 */
	return (bool) apply_filters( 'wpforms_is_amp', $is_amp );
}

/**
 * Helper function to determine if loading on WPForms related admin page.
 *
 * Here we determine if the current administration page is owned/created by
 * WPForms. This is done in compliance with WordPress best practices for
 * development, so that we only load required WPForms CSS and JS files on pages
 * we create. As a result, we do not load our assets admin wide, where they might
 * conflict with other plugins needlessly, also leading to a better, faster user
 * experience for our users.
 *
 * @since 1.3.9
 *
 * @param string $slug Slug identifier for a specific WPForms admin page.
 * @param string $view Slug identifier for a specific WPForms admin page view ("subpage").
 *
 * @return bool
 */
function wpforms_is_admin_page( $slug = '', $view = '' ): bool {

	// phpcs:disable WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

	// Check against basic requirements.
	if (
		empty( $_REQUEST['page'] ) ||
		strpos( $_REQUEST['page'], 'wpforms' ) === false ||
		! is_admin()
	) {
		return false;
	}

	// Check against page slug identifier.
	if (
		( ! empty( $slug ) && $_REQUEST['page'] !== 'wpforms-' . $slug ) ||
		( empty( $slug ) && $_REQUEST['page'] === 'wpforms-builder' )
	) {
		return false;
	}

	// Check against sub-level page view.
	if (
		! empty( $view ) &&
		( empty( $_REQUEST['view'] ) || $_REQUEST['view'] !== $view )
	) {
		return false;
	}

	// phpcs:enable WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

	return true;
}

/**
 * Check if a string is empty.
 *
 * @since 1.5.0
 *
 * @param string $value String to test.
 *
 * @return bool
 */
function wpforms_is_empty_string( $value ): bool {
	// phpcs:ignore WPForms.Formatting.EmptyLineBeforeReturn.RemoveEmptyLineBeforeReturnStatement
	return $value === '';
}

/**
 * Determine if the request is a rest API call.
 *
 * NOTE: The function shouldn't be used before the `rest_api_init` action.
 *
 * @since 1.8.8
 *
 * @return bool|null True if the request is a REST API call, null if the function is called incorrectly.
 */
function wpforms_is_rest() { // phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh

	// The function is not available, means that `wpforms_is_rest` is called incorrectly.
	// The possible reason is that the function is called too early, before the `rest-api.php` is loaded.
	// In this case, we should not proceed with the check.
	if ( ! function_exists( 'rest_url' ) ) {
		return null;
	}

	// We can replace `wpforms_is_rest` with `wp_is_rest_endpoint` function when the minimum WP version is bumped to 6.5.
	if ( function_exists( 'wp_is_rest_endpoint' ) ) {
		return wp_is_rest_endpoint();
	}

	$rest_url         = wp_parse_url( trailingslashit( rest_url() ) );
	$current_url      = wp_parse_url( trailingslashit( wpforms_current_url() ) );
	$rest_url['path'] = $rest_url['path'] ?? '';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	$is_rest_plain    = $rest_url['path'] === '/index.php' && ! empty( $_GET['rest_route'] );
	$is_rest_postname = strpos( $rest_url['path'], '/wp-json/' ) !== false;

	if ( $is_rest_plain ) {
		$rest_route = sanitize_text_field( wp_unslash( $_GET['rest_route'] ) );

		return strpos( $rest_route, '/wpforms/' ) !== false;
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended

	if ( $is_rest_postname ) {
		return strpos( $current_url['path'] ?? '', '/wpforms/' ) !== false;
	}

	return false;
}

/**
 * Determine if the request is WPForms AJAX.
 *
 * @since 1.8.0
 * @since 1.9.1 Added an optional parameter to check for a specific action.
 *
 * @param string $action Certain AJAX action to check. Optional. Default is empty.
 *
 * @return bool
 */
function wpforms_is_ajax( string $action = '' ): bool {

	if ( ! wp_doing_ajax() ) {
		return false;
	}

	// Make sure the request target is admin-ajax.php.
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	if ( isset( $_SERVER['SCRIPT_FILENAME'] ) && basename( sanitize_text_field( wp_normalize_path( $_SERVER['SCRIPT_FILENAME'] ) ) ) !== 'admin-ajax.php' ) {
		return false;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$request_action    = isset( $_REQUEST['action'] ) ? sanitize_key( $_REQUEST['action'] ) : '';
	$is_wpforms_action = strpos( $request_action, 'wpforms_' ) === 0;

	if ( empty( $action ) ) {
		return $is_wpforms_action;
	}

	return $is_wpforms_action && $action === $request_action;
}

/**
 * Determine if request is frontend AJAX.
 *
 * @since 1.5.8.2
 * @since 1.6.5 Added filterable frontend ajax actions list as a fallback to missing referer cases.
 * @since 1.6.7.1 Removed a requirement for an AJAX action to be a WPForms action if referer is not missing.
 * @since 1.8.0 Added clear separation between frontend and admin AJAX requests, see `wpforms_is_admin_ajax()`.
 *
 * @return bool
 */
function wpforms_is_frontend_ajax(): bool {

	if ( wpforms_is_ajax() && ! wpforms_is_admin_ajax() ) {
		return true;
	}

	// Try detecting a frontend AJAX call indirectly by comparing the current action
	// with a known frontend actions list in case there's no HTTP referer.

	$ref = wp_get_raw_referer();

	if ( $ref ) {
		return false;
	}

	$frontend_actions = [
		'wpforms_submit',
		'wpforms_file_upload_speed_test',
		'wpforms_upload_chunk_init',
		'wpforms_upload_chunk',
		'wpforms_file_chunks_uploaded',
		'wpforms_remove_file',
		'wpforms_restricted_email',
		'wpforms_form_locker_unique_answer',
		'wpforms_form_abandonment',
	];

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$action = isset( $_REQUEST['action'] ) ? sanitize_key( $_REQUEST['action'] ) : '';

	/**
	 * Allow modifying the list of frontend AJAX actions.
	 *
	 * This filter may be running as early as `plugins_loaded` hook.
	 * Please mind the hook order when using it.
	 *
	 * @since 1.6.5
	 *
	 * @param array $frontend_actions A list of frontend actions.
	 */
	$frontend_actions = (array) apply_filters( 'wpforms_is_frontend_ajax_frontend_actions', $frontend_actions );

	return in_array( $action, $frontend_actions, true );
}

/**
 * Determine if request is admin AJAX.
 *
 * @since 1.8.0
 *
 * @return bool
 */
function wpforms_is_admin_ajax(): bool {

	if ( ! wpforms_is_ajax() ) {
		return false;
	}

	$ref = wp_get_raw_referer();

	if ( ! $ref ) {
		return false;
	}

	$path       = wp_parse_url( $ref, PHP_URL_PATH );
	$admin_path = wp_parse_url( admin_url(), PHP_URL_PATH );

	// Is an admin AJAX call if HTTP referer contain an admin path.
	return strpos( $path, $admin_path ) !== false;
}

/**
 * Check if Gutenberg is active.
 *
 * @since 1.6.2
 *
 * @return bool True if Gutenberg is active.
 * @noinspection PhpUndefinedFunctionInspection
 */
function wpforms_is_gutenberg_active(): bool {

	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
		return in_array( get_option( 'classic-editor-replace' ), [ 'no-replace', 'block' ], true );
	}

	if ( is_plugin_active( 'disable-gutenberg/disable-gutenberg.php' ) ) {
		return ! disable_gutenberg();
	}

	return true;
}

/**
 * Determines whether the current request is a WP CLI request.
 *
 * @since 1.7.6
 *
 * @return bool
 */
function wpforms_doing_wp_cli(): bool {

	return defined( 'WP_CLI' ) && WP_CLI;
}

/**
 * Determines whether search functionality is enabled for Choices.js elements in the admin area.
 *
 * @since 1.8.3
 *
 * @param array $data Data to be displayed in the dropdown.
 *
 * @return string
 */
function wpforms_choices_js_is_search_enabled( $data ): string {

	/**
	 * Filter max number of items at which no search box is displayed.
	 *
	 * @since 1.8.3
	 *
	 * @param int $count Max items count.
	 */
	return count( $data ) >= apply_filters( 'wpforms_choices_js_is_search_enabled_max_limit', 20 ) ? 'true' : 'false';
}

/**
 * Check if a form is a template.
 *
 * @since 1.8.8
 *
 * @param int|WP_Post $form Form ID or object.
 *
 * @return bool True if the form is a template.
 */
function wpforms_is_form_template( $form ): bool {

	$template_post_type = 'wpforms-template';

	if ( $form instanceof WP_Post ) {
		return $form->post_type === $template_post_type;
	}

	return $template_post_type === get_post_type( $form );
}

/**
 * Checks if the current screen is using the block editor.
 *
 * @since 1.8.8
 *
 * @return bool True if the current screen is using the block editor, false otherwise.
 */
function wpforms_is_block_editor(): bool {

	$screen = get_current_screen();

	return $screen && method_exists( $screen, 'is_block_editor' ) && $screen->is_block_editor();
}

/**
 * Check for the editor page.
 *
 * @since 1.9.0
 *
 * @return bool True if the page is in the editor, false otherwise.
 */
function wpforms_is_editor_page(): bool {

	// phpcs:disable WordPress.Security.NonceVerification
	$rest_request = defined( 'REST_REQUEST' ) && REST_REQUEST;
	$context      = isset( $_REQUEST['context'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['context'] ) ) : '';
	$post_action  = isset( $_POST['action'] ) ? sanitize_text_field( wp_unslash( $_POST['action'] ) ) : '';
	$get_action   = isset( $_GET['action'] ) ? sanitize_text_field( wp_unslash( $_GET['action'] ) ) : '';

	$is_gutenberg = $rest_request && $context === 'edit';
	$is_elementor = $post_action === 'elementor_ajax' || $get_action === 'elementor';
	$is_divi      = ! empty( $_GET['et_fb'] ) || $post_action === 'wpforms_divi_preview';
	// phpcs:enable WordPress.Security.NonceVerification

	return $is_gutenberg || $is_elementor || $is_divi;
}
