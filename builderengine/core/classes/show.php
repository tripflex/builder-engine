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

    global $active_show;

    class Show{

        public $controller;
        public $frontend = false;
        public $isolated;
        public $breadcrumb;

        function Show($controller)
        {
            global $active_show;

            //Take care of initializing the active_show with the FIRST show object, otherwise multiple show objects are created
            //This causes the frontend flag and shows to mess up if more than one controller inherits BE_Controller
            if(!is_null($active_show)) return;

            $this->controller = $controller;
            $this->isolated = false;

            $active_show = $this;
            $this->breadcrumb = array();
        }
        function set_default_breadcrumb($index, $name, $url)
        {
            $this->breadcrumb[$index]['name'] = $name;
            $this->breadcrumb[$index]['url'] = $url;

        }
        function set_frontend()
        {
            global $active_show;
            $active_show->frontend = true;
        }
        function theme_file_exists($file)
        {
            return file_exists(APPPATH."..".get_theme_path().$file);   
        }

        function theme($file, $data = array())
        {
            global $active_show;
            $data['user']   = $active_show->controller->get_user();
            $data['BuilderEngine'] = $active_show->controller->get_builderengine();
            $active_show->controller->load->view("../..".get_theme_path().$file,$data);   
        }

        // parse constants ( site name, slogan, motto or whatever constant strings )
        function frontend($string, $data=array()) {


            global $active_show;

            $data['user']   = $active_show->controller->get_user();
            $data['BuilderEngine'] = $active_show->controller->get_builderengine();
            $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
            if ($_SERVER["SERVER_PORT"] != "80")
            {
                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } 
            else 
            {
                $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }

            if($data['BuilderEngine']->is_editor_active() && ($data['user']->is_member_of("Administrators") || $data['user']->is_member_of("Frontend Editor") || $data['user']->is_member_of("Frontend Manager") ))
            {
                

                
     
                $data['url'] = $pageURL;
                $view = $active_show->controller->layout_system->load->view('site_editor', $data, true);

                $active_show->controller->module_parser->parse($view);
                return;
            }else

            {
                

            }

            if(!array_key_exists('contents', $data))
                $data['contents'] = $active_show->controller->load->view($string,$data,true);

            if($active_show->isolated) {
                $active_show->controller->load->vars($data);
                $view = $data['contents'];
                
            } else {
               
                $view = $active_show->controller->load->view("../..".get_theme_path()."full.php",$data, true);
            }
            $active_show->controller->module_parser->parse($view);
            


            if(!isset($_GET['iframed']) && ($data['user']->is_member_of("Administrators") || $data['user']->is_member_of("Frontend Editor") || $data['user']->is_member_of("Frontend Manager") )){
                $ci =& get_instance();

                $parse = parse_url($pageURL);
                //print_r ($parse); 
                $editor_url = $parse['scheme']."://".$parse['host']."/editor".$parse['path']; 
                $editor_url = str_replace("index.php", "", $editor_url);
                $ci->output->append_output("
                        <style>
                        .be-edit-btn{
                            -webkit-background-clip: border-box;
                            -webkit-background-origin: padding-box;
                            -webkit-background-size: auto;
                            background-attachment: scroll;
                            background-clip: border-box;
                            background-color: rgb(88, 95, 105);
                            background-image: none;
                            background-origin: padding-box;
                            background-size: auto;
                            border-bottom-left-radius: 0px;
                            border-bottom-right-radius: 0px;
                            border-top-left-radius: 0px;
                            border-top-right-radius: 0px;
                            color: rgb(255, 255, 255);
                            cursor: pointer;
                            display: block;
                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                            font-size: 18px;
                            font-style: italic;
                            height: 28px;
                            line-height: 28.799999237060547px;
                            padding-bottom: 7px;
                            padding-left: 9px;
                            padding-right: 9px;
                            padding-top: 7px;
                            position: fixed;
                            
                            
                            width: 135px;
                            z-index: 555555;
                        }
                        #trigger
                        {
                            right: -87px;
                            top: 37px;
                        }
                        #page-styler
                        {
                            right: -100px;
                            top: 87px;
                        }

                        #launch_editor {
                            display:none;
                        }
                        </style>
                        <script>
                            $(document).ready(function (){

                                $('#trigger').hover(function () {
                                    $(this).animate({right: '0px'}, 500);
                                },
                                function () {
                                    $(this).animate({right: '-87px'}, 500);
                                }
                                );
                            })
                        </script>

                        <a href='$editor_url'><i class=\"be-edit-btn\" id='trigger'>Admin Mode</i></a>


                    ");
                }
        }

        function component($string) {
            global $active_show;
            $active_show->controller->load->view("../..".get_theme_path().$string.".php");
        }

        function backend($string, $data=array()){
            global $active_show;
            $data['BuilderEngine'] = $active_show->controller->get_builderengine();
            if(isset($active_show->breadcrumb[0]))
                $data['breadcrumb'] = $active_show->breadcrumb;
            else{
                $uri = $active_show->controller->uri->segment(2);
                
                
                $name = explode("_", $uri);

                foreach($name as &$segment)
                {
                    $segment[0] = strtoupper($segment[0]);
                }
                $name = implode(" ", $name);
                $data['breadcrumb'][0]['name'] = $name;
                $data['breadcrumb'][0]['url'] = "";

                $uri = $active_show->controller->uri->segment(3);
                $name = explode("_", $uri);
                foreach($name as &$segment)
                {
                    $segment[0] = strtoupper($segment[0]);
                }
                $name = implode(" ", $name);
                
                $data['breadcrumb'][1]['name'] = $name;
                $data['breadcrumb'][1]['url'] = "";
            }

            $data['user']   = $active_show->controller->get_user();
            $active_show->controller->load->view("../..".get_theme_path().$string.".php",$data);
        }

        //disables the full wrapper class
        function disable_full_wrapper() {
            global $active_show;
            $active_show->isolated = true;
        }


    }

    function is_installed()
    {
        global $active_show;
        return $active_show->controller->is_installed();
    }

    function get_header(){
        global $active_show;
        $active_show->controller->show->component("header");
    }

    function get_sidebar(){
        global $active_show;
        $active_show->controller->show->component("sidebar");
    }

    function get_footer(){
        global $active_show;
        $active_show->controller->show->component("footer");
    }

    function get_page_versions()
    {
        global $active_show;
        return $active_show->controller->get_page_versions();
    }

    function get_page_path(){
        global $active_show;
        return $active_show->controller->get_page_path();
    }
    function set_current_page_version_to_pending()
    {
        global $active_show;
        $controller =  &$active_show->controller;

        $page_version = $controller->versions->get_current_page_version();
        $controller->versions->set_version_pending($page_version);
    }
    function get_theme_path(){
        global $active_show;

        if($active_show->frontend)
            return "/themes/".$active_show->controller->BuilderEngine->get_frontend_theme()."/";
        else
            return "/themes/".$active_show->controller->BuilderEngine->get_backend_theme()."/";
    }

    function get_modules_url(){
        return base_url()."/modules/".$active_show->controller->BuilderEngine->get_backend_theme()."/";
    }

    function build_link($type, $relative_href)
    {
        switch($type)
        {
            case "site":
                return "/index.php/".$relative_href;
            case "module":
                return "/index.php/module/".$relative_href;
            case "module_admin":
                return "/index.php/admin/module/".$relative_href;
            case "admin":
                return "/index.php/admin/".$relative_href;

        }

    }

    function href($type, $relative_href)
    {
        return "href=\"".build_link($type, $relative_href)."\"";
        //return "href=\"#\" onclick=\"$('#content').load('".build_link($type, $relative_href)." .wrapper, script', function () { $(document).trigger('onload'); }); \"";
        //return "href=\"#\" onclick=\"ajax_load('#content', '".build_link($type, $relative_href)."?ajax=true');\"";
    }

    function get_links($tag = "")
    {
        global $active_show;
        $links = $active_show->controller->get_links($tag);
        foreach($links as $key => $link)
        {
            if($link->parent != 0)
                unset($links[$key]);
        }

        foreach($links as $key => $link)
        {
            if($link->childs)
                foreach($link->childs as &$sublink)
                    $sublink = (object)$sublink;
        }
        return $links;
    }
?>
