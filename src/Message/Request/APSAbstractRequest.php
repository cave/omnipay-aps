<?php namespace Omnipay\APS\Message\Request;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

abstract class APSAbstractRequest extends AbstractRequest
{
	const DEFAULT_SHA_TYPE = 'sha256';

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
			// Sort array by key ascending
			ksort($data);

			$data['signature'] = $this->_createSignature($data);

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

	/**
	 * Creates signature used by Amazon for authorisation
	 * @param array $data
	 *
	 * @return string
	 * @throws RequestPhraseException
	 */
	private function _createSignature(array $data): string
	{
		$shaType = $this->hasParameter('sha_type') ? $this->hasParameter('sha_type') : self::DEFAULT_SHA_TYPE;

		if ( ! $this->hasParameter('request_phrase'))
			throw new RequestPhraseException('Request phrase is missing.');

		foreach ($data as $key => $value)
		{
			$shaString .= "$key=$value";
		}

		// "Glue" phrase to the both sides of the payload
		$shaString = $this->getParameter('request_phrase') . $shaString . $this->getParameter('request_phrase');

		return hash($shaType, $shaString);
	}
}