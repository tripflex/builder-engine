<?php
	class builderpayment extends Module_Controller
	{
		function test()
		{
			$this->load->module('builderpayment/api');
			$this->api->identifyModule('ecommerce');
			$this->api->test_order();
		}
		public function callback()
		{
			
		}
		public function processOrder($order_id)
		{
			$this->load->module('builderpayment/api');
			$order = new BuilderPaymentOrder($order_id);
			$this->api->submitOrder($order);
		}

		public function process($order_id)
		{
			
		}
	}
?>