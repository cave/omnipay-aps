<?php namespace Omnipay\APS\Message\Request;

use Omnipay\APS\Message\Response\CaptureResponse;
use Omnipay\Common\Exception\InvalidRequestException;

class CaptureRequest extends APSAbstractRequest
{
	const COMMAND = 'CAPTURE';

	protected $test_endpoint = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';

	protected $live_endpoint = 'https://paymentservices.payfort.com/FortAPI/paymentApi';

	/**
	 * @return mixed
	 * @throws InvalidRequestException
	 */
	public function getData(): array
	{
		$this->validate('access_code', 'merchant_identifier', 'merchant_reference', 'amount', 'currency', 'language');

		return [
			'command'             => self::COMMAND,
			'testMode'            => $this->getParameter('testMode'),
			'access_code'         => $this->getParameter('access_code'),
			'merchant_identifier' => $this->getParameter('merchant_identifier'),
			'merchant_reference'  => $this->getParameter('merchant_reference'),
			'amount'              => $this->getParameter('amount'),
			'currency'            => $this->getParameter('currency'),
			'language'            => $this->getParameter('language'),
			'order_description'   => $this->getParameter('order_description'),
			'fort_id'             => $this->getParameter('fort_id'),
		];
	}

	/**
	 * @param array $data
	 *
	 * @return CaptureResponse
	 * @throws \Omnipay\Common\Exception\InvalidResponseException
	 */
	protected function createResponse(array $data): CaptureResponse
	{
		return new CaptureResponse($this, $data);
	}
}