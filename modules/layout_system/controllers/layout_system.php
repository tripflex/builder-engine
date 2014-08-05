<?php
/***********************************************************
* BuilderEngine v2.0.12
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2014. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2014-23-04 | File version: 2.0.12
*
***********************************************************/

	class Layout_system extends Module {
		public function index()
		{
			echo "Layout_system::index()";
		}
		public function test()
		{
			echo "Yep working wtf";
		}
		public function query1($string)
		{
			echo "Layout_system::query()"; 
		}

		public function editor_nav()
		{
			$this->show->disable_full_wrapper();

			$data['page_path'] = $_REQUEST['page_path'];
			$this->BuilderEngine->set_page_path($data['page_path']);
			$this->load->view('editor_nav');
		}
		public function erase_all_blocks()
		{
			$this->db->query('truncate be_blocks');
			$this->db->query('truncate be_block_relations');
			$this->db->query('truncate be_page_versions');
			redirect(base_url('/'), 'location');  
		}
	}

?>