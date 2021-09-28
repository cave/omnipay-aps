<?php namespace Omnipay\APS\Message\Request;

abstract class AbstractCheckoutRequest extends APSAbstractRequest
{
<<<<<<< HEAD
	protected $test_endpoint = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';

	protected $live_endpoint = 'https://checkout.payfort.com/FortAPI/paymentPage';

	public function validateData()
	{
		$this->validate('access_code', 'merchant_identifier', 'merchant_reference', 'amount', 'currency', 'language', 'customer_email');
=======
	private $test_endpoint = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';

	private $live_endpoint = 'https://checkout.payfort.com/FortAPI/paymentPage';

	public function validateData()
	{
		$this->validate('access_code', 'merchant_identifier', 'merchant_reference', 'amount', 'currency', 'language', 'customer_email', 'signature');
>>>>>>> 24428a5b7399bc46a68f08187fb62fe42a45d455
	}
}