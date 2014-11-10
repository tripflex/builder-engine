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
class Cache extends CI_Model{
	
	function insert($id, $object, $timeout = 0)
	{
		$this->delete($id);
		$blob = serialize($object);		// Serializing the object.
		
		if($timeout != 0)
			$timeout += time();				// We set when the object should disappear.

		$data = array(
			"id"		=> $id,
			"object"	=> $blob,
			"timeout"	=> $timeout
		);

		$this->db->insert("cache", $data);

	}

	function fetch($id)
	{
		$this->db->where("id", $id);

		$query = $this->db->get("cache");
		$result = $query->result();
		
		if(!$result)
			return null;

		$cache = $result[0];

		if ((int)$cache->timeout < time() && (int)$cache->timeout != 0)
		{
			$this->delete($cache->id);
			return null;
		}else{
			return unserialize($cache->object);
		}
	}

	function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("cache");
	}

};
?>