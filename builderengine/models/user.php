<?
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

	class User extends DataMapper 
	{	
		/* DataMapper specific members below*/
		var $table = 'users';
		var $has_one = array();
		var $has_many = array(
		"alert",
		"group"	=> array(
				'join_table' => 'link_groups_users',
				'join_self_as' => 'user',
				'join_other_as' => 'group',
				 ), );


		/* User specific members below*/

		private $session; 
		private static $s_session; 
        private $user_model;
        public $groups     = array();
        private $user_data;
        private $alerts;
        private $in_edit_mode;

        public function __construct($id = NULL)
        {
           parent::__construct($id);
           EventManager::fire("builderengine_user_construct", $this);

        }
        function _init(&$session)
        {
            $in_edit_mode = false;
            $this->session = self::$s_session = &$session;  
            
            if($this->is_logged_in())
                $this->initialize($this->get_id());
            else
            {
            	$group = new Group();
            	$group->where('name', 'Guests')->get();
                array_push($this->groups, $group->id);
            }
        
        }

        function initialize($user_id)
        {
        	$this->get_by_id($user_id);
        	foreach($this->group->get() as $group)
        	{
        		array_push($this->groups, $group->id);
        	}
            $this->session->set_userdata('user_id', (int)$user_id);
            $this->register_activity();
            $this->load_alerts();
        }
        public function get_group_ids()
        {
        	return $this->groups;
        }
        function load_alerts()
        {
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
            return $this->username;    
        }
        function is_logged_in()
        {
            return $this->session->userdata('user_id') > 0;
        }
        
        function is_guest()
        {
            return $this->session->userdata('user_id') == 0;
        }
        function register_activity()
        {
        	$this->last_activity = time();
        	$this->save();
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
                $group = new Group();
                $group->where('name', $group_id)->get();
                $group_id = $group->id;
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

            $group = new Group();

            $group_id = $group->get_by_name($group_name)->id;
             
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
            $alert = new Alert();
            $alert->where("user_id", $this->id)->where("text", $text)->where("url", $url)->get();
            $alert->text = $text;
            $alert->url = $url;
            $alert->icon = $icon;
            $alert->tag = $tag;
            $alert->save();
            $this->save_alert($alert);
            //$this->user_model->add_alert($this->get_id(), $text, $url, $icon, $tag);
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


        function can_access_module($module, $access_type)
        {
            
            foreach($this->groups as $user_group){
                foreach($module->group_permission->get() as $permission)
                {
                    if($user_group == $permission->group->get()->id && $permission->access == $access_type)
                        return true;
                }
            }
            return false;
        }


        function register()
        {
            $this->date_registered = time();
            $this->save();
            $this->groups = array();
            $this->set_member_of("Members");

            return $this;
        }

        function set_member_of($group_id)
        {
            $int_val = intval($group_id);
            if(is_string($group_id)){
                $group = new Group();
                $group->where('name', $group_id)->get();
                $this->save_group($group);
            }else
            {
                $group = new Group($group_id);
                $this->user->save_group($group);
            }

            return $this;
        }

        function get_avatar()
        {
            if($this->avatar == "" || !file_exists(APPPATH."../".$this->avatar))
                return base_url("/themes/dashboard/images/avatars/no_avatar.jpg");
            else
                return base_url($this->avatar);
        }
	}
?>