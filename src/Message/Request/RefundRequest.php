<?php namespace Omnipay\APS\Message\Request;

use Omnipay\APS\Message\Response\RefundResponse;
use Omnipay\Common\Exception\InvalidRequestException;

class RefundRequest extends APSAbstractRequest
{
	const COMMAND = 'REFUND';

	private $test_endpoint = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';

	private $live_endpoint = 'https://paymentservices.payfort.com/FortAPI/paymentApi';

	/**
	 * @return mixed
	 *
	 * @throws InvalidRequestException
	 */
	public function getData(): array
	{
		$this->validate('access_code', 'merchant_identifier', 'merchant_reference', 'amount', 'currency', 'language', 'signature');

		return [
			'command' => self::COMMAND,
		];
	}

	/**
	 * @param array $data
	 *
	 * @return RefundResponse
	 * @throws \Omnipay\Common\Exception\InvalidResponseException
	 */
	protected function createResponse(array $data): RefundResponse
	{
		return new RefundResponse($this, $data);
	}
}