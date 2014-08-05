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

/* 
 * TODO: Major cleanup and optimization
 */
global $BuilderEngine;
$BuilderEngine = null;
    class BuilderEngine extends CI_Model {
        private $options = array();   
        private $global_blocks = false;
        private $user;
        private static $page_path = false;
        private static $is_editor_active = false;
        function set_blocks_global($bool)
        {
            $this->global_blocks = $bool;
        }
        function get_blocks_global() { return $this->global_blocks; }
        function __construct()
        {
            parent::__construct(); 
            $this->load_settings();
            global $active_show;
            $this->user = &$active_show->controller->user;

            global $BuilderEngine;
            if($BuilderEngine == null){
                $BuilderEngine = $this;
            }
        }
        public function is_editor_active()
        {
            return self::$is_editor_active;
        }
        public function set_editor_active()
        {
            self::$is_editor_active = true;
        }
        public function set_page_path($page_path)
        {
            self::$page_path = $page_path;
            $this->versions->load_page_blocks();
        }
        public function get_page_path()
        {
            if(!self::$page_path)
                return "{error:no_path_specified}";
            return self::$page_path;
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

        function load_settings()
        {    
            global $active_show;

            if(!$active_show->controller->is_installed())
                return;
            $result = $this->db->get("options");
            $result = $result->result();
            foreach ($result as $option)
            {
                $this->options[$option->name] = $option->value;
            }
              
        }
        function integrate_builderengine_styles()
        {?>
            <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
            <link href="http://vitalets.github.io/angular-xeditable/dist/css/xeditable.css" rel="stylesheet" />
            <link rel='stylesheet' id='font-awesome-4-css'  href='/builderengine/public/css/font-awesome.css?ver=4.0.3' type='text/css' media='all' />

            <?php

            $block = new Block('be_body_styler_'.$this->BuilderEngine->get_option('active_frontend_theme'));
            $block->set_global(true);
            if(!$block->load())
                $block->save();
            ?>
            
            <style>
            body
            {
                <?=$block->build_style(true)?>
            }
            #virtual-block-holder{
                position: absolute;
                z-index:999;
            }
            .area {
                position: relative;
                display: inline-block;
                min-width: 50px;
                min-height: 25px;
            }

               .active a{
                    background-color: #ddddff !important;
                }

                #admin-window {
                    z-index: 999999 !important;
                }
                .block-children {
                    position:relative;
                    /*display: inline-block;*/
                    float: left;
                }
                .block {
                    position: relative;
                    float: left;
                    /*display: inline-block;*/
                }
                .placeholder {
                    border: 1px dotted #888;
                    
                    -webkit-box-shadow: 0px 0px 10px #888;
                    -moz-box-shadow: 0px 0px 10px #888;
                    box-shadow: 0px 0px 10px #888;
                }
                .ui-sortable-placeholder {
                    border: 2px dotted #333;
                    -webkit-box-shadow: 0px 0px 10px #888;
                    -moz-box-shadow: 0px 0px 10px #888;
                    box-shadow: 0px 0px 10px #888;
                    visibility: visible !important;
                }
            </style>
        <?php
        }
        
        function integrate_builderengine_js()
        {
            global $active_show;
            $user = $active_show->controller->user;
            ?>

            <script src="/builderengine/public/js/jquery.js"></script>
            <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" ></script>
            
            <script src="/builderengine/public/js/editor/ckeditor.js"></script>

            <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
            <script src="http://vitalets.github.io/angular-xeditable/dist/js/xeditable.js"></script>

            
            <script type="text/javascript">
                var page_path = "<?=get_page_path()?>";
                var theme_path = "<?=get_theme_path()?>";
                var blocks_for_reload = {};
                var disable_auto_block_reload = false;
                var getting_block = false;

                var has_focus = true;
                var var_editor_mode = "";

            </script>
            <script src="/builderengine/public/js/frontend-editor.js"></script>
            <script type="text/javascript">
                function reload_block(block_name, page_path, forced)
                {
                    //if(!has_focus)
                    //    return;
                    if(!forced && disable_auto_block_reload ){
                        alert('nope ' + forced);
                        return;
                    }
                    var getting_block = true;

                    jQuery.ajax({
                        type: "POST",
                        data: { page_path: page_path },
                         url:    '/layout_system/ajax/get_block/' +block_name + '?time='+new Date().getTime(),
                         success: function(data) {
                                    $('.block').each(function(){
                                        if($(this).attr("name") == block_name){

                                            old_data = $(this).html();

                                            cloned = $(this).clone();
                                            cloned = cloned.replaceWith(data);
                                            cloned_data = cloned.html();
                                            $(this).attr('class', cloned.attr('class'));
                                            cloned.remove();
                                            if(old_data != cloned_data || forced)
                                                $(this).replaceWith(data);
                                            if(var_editor_mode == "edit")
                                                initializeCustomEditorClickEvent();
                                            if(var_editor_mode == "style")
                                                initializeStyleEditorClickEvent();
                                                                            
                                        }
                                    }); 

                                    var getting_block = false;
                                    },
                         async:   true
                    });

                    
                }
                $(document).ready(function(){
                    if(window.parent.page_url_change)
                    window.parent.page_url_change(page_path);
                    jQuery(document).bind('editor_mode_change',  function (event, action){
                        if(action == "editModeEnable")
                            var_editor_mode = "edit";
                        if(action == "blockStyleModeEnable")
                            var_editor_mode = "style";

                        console.log('Received event '+action);
                        if(action == "blockStyleModeEnable" || action == "editModeEnable" || action == 'resizeModeEnable' || action == 'moveModeEnable' || action == 'addBlockModeEnable' || action == 'deleteBlockModeEnable')
                        {
                            disable_auto_block_reload = true;
                        }

                        if(action == "blockStyleModeDisable" || action == "editModeDisable" || action == 'resizeModeDisable' || action == 'moveModeDisable' || action == 'addBlockModeDisable' || action == 'deleteBlockModeDisable')
                        {
                            var_editor_mode = "";
                            disable_auto_block_reload = false;
                        }
                    });
                    <?  $copied_block = $this->user->get_session_data("copied_block");
                    if($copied_block):?>
                        $("#paste-block-button").parent().removeClass("disabled");
                    <?endif;?>  


                    $("#editor-holder").css('display','none');
                    <? if($user->is_member_of("Administrators") || $user->is_member_of("Frontend Editor") || $user->is_member_of("Frontend Manager")): ?>
                    //$("body").css("padding-top", "45px");

                   
                    <? endif; ?>
                    //$("html").attr('ng-app','');
                    //$.getScript("http://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js");
                });
            </script>
            
            <script src="/builderengine/public/js/bootstrap-wysihtml5.js"></script>

            <?php
        }
        function get_option($name)
        {
            if (array_key_exists($name, $this->options) )
                return $this->options[$name];
            else
                return "";
        }
        function set_option($name, $value, $synch_db = true)
        {
            if($synch_db)
                if (array_key_exists($name, $this->options) )
                {
                    $this->db->where(array('name' => $name));
                    $this->db->update('options', array('value' => $value));
                }else{
                    $data = array(
                        'name' => $name,
                        'value' => $value
                    );
                    
                    $this->db->insert('options', $data);
                }
            $this->options[$name] = $value;
            
        }
        
        function get_frontend_theme()
        {
            return $this->get_option('active_frontend_theme');
        }
        function get_backend_theme()
        {
            return $this->get_option('active_backend_theme');
        }
        
        function activate_frontend_theme($theme)
        {
            $this->set_option("active_frontend_theme", $theme);
        }
        function activate_backend_theme($theme)
        {
            $this->set_option("active_backend_theme", $theme);
        }

        function register_visit($page_path)
        {
            $data = array(
                "ip"        => $_SERVER['REMOTE_ADDR'],
                "page"      => $page_path,
                "date"      => date("Y-m-d"),
                "timestamp" => time()
                );
            $this->db->insert("visits", $data);

        }
        function get_online_site_visitors($seconds = 300)
        {
            $this->db->select("COUNT(DISTINCT ip) as visitors");
            $time = time() - $seconds;
            $this->db->where("`timestamp` >= '$time'");
            $query = $this->db->get("visits");
            $result = $query->result();
            return $result[0]->visitors;
        }
        function get_total_site_visits($from, $to, $type)
        {
            global $active_show;

            if(!$active_show->controller->is_installed())
                return;

            switch($type)
            {
                case "all":
                    $this->db->select("count(*) as count");

                    $this->db->where("timestamp > $from");
                    $this->db->where("timestamp < $to");

                    $query = $this->db->get("visits");
                    $result = $query->result();
                    return intval($result[0]->count);
                    break;

                case "unique":
                    $this->db->select("count(DISTINCT `ip`) as count");

                    $this->db->where("timestamp > $from");
                    $this->db->where("timestamp < $to");
                    //$this->db->group_by("date");

                    $query = $this->db->get("visits");
                    $result = $query->result();
                    return intval($result[0]->count);
                    break;
            }
        }
        function get_site_visits($type, $days, $single_day = false)
        {
            global $active_show;

            if(!$active_show->controller->is_installed())
                return;
            
            $distinct = false;
            switch($type){
                case "unique":
                    $distinct = true;

                case "all":
                for($i = 0; $i < $days; $i++)
                {
                    $visits[$i] = 0;
                    if($single_day)
                        break;
                }

                for($i = 0; $i < $days; $i++){
                    $date = date("Y-m-d",mktime(0,0,0,date("m"),date("d") - $i));
   
                    if($distinct)
                        $this->db->select("COUNT(DISTINCT `ip`) as visits");
                    else
                        $this->db->select("COUNT(*) as visits");
                    
                    //$this->db->group_by("date");
                    if(true)
                        $this->db->where("date = '$date'");   
                    else
                        $this->db->where("date >= '$date'");
                    $this->db->order_by("date DESC");
                    
                    $query = $this->db->get("visits");
                    $result = $query->result();

      
                    $visits[$i] = $result[0]->visits;
                    
                    
                    
                }

                if(count($visits) == 1)
                    return $visits[0];
                else
                    return $visits;
                break;
            }
        }
        /*
        function get_site_visits($type, $days, $single_day = false)
        {
            $distinct = false;
            switch($type){
                case "unique":
                    $distinct = true;

                case "all":
                    $date = date("Y-m-d",mktime(0,0,0,date("m"),date("d") - $days));
                    $visits = array();

                    for($i = 0; $i < $days; $i++)
                    {
                        $visits[$i] = 0;
                        if($single_day)
                            break;
                    }
                    if($distinct)
                        $this->db->select("COUNT(DISTINCT `ip`) as visits");
                    else
                        $this->db->select("COUNT(*) as visits");
                    
                    $this->db->group_by("date");
                    if($single_day)
                        $this->db->where("date = '$date'");   
                    else
                        $this->db->where("date >= '$date'");
                    $this->db->order_by("date DESC");
                    $query = $this->db->get("visits");
                    $result = $query->result();

                    $i = 0;
                    foreach($result as $day)
                    {
                        $visits[$i] = $day->visits;
                        $i++;
                    }
                    if(count($visits) == 1)
                        return $visits[0];
                    else
                        return $visits;
                    break;
            }
        }*/


    }
?>
