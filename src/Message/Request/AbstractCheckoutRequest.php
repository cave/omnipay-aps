<?php namespace Omnipay\APS\Message\Request;

abstract class AbstractCheckoutRequest extends APSAbstractRequest
{
	private $test_endpoint = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';

	private $live_endpoint = 'https://checkout.payfort.com/FortAPI/paymentPage';

	public function validateData()
	{
		$this->validate('access_code', 'merchant_identifier', 'merchant_reference', 'amount', 'currency', 'language', 'customer_email', 'signature');
	}
}