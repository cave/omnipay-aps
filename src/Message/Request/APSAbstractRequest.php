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

			echo $data['signature'] = $this->_createSignature($data);

			$httpResponse = $this->httpClient->request(
				'POST',
				$this->getEndpoint(),
				[
					'Content-type' => 'application/json',
				],
				json_encode($data)
			);

			if ($httpResponse->getStatusCode() != 200)
			{
				throw new \Exception($httpResponse->getReasonPhrase(), $httpResponse->getStatusCode());
			}

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
		unset($data['testMode']);
		unset($data['Mode']);

		if (empty($this->getParameter('request_phrase')))
			throw new RequestPhraseException('Request phrase is missing.');

		$shaType = ! empty($this->getParameter('sha_type')) ? $this->hasParameter('sha_type') : self::DEFAULT_SHA_TYPE;

		$shaString = '';
		foreach ($data as $key => $value)
		{
			if (empty($value)) continue;

			$shaString .= "$key=$value";
		}

		// "Glue" phrase to the both sides of the payload
		$shaString = $this->getParameter('request_phrase') . $shaString . $this->getParameter('request_phrase');

		return hash_hmac($shaType, $shaString, $this->getParameter('request_phrase'));
	}

	/**
	 * @param string $requestPhrase
	 *
	 * @return mixed
	 */
	public function setRequestPhrase(string $requestPhrase)
	{
		return $this->setParameter('request_phrase', $requestPhrase);
	}

	/**
	 * @param string $shaType
	 *
	 * @return mixed
	 */
	public function setShaType(string $shaType)
	{
		return $this->setParameter('sha_type', $shaType);
	}

	public function setAccessCode($code)
	{
		return $this->setParameter('access_code', $code);
	}

	public function setMerchantIdentifier($merchant_id)
	{
		return $this->setParameter('merchant_identifier', $merchant_id);
	}

	public function setMerchantReference($reference)
	{
		return $this->setParameter('merchant_reference', $reference);
	}

	public function setAmount($amount)
	{
		return $this->setParameter('amount', $amount);
	}

	public function setCurrency($currency = 'AED')
	{
		return $this->setParameter('currency', $currency);
	}

	public function setLanguage($language = 'en')
	{
		return $this->setParameter('language', $language);
	}

	public function setCustomerEmail($email)
	{
		return $this->setParameter('customer_email', $email);
	}

	public function setOrderDescription($description)
	{
		return $this->setParameter('order_description', $description);
	}

	public function setFortId($fort_id)
	{
		return $this->setParameter('fort_id', $fort_id);
	}

	protected function _is_json_response($string) {
		json_decode($string);
		return json_last_error() === JSON_ERROR_NONE;
	}
}