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

	class Version_manager extends Module {

		public function Version_manager()
		{
			parent::__construct();
			
		}
		
		public function index()
		{
			echo "Versions1::index()";
		}

		public function test()
		{
			echo "Yep working good";
		}
		public function query1($string)
		{
			echo "Versions1::query()"; 
		}

		
	}

?>