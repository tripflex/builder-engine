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

    class Settings extends CI_Model {
    	private $layout_system_type = "bootstrap2";
    	public function set_layout_system_type($type)
    	{
    		$this->$layout_system_type = $type;
    	}
    	public function layout_system_type()
    	{
    		return $this->$layout_system_type;
    	}

    }
?>