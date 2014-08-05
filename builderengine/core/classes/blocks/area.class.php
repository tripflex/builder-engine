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

/*include_once("block.class.php");
    class Area{
        private $id;
        private $name;
        private $blocks = array();
        private $new = false;
        private $global = false;
        private $db;
        private $versions;
        private $BuilderEngine;
        private $page_path;
        private $class;
        private $span = " ";
        private $css = array();
        private $disable_children_float_left = false;
        private $disable_block_wrapper = false;

        function __construct($name, $class = "") {
            $this->class = $class;
            $this->name = $name;
            $ci =& get_instance();
            $ci->load->model('versions');

            $this->db =& $ci->db;
            $this->versions =& $ci->versions;
            global $BuilderEngine;
            $this->BuilderEngine =& $BuilderEngine;
        }
        function disable_children_float_left()
        {
            $this->disable_children_float_left = true;
        }
        function disable_block_wrapper()
        {
            $this->disable_block_wrapper = true;
        }
        function css($key, $value = null)
        {
            if($value == null)
            {
                if(isset($this->css[$key]))
                    return $key;
                else
                    return "";
            }

            $this->css[$key] = $value;
        }
        function enable_span12()
        {
            $this->span = " span12";
        }
        function set_global($bool)
        {
            $this->global = $bool;
        }
        function load()
        {
            $this->page_path = $this->global ? "layout" : $this->BuilderEngine->get_page_path();

            $this->db->where("name", $this->name);
            $this->db->where("page", $this->page_path );
            $query = $this->db->get("areas");
            $result = $query->result();


            if(!$result)
                return $this->initialize();

            $result = $result[0];

            $this->id = $result->id;

            $this->blocks = array();
            $result = $this->versions->get_area_blocks($this->id);
            
            foreach($result as $block)
            {
                $new_block = null;
                if($block->type == "block")
                    $new_block = new Block($block->id);
                else if($block->type == "icon")
                    $new_block = new IconSelector($block->id, $block->classes, $block->style);
                array_push($this->blocks, $new_block);
            }
        }
        function initialize()
        {
            $this->page_path  = $this->global ? "layout" : $this->BuilderEngine->get_page_path();
            $data = array(
                "name"  => $this->name,
                "page"  => $this->page_path ,
                "global"=> $this->global ? "true" : "false"
                );
            $this->db->insert("areas", $data);
            $this->id = $this->db->insert_id();
        }
        function add_block($block){
            array_push($this->blocks, $block);    
        }

        function show(){
            $this->load();
            $styler = new Styler($this->name.str_replace("/","",$this->page_path), "area ".$this->span.$this->class, false);
            $styler->css($this->css);
            echo "<div ".$styler->show(true)." page='{$this->page_path}' id='area-{$this->id}' areaid='{$this->id}'>";
            foreach ($this->blocks as $block){
                $block->set_area($this->id);

                if($this->disable_block_wrapper)
                {
                    $block->show();                    
                    continue;
                }
                $block_styler = new Styler("block-".$block->get_db_id()."-holder", "", false);

                if(!$this->disable_children_float_left)
                    $block_styler->css("float", "left");

                //echo "<div ".$block_styler->show(true)." page='{$this->page_path}' id='block-holder-{$block->get_db_id()}' areaid='{$this->id}'>";

                $block->show();
                //echo "</div>";

            } 
            echo "</div>";   
        }


    }*/
?>
