<?php
	class setup extends Module_Controller
	{
		public function install()
		{
			echo "Installed";
			$this->module->name = "Awesome Blog";
			$this->module->version = "1.1";
			$this->setup_database();
			return true;
		}

		public function setup_database()
		{
			$this->db->execute_file();
		}
	}