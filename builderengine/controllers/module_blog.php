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

  class module_blog extends BE_Controller{
      
      public function module_blog()
      {
          parent::__construct();
      }
      
      public function index()
      {
        $this->show->frontend("blog");    
      }
      
  }
?>
