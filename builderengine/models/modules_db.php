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

class modules_db extends CI_Model {
	private $users;

	function modules_db()
	{
			$CI =& get_instance();
            $CI->load->model('users');
            $this->users = &$CI->users;   
	}
	function insert($folder)
	{
		$data = array(
			"name"			=> ucfirst($folder),
			"folder"		=> $folder,
			"installer_id"	=> 0,
			"install_time"	=> time(),
			"active"		=> "true",
			"version"		=> "unknown");

		$this->db->insert("modules", $data);
	}
	function get_by_folder($folder)
	{
		$this->db->where("folder", $folder);
		$query = $this->db->get("modules");
		$result = $query->result();

		if($result){
			foreach($result as $key => $module)
			{
				$result[$key] = (array)$result[$key]; // Converting Result object to array so we can insert a new element.

				$user = $this->users->get_by_id($result[$key]['installer_id']);
				if(!$user)
					$result[$key]['installer_name'] = "System";
				else
					$result[$key]['installer_name'] = ($user->name != "") ? $user->name : $user->username;
				$result[$key]['permissions'] = $this->get_module_permissions($module->id);

				$result[$key] = (object) $result[$key];
			}
			return $result[0];
		}else{
			return array();
		}
	}

	function get($id)
	{
		$this->db->where("id", $id);
		$query = $this->db->get("modules");
		$result = $query->result();

		foreach($result as $key => $module)
		{
			$result[$key] = (array)$result[$key]; // Converting Result object to array so we can insert a new element.

			$user = $this->users->get_by_id($result[$key]['installer_id']);
			if($user)
				$result[$key]['installer_name'] = ($user->name != "") ? $user->name : $user->username;
			else
				$result[$key]['installer_name'] = "System";
			$result[$key]['permissions'] = $this->get_module_permissions($module->id);

			$result[$key] = (object) $result[$key];
		}
		return $result[0];
	}

	function get_module_permissions($id)
	{
		$permissions = array();
		$permissions['frontend'] = array();
		$permissions['frontend']['ids'] = array();
		$permissions['frontend']['names'] = array();
		$permissions['backend'] = array();
		$permissions['backend']['ids'] = array();
		$permissions['backend']['names'] = array();


		$this->db->where("module", $id);
		$query = $this->db->get("module_permissions");
		$result = $query->result();
		
		foreach ($result as $key => $permission)
		{
			array_push($permissions[$permission->access]['ids'], intval($permission->group));
			array_push($permissions[$permission->access]['names'], $this->users->get_group_name_by_id($permission->group));
		}

		return $permissions;
	}
	function get_all()
	{
		$query = $this->db->get("modules");
		$result = $query->result();

		foreach($result as $key => $module)
		{
			$result[$key] = (array)$result[$key]; // Converting Result object to array so we can insert a new element.

			$user = $this->users->get_by_id($result[$key]['installer_id']);
			if($user)	
				$result[$key]['installer_name'] = ($user->name != "") ? $user->name : $user->username;
			else
				$result[$key]['installer_name'] = "System";

			$result[$key] = (object) $result[$key];
		}
		return $result;
	}

	function edit($data)
	{
		$update = array(
			"name"	=> $data['name']
			);

		$this->db->where("id", $data['id']);
		$this->db->update("modules", $update);

		$this->erase_permissions($data['id']);
		if($data['frontend-groups'] != "")
			$this->insert_permissions($data['id'], "frontend", explode(",", $data['frontend-groups']));

		if($data['backend-groups'])
			$this->insert_permissions($data['id'], "backend", explode(",", $data['backend-groups']));
	}
	private function erase_permissions($id)
	{
		$this->db->where('module', $id);
        $this->db->delete('module_permissions');
	}
	private function insert_permissions($module_id, $access_type, $groups = array())
    {

        $CI =& get_instance();
        $CI->load->model('users');

        foreach($groups as $group)
        {
            $data = array(
                "module"   	=> $module_id,
                "group"   	=> $CI->users->get_group_id_by_name($group),
                "access"	=> $access_type
            );
            $this->db->insert('module_permissions', $data);
        }

        
    }

}

?>