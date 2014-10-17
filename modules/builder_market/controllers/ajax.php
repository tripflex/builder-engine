<?php
	class ajax extends BE_Controller
	{
		public function ajax()
		{
			parent::__construct();
			$this->load->model('communication');
		}

		public function install_product($product_id)
		{
			$response = $this->communication->request('get_product_system_information', $product_id);
			if($response->status != "success")
				die("error");
			@mkdir(APPATH.'../download');

			$file = $this->communication->request_raw('download_product', $product_id);
			file_put_contents(APPPATH."../download/download.zip", $file);
			echo "yey";
		}

		public function install_theme($id)
		{
			$response = file_get_contents("http://devcms.bg.builderengine.com/builder_market_server/get_theme_info/{$id}");
			$data = json_decode($response);
		}

		
		
	}