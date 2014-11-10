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

	class Blocks extends CI_Model {
		private $page_path = false;
		function __construct()
		{
			parent::__construct();
			$this->load->model("versions");	
			
			//echo $page_path;
			//echo debug_print_backtrace();
		}
		public function load($block)
		{
			return $this->versions->load_block($block);
		}
		function get($block_name)
		{
			$block_name = mysql_real_escape_string($block_name);
			$this->db->where("name", $block_name);
			$query =  $this->db->get("blocks");

			return $query->first_row();
		}

		function save($block_name, $data, $children) {

			PC::SAVING($data);
			$page_path = $this->BuilderEngine->get_page_path();
			PC::debug("blocks::save() looking for pending version of page path $page_path");
			if($this->is_block_global($block_name))
				$pending_version = $this->versions->get_or_create_pending_version("layout");
			else
				$pending_version = $this->versions->get_or_create_pending_version($page_path);
				
			$update_data = array(
				'data'	=>	$data);
			PC::debug("Saving block with version $pending_version");
			$this->db->where('name', $block_name);
			$this->db->where('version', $pending_version);
			//echo "Updating block $block_name with version $pending_version";
			$this->db->update('blocks', $update_data);

			$this->db->where('parent', $block_name);
			$this->db->where('version', $pending_version);
			$this->db->delete('block_relations');

			foreach($children as $key => $childname)
			{
				$insert = array(
					"parent"	=> $block_name,
					"child"	=> $childname,
					"version"	=> $pending_version,
					"sort_order"	=> $key
					);

				$this->db->insert('block_relations', $insert);
			}
		}
		public function is_block_global($name)
		{
			$this->db->where('name', $name);
			$query = $this->db->get('blocks');
			$result = $query->result();

			if($result)
				return $result[0]->global == 'yes';
			else
				return -1;
		}
		public function set_page_path($page_path)
		{
			$this->page_path = $page_path;
		}
		public function get_page_path_of($block)
		{
			$query_str = "select be_page_versions.path from be_blocks LEFT JOIN be_page_versions on be_blocks.version=be_page_versions.id where be_blocks.name='$block' ORDER BY be_page_versions.id DESC LIMIT 1";
            $query = $this->db->query($query_str);
            $result = $query->result();
            
            if($result){
            	PC::debug("Page path of block $block: ".$result[0]->path);
                return $result[0]->path;
            }else{
            	PC::debug("!!!! No page path");
             	return false;
            }
		}
		public function block_version_exists($name, $version)
		{
			$this->db->where('name', $name);
			$this->db->where('version', $version);
			$result = $this->db->get('blocks')->result();

			if($result)
				return true;
			else
				return false;
		}
		public function create($data)
		{
			if($this->page_path === false)
				$this->page_path = $this->BuilderEngine->get_page_path();

			$children = $data['children'];
			unset($data['children']);

			$data['active'] 	= 'yes';
			
			$page_path = $data['global'] == 'yes' ? "layout" : $this->page_path;
			$data['version']	= $this->versions->get_pending_or_active_page_version_id($page_path);

			if($this->block_version_exists($data['name'], $data['version']))
				return;
			
			$this->db->insert('blocks', $data);
			PC::creating_block($data);
			foreach($children as $key => $childname)
			{
				$insert = array(
					"parent"	=> $data['name'],
					"child"	=> $childname,
					"version"	=> $data['version'],
					"sort_order"	=> $key
					);

				$this->db->insert('block_relations', $insert);
			}
		}
		function get_max_block_id()
		{
			$this->db->select('MAX(id) as max_id');
			$query = $this->db->get("blocks");
			$result = $query->result();
			if($result)
				return $result[0]->max_id;
			else
				return -1;
		}
		function get_page_path($block_name)
        {
            $query_str = "select be_page_versions.path from be_blocks LEFT JOIN be_page_versions on be_blocks.version=be_page_versions.id where be_blocks.name='$block_name' ORDER BY be_page_versions.id DESC LIMIT 1";

            $query = $this->db->query($query_str);
            $result = $query->result();
            
            if($result)
                return $result[0]->path;
            else
                return -1;
        }
	}
?>