<?php namespace Omnipay\APS\Message\Request;

abstract class AbstractCheckoutRequest extends APSAgit stbstractRequest
{
	protected $test_endpoint = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';

	protected $live_endpoint = 'https://checkout.payfort.com/FortAPI/paymentPage';

	public function validateData()
	{
		$this->validate('access_code', 'merchant_identifier', 'merchant_reference', 'amount', 'currency', 'language', 'customer_email');
	}
}