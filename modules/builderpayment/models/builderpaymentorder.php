<?php
	class BuilderPaymentOrder extends Datamapper
	{
		public $api = null;

	    var $table = 'be_builderpayment_orders';

	    var $has_many = array(
	    	"product" => array(
	    		'class' 		=> 'BuilderPaymentOrderProduct',
	    		'join_self_as'	=> 'order',
	    		'join_other_as'	=> 'product',
	    		'other_field'	=> 'order'
	    	),
	    	
	    );
	    var $has_one = array(
	        "user",
	    	"billingAddress" => array(
	    		'class' 		=> 'BuilderPaymentAddress',
	    		'other_field'	=> 'billingaddress',
	    		'join_other_as' => 'billingaddress',
	    		'join_self_as' => 'order',
	    	),
	    	"shippingAddress" => array(
	    		'class' 		=> 'BuilderPaymentAddress',
	    		'other_field'	=> 'shippingaddress',
	    		'join_other_as' => 'shippingaddress',
	    		'join_self_as' => 'order',
	    	),
	    );
		public function set_api(&$api)
		{
			$this->api = $api;
		}
		public function addProduct()
		{
			$this->save();
			$product = new BuilderPaymentOrderProduct();
			$product->name = "Empty Product";
			$product->price = 0;
			$product->quantity = 1;
			$product->save();
			$this->save_product($product);
			return $product;
		}
		public function createShippingAddress()
		{
			$this->save();
			$address = new BuilderPaymentAddress();
			$address->first_name = "Unknown";
			$address->save();
			$this->save_shippingAddress($address);
			return $address;
		}
		public function createBillingAddress()
		{
			$this->save();
			$address = new BuilderPaymentAddress();
			$address->first_name = "Unknown";
			$address->save();
			$this->save_billingAddress($address);
			return $address;
		}
		public function submit()
		{
			
			if(empty($this->shippingAddress->get()->id) && empty($this->billingAddress->get()->id))
				throw new Exception("No shipping or billing addrress specified. Please create one by using BuilderPaymentOrder::createShippingAddress() or BuilderPaymentOrder::createBillingAddress().", 1);

			if(empty($this->shippingAddress->get()->id))
				$this->save_shippingAddress($this->billingAddress->get());
			
			if(empty($this->billingAddress->get()->id))
				$this->save_billingAddress($this->shippingAddress->get());
			
			$this->gross = 0;
			foreach($this->product->get() as $product)
			{
				$this->gross += $product->price * $product->quantity;
				$product->save();
				$this->save_product($product);
			}
			$this->save();
			global $user;
			$this->save_user($user);
			$this->api->submitOrder($this);
			//Modules::Run($this->module."/".$this->callback, $this);
		}
		public function paid()
		{
			$this->status = 'paid';
			$this->time_paid = time();
			$this->save();
			$this->api->process_paid_order($this);
		}
	}
?>