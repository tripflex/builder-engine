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


class Admin_user extends BE_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -  
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function login()
    {
        $this->load->model('users');

        $this->show('index');    
        
    }
    public function search(){
        $this->load->model('users');
        
        $data = array();
        
        
        if($_POST)
            $data['search_results'] = $this->users->get($_POST['search']);
        else
            $data['search_results'] = $this->users->get();  
        
                  
        $this->show->backend('search_user', $data);    
    }
    public function groups(){
        $this->load->model('users');
        

        $data['groups'] = $this->users->get_groups();  
        
                  
        $this->show->backend('groups', $data);    
    }
    public function add()
    {
        $this->load->model('users');

        if($_POST){
            $new_user = $this->users->register_user($_POST);
            $this->user->notify('success', "User created successfully!");
        }
        $data['groups'] = $this->users->get_groups(); 
        
        
        
        $this->show->backend('add_user', $data); 
    }
    
    public function add_group()
    {
        $this->load->model('users');

        if($_POST){
            $new_user = $this->users->add_group($_POST);
            $this->user->notify('success', "Group created successfully!");
        }
            
        
        
        
        $this->show->backend('add_group'); 
    }
    
    public function edit_group($id)
    {
        $this->load->model('users');

        if($_POST)
            $new_user = $this->users->edit_group($_POST);
        
        $data['group'] = $this->users->get_group_by_id($id);
        $this->user->notify('success', "Group edited successfully!");
        
        $this->show->backend('edit_group', $data); 
    }
    public function edit($user_id)
    { 
        $this->load->model('users');

        if($_POST){
            $this->user->notify('success', "User edited successfully!");
            $this->users->edit($_POST);
        }
                
        $data['user_data'] = $this->users->get_by_id($user_id);
        $data['groups'] = $this->users->get_groups(); 
        
        
        
        $this->show->backend('edit_user', $data); 
    }
    public function delete($user_id)
    {
        $this->load->model('users');

        $this->users->delete($user_id);
        $this->load->helper('url');
        $this->user->notify('success', "User deleted successfully!");    
        redirect('/admin/user/search/', 'location');
    }
    public function validate_group($original_value = ""){
        $original_value = urldecode($original_value); 
        $group = $_POST['group'];
       $this->load->model('users');
       $group = urldecode($group);
       if($this->users->group_already_used($group) && $group != $original_value)
        echo "false";
       else
        echo "true";
    }
    public function email_exists($original_value = ""){ 
        $original_value = urldecode($original_value);
        $email = $_POST['email'];
       $this->load->model('users');
       $email = urldecode($email);
       if($this->users->email_already_used($email) && $email != $original_value)
        echo "true";
       else
        echo "false";
    }
    public function validate_email($original_value = ""){ 
        $original_value = urldecode($original_value);
        $email = $_POST['email'];
       $this->load->model('users');
       $email = urldecode($email);
       if($this->users->email_already_used($email) && $email != $original_value)
        echo "false";
       else
        echo "true";
    }
    public function validate_username($original_value = ""){
        $original_value = urldecode($original_value);
        $username = $_POST['username'];
       $this->load->model('users');
       $username = urldecode($username);
       if($this->users->username_already_used($username) && $username != $original_value)
        echo "false";
       else
        echo "true";
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */