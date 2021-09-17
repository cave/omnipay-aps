<?php namespace Omnipay\APS;

/**
 * Amazon Payment Service
 */
use Omnipay\APS\Message\Request\AuthorizationRequest;
use Omnipay\APS\Message\Request\CaptureRequest;
use Omnipay\APS\Message\Request\PurchaseRequest;
use Omnipay\APS\Message\Request\RefundRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return 'Amazon Payment Service';
	}

	/**
	 * @return string
	 */
	public function getShortName(): string
	{
		return 'APS';
	}

	/**
	 * @return array
	 */
	public function getDefaultParameters(): array
	{
		return [
			'testMode' => FALSE,
		];
	}

	/**
	 * @param array $options
	 *
	 * @return AbstractRequest|RequestInterface
	 */
	public function authorize(array $options = [])
	{
		return $this->createRequest(AuthorizationRequest::class, $options);
	}

	/**
	 * @param array $options
	 *
	 * @return AbstractRequest|RequestInterface
	 */
	public function purchase(array $options = [])
	{
		return $this->createRequest(PurchaseRequest::class, $options);
	}

	/**
	 * @param array $options
	 *
	 * @return AbstractRequest|RequestInterface
	 */
	public function capture(array $options = [])
	{
		return $this->createRequest(CaptureRequest::class, $options);
	}

	/**
	 * @param array $options
	 *
	 * @return AbstractRequest|RequestInterface
	 */
	public function refund(array $options = [])
	{
		return $this->createRequest(RefundRequest::class, $options);
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
}

