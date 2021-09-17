<?php

namespace Omnipay\APS\Tests;

use Omnipay\APS\Message\Response\AuthorizationResponse;
use Omnipay\Stripe\Message\AuthorizeRequest;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\APS\Message\Response\PurchaseResponse;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * @var array
     */
    protected $options;

    protected function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setTestMode(TRUE);

        $this->options = [
	        'access_code' => 'zx0IPmPy5jp1vAz8Kpg7',
	        'merchant_identifier' => 'CycHZxVj',
	        'merchant_reference' => 'XYZ9239-yu898',
	        'currency' => 'AED',
	        'language' => 'en',
	        'customer_email' => 'test@payfort.com',
	        'signature' => '7cad05f0212ed933c9a5d5dffa31661acf2c827a',
	        'order_description' => 'iPhone 6-S',
        ];
    }

	/**
	 * Authorization success
	 */
    public function testAuthorizationSuccess()
    {
        $this->setMockHttpResponse('AuthorizationSuccess.txt');

        $this->options['amount'] = '10000';

        /** @var AuthorizationResponse $response */
        $response = $this->gateway
	        ->authorize($this->options)
	        ->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('Success.', $response->getMessage());
    }

    /**
     * Authorization failure
     */
    public function testAuthorizationFailure()
    {
        $this->setMockHttpResponse('AuthorizationFailure.txt');

	    $this->options['amount'] = NULL;

	    /** @var AuthorizationResponse $response */
	    $response = $this->gateway
		    ->authorize($this->options)
		    ->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('Invalid amount.', $response->getMessage());
    }

	/**
	 * Purchase success. Purchase combines authorization and capture requests
	 */
	public function testPurchaseSuccess()
	{
		$this->setMockHttpResponse('PurchaseFailure.txt');

		$this->options['amount'] = '10000';

		/** @var PurchaseResponse $response */
		$response = $this->gateway
			->authorize($this->options)
			->send();

		$this->assertTrue($response->isSuccessful());
		$this->assertEquals('Success.', $response->getMessage());
	}


	/**
	 * Purchase failure
	 */
	public function testPurchaseFailure()
	{
		$this->setMockHttpResponse('PurchaseSuccess.txt');

		$this->options['amount'] = '10001';

		/** @var PurchaseResponse $response */
		$response = $this->gateway
			->authorize($this->options)
			->send();

		$this->assertFalse($response->isSuccessful());
		$this->assertEquals('Operation amount exceeds the authorized amount.', $response->getMessage());
	}
}
