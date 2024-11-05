<?php

namespace WPForms\Integrations\AI\Admin\Builder;

/**
 * Enqueue assets on the Form Builder screen.
 *
 * @since 1.9.1
 */
class Enqueues {

	/**
	 * Initialize.
	 *
	 * @since 1.9.1
	 */
	public function init() {

		$this->hooks();
	}

	/**
	 * Register hooks.
	 *
	 * @since 1.9.1
	 */
	private function hooks() {

		add_action( 'wpforms_builder_enqueues', [ $this, 'enqueues' ] );
	}

	/**
	 * Enqueue styles and scripts.
	 *
	 * @since 1.9.1
	 *
	 * @param string|null $view Current view (panel).
	 */
	public function enqueues( $view ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found

		$this->enqueue_styles();
		$this->enqueue_scripts();
	}

	/**
	 * Enqueue styles.
	 *
	 * @since 1.9.1
	 */
	private function enqueue_styles() {

		$min = wpforms_get_min_suffix();

		wp_enqueue_style(
			'wpforms-ai-modal',
			WPFORMS_PLUGIN_URL . "assets/css/integrations/ai/modal{$min}.css",
			[],
			WPFORMS_VERSION
		);

		wp_enqueue_style(
			'wpforms-ai-chat-element',
			WPFORMS_PLUGIN_URL . "assets/css/integrations/ai/chat-element{$min}.css",
			[],
			WPFORMS_VERSION
		);
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 1.9.1
	 */
	private function enqueue_scripts() {

		$min = wpforms_get_min_suffix();

		wp_enqueue_script(
			'wpforms-ai-modal',
			WPFORMS_PLUGIN_URL . "assets/js/integrations/ai/wpforms-ai-modal{$min}.js",
			[],
			WPFORMS_VERSION,
			false
		);

		wp_enqueue_script(
			'wpforms-ai-chat-element',
			WPFORMS_PLUGIN_URL . "assets/js/integrations/ai/wpforms-ai-chat-element{$min}.js",
			[],
			WPFORMS_VERSION,
			false
		);

		wp_localize_script(
			'wpforms-ai-chat-element',
			'wpforms_ai_chat_element',
			$this->get_localize_data()
		);
	}

	/**
	 * Get choices data.
	 *
	 * @since 1.9.1
	 *
	 * @return array
	 */
	private function get_localize_data(): array {

		return [
			'ajaxurl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'wpforms-ai-nonce' ),
			'min'       => wpforms_get_min_suffix(),
			'dislike'   => esc_html__( 'Bad response', 'wpforms-lite' ),
			'refresh'   => esc_html__( 'Clear chat history', 'wpforms-lite' ),
			'btnYes'    => esc_html__( 'Yes, Continue', 'wpforms-lite' ),
			'btnCancel' => esc_html__( 'Cancel', 'wpforms-lite' ),
			'confirm'   => [
				'refreshTitle'   => esc_html__( 'Clear Chat History', 'wpforms-lite' ),
				'refreshMessage' => esc_html__( 'Are you sure you want to clear the AI chat history and start over?', 'wpforms-lite' ),
			],
			'errors'    => [
				'default' => esc_html__( 'An error occurred.', 'wpforms-lite' ),
				'network' => esc_html__( 'There appears to be a network error.', 'wpforms-lite' ),
				'empty'   => esc_html__( 'I\'m not sure what to do with that.', 'wpforms-lite' ),
			],
			'reasons'   => [
				'default' => esc_html__( 'Please try again.', 'wpforms-lite' ),
				'empty'   => esc_html__( 'Please try a different prompt. You might need to be more descriptive.', 'wpforms-lite' ),
			],
			'choices'   => $this->get_choices_data(),
		];
	}

	/**
	 * Get choices data.
	 *
	 * @since 1.9.1
	 *
	 * @return array
	 */
	private function get_choices_data(): array {

		return [
			'title'         => esc_html__( 'Generate Choices', 'wpforms-lite' ),
			'description'   => esc_html__( 'Describe the choices you would like to create or use one of the examples below to get started.', 'wpforms-lite' ),
			'footer'        => wp_kses(
				__( '<strong>What do you think of these choices?</strong> If you’re happy with them, you can insert these choices, or make changes by entering additional prompts.', 'wpforms-lite' ), // phpcs:ignore WordPress.WP.I18n.NoHtmlWrappedStrings
				[
					'strong' => [],
				]
			),
			'learnMore'     => esc_html__( 'Learn more about WPForms AI', 'wpforms-lite' ),
			'warning'       => esc_html__( 'It looks like you have some existing choices in this field. If you generate new choices, your existing choices will be overwritten. You can simply close this window if you’d like to keep your existing choices.', 'wpforms-lite' ),
			'placeholder'   => esc_html__( 'What would you like to create?', 'wpforms-lite' ),
			'waiting'       => esc_html__( 'Just a minute...', 'wpforms-lite' ),
			'insert'        => esc_html__( 'Insert Choices', 'wpforms-lite' ),
			'learnMoreUrl'  => wpforms_utm_link( 'https://wpforms.com/features/wpforms-ai/', 'Builder - Settings', 'Learn more - AI Choices modal' ),
			'errors'        => [
				'default'    => esc_html__( 'An error occurred while generating choices.', 'wpforms-lite' ),
				'rate_limit' => esc_html__( 'Sorry, you\'ve reached your daily limit for generating choices.', 'wpforms-lite' ),
			],
			'reasons'       => [
				'rate_limit' => sprintf(
					wp_kses( /* translators: %s - WPForms contact support link. */
						__( 'You may only generate choices 50 times per day. If you believe this is an error, <a href="%s" target="_blank" rel="noopener noreferrer">please contact WPForms support</a>.', 'wpforms-lite' ),
						[
							'a' => [
								'href'   => [],
								'target' => [],
								'rel'    => [],
							],
						]
					),
					wpforms_utm_link( 'https://wpforms.com/account/support/', 'AI Feature' )
				),
			],
			'samplePrompts' => [
				[
					'icon'  => 'wpforms-ai-chat-flag',
					'title' => esc_html__( 'american public holidays with dates in brackets', 'wpforms-lite' ),
				],
				[
					'icon'  => 'wpforms-ai-chat-clover',
					'title' => esc_html__( 'provinces of canada ordered by population', 'wpforms-lite' ),
				],
				[
					'icon'  => 'wpforms-ai-chat-thumbs-up',
					'title' => esc_html__( 'top 5 social networks in europe', 'wpforms-lite' ),
				],
				[
					'icon'  => 'wpforms-ai-chat-globe',
					'title' => esc_html__( 'top 10 most spoken languages in the world', 'wpforms-lite' ),
				],
				[
					'icon'  => 'wpforms-ai-chat-palm',
					'title' => esc_html__( 'top 20 most popular tropical travel destinations', 'wpforms-lite' ),
				],
				[
					'icon'  => 'wpforms-ai-chat-shop',
					'title' => esc_html__( '30 household item categories for a marketplace', 'wpforms-lite' ),
				],
			],
			'defaults'      => [
				'1' => esc_html__( 'First Choice', 'wpforms-lite' ),
				'2' => esc_html__( 'Second Choice', 'wpforms-lite' ),
				'3' => esc_html__( 'Third Choice', 'wpforms-lite' ),
			],
		];
	}
}
