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

    class Users extends CI_Model {
 
        function get_current_user()
        {
            global $active_show;
            return $active_show->controller->user;
        }
        function is_online($id) {
            $timeout = 300;
 
            $now = strtotime("now");
            $id = mysql_real_escape_string($id);
 
            $this->db->select('last_activity')->where("`id` = '".$id."'", "LIMIT 1", FALSE);
            $query = $this->db->get('users');
            $last_activity = $query->first_row()->last_activity;
 
            if($now - $last_activity < 300)
                return true;
            return false;
        }
        function validate_password_reset_token(&$token)
        {
            $this->db->where("pass_reset_token", $token);
            $query = $this->db->get("users");
            $result = $query->result();

            if(!$result)
                $token = FALSE;
        }
        function register_activity($id) {
            $now = strtotime("now");
            $id = mysql_real_escape_string($id);
 
            $object = array('last_activity' => $now);
            $this->db->where("`id` = '".$id."'", "LIMIT 1", FALSE);
            $this->db->update('users', $object);
        }
 
        function set_user_groups_by_name($user, $groups)
        {
            $groups = explode(",", $groups);
 
 
            $this->db->delete('user_group_link', array('user' => $user));
 
            foreach($groups as $group)
            {
                $group_id = $this->get_group_id_by_name($group);
                if($group_id == -1)
                    continue;
 
                $data = array(
                    "user" => $user,
                    "group"=> $group_id
                );
                $this->db->insert("user_group_link", $data);
            }
        }
        function get_group_id_by_name($name)
        {
            $this->db->where("name", $name);
            $query = $this->db->get("user_groups");
            $result = $query->result();
            if(count($result) != 0)
            {
                return $result[0]->id;
            }else
                return -1;
        }
 
        function register_user($data, $admin = false){
            if($this->username_already_used($data['username']) || $this->email_already_used($data['email'])){
                return 0;
            }
 
            $insert = array(
                'name'              => $data['name'],
                'username'          => $data['username'],
                'password'          => md5($data['password']),
                'email'             => $data['email'],
                //'level'             => $data['level'],
                'date_registered'   => time()
            );
 
            $this->db->insert('users', $insert);
            $user = $this->db->insert_id();
 
            $user_data = $this->get_by_id($user);
            $username = $user_data->username;
 
            $this->upload_avatar($username);
 
            if($admin)
                $data['groups'] = "Members, Administrators, Frontend Editor, Frontend Manager";
 
            if(!isset($data['groups']) || $data['groups'] == "")
                $data['groups'] = "Members";
            
            $this->set_user_groups_by_name($user,$data['groups']);
            return $user;
        }
        function delete_alerts_with_tag ($tag)
        {
            $this->db->where("tag", $tag);
            $this->db->delete("alerts");
        }
        function get_alerts($user) 
        {
            $this->db->where("user", $user);
            $query = $this->db->get("alerts");
            $result = $query->result();


            return $result;
        }
        function add_alert($user, $text, $url, $icon, $tag)
        {
            $this->db->where("user", $user);
            $this->db->where("text", $text);
            $this->db->where("url", $url);
            $query = $this->db->get("alerts");
            $result = $query->result();
            if($result)
            {
                return;
            }

            $data = array(
                "user"  => $user,
                "text"  => $text,
                "url"   => $url,
                "icon"  => $icon,
                "tag"   => $tag
                );

            $this->db->insert("alerts", $data);
        }
        function add_group($data)
        {
            if($this->group_already_used($data['group']))
                return 0;
 
            $data = array(
                'name'              => $data['group'],
                'description'       => $data['description'],
            );
 
            $this->db->insert('user_groups', $data);
            return $this->db->insert_id();
        }
 
        function edit_group($data)
        {
 
            $update = array(
                'name'              => $data['group'],
                'description'       => $data['description'],
            );
 
            $this->db->where('id', $data['id']);
            $this->db->update('user_groups', $update);
        }
 
        function delete($id)
        {
            $this->db->delete('users', array('id' => $id));
        }
        function upload_avatar($username)
        {
            if(!is_dir("files"))
                mkdir("files");
 
            if(!is_dir("files/avatars"))
                mkdir("files/avatars");
 
 
            $this->load->library('upload');
 
            $file = 'avatar';
            // Check if there was a file uploaded - there are other ways to
            // check this such as checking the 'error' for the file - if error
            // is 0, you are good to code
 
 
            // Specify configuration for File
            $config['file_name'] = $username.".jpg";
            $config['upload_path'] = 'files/avatars/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '11100';
            $config['max_width']  = '22048';
            $config['max_height']  = '22048';
            $config['overwrite']  = true;
 
            // Initialize config for File
            $this->upload->initialize($config);
 
            // Upload file
            if ($this->upload->do_upload($file))
            {
                $result = $this->upload->data();
            }
 
     
        }
        function send_password_reset_email($email)
        {
            $token = md5(time().rand(0,99999999999999999999));
            $link = "http://".$_SERVER['HTTP_HOST']."/admin/main/recover_password/".$token;
            $to      = $email;
            $subject = 'the subject';
            $message = '<h2>Password Reset</h2><br>We have received a password reset request for your account at '. $_SERVER['HTTP_HOST'].'<br>To reset your password please click <a href="'.$link.'">HERE</a>.';
            $headers = 'MIME-Version: 1.0' . "\r\n".
                'Content-type: text/html; charset=iso-8859-1' . "\r\n".
                'From: no-reply@'.$_SERVER['HTTP_HOST'] . "\r\n" .
                'Reply-To: no-reply@'.$_SERVER['HTTP_HOST'] . "\r\n" .
                'mailed-by: no-reply@'.$_SERVER['HTTP_HOST'] . "\r\n";

            mail($to, $subject, $message, $headers);
            

            $update = array("pass_reset_token" => $token);
            $this->db->where("email", $email);
            $this->db->update("users", $update);
        }
        function reset_password($token, $password)
        {
            $update = array(
                "password"          => md5($password),
                "pass_reset_token"  => "");
            $this->db->where("pass_reset_token", $token);

            $this->db->update("users", $update);
        }
        function edit($data){
            $update = array(
                'name'              => $data['name'],
                'email'             => $data['email'],
                //'level'             => $data['level'],
 
            );
 
            $user = $this->get_by_id($data['id']);
            $username = $user->username;
 
            $this->upload_avatar($username);
 
            if(strlen($data['password']) > 1)
                $update['password'] = md5($data['password']);
 
            $this->db->where('id', $data['id']);
            $this->db->update('users', $update);
 
            $this->set_user_groups_by_name($data['id'], $data['groups']);
            return true;
        }
 
        function get($search = "")
        {
            $search = mysql_real_escape_string($search);
            if($search != "")
                $this->db->where("`username` like '%".$search."%'", NULL, FALSE);
 
            $this->db->limit(600);
            $query = $this->db->get("users");
            return $query->result();
        }
 
        function get_group_by_id($id)
        {
            $id = mysql_real_escape_string($id);
            $this->db->where("`id` = '".$id."'", NULL, FALSE);
 
            $this->db->limit(1);
            $query = $this->db->get("user_groups");
            $result = $query->result();
            return $result[0];
        }
 
        function get_user_group_ids($user)
        {
            $id = mysql_real_escape_string($user);
            $this->db->where("`user` = '".$id."'", NULL, FALSE);
 
            $this->db->from("user_group_link");
            $this->db->join('user_groups', 'user_groups.id = user_group_link.group');
            $query = $this->db->get();
 
            $groups = array();
            foreach($query->result() as $group)
            {
                array_push($groups, intval($group->id));
            }
 
            return $groups;
        }
        function get_groups($search = "")
        {
            $search = mysql_real_escape_string($search);
            if($search != "")
                $this->db->where("`name` like '%".$search."%'", NULL, FALSE);
 
            $this->db->limit(600);
            $query = $this->db->get("user_groups");
            return $query->result();
        }
        function get_group_name_by_id($group_id)
        {
 
            $this->db->where('id', $group_id);
            $query = $this->db->get("user_groups");
            $result = $query->result();
 
            return $result[0]->name;
        }
        function get_groups_string($user)
        {
            $this->db->where('user', $user);
            $query = $this->db->get("user_group_link");
            $result = $query->result();
 
 
            $groups = array();
            foreach($result as $group)
            {
                $group_name = $this->get_group_name_by_id($group->group);
                array_push($groups, $group_name);
            }
 
            $result = implode(",", $groups);
 
            return $result;
        }
        function get_by_id($id)
        {
            $id = mysql_real_escape_string($id);
            $this->db->where("`id` = '".$id."'", "LIMIT 1", FALSE);
 
            $query = $this->db->get("users");
            $result = $query->result();

            if(!$result)
                return null;
            $result = $result[0];
 
            $obj = (object) array_merge( (array)$result, array( 'groups_string' => $this->get_groups_string($id) ) );
            return $obj;
        }
        function email_already_used($email = ""){
            $email = mysql_real_escape_string($email);
 
            $this->db->where(array('email' => $email));
            $this->db->from("users");
 
            $count = $this->db->count_all_results();
            return $count != 0;
        }
 
        function username_already_used($username = ""){
            $username = mysql_real_escape_string($username);
 
            $this->db->where(array('username' => $username));
            $this->db->from("users");
 
            $count = $this->db->count_all_results();
            return $count != 0;
        }
 
        function group_already_used($username = ""){
            $username = mysql_real_escape_string($username);
 
            $this->db->where(array('name' => $username));
            $this->db->from("user_groups");
 
            $count = $this->db->count_all_results();
            return $count != 0;
        }
        function verify_login($username, $password, $admin = false){
            $where = array(
                'username'  => $username,
                'password'  => md5($password),
 
            );
 
 
            $this->db->where($where);
 
            $query = $this->db->get("users");
            $result = $query->result();
 
            if(count($result) != 1)
                return 0;
 
            $result = $result[0];
            return $result->id;
        }
 
        function verify_admin_login($username, $password)
        {
            return $this->verify_login($username, $password, true);
        }
 
    }
?>