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

    include ("system/helpers/url_helper.php");
    class User
    {
        private $session; 
        private $user_model;
        public $groups     = array();
        private $user_data;
        private $alerts;
        private $in_edit_mode;
        function User(&$session, $model)
        {
            $in_edit_mode = false;
            $this->session = $session;  
            $this->user_model = $model;
            
            if($this->is_logged_in())
                $this->initialize($this->get_id());
            else
                array_push($this->groups, $this->user_model->get_group_id_by_name("Guests"));

        
        }
        

        function initialize($user_id)
        {
            $this->session->set_userdata('user_id', $user_id);
            $this->user_data = $this->user_model->get_by_id($user_id); 
            $this->user_model->register_activity($user_id);
            $this->groups = $this->user_model->get_user_group_ids($this->get_id());
            $this->load_alerts();
        }
        function load_alerts()
        {
            $this->alerts = $this->user_model->get_alerts($this->get_id());
        }
        function logout()
        {
            $this->session->sess_destroy();
        }
        function get_id()
        {
            return $this->session->userdata('user_id');   
        }
        function get_username()
        {
            return $this->user_data->username;    
        }
        function is_logged_in()
        {
            return $this->session->userdata('user_id') > 0;
        }
        
        function is_guest()
        {
            return $this->session->userdata('user_id') == 0;
        }
        
        function is_member_of_any($groups)
        {

            foreach($groups as $entry)
            {
                if($this->is_member_of($entry))
                    return true;
            }
            
            return false;    
        }
        
        function is_member_of($group_id)
        {

            $int_val = intval($group_id);
            if(is_string($group_id)){
                
                $group_id = $this->user_model->get_group_id_by_name($group_id);
            }

            foreach($this->groups as $entry)
            {
                if($entry == $group_id)
                    return true;
            }
            
            return false;    
        }

        function require_group($group_name)
        {
             if($this->is_guest())
                redirect('/admin/main/login', 'location');

                
             $group_id = $this->user_model->get_group_id_by_name($group_name);
             
             if(!$this->is_member_of((int)$group_id)){ //PHP, why aren't you strong typed.......
                redirect('/', 'location');          
                die();
            }
        }
        function require_login()
        {
            if($this->is_guest())
                redirect('/admin/main/login', 'location');
        }
        
        function notify($type, $message)
        {
            $notification = array(
                'type'      => $type,
                'message'   => $message
            );
            $notifications = array();
            array_push($notifications,$notification);
            $this->session->set_userdata('notifications', $notifications);
        }

        function editor_mode($bool)
        {
            $this->session->set_userdata('edit_mode', $bool);
        }
        function is_editor_mode()
        {
            return $this->session->userdata('edit_mode') == true;
        }
        function alert($text, $url, $icon, $tag)
        {
            $this->user_model->add_alert($this->get_id(), $text, $url, $icon, $tag);
            $this->load_alerts();
        }
        function get_notifications()
        {
            $notifications = $this->session->userdata('notifications');
            $this->session->unset_userdata('notifications');
            if(is_array($notifications))
                return $notifications;
            else
                return array();
        }

        function get_alerts()
        {
            return $this->alerts;
        }

        function set_session_data($key, $value)
        {
            $this->session->set_userdata($key, $value);
        }

        function get_session_data($key)
        {
            return $this->session->userdata($key);
        }
            
    }
?>
