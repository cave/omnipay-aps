<?php namespace Omnipay\APS\Message\Request;

use Omnipay\APS\Message\Response\PurchaseResponse;

class PurchaseRequest extends AbstractCheckoutRequest
{
	const COMMAND = 'PURCHASE';

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
	 * @return PurchaseResponse
	 * @throws \Omnipay\Common\Exception\InvalidResponseException
	 */
	protected function createResponse(array $data): PurchaseResponse
	{
		return new PurchaseResponse($this, $data);
	}
}
