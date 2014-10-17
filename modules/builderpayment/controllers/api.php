<?php
	class api extends Module_Controller
	{
		private $module = null;
		private $order = null;
		public $gateway = null;
		private $shippingAddress = null;
		private $billingAddress = null;
		private $products = array();
		public function initialize()
		{
			//die("Forbidden");
		}
		public function getAvailableGateways()
		{
			$gateways = array("paypal", 'cod');

			$available_gateways = array();
			foreach($gateways as $gate_name)
			{
				$gateway_controller = $gate_name.'gateway';
				$this->load->module('builderpayment/'.$gateway_controller);
				if(!$gateway_info = $this->$gateway_controller->is_available())
					continue;
				$gateway_info = $this->$gateway_controller->details();
				if(!isset($gateway_info['icon']))
					$gateway_info['icon'] = false;
				$gateway_info['id'] = $gate_name;
				array_push($available_gateways, (object)$gateway_info);
				
			}
			return $available_gateways;
		}

		public function submitOrder($order)
		{
			$this->gateway = $this->getGatewayByID($order->payment_method);

			if($this->gateway == null )
				throw new Exception("No payment method specified.", 1);

			$this->gateway->process($order);
		}
		public function setGateway($gatewayID)
		{
			$this->gateway = $this->getGatewayByID($gatewayID);
			$this->gateway->api = $this;
		}
		public function getGatewayByID($gatewayID)
		{
			$gateway_controller = $gatewayID.'gateway';
			$this->load->module('builderpayment/'.$gateway_controller);
			return $this->$gateway_controller;
		}
		public function test_available_gateways()
		{
			foreach($this->get_available_gateways() as $gateway)
			{
				echo "<img src='{$gateway->icon}'>";
			}
		}
		public function identifyModule($module)
		{
			$this->module = $module;
		}
		public function getOrderByID($id)
		{
			$order = new BuilderPaymentOrder($id);
			$order->set_api($this);
			return $order;
		}
		public function getOrders()
		{
			if($this->module == null)
				throw new Exception('Module identification not provided. Please identify by using API::identifyModule($module_name).', 1);

			$orders = new BuilderPaymentOrder();
			return $orders->where('module', $this->module)->get();
		}
		public function createOrder()
		{
			if($this->module == null)
				throw new Exception('Module identification not provided. Please identify by using API::identifyModule($module_name).', 1);

			$order = new BuilderPaymentOrder();
			$order->module = $this->module;
			$order->api = $this;
			$order->time_created = time();
			$order->save();
			return $order;
		}
		
		public function createShippingAddress()
		{
			return $this->shippingAddress = new BuilderPaymentAddress();
		}
		public function createBillingAddress()
		{
			return $this->billingAddress = new BuilderPaymentAddress();
		}
		
		public function test_order()
		{
			$this->identifyModule("page");
			$this->setGateway("paypal");
			$order = $this->createOrder();
			$order->currency = "USD";
			$order->callback = "page/callback";
			$order->save();
			$ship = $order->createShippingAddress();
			$ship->first_name = "Dimitar";
			$ship->middle_name = "Todorov";
			$ship->last_name = "Krastev";
			$ship->save();

			$bill = $order->createBillingAddress();
			$bill->first_name = "Alfonso";
			$bill->save();

			$product = $order->addProduct();
			$product->name = "iPhone 5s Super";
			$product->price = 123;
			$product->quantity = 3;
			$product->save();
			$order->submit();
		}

		public function test()
		{
			$this->load->model('BuilderPaymentOrder');

			$order				= new BuilderPaymentOrder();
			$shippingAddress	= new BuilderPaymentAddress();

			$relation = array(
				'class' 		=> 'BuilderPaymentAddress',
				'join_table' 	=> 'be_builderpayment_link_ship_user',
				'join_self_as'	=> 'user',
				'join_other_as'	=> 'shippingAddress',
				'other_field'	=> "shipped_user"
			);
			$this->user->has_many('shippingAddress', $relation);


			$order->first_name = "Dimitar";
			$order->save();

			$shippingAddress->first_name = "Another Dimitar";
			$shippingAddress->save();

			
			echo $shippingAddress->id;
			$this->user->save_shippingAddress($shippingAddress);

			foreach ($this->user->shippingAddress->get() as $address)
			{
				echo $address->first_name;

			}
		}

		
		public function blah()
		{
			sleep(1);
			echo "manja";
		}
		public function process_paid_order($order)
		{
			if($order->callback != "")
				Modules::Run($order->module."/".$order->callback, $order);
		}



	}
?>