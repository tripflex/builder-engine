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
            $this->show->set_default_breadcrumb(0, "Blog", "/admin/module/blog/show_posts");
        }
        // [MenuItem ("Blog/Add Post")]    
        function add_post(){
            $this->load->model("posts");
            if($_POST){
                $post = $this->posts->add($_POST, $this->user->get_id());
                redirect('/blog/'.$post."?edit=.blog-post", 'location');
            }
                
            $this->user->editor_mode(true);
            $this->load->view("add_post");
        }
        

        

        function edit_post($id){
            $this->load->model("posts");
            if($_POST){
                $this->posts->edit($_POST['id'], $_POST);
                if(isset($_POST['invoker']) && $_POST['invoker'] == "frontend")
                    redirect("/blog/".$id, 'location');
            }
                
            
            $data['post'] = $this->posts->get($id);
               
            
            $this->load->view("edit_post", $data);
        }
        
        function delete_post($id)
        {              
            $this->load->model("posts");
            $this->load->helper('url');
            
            $this->posts->delete($id);
            
            redirect('/admin/module/blog/show_posts', 'location');
        }
        // [MenuItem ("Blog/Show Posts")]
        function show_posts(){
            $this->load->model("posts");
            $this->load->model("users");

            /*if($_POST)
                $data['posts'] = $this->posts->search($_POST['search']);
            else*/
            $data['posts'] = $this->posts->get();
            
            foreach($data['posts'] as $key => $post)
            {
                $user = $this->users->get_by_id($post->author);
                $post_array = (array)$post;
                unset($post_array['author']);
                $obj = (object) array_merge( (array)$post_array, array( 'author' => $user ) );
                $data['posts'][$key] = $obj;  
            }

            
            $this->load->view("show_posts", $data);
        }
    }  
?>
