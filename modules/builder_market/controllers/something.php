<?php
	class something extends Module_Controller
	{
		public function index()
		{
			echo "index.";
		}
		public function haide()
		{
			return "as";
		}
		public function something2()
		{
			$this->show->disable_full_wrapper();
			sleep(20);
		}
	}