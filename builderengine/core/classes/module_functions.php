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
    class ModuleSystem
    {
        private static $admin_links = array();

       /* public static function register_admin_link($module, $name, $handle)
        {
            if(!array_key_exists($module, self::$admin_links))
                self::$admin_links[$module] = array();
            
            $link['name'] = $name;
            $link['handle'] = $handle;    
            array_push(self::$admin_links[$module],$link);
            
                
        }*/
        
        public static function register_admin_link($link, $module, $handler)
        {    
            //echo "ueu";

            
            $link = explode("/", $link);

            if(!array_key_exists($link[0], self::$admin_links))
                self::$admin_links[$link[0]] = array();

            if(count($link) > 2)
            {
                $entry['name'] = $link[1];
                $entry['handle'] = $handler; 
                self::$admin_links[$link[0]][$link[1]][$link[2]] = "/index.php/admin/module/".$module."/".$handler;    
            }else if(count($link) > 1){
                self::$admin_links[$link[0]][$link[1]] = "/index.php/admin/module/".$module."/".$handler;
            }
            
                        
                
        }
        
        public static function get_admin_links()
        {

            
            return self::$admin_links;
                
        }
    }
    function register_admin_link($module, $name, $handle)
    {                           
        ModuleSystem::register_admin_link($module, $name,  $handle);   
    }
    function get_admin_links()
    {
        populate_admin_links(); 
        return ModuleSystem::get_admin_links();
    }
    
    
    function MenuItem($string){
        global $attr_module;
        global $attr_function;
        //echo $string."<br>";
        ModuleSystem::register_admin_link($string, $attr_module, $attr_function);   
            
   
    };
    
    function get_comment_blocks($string)
    {
        $comments = explode ("//",$string);
        unset($comments[0]);
        
        $result = array();
        foreach($comments as $key => $value)
        {
            $data = explode("\n", $comments[$key]);
            $result[$key]['comment'] = $data[0];
            
            $function = "";
            $main_data = $data;
            for($j = 1; $j < count($main_data); $j++){
                $data = explode("function", $main_data[$j]);
                
                if(count($data) > 1){
                    $data = explode("(", $data[1]);
                    $function = trim($data[0], " ");
                    
                    for($i = $key-1 ; $i > 0; $i--)
                    {
                        if($result[$i]['function'] == "")
                           $result[$i]['function'] = $function;
                        else
                            break;     
                    }
                    break;
                }
            }
            $result[$key]['function'] = $function;
            
        }

        return $result;
    }
    function extract_attributes($comments)
    {
        if(!is_array($comments))
            return array();
        
        $attributes = array();
        
        //print_r($comments);    
        foreach($comments as $comment)
        {
            $data = explode("[", $comment['comment']);
            unset($data[0]);
            
            foreach($data as $key => $entry){   

                $data[$key] = substr($data[$key], 0, strpos($data[$key], "]")).";";
                $attribute['attribute'] = $data[$key];
                $attribute['function'] = $comment['function'];
                 
                array_push($attributes, $attribute);   
            }
  
        }
        return $attributes;    
    }
    function invoke_attributes($module, $file)
    {
        global $attr_module;
        global $attr_function;
        $attr_module = $module;
        $comments = get_comment_blocks($file);
        $attributes = extract_attributes($comments);
        
        foreach($attributes as $attribute)
        {
            $attr_function = $attribute['function'];
            eval($attribute['attribute']);
        }        
    };
    function populate_admin_links()
    {
        $dir    = 'modules';
        
        global $cache;
        $results = $cache->fetch("f_populate_admin_links-modules");

        if(!$results)
        {
            $results = scandir($dir);
            $cache->insert("f_populate_admin_links-modules", $results);
        }

        
        
        foreach( $results as $module)
        {
            if($module == "." || $module == "..")
                continue;
            
            if(strpos($module,'_child') !== false)
            {
                $file_path = "modules/".$module."/controllers/admin_child.php";
                $module = str_replace("_child", "", $module);
            }else
            {
                $file_path = "modules/".$module."/controllers/admin.php";
            }
              
            if(file_exists($file_path))
            {
                $file = file_get_contents($file_path);
                
                invoke_attributes($module, $file);
            }

            
        }

    }  
    function get_modules()
    {
       /* $dir    = 'modules';
        $results = scandir($dir);
                        
        $modules = array();
        foreach( $results as $result)
        {
            if($result == "." || $result == "..")
                continue;
            
                
            if(is_dir("modules/".$result)){
                if(file_exists("modules/".$result."/config/general.php"))
                    include_once("modules/".$result."/config/general.php");
                $entry['name'] = $result;
                $entry['name'][0] = strtoupper($result[0]);
                $entry['folder_name'] = $result;
                global $menus;

                $entry['menus'] = $menus; 
                 
                array_push($modules, (object)$entry);
            }
        }
        fire_action("module_init");
        return $modules; */
    }
      function parse($argv, &$handler, &$parameters)
        {
            $handler = "";
            $parameters = array();
            
            $i = 0;
            $data = $argv;
            $handler = $data[$i++];
            
            if(count($data) > 1 && file_exists("modules/".$data[0]."/controllers/".$data[$i].".php"))
            {
                
                $handler .= "/".$data[$i++];
                $contents = file_get_contents("modules/".$data[0]."/controllers/".$data[1].".php");
                if(strstr($contents, "function ".$data[$i])){
                    $handler .= "/".$data[$i++];    
                }
            }
            else
            {

                if(count($data) > 1 && file_exists("modules/".$data[0]."/"."controllers/".$data[0].".php"))
                {
                    $contents = file_get_contents("modules/".$data[0]."/controllers/".$data[0].".php");  
                    if(strstr($contents, "function ".$data[$i])){
                        $handler .= "/".$data[$i++];    
                    }
                }
            }
            
            for($j = $i; $j < count($data); $j++)
            {
                array_push($parameters, $data[$j]);    
            }   
            

        }
        function process($par1)
        {
            $this->load->model('users');

            $argv = func_get_args();
            
            $parameters = $argv[0];
            
            for($i = 1; $i < func_num_args(); $i++)
            {
                //$this->is_valid($handler);
                $parameters .= "/".$argv[$i];  
            }
            $handler = "";
            $parameters = "";
            
            $this->parse($argv, $handler, $parameters);
            
            switch(count($parameters))
            {
                case 0:
                    $data['contents'] = Modules::run($handler);
                    break;
                case 1:
                    $data['contents'] = Modules::run($handler,$parameters[0]);
                    break;
                case 2:
                    $data['contents'] = Modules::run($handler,$parameters[0],$parameters[1]);
                    break;
                case 3:
                    $data['contents'] = Modules::run($handler,$parameters[0],$parameters[1],$parameters[2]);
                    break;
                case 4:
                    $data['contents'] = Modules::run($handler,$parameters[0],$parameters[1],$parameters[2],$parameters[3]);
                    break;
                case 5:
                    $data['contents'] = Modules::run($handler,$parameters[0],$parameters[1],$parameters[2],$parameters[3],$parameters[4]);
                    break;
                case 6:
                    $data['contents'] = Modules::run($handler,$parameters[0],$parameters[1],$parameters[2],$parameters[3],$parameters[4],$parameters[5]);
                    break;
                case 7:
                    $data['contents'] = Modules::run($handler,$parameters[0],$parameters[1],$parameters[2],$parameters[3],$parameters[4],$parameters[5],$parameters[6]);
                    break;
                case 8:
                    $data['contents'] = Modules::run($handler,$parameters[0],$parameters[1],$parameters[2],$parameters[3],$parameters[4],$parameters[5],$parameters[6],$parameters[7]);
                    break;
            }


            
            $this->show->frontend('full',$data); 
        }
?>
