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

include_once("core_functions.php");
includeRecurse(APPPATH."/core/classes");


require_once(APPPATH."third_party/MX/Controller.php");
global $active_controller;
global $cache;
    class BE_Controller extends MX_Controller{
        public $show;
        public $user;
        public $links_array;
        protected $page_path;
        protected $versions = null;
        function BE_Controller()
        {
            $this->page_path = false;
            global $active_controller;
            global $active_show;
            $active_controller = $this;
            parent::__construct();

            if(!$this->is_installed() && $this->uri->segment(2) != "install"){
                redirect('/admin/install/index', 'location');
            }

            if($this->is_installed())
                $this->load->database();

            $this->load->library('datamapper');

            $this->load->helper("url");

            if(!$active_show)
                $this->show = new Show($this);
            else
                $this->show = &$active_show;
            $this->load->model('BuilderEngine');
            $this->load->model('users');

            

            if($this->is_installed()){
                global $cache;
                $this->load->model("cache");
                $cache = $this->cache;


                $this->BuilderEngine->load_settings();

                $session = $this->session;
                $user_model = $this->users;
                $this->user = new User($session, $user_model);

                global $user;
                $user = $this->user;
                $CI =& get_instance();
                $CI->load->model('links');

                $this->links_array = $CI->links->get();

                
            }
            $this->BuilderEngine->set_option("active_backend_theme","dashboard", false);
            $this->load->library('module_parser');
            $this->load->library('parser');

            //$this->BuilderEngine->activate_theme("default");

            //echo $this->get_page_path();

            $this->load->module("layout_system");
            $this->layout_system->load->model("blocks");

            $this->layout_system->load->model('versions');
            $this->versions = &$this->layout_system->versions;
        }
        public function get_builderengine()
        {
            return $this->BuilderEngine;
        }
        public function get_page_versions($page_path = null)
        {
            return $this->versions->get_page_versions(($page_path != null) ? $page_path : $this->get_page_path());
        }

        public function get_page_path()
        {
            global $BuilderEngine;
            return $BuilderEngine->get_page_path();

            //Old code below
            if(!$this->page_path)
                die("No Path");
            $path = "";
            $i = 1;
            if($this->uri->rsegments[1] == "module_manager")
            {
                $path = "module/";
                $i += 2;
            }

            for($i; $i <= count($this->uri->rsegments); $i++)
            {
                $path .= $this->uri->rsegments[$i]."/";
            }
            $path = trim($path, "/");
            return $path;
        }
        public function is_installed()
        {
            return file_exists("builderengine/config/database.php") && $this->config->item("site_installed");
        }
        public function get_user()
        {
            return $this->user;
        }
        public function get_links($tag = "")
        {
            if($tag != "")
                return $this->links->get_by_tag($tag);
            
            return $this->links_array;
        }
        public function show($view)
        {
            //commented function
            // if(file_exists("themes/".$this->BuilderEngine->get_active_theme()."/".$view.".php"))
            //     $this->load->view("../../themes/".$this->BuilderEngine->get_active_theme()."/".$view);
            // else
            //     die ("File "."themes/".$this->BuilderEngine->get_active_theme()."/".$view.".php");
        }
        
    }

    class Module extends BE_Controller{
        private $initialized = false;
        private function _initialize()
        {
            unset($this->versions);
            $this->load->model("versions"); //hackfix
            unset($this->users);
            $this->load->model("users"); //hackfix
            unset($this->presentation);
            $this->load->model("be_presentation", "presentation"); //hackfix
            $this->initialize();
            $this->initialized = true;
        }
        public function initialize()
        {

        }
        public function _remap($method)
        {
            //echo "Method: $method <br>\n";
            //echo "Params: ";
            $params = array_slice(func_get_args(), 1);
            if(!is_array($params))
            {
                $val = $params;
                $params = array($val);
            }
            

            if(method_exists($this, $method)){
                if(!$this->initialized)
                    $this->_initialize();
                return call_user_func_array(array($this, $method), $params);    
            }
                

            $string[0] = $method;
            for($i = 0; $i < count($params); $i++)
            {
                array_push($string, $params[$i]);
            }
            if ((strrpos($method, '.html') === strlen($method) - 5) && method_exists($this, "seo"))
            {
                if(!$this->initialized)
                    $this->_initialize();
                return call_user_func_array(array($this, "seo"), $string);
            }

            if(method_exists($this, "query"))
            {
                if(!$this->initialized)
                    $this->_initialize();
                return call_user_func_array(array($this, "query"), $string);
            }

            if(method_exists($this, "index"))
            {
                if(!$this->initialized)
                    $this->_initialize();
                return call_user_func_array(array($this, "index"), $string);
            }
                

           return "__404__";
        }
    }


?>
