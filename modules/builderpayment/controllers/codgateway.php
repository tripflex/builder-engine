<?php
	require_once('paymentgateway.php');
	class codgateway extends PaymentGateway
	{
		public function process($order)
		{
			$this->load->view('cod/order_accepted', array('order' => $order));	
		}
		public function details()
		{
			return array(
			    "id"				=> "cod",
				"name"			=> "Cash on Delivery",
				"logo_big"		=> "",
				"logo_small"	=> "",
				"icon"			=> base_url("/modules/builderpayment/img/gateways/cod/icon.png")
			);
		}
		public function default_config()
		{
			$this->config_set('currency', 'USD');
		}
		public function test($var)
		{
			echo $var;
		}
	}
?> 