<?php
	class PaymentGateway extends Module_Controller
	{
		protected $m_config = array();

		function __construct()
		{
			parent::__construct();
			$this->load->module('builderpayment/api');
		}
		private function load_config()
		{
			$this->default_config();
			$config = $this->builderengine->get_option("builderpayment-config-".get_class($this));
			if($config != "")
				$this->m_config = json_decode($config);
		}

		private function save_config()
		{
			$this->builderengine->set_option("builderpayment-config-".get_class($this), json_encode($this->m_config) );
		}

		public function config_get($key)
		{
			return $this->m_config['key'];
		}
		public function config_set($key, $value)
		{
			$this->m_config['key'] = $value;
		}
		public function is_available()
		{
			return true;
		}

	}
?>