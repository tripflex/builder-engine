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

    class Admin_links extends BE_Controller{

        public function Admin_links(){
            parent::__construct();
            $this->load->model('users');
            $this->load->model('links');
        }
         
        function add()
        {
            $this->show->set_default_breadcrumb(0, "Links", "/admin/links/show");
            $this->show->set_default_breadcrumb(1, "Add", "");
            if($_POST)
            {
                $this->links->add($_POST); 
                $this->user->notify('success', "Link added successfully!");   
            }
            $data['groups'] = $this->users->get_groups();
            $this->show->backend("add_link", $data);    
        }
        
        function edit($id)
        {
            $this->show->set_default_breadcrumb(0, "Links", "/admin/links/show");
            $this->show->set_default_breadcrumb(1, "Edit", "");
            $this->load->model('links');
            if($_POST)
            {
                $this->links->edit($_POST);
                $this->user->notify('success', "Link edited successfully!");    
            }    
            $data['groups'] = $this->users->get_groups();
            $data['link'] = $this->links->get($id);
            $this->show->backend("edit_link", $data);    
        }

        function delete($id)
        {    
            $this->links->delete($id);
            $this->user->notify('success', "Link deleted successfully!");      
            redirect('/admin/links/show/', 'location');        
        }
        
        function show()
        {         
            $this->show->set_default_breadcrumb(0, "Links", "/admin/links/show");
            $this->show->set_default_breadcrumb(1, "Show", "");
            $this->show->backend("show_links");        
        }
    }
?>
