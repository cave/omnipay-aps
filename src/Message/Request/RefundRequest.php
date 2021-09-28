<?php namespace Omnipay\APS\Message\Request;

use Omnipay\APS\Message\Response\RefundResponse;
use Omnipay\Common\Exception\InvalidRequestException;

class RefundRequest extends APSAbstractRequest
{
	const COMMAND = 'REFUND';

	protected $test_endpoint = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';

	protected $live_endpoint = 'https://paymentservices.payfort.com/FortAPI/paymentApi';

	/**
	 * @return mixed
	 *
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
	 * @return RefundResponse
	 * @throws \Omnipay\Common\Exception\InvalidResponseException
	 */
	protected function createResponse(array $data): RefundResponse
	{
		return new RefundResponse($this, $data);
	}
}