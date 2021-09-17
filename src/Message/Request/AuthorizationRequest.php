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
			'command' => self::COMMAND,
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
