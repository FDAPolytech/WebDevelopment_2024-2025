<?php

namespace WPForms\Integrations\AI;

use WPForms\Integrations\IntegrationInterface;
use WPForms\Integrations\AI\Admin\Builder\Enqueues;
use WPForms\Integrations\AI\Admin\Builder\FieldOption;
use WPForms\Integrations\AI\Admin\Ajax\Choices;

/**
 * Integration of the AI features.
 *
 * @since 1.9.1
 */
final class AI implements IntegrationInterface {

	/**
	 * Determine whether the integration is allowed to load.
	 *
	 * @since 1.9.1
	 *
	 * @return bool
	 */
	public function allow_load(): bool {

		// Always load the Settings class in order to register the toggle.
		if ( wpforms_is_admin_page( 'settings', 'misc' ) ) {
			( new Admin\Settings() )->init();
		}

		return ! Helpers::is_disabled();
	}

	/**
	 * Load the integration classes.
	 *
	 * @since 1.9.1
	 */
	public function load() {

		if ( wpforms_is_admin_page( 'builder' ) ) {
			( new Enqueues() )->init();
			( new FieldOption() )->init();
		}

		$this->load_ajax_classes();
	}

	/**
	 * Load AJAX classes.
	 *
	 * @since 1.9.1
	 */
	private function load_ajax_classes() {

		if ( ! wpforms_is_admin_ajax() ) {
			return;
		}

		( new FieldOption() )->init();
		( new Choices() )->init();
	}
}
