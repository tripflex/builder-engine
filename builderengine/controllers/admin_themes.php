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

    class Admin_themes extends BE_Controller{

        public function Admin_themes(){
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
            if($_POST)
            {
                $this->BuilderEngine->set_option("active_frontend_theme", $_POST['theme']);
            }   
            $this->show->set_default_breadcrumb(0, "Settings", "");
            $this->show->set_default_breadcrumb(1, "Themes", "");
            $this->show->set_default_breadcrumb(2, "Show", "");

            $active_theme_name = $this->BuilderEngine->get_option("active_frontend_theme");

            $active_theme = array();
            $active_theme['name'] = $active_theme_name;

            if(file_exists(APPPATH."../themes/".$active_theme_name."/screenshot.png"))
                $active_theme['screenshot_url'] = "/themes/{$active_theme_name}/screenshot.png";
            else if(file_exists(APPPATH."../themes/".$active_theme_name."/screenshot.jpg"))
                $active_theme['screenshot_url'] = "/themes/{$active_theme_name}/screenshot.jpg";
            else
                $active_theme['screenshot_url'] = "/builderengine/public/img/no_preview.png";


            if(file_exists(APPPATH."../themes/".$active_theme_name."/description.txt"))
                $active_theme['description'] = file_get_contents(APPPATH."../themes/".$active_theme_name."/description.txt");
            else
                $active_theme['description'] = "This theme does not have a description.";


            $themes = array();
            $folders = scandir(APPPATH."../themes");
            foreach ($folders as $folder)
            {
                if($folder == "." || $folder == ".." || $folder == "dashboard" || $folder[0] == "." || !is_dir(APPPATH."../themes/".$folder))
                    continue;

                $theme = array();

                if(file_exists(APPPATH."../themes/".$folder."/screenshot.png"))
                    $theme['screenshot_url'] = "/themes/{$folder}/screenshot.png";
                else if(file_exists(APPPATH."../themes/".$folder."/screenshot.jpg"))
                    $theme['screenshot_url'] = "/themes/{$folder}/screenshot.jpg";
                else
                    $theme['screenshot_url'] = "/builderengine/public/img/no_preview.png";


                if(file_exists(APPPATH."../themes/".$folder."/description.txt"))
                    $theme['description'] = file_get_contents(APPPATH."../themes/".$folder."/description.txt");
                else
                    $theme['description'] = "This theme does not have a description.";

                $theme['name'] = $folder;
                array_push($themes, $theme);

            } 
            $data['active_theme'] = $active_theme;
            $data['themes'] = $themes;
            $this->show->backend("themes", $data);        
        }
    }
?>
