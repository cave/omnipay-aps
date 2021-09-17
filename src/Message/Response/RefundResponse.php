<?php namespace Omnipay\APS\Message\Response;

class RefundResponse extends AbstractResponse
{
	/**
	 * Refer to {@APSAbstractCheckoutResponse::$status_codes}
	 */
	const STATUS_SUCCESS = '06';

	/**
	 * @return bool
	 */
	public function isSuccessful(): bool
	{
		return $this->response['status'] == self::STATUS_SUCCESS;
	}
}