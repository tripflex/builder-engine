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

    class module_manager extends BE_Controller
    {
        function parse($argv, &$handler, &$parameters)
        {

            $handler[1] = "";
            $parameters[1] = array();

            $handler[1] = $argv[0]."/_remap";
            
            
            for($i = 1; $i < count($argv); $i++)
                array_push($parameters[1], $argv[$i]);
           
            if(count($parameters[1]) == 0)
                array_push($parameters[1], "index");   


            if(isset($argv[1])){
                $handler[0] = "";
                $parameters[0] = array();

                $handler[0] = $argv[0]."/".$argv[1]."/_remap";
                
                
                for($i = 2; $i < count($argv); $i++)
                    array_push($parameters[0], $argv[$i]);
               
                if(count($parameters[0]) == 0)
                    array_push($parameters[0], "index");   
            }
 
        
        }

        function parse_ajax($argv, &$handler, &$parameters)
        {

            $handler = "";
            $parameters = array();

            $handler = $argv[0]."/ajax/".$argv[1];
            
            
            for($i = 1; $i < count($argv); $i++)
                array_push($parameters, $argv[$i]);
           
            if(count($parameters) == 0)
                array_push($parameters, "index");    
        
        }
        function process_seo()
        {

            $original_argv = func_get_args();

            $data = explode("-", $original_argv[0],2);

            global $BuilderEngine;
            $this->show->set_frontend();
            $this->load->model('users');

            $argv = $data;

            $handler = "";
            $parameters = "";
            $this->parse($argv, $handler, $parameters);


            $parameters_string = implode("/", $parameters[1]);
            $page_path = $argv[0]."/".$parameters_string;

            PC::oops($argv);
            $BuilderEngine->set_page_path($page_path);
            

            
            



            $module_folder = explode("/", $handler[1]);

            $this->load->model("modules_db");
            $module = $this->modules_db->get_by_folder($module_folder[0]);


            if(!$module){
                if(is_dir(APPPATH."../modules/".$module_folder[0])){
                    $this->modules_db->insert($module_folder[0]);
                    $module = $this->modules_db->get_by_folder($module_folder[0]);
                }else{
                    return show_404();
                }
            }

            if(!$this->user->is_member_of_any($module->permissions['frontend']['ids']) && count($module->permissions['frontend']['ids']) != 0){
                //show_404();
                echo"Forbidden";
                return;
            }

            /*$result = $this->cache->fetch("cached-page-".$page_path);
            if($result)
            {
                echo $result;
                return;
            }*/

            if(isset($handler[0]))
                $data['contents'] = Modules::run_with_params($handler[0], $parameters[0]);


            //die("Data: ".$data['contents']);  
            
            if(!isset($handler[0]) || $data['contents'] == "__NO_MODULE__" ){
                $data['contents'] = Modules::run_with_params($handler[1], $parameters[1]);
            }else{
            }
                

                
            if($data['contents'] == "__404__" || $data['contents'] == "__NO_MODULE__")
            {
                die("blabla");
                $data = explode("-", $original_argv[0]);
                call_user_func_array(array($this, "process"), $data);
                return;
            }
                

            if(isset($_POST['be_editor_frame']))
            {
                $this->user->set_session_data('is_editor_active', true);
            }
            $this->show->frontend('full',$data);
            if(!$this->user->get_session_data('is_editor_active') && ($this->user->is_member_of("Administrators") || $this->user->is_member_of("Frontend Editor") || $this->user->is_member_of("Frontend Manager") ))
            {

                $CI = & get_instance();
                $CI->output->append_output("
                    
                        ");
            }
            global $BuilderEngine;
            if(!$BuilderEngine->is_editor_active())
                $this->BuilderEngine->register_visit($this->get_page_path());

        }
        function process($par1)
        {
            global $BuilderEngine;
            $this->show->set_frontend();
            $this->load->model('users');

            $argv = func_get_args();

            $handler = "";
            $parameters = "";
            $this->parse($argv, $handler, $parameters);


            $parameters_string = implode("/", $parameters[1]);
            $page_path = $argv[0]."/".$parameters_string;

            PC::oops($argv);
            $BuilderEngine->set_page_path($page_path);
            

            
            


            $module_folder = explode("/", $handler[1]);

            $this->load->model("modules_db");
            $module = $this->modules_db->get_by_folder($module_folder[0]);


            if(!$module){
                if(is_dir(APPPATH."../modules/".$module_folder[0])){
                    $this->modules_db->insert($module_folder[0]);
                    $module = $this->modules_db->get_by_folder($module_folder[0]);
                }else{
                    return show_404();
                }
            }
            if(!$this->user->is_member_of_any($module->permissions['frontend']['ids']) && count($module->permissions['frontend']['ids']) != 0){
                //show_404();
                echo"Forbidden";
                return;
            }

            /*$result = $this->cache->fetch("cached-page-".$page_path);
            if($result)
            {
                echo $result;
                return;
            }*/

            if(isset($handler[0]))
                $data['contents'] = Modules::run_with_params($handler[0], $parameters[0]);


            //die("Data: ".$data['contents']);  
            if(!isset($handler[0]) || $data['contents'] == "__NO_MODULE__" ){
                $data['contents'] = Modules::run_with_params($handler[1], $parameters[1]);
            }else{
            }
                

                
            
            if($data['contents'] == "__404__" || $data['contents'] == "__NO_MODULE__")
            {
                return show_404();
            }
                

            if(isset($_POST['be_editor_frame']))
            {
                $this->user->set_session_data('is_editor_active', true);
            }
            $this->show->frontend('full',$data);
            if(!$this->user->get_session_data('is_editor_active') && ($this->user->is_member_of("Administrators") || $this->user->is_member_of("Frontend Editor") || $this->user->is_member_of("Frontend Manager") ))
            {

                $CI = & get_instance();
                $CI->output->append_output("
                    
                        ");
            }
            global $BuilderEngine;
            if(!$BuilderEngine->is_editor_active())
                $this->BuilderEngine->register_visit($this->get_page_path());


            /*
            $CI = & get_instance();
            $this->cache->insert("cached-page-".$page_path, $CI->output->get_output());*/
        }

        function process_ajax($par1)
        {
            global $BuilderEngine;
            $this->show->set_frontend();
            $this->load->model('users');

            $argv = func_get_args();

            $handler = "";
            $parameters = "";

            $this->parse($argv, $handler, $parameters);

            $parameters_string = implode("/", $parameters[1]);
            $page_path = $argv[0]."/".$parameters_string;

            //$BuilderEngine->set_page_path($page_path);
            
            $output =  Modules::run_with_params($handler[0], $parameters[0]);

            if($output == "__404__" || $output == "__NO_MODULE__")
                return show_404();

            echo $output;
 
        }

        function process_editor()
        {
            //echo "Intercepted";
            global $BuilderEngine;

            $BuilderEngine->set_editor_active();
            $argv = func_get_args();
            PC::vardumps($argv, '$argv');

            if(strstr($argv[0], ".html")){
                $argv[0] = str_replace(".html", "", $argv[0]);
                $data = explode("-", $argv[0], 2);
                call_user_func_array(array($this, 'process'), $data); 
            }
                   
            else{
                call_user_func_array(array($this, 'process'), $argv);
            }
                

        }
        function process_admin($par1)
        {
            $this->load->model('users');
            
            if(!$this->user->is_member_of("Administrators"))
                redirect(base_url("/admin/main/login"), 'location');

            $argv = func_get_args();
            $handler = "";
            for($i = 0; $i < 3; $i++)
            {
                $handler .= $argv[$i]."/";
                unset($argv[$i]);
            }
            
            $handler = trim($handler ,"/");
            $argv = array_shift($argv);

            $module = explode("/", $handler);

            $this->load->model("modules_db");
            $module = $this->modules_db->get_by_folder($module[0]);

            

            if(!$this->user->is_member_of_any($module->permissions['frontend']['ids']) || count($this->user->is_member_of_any($module->permissions['frontend']['ids'])) == 0){
                show_404();
                return;
            }
            if(!is_array($argv))
                $argv = array($argv);


            $data['contents'] = Modules::run_with_params($handler, $argv);
            $breadcrumb = explode("/", $handler);
            $breadcrumb[0][0] = strtoupper($breadcrumb[0][0]);
            if(!isset($this->show->breadcrumb[0])){
                $this->show->breadcrumb[0]['name'] = $breadcrumb[0];
                $this->show->breadcrumb[0]['url'] = "";
            }
            $name = explode("_", $breadcrumb[2]);
            foreach($name as &$segment)
            {
                $segment[0] = strtoupper($segment[0]);
            }
            $breadcrumb[2] = implode(" ", $name);
            $this->show->breadcrumb[1]['name'] = $breadcrumb[2];
            $this->show->breadcrumb[1]['url'] = "#";

            $this->show->backend('blank',$data);
        }
    }
?>