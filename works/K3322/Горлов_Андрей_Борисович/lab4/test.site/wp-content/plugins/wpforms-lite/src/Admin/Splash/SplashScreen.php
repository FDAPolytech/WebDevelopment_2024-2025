<?php

namespace WPForms\Admin\Splash;

/**
 * What's New class.
 *
 * @since 1.8.7
 */
class SplashScreen {

	use SplashTrait;

	/**
	 * Splash data.
	 *
	 * @since 1.8.7
	 *
	 * @var array
	 */
	private $splash_data = [];

	/**
	 * Whether it is a new WPForms installation.
	 *
	 * @since 1.8.8
	 *
	 * @var bool
	 */
	private $is_new_install;

	/**
	 * Initialize class.
	 *
	 * @since 1.8.7
	 */
	public function init() {

		$this->hooks();
	}

	/**
	 * Hooks.
	 *
	 * @since 1.8.7
	 */
	private function hooks() {

		add_action( 'admin_init', [ $this, 'initialize_splash_data' ], 15 );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		add_action( 'admin_footer', [ $this, 'admin_footer' ] );
		add_filter( 'wpforms_pro_admin_dashboard_widget_welcome_block_html_message', [ $this, 'add_splash_link' ] );
		add_filter( 'wpforms_lite_admin_dashboard_widget_welcome_block_html_message', [ $this, 'add_splash_link' ] );
		add_filter( 'update_footer', [ $this, 'add_splash_link' ], PHP_INT_MAX );
		add_filter( 'removable_query_args', [ $this, 'removable_query_args' ] );
	}

	/**
	 * Initialize splash data.
	 *
	 * @since 1.8.7
	 */
	public function initialize_splash_data() {

		if ( ! $this->is_allow_splash() ) {
			return;
		}

		if ( empty( $this->splash_data ) ) {
			$cached_data_obj = wpforms()->obj( 'splash_cache' );
			$cached_data     = $cached_data_obj ? $cached_data_obj->get() : null;

			if ( empty( $cached_data ) ) {
				return;
			}

			$default_data = $this->get_default_data();

			$this->splash_data = wp_parse_args( $cached_data, $default_data );

			$version = $this->get_major_version( WPFORMS_VERSION );

			$this->update_splash_data_version( $version );
		}
	}

	/**
	 * Enqueue assets.
	 *
	 * @since 1.8.7
	 */
	public function admin_enqueue_scripts() {

		$min = wpforms_get_min_suffix();

		// jQuery confirm.
		wp_register_script(
			'jquery-confirm',
			WPFORMS_PLUGIN_URL . 'assets/lib/jquery.confirm/jquery-confirm.min.js',
			[ 'jquery' ],
			'1.0.0',
			true
		);

		wp_register_style(
			'jquery-confirm',
			WPFORMS_PLUGIN_URL . 'assets/lib/jquery.confirm/jquery-confirm.min.css',
			[],
			'1.0.0'
		);

		wp_register_script(
			'wpforms-splash-modal',
			WPFORMS_PLUGIN_URL . "assets/js/admin/splash/modal{$min}.js",
			[ 'jquery' ],
			WPFORMS_VERSION,
			true
		);

		wp_register_style(
			'wpforms-splash-modal',
			WPFORMS_PLUGIN_URL . "assets/css/admin/admin-splash-modal{$min}.css",
			[],
			WPFORMS_VERSION
		);

		wp_localize_script(
			'wpforms-splash-modal',
			'wpforms_splash_data',
			[
				'nonce'            => wp_create_nonce( 'wpforms_dash_widget_nonce' ),
				'triggerForceOpen' => $this->should_open_splash(),
			]
		);
	}

	/**
	 * Output splash modal.
	 *
	 * @since 1.8.7
	 */
	public function admin_footer() {

		if ( $this->is_splash_empty() || ! $this->is_allow_splash() ) {
			return;
		}

		$this->render_modal();
	}

	/**
	 * Check if splash data is empty.
	 *
	 * @since 1.8.7
	 * @since 1.8.8 Changed method visibility from private to public.
	 *
	 * @return bool True if empty, false otherwise.
	 */
	public function is_splash_empty(): bool {

		if ( empty( $this->splash_data ) ) {
			return true;
		}

		return empty( $this->retrieve_blocks_for_user( $this->splash_data['blocks'] ?? [] ) );
	}

	/**
	 * Retrieve blocks for user.
	 *
	 * @since 1.8.7
	 *
	 * @param array $blocks Splash modal blocks.
	 */
	private function retrieve_blocks_for_user( array $blocks ): array {

		$user_license = $this->get_user_license();

		if ( ! $user_license ) {
			$user_license = 'lite';
		}

		return array_filter(
			$blocks,
			static function ( $block ) use ( $user_license ) { //phpcs:ignore WPForms.PHP.UseStatement.UnusedUseStatement

				return in_array( $user_license, $block['type'] ?? [], true );
			}
		);
	}

	/**
	 * Render splash modal.
	 *
	 * @since 1.8.7
	 *
	 * @param array $data Splash modal data.
	 */
	public function render_modal( array $data = [] ) {

		wp_enqueue_script( 'jquery-confirm' );
		wp_enqueue_style( 'jquery-confirm' );

		wp_enqueue_script( 'wpforms-splash-modal' );
		wp_enqueue_style( 'wpforms-splash-modal' );

		if ( $this->should_open_splash() ) {
			$this->update_splash_version();
		}

		if ( empty( $data ) ) {
			$data = $this->splash_data ?? [];

			$data['blocks'] = $this->retrieve_blocks_for_user( $data['blocks'] ?? [] );
		}

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo wpforms_render( 'admin/splash/modal', $data, true );
	}

	/**
	 * Add a splash link to footer.
	 *
	 * @since 1.8.7
	 *
	 * @param string|mixed $content Footer content.
	 *
	 * @return string Footer content.
	 */
	public function add_splash_link( $content ): string {

		$content = (string) $content;

		if ( ! $this->is_available_for_display() ) {
			return $content;
		}

		// Allow only on WPForms pages and the Dashboard.
		if ( ! $this->is_allow_splash() || $this->is_new_install() ) {
			return $content;
		}

		// Do not output the link in the footer on the dashboard.
		if ( $this->is_dashboard() && current_filter() === 'update_footer' ) {
			return $content;
		}

		$content .= sprintf(
			' <span>-</span> <a href="#" class="wpforms-splash-modal-open">%s</a>',
			__( 'See the new features!', 'wpforms-lite' )
		);

		return $content;
	}

	/**
	 * Check if splash modal can be displayed manually, via a link.
	 * Used in footer and in form builder context menu.
	 *
	 * @since 1.8.8
	 *
	 * @return bool
	 */
	public function is_available_for_display(): bool {

		// Return if splash data is empty.
		if ( $this->is_splash_empty() ) {
			return false;
		}

		// Return if a splash data version is different from the current plugin major version.
		if ( $this->get_splash_data_version() !== $this->get_major_version( WPFORMS_VERSION ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Check if splash modal is allowed.
	 * Only allow in Form Builder, WPForms pages, and the Dashboard.
	 * And only if it's not a new installation.
	 *
	 * @since 1.8.7
	 *
	 * @return bool True if allowed, false otherwise.
	 */
	public function is_allow_splash(): bool {

		if ( ! $this->is_force_open() && ( $this->is_new_install() || $this->is_minor_update() ) ) {
			return false;
		}

		// Only show on WPForms pages OR dashboard.
		return wpforms_is_admin_page( 'builder' ) || wpforms_is_admin_page() || $this->is_dashboard();
	}

	/**
	 * Check if the current page is the dashboard.
	 *
	 * @since 1.8.8
	 *
	 * @return bool True if it is the dashboard, false otherwise.
	 */
	private function is_dashboard(): bool {

		global $pagenow;

		return $pagenow === 'index.php';
	}

	/**
	 * Check if splash modal should be forced open.
	 *
	 * @since 1.8.8
	 *
	 * @return bool True if it should be forced open, false otherwise.
	 */
	private function is_force_open(): bool {

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return sanitize_key( $_GET['wpforms_action'] ?? '' ) === 'preview-splash-screen';
	}

	/**
	 * Check if splash modal should be opened.
	 *
	 * @since 1.8.7
	 *
	 * @return bool True if splash should open, false otherwise.
	 */
	private function should_open_splash(): bool {

		// Skip if announcements are hidden, or it is the dashboard page.
		if ( $this->is_dashboard() || $this->hide_splash_modal() ) {
			return false;
		}

		// Allow if a splash version different from the current plugin major version, and it's not a new installation.
		$should_open_splash = $this->get_latest_splash_version() !== $this->get_major_version( WPFORMS_VERSION ) &&
			( ! $this->is_new_install() || $this->is_force_open() );

		if ( ! $should_open_splash ) {
			return false;
		}

		// Skip if user on the builder page and the Challenge can be started.
		if ( wpforms_is_admin_page( 'builder' ) ) {
			return $this->is_allow_builder_splash();
		}

		return true;
	}

	/**
	 * Check if splash modal should be allowed on the builder page.
	 * If the Challenge can be started, the splash modal should not be displayed.
	 *
	 * @since 1.9.0
	 *
	 * @return bool True if allowed, false otherwise.
	 */
	private function is_allow_builder_splash(): bool {

		$challenge = wpforms()->obj( 'challenge' );

		return ! ( $challenge->challenge_force_start() || $challenge->challenge_can_start() );
	}

	/**
	 * Check if the plugin is newly installed.
	 *
	 * Get all migrations that have run.
	 * If the only migration with a timestamp is the current version, it's a new installation.
	 *
	 * @since 1.8.8
	 *
	 * @return bool True if new install, false otherwise.
	 */
	private function is_new_install(): bool {

		if ( isset( $this->is_new_install ) ) {
			return $this->is_new_install;
		}

		$option_name = wpforms()->is_pro() ? 'wpforms_versions' : 'wpforms_versions_lite';

		$migrations_run = get_option( $option_name, [] );

		if ( empty( $migrations_run ) ) {
			return true;
		}

		unset( $migrations_run[ WPFORMS_VERSION ] );

		$this->is_new_install = empty( end( $migrations_run ) );

		return $this->is_new_install;
	}

	/**
	 * Determine if the current update is a minor update.
	 *
	 * This method checks the version history of migrations run and compares
	 * the last recorded version with the current version to determine if
	 * the update is minor or major.
	 *
	 * @since 1.9.0
	 *
	 * @return bool True if it's a minor update, false otherwise.
	 */
	private function is_minor_update(): bool {

		return $this->get_major_version( $this->get_previous_plugin_version() ) === $this->get_major_version( WPFORMS_VERSION );
	}

	/**
	 * Check if splash modal should be hidden.
	 *
	 * @since 1.8.8
	 *
	 * @return bool True if hidden, false otherwise.
	 */
	private function hide_splash_modal(): bool {

		/**
		 * Force to hide splash modal.
		 *
		 * @since 1.8.8
		 *
		 * @param bool $hide_splash_modal True to hide, false otherwise.
		 */
		return (bool) apply_filters( 'wpforms_admin_splash_screen_hide_splash_modal', wpforms_setting( 'hide-announcements' ) );
	}

	/**
	 * Remove certain arguments from a query string that WordPress should always hide for users.
	 *
	 * @since 1.8.8
	 *
	 * @param array $removable_query_args An array of parameters to remove from the URL.
	 *
	 * @return array Extended/filtered array of parameters to remove from the URL.
	 */
	public function removable_query_args( $removable_query_args ) {

		$removable_query_args[] = 'wpforms_action';

		return $removable_query_args;
	}
}
