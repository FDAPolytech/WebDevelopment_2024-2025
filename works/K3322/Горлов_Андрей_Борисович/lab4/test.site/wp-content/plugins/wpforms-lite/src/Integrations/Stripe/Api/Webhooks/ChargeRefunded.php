<?php

namespace WPForms\Integrations\Stripe\Api\Webhooks;

use RuntimeException;
use WPForms\Integrations\Stripe\Helpers;
use WPForms\Db\Payments\UpdateHelpers;
use WPForms\Integrations\Stripe\Api\PaymentIntents;

/**
 * Webhook charge.refunded class.
 *
 * @since 1.8.4
 */
class ChargeRefunded extends Base {

	/**
	 * Decimals amount.
	 *
	 * @since 1.8.4
	 *
	 * @var int
	 */
	private $decimals_amount;

	/**
	 * Handle the Webhook's data.
	 *
	 * Save refunded amount in the payment meta with key refunded_amount.
	 * Update payment status to 'partrefund' or 'refunded' if refunded amount is equal to total amount.
	 *
	 * @since 1.8.4
	 *
	 * @throws RuntimeException If payment not found or not updated.
	 *
	 * @return bool
	 */
	public function handle() {

		$this->set_payment();

		if ( ! $this->db_payment ) {
			return false;
		}

		$currency              = strtoupper( $this->data->currency );
		$this->decimals_amount = Helpers::get_decimals_amount( $currency );

		$charge = ( new PaymentIntents() )->get_charge( $this->data->id );

		if ( isset( $charge->refunds->data[0]->metadata->refunded_by ) && $charge->refunds->data[0]->metadata->refunded_by === 'wpforms_dashboard' ) {
			return false;
		}

		if ( ! $this->is_previous_statuses_matched() ) {
			return false;
		}

		// We need to format amount since it doesn't contain decimals, e.g. 525 instead of 5.25.
		$refunded_amount       = $this->data->amount_refunded / $this->decimals_amount;
		$last_refund_formatted = wpforms_format_amount( $this->get_last_refund_amount() / $this->decimals_amount, true, $currency );
		$log                   = sprintf( 'Stripe payment refunded from the Stripe dashboard. Refunded amount: %1$s.', $last_refund_formatted );

		if ( ! UpdateHelpers::refund_payment( $this->db_payment, $refunded_amount, $log ) ) {
			throw new RuntimeException( 'Payment not updated' );
		}

		return true;
	}

	/**
	 * Get last refund amount.
	 *
	 * @since 1.8.4
	 *
	 * @return int Last refund amount in cents.
	 */
	private function get_last_refund_amount() {

		if ( isset( $this->data->refunds->data[0]->amount ) ) {
			return $this->data->refunds->data[0]->amount;
		}

		if ( isset( $this->data->previous_attributes->amount_refunded ) ) {
			return $this->data->amount_refunded - $this->data->previous_attributes->amount_refunded;
		}

		// get the last refunded from DB.
		$previous_refund_in_db = wpforms()->obj( 'payment_meta' )->get_last_by(
			'refunded_amount',
			$this->db_payment->id
		);
		$previous_refund       = $previous_refund_in_db ? $previous_refund_in_db->meta_value : 0;

		return $this->data->amount_refunded - ( $previous_refund * $this->decimals_amount );
	}
}
