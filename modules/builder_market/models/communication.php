<?
	class GENERAL_RESPONSE
	{
		public static $NOT_AUTHORIZED = array('status' => "error", 'message' => "Your website is not authorized to access this section. Please check your license.");
		
	}

	class AUTH_RESPONSE
	{
		public static $SUCCESS = array('status' => "success");

		public static $PENDING = array('status' => "error", 'message' => "This website lincense is still pending.");

		public static $SUSPENDED = array('status' => "error", 'message' => "This website lincense is suspended. Please contact customer support.");

		public static $NOT_FOUND = array('status' => "error", 'message' => "This website lincense does not appear to be valid.");
		
		public static $WRONG_OWNER = array('status' => "error", 'message' => "This lincense is bound to another hostname.");



	}
	class LICENSE_REQUEST_RESPONSE
	{
		public static $WRONG_OWNER = array('status' => "error", 'message' => "The IP address lookup of the provided hostname does not match your IP address. You should submit this request from the subject website.");
		
		public static $HOST_ALREADY_HAS_LICENSE = array('status' => "error", 'message' => "This hostname already has registered license. If you have lost your license, please contact Customer Support.");
		
		public static $SUCCESS = array('status' => "success", 'message' => "You have registerd your website license successfully.");
		
	}
	class communication extends CI_Model
	{
		public function request($function, $arg1 = "", $arg2 = "")
		{
			if($arg2 == "")
				return json_decode($this->request_raw($function, $arg1));
			else
				return json_decode($this->request_raw($function, $arg1, $arg2));

		}
		public function request_raw($function, $arg1 = "", $arg2 = "")
		{
			PC::market("http://builderengine.com/builder_market_server/{$function}/{$arg1}?core_version=".$this->BuilderEngine->get_option('version')."&license=". $this->get_license());
			if($arg2 == "")
				return file_get_contents("http://builderengine.com/builder_market_server/{$function}/{$arg1}?core_version=".$this->BuilderEngine->get_option('version')."&license=". $this->get_license());
			else
				return file_get_contents("http://builderengine.com/builder_market_server/{$function}/{$arg1}/{$arg2}?core_version=".$this->BuilderEngine->get_option('version')."&license=". $this->get_license());
		}
		public function get_license()
		{
			$license = $this->BuilderEngine->get_option('be_website_license');
			if(!empty($license))
				return $license;
			else
				return $this->request_license();
		}
		public function request_license()
		{

			$hostname = $_SERVER['HTTP_HOST'];
			PC::market("http://builderengine.com/builder_market_server/request_license?hostname=".$hostname);
		
			$response_string = file_get_contents("http://builderengine.com/builder_market_server/request_license?hostname=".$hostname);
			$response = json_decode($response_string);

			if($response->status == "success")
			{
				$this->BuilderEngine->set_option('be_website_license', $response->license);
			}else
			echo "error";
			return $response->license;
		}
	}
