<?php namespace Omnipay\APS\Message\Response;

class AuthorizationResponse extends AbstractResponse
{
	/**
	 * Refer to {@APSAbstractCheckoutResponse::$status_codes}
	 */
	const STATUS_SUCCESS = '02';

	/**
	 * @return bool
	 */
	public function isSuccessful(): bool
	{
		return $this->response['status'] == self::STATUS_SUCCESS;
	}
}