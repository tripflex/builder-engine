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

class blog extends Module {

	public function index($id = 0)
	{
        if($id > 0) {
            $this->read($id);
            return;
        }
        $this->load->model("posts");
        $this->load->model('users');

        $search = "";
        if($_GET)
        {
            $search = $_GET['search'];
        }
        $posts = $this->posts->search($search);

        foreach($posts as &$post)
        {
            $user = $this->users->get_by_id($post->author);
            $post_array = (array)$post;
            $post = (object) array_merge( (array)$post_array, array( 'author' => $user ) );
        }
        $data['post'] = $posts;

        $this->db->limit(5);
        $data['recent'] = $this->posts->get();
		$this->load->view('blog_index', $data);
        return;
	}
    public function read($id)
    {
        $this->load->model("posts");
        $this->load->model("comments");
        $this->load->model("users");
        
        if($_POST)
        {
            $this->comments->add($id, $_POST);
        }

        $post = $this->posts->get($id);



        $user = $this->users->get_by_id($post->author);
        $post_array = (array)$post;
        unset($post_array['author']);
        $obj = (object) array_merge( (array)$post_array, array( 'author' => $user ), array( 'comments' => $this->comments->get($id)) );

        $data['post'] = $obj;
        $this->db->limit(5);
        $data['recent'] = $this->posts->get();
        
        $this->load->view('blog_entry', $data);
    }
    public function query($string){
        if(intval($string) != $string)
        {

        }else
            $this->read($string);

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */