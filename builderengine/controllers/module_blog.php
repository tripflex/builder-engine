<?php
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
