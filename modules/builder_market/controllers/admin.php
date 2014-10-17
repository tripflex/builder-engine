<?php
	class Admin extends Module_Controller
	{
		public function Admin()
		{
			parent::__construct();
			$this->load->model('communication');
		}
		public function update_products()
		{
			$products = new Product();

			foreach($products->get() as $product)
			{
				$this->update_product($product);
			}

		}
		public function update_product($product)
		{
			set_time_limit(0);
			while($next_version = $this->next_revision($product))
			{
				$update = $this->download_update($product);
				$this->install_update($product, $update);
				$product->version = $next_version;
			}
			$product->save();
		}
		private function download_update($product)
		{
			@mkdir(APPPATH.'download');

			$file = $this->communication->request_raw('download_product_update', $product->remote_id, $product->version);
			file_put_contents(APPPATH."download/download.zip", $file);
			
			if(file_exists(APPPATH."download/download.zip"))
				PC::builder_market("Downloaded product zip.");
			else
				PC::builder_market("Unable to download product zip.");

			return APPPATH."download/download.zip";
		}
		private function install_update($product, $update_file)
		{
			switch($product->type)
			{
				case "theme":
					$zip = new ZipArchive;
		            $file_path = $update_file;
		            if ($zip->open($file_path) === TRUE) {
		                $zip->extractTo(APPPATH.'../themes');
		                $zip->close();
		                
		                unlink($update_file);

		            } else {
		            }
					break;

				case "module":
					$zip = new ZipArchive;
		            $file_path = $update_file;
		            if ($zip->open($file_path) === TRUE) {
		            	$folder = $zip->getNameIndex(0);
		                $zip->extractTo(APPPATH.'../modules');
		                		                
						PC::builder_market("Zip extracted successfully.");
		                PC::builder_market("Unzipped folder ".$folder);
		                Modules::run("module_system/admin/update", $folder);
		                $zip->close();
		                unlink($update_file);

		            } else {
						PC::builder_market("Unable to extract zip.");
		                
		            }
					break;
			}
		}
		private function next_revision($product)
		{
			$new_version = $this->communication->request('product_update_revision', $product->remote_id, $product->version);
			if($product->version != $new_version->revision)
				return $new_version->revision;
			else
				return false;
		}

		public function themes()
		{
			$response = $this->communication->request('themes');
			$data['response'] = $response;

			$this->load->view('items', $data);
		}

		public function modules()
		{
			$response = $this->communication->request('modules');
			$data['response'] = $response;

			$this->load->view('items', $data);
		}
		public function install_theme($id)
		{
			$response = file_get_contents("http://devcms.bg.builderengine.com/builder_market_server/get_theme_info/{$id}");
			$data = json_decode($response);
		}

		public function install_product($product_id)
		{
			$response = $this->communication->request('get_product_system_information', $product_id);
			if($response->status != "success")
				die("error");
			@mkdir(APPPATH.'download');

			$file = $this->communication->request_raw('download_product', $product_id);
			file_put_contents(APPPATH."download/download.zip", $file);
			
			if(file_exists(APPPATH."download/download.zip"))
				PC::builder_market("Downloaded product zip.");
			else
				PC::builder_market("Unable to download product zip.");

			$product = new Product();
			$product->remote_id = $response->info->product_id;
			$product->type = $response->info->type;
			$product->version = $response->info->version;
			$product->save();

			switch($response->info->type)
			{
				case "theme":
					$zip = new ZipArchive;
		            $file_path = APPPATH."download/download.zip";
		            if ($zip->open($file_path) === TRUE) {
		                $zip->extractTo(APPPATH.'../themes');
		                $zip->close();
		                
		                unlink(APPPATH."download/download.zip");

		                echo 'success';
		            } else {
		                echo 'failed';
		            }
					break;

				case "module":
					$zip = new ZipArchive;
		            $file_path = APPPATH."download/download.zip";
		            if ($zip->open($file_path) === TRUE) {
		                $zip->extractTo(APPPATH.'../modules');
		                
						PC::builder_market("Zip extracted successfully.");
						$folder = $zip->getNameIndex(0);
						$folder = str_replace("/", "", $folder);
		                PC::builder_market("Unzipped folder ".$folder);
		                //$this->load->module('module_system/admin');
		                //$this->load->module('module_system');
		                //$this->module_system->admin->install();
		                echo Modules::run_with_params("module_system/install",  array($folder));
		                $zip->close();
		                
		                unlink(APPPATH."download/download.zip");
		                echo "success";
		            } else {
						PC::builder_market("Unable to extract zip.");
		                
		                echo 'failed';
		            }
					break;
			}
		}
		public function install_module($module_folder)
		{

			PC::install("Installing module.");
			$this->load->module($module_folder."/setup");

			$this->module = new Module();
			$this->module->where('folder', $module_folder)->get();
			
			if(get_class($this->setup) != 'setup' || $this->module->installed == 'yes'){
				return $this->finish();
			}

			$this->setup->module = null;
			$this->setup->module = &$this->module;
			if($this->setup->install() !== false)
			{
				return $this->finish();
			}
		}
		
	}