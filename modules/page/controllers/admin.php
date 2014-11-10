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

    class Admin extends BE_Controller{
        
        function Admin()
        {
            parent::__construct();
            $this->show->set_default_breadcrumb(0,"Pages", "/admin/module/page/show_pages");
        }

        // [MenuItem ("Pages/Add Page")]    
        function add(){
            $this->load->model("pages");
            if($_POST){
                $this->pages->add($_POST, $this->user->get_id());
                $this->user->editor_mode(true);
                redirect('/editor/page-'.$_POST['slug'].".html?force-editor-mode=edit", 'location');
            }
                
            $pages_folder = "themes/".$this->BuilderEngine->get_option("active_frontend_theme")."/templates";
            if(is_dir($pages_folder))
            {
                $folder_contents = scandir($pages_folder);
                $page_files = array();
                foreach($folder_contents as $entry)
                {
                    if($entry == "." || $entry ==".." || is_dir($entry))
                        continue;

                    $entry = basename($entry, ".php");
                    array_push($page_files, $entry);
                }
            }
            $data = array();
            if($page_files)
                $data['theme_pages'] = $page_files;
            $this->load->view("add_page", $data);
        }
        

        

        function edit_page($id){
            $this->load->model("pages");
            if($_POST)
                $this->pages->edit($_POST['id'], $_POST);
            
            $data['page'] = $this->pages->get($id);
                
            $this->load->view("edit_page", $data);
        }
        
        function delete_page($id)
        {              
            $this->load->model("pages");
            $this->load->helper('url');
            
            $this->pages->delete($id);
            
            redirect('/admin/module/page/show_pages', 'location');
        }
        // [MenuItem ("Pages/Show Pages")]
        function show_pages(){
            $this->load->model("pages");
            $this->load->model("users");

            if($_POST)
                $data['pages'] = $this->pages->search($_POST['search']);
            else
                $data['pages'] = $this->pages->search();
            
            foreach($data['pages'] as $key => $post)
            {
                $user = $this->users->get_by_id($post->author);
                $page_array = (array)$post;
                unset($page_array['author']);
                $obj = (object) array_merge( (array)$page_array, array( 'author' => $user ) );
                $data['pages'][$key] = $obj;  
            }

            
            $this->load->view("show_pages", $data);
        }
    }  
?>
