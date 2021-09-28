<?php namespace Omnipay\APS\Message\Request;

use Omnipay\APS\Message\Response\AuthorizationResponse;

class AuthorizationRequest extends AbstractCheckoutRequest
{
	const COMMAND = 'AUTHORIZATION';

	/**
	 * @return array
	 */
	public function getData(): array
	{
		$this->validateData();

		return [
<<<<<<< HEAD
			'command'             => self::COMMAND,
			'testMode'            => $this->getParameter('testMode'),
			'access_code'         => $this->getParameter('access_code'),
			'merchant_identifier' => $this->getParameter('merchant_identifier'),
			'merchant_reference'  => $this->getParameter('merchant_reference'),
			'amount'              => $this->getParameter('amount'),
			'currency'            => $this->getParameter('currency'),
			'language'            => $this->getParameter('language'),
			'customer_email'      => $this->getParameter('customer_email'),
			'order_description'   => $this->getParameter('order_description'),
=======
			'command' => self::COMMAND,
>>>>>>> 24428a5b7399bc46a68f08187fb62fe42a45d455
		];
	}

	/**
	 * @param array $data
	 *
	 * @return AuthorizationResponse
	 * @throws \Omnipay\Common\Exception\InvalidResponseException
	 */
	protected function createResponse(array $data): AuthorizationResponse
	{
		return new AuthorizationResponse($this, $data);
	}
}
