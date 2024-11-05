<?php

namespace WPForms\SmartTags\SmartTag;

/**
 * Class PageTitle.
 *
 * @since 1.6.7
 */
class PageTitle extends SmartTag {

	/**
	 * Get smart tag value.
	 *
	 * @since 1.6.7
	 *
	 * @param array  $form_data Form data.
	 * @param array  $fields    List of fields.
	 * @param string $entry_id  Entry ID.
	 *
	 * @return string
	 */
	public function get_value( $form_data, $fields = [], $entry_id = '' ) {

		$page_title = $this->get_meta( $entry_id, 'page_title' );

		if ( ! empty( $page_title ) ) {
			return wp_kses_post( $page_title );
		}

		// phpcs:disable WordPress.Security.NonceVerification.Missing
		if ( ! empty( $_POST['page_title'] ) && ! is_array( $_POST['page_title'] ) ) {
			return wp_kses_post( wp_unslash( $_POST['page_title'] ) );
		}
		// phpcs:enable WordPress.Security.NonceVerification.Missing

		if ( is_front_page() ) {
			return wp_kses_post( is_page() ? get_the_title( get_the_ID() ) : get_bloginfo( 'name' ) );
		}

		$title = $this->get_gutenberg_page_title();

		if ( $title ) {
			return wp_kses_post( $title );
		}

		return wp_kses_post( $this->get_wp_title() );
	}

	/**
	 * Retrieve a page title based on `wp_title()`.
	 *
	 * @since 1.7.9
	 *
	 * @return string
	 */
	private function get_wp_title() {

		global $wp_filter;

		// Back up all callbacks.
		$callbacks = isset( $wp_filter['wp_title']->callbacks ) ? $wp_filter['wp_title']->callbacks : [];

		if ( ! empty( $callbacks ) ) {
			// Unset all callbacks.
			$wp_filter['wp_title']->callbacks = [];
		}

		/*
		 * In most cases `wp_title()` returns the value we're going to use, except:
		 * - on static front page (we can use page title as a fallback),
		 * - on standard front page with the latest post (we can use the site name as a fallback).
		 */
		$title = trim( wp_title( '', false ) );

		// Run through the default transformations WordPress does on this hook.
		$title = wptexturize( $title );
		$title = convert_chars( $title );
		$title = esc_html( $title );
		$title = capital_P_dangit( $title );

		if ( ! empty( $callbacks ) ) {
			// Restore all callbacks.
			$wp_filter['wp_title']->callbacks = $callbacks;
		}

		return $title;
	}

	/**
	 * Retrieve title in Gutenberg editor.
	 *
	 * @since 1.9.0
	 *
	 * @return string
	 */
	private function get_gutenberg_page_title(): string {

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return wp_kses_post( sanitize_text_field( wp_unslash( $_GET['attributes']['pageTitle'] ?? '' ) ) );
	}
}
