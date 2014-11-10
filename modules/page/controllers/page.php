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

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends Module {

    function __construct(){ parent::__construct();}
	public function index($id = 0)
	{
        if($id != 0)
            return $this->read($id);


        $this->load->model("users");
        $this->show->disable_full_wrapper();
        $this->show->theme('home', null);
	}
    public function show_404()
    {
        if($this->show->theme_file_exists('404.php')){
            $this->show->theme('404', null);
        }else{
            $this->load->view('404', null);
        }
            
    }
    public function read($id)
    {
        $this->load->model("pages");
        $this->load->model("users");
        $post = $this->pages->get($id);


        $user = $this->users->get_by_id($post->author);
        $post_array = (array)$post;
        unset($post_array['author']);
        $obj = (object) array_merge( (array)$post_array, array( 'author' => $user ) );

        $data['page'] = $obj;
        if($obj->template == "__blank__"){
            echo "loading view";
            $this->load->view('page_entry.php', $data);
        }else{
            echo "not loading view";
            $this->show->disable_full_wrapper();
            $this->show->theme("templates/".$obj->template, $data);
        }

    }

    public function template_test()
    {
        $this->show->theme('pages/contact-us', null);
    }
    public function query($slug)
    {

        $this->load->model("pages");
        $this->load->model("users");
        $page = $this->pages->get_by_slug($slug);
        if(!$page)
            return show_404();
            
        $user = $this->users->get_by_id($page->author);
        $post_array = (array)$page;
        unset($post_array['author']);
        $obj = (object) array_merge( (array)$post_array, array( 'author' => $user ) );

        $data['page'] = $obj;

        if($obj->template == "__blank__"){
            $this->load->view('page_entry.php', $data);
        }else{
            $this->show->disable_full_wrapper();
            $this->show->theme("templates/".$obj->template, $data);
        }
    }

    public function seo($slug)
    {
        echo"seo $slug";
        $this->query($slug);

    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */