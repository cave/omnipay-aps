<?php namespace Omnipay\APS\Message\Response;

class PurchaseResponse extends AbstractResponse
{
	/**
	 * Refer to {@APSAbstractCheckoutResponse::$status_codes}
	 */
	const STATUS_SUCCESS = '14';

	/**
	 * @return bool
	 */
	public function isSuccessful(): bool
	{
		return $this->response['status'] == self::STATUS_SUCCESS;
	}
}