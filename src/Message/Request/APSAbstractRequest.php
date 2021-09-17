<?php namespace Omnipay\APS\Message\Request;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

abstract class APSAbstractRequest extends AbstractRequest
{
	/**
	 * @param mixed $data
	 *
	 * @return ResponseInterface
	 * @throws InvalidResponseException
	 */
	public function sendData($data): ResponseInterface
	{
		try
		{
			$httpResponse = $this->httpClient->request(
				'POST',
				$this->getEndpoint(),
				[
					'Accept' => 'application/json',
					'Content-type' => 'application/json',
				],
				json_encode($data)
			);

			$json = $httpResponse->getBody()->getContents();

			$data = !empty($json) ? json_decode($json, true) : [];

			return $this->response = $this->createResponse($data);

		}
		catch (\Exception $e)
		{
			throw new InvalidResponseException(
				"Communication failed with message: " . $e->getMessage(),
				$e->getCode()
			);
		}
	}

	/**
	 * @return string
	 */
	protected function getEndpoint(): string
	{
		return $this->getTestMode() ? $this->test_endpoint : $this->live_endpoint;
	}
}