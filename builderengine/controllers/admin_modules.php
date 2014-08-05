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

    class Admin_modules extends BE_Controller{

        public function Admin_modules(){
            parent::__construct();
            $this->load->model('users');
            $this->load->model('modules_db');
        }
         
        function edit($id)
        {
            $this->show->set_default_breadcrumb(0, "Settings", "");
            $this->show->set_default_breadcrumb(1, "Modules", "/admin/modules/show");
            $this->show->set_default_breadcrumb(2, "Edit", "");

            $data = array();
            if($_POST)
            {
                $this->modules_db->edit($_POST);
                $this->user->notify('success', "Module edited successfully!");    
            }    
            $data['module'] = $this->modules_db->get($id);
            $data['groups'] = $this->users->get_groups();
            $this->show->backend("edit_module", $data);    
        }

        function delete($id)
        {    
            $this->links->delete($id);
            $this->user->notify('success', "Module deleted successfully!");      
            redirect('/admin/links/show/', 'location');        
        }
        
        function show()
        {         
            $this->show->set_default_breadcrumb(0, "Settings", "");
            $this->show->set_default_breadcrumb(1, "Modules", "");
            $this->show->set_default_breadcrumb(2, "Show", "");
            $data['modules'] = $this->modules_db->get_all();
            $this->show->backend("show_modules", $data);        
        }
    }
?>
