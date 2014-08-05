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

    class comments extends CI_Model
    {
    	function add($post_id, $data)
    	{
    		$insert = array(
    			"post_id"	=> $post_id,
    			"name"		=> $data['name'],
    			"text"		=> $data['text'],
    			"time"		=> time());

    		$this->db->insert('be_post_comments', $insert);
    		return $this->db->insert_id();
    	}

    	function get($post_id)
        {
            $this->db->where("post_id", mysql_real_escape_string($post_id));

            $query = $this->db->get("be_post_comments");
            $result = $query->result();
            if(!$result)
                return array();
            else
                return $result;
        }
    }
?>