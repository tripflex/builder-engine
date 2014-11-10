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

    /*class Blocks extends CI_Model {
        private $versions;
        public function Blocks()
        {
            $CI =& get_instance();
            $CI->load->model('versions');
            $this->versions = &$CI->versions;    
        }
        public function add($area_id, $page)
        {
            $pending_version = -1;

           

            $pending_version = $this->versions->get_pending_page_version_id($page);
            if(!$pending_version){
                $pending_version = $this->versions->create_version($page);
                $this->copy_blocks_to_new_version($this->versions->get_active_page_version_id($page) , $pending_version);
            }
                

            $data = array(
                    'version'   => $pending_version,
                    'name'      => "",
                    'content'   => "This is your new block.",
                    'style'     => "float: left",
                    'static_style'     =>"",
                    'classes'   => "",
                    'active'    => 'false',
                    'global'    => $page == "layout",
                    'area'    => $area_id,
                    'type'    => "block",

                );
            $this->db->insert('blocks', $data);
            return $this->db->insert_id();

        }
        public function delete($id)
        {
            $pending_version = $this->get_pending_version($id);

            if($pending_version == -1){
                $new_version = $this->versions->create_version($this->get_page_path($id));   
                $this->copy_blocks_to_new_version($this->get_active_version($id) , $new_version);
                $pending_version = $new_version;
            }

            echo "Pending version ".$pending_version;

            echo "DELETE FROM `be_blocks` WHERE (`id`='$id' OR `name` = '$id') AND `version` = '$pending_version'";
            $this->db->query("DELETE FROM `be_blocks` WHERE (`id`='$id' OR `name` = '$id') AND `version` = '$pending_version'");
        }
        public function save($id, $contents, $style, $classes)
        {
            $this->db->query("LOCK TABLE be_blocks WRITE, be_page_versions WRITE");
            $pending_version = $this->get_pending_version($id);
            echo "<br>ID ".$id;
            echo "<br>content ".$contents;


            if($pending_version == -1){
                $new_version = $this->versions->create_version($this->get_page_path($id));   
                echo "Copying blocks from version ".$this->versions->get_active_page_version_id($this->get_page_path($id)) ." to version $new_version <br>";
                $this->copy_blocks_to_new_version($this->versions->get_active_page_version_id($this->get_page_path($id)) , $new_version);
                $pending_version = $new_version;
            }
            echo "<br>Pending version $pending_version";
            $id = mysql_real_escape_string($id);
            $pending_version = mysql_real_escape_string($pending_version);
            
            $this->db->where("(`id` = '$id' OR `name`='$id') AND `version` = '$pending_version'");
            //$this->db->where('id', $id);
            //$this->db->or_where('name', $id);
            //$this->db->where('version', $pending_version);
            
            $data = array();
            if($classes != null)
                $data['classes'] = $classes;
            if($style != null)
                $data['style'] = $style;
            if($contents != null)
                $data['content'] = $contents;

            print_r($data);
            $this->db->update('blocks', $data);
            $this->db->query("UNLOCK TABLES");
        }
        public function copy($src_block, $src_version, $dst_block, $dst_version, $dst_area)
        {
            echo "Attepting to copy $src_block $src_version to $dst_block $dst_version";
            $this->db->where('id', $src_block);
            $this->db->where('version', $src_version);
            $query = $this->db->get("blocks");
            $result = $query->result();

            if(!$result)
                die("Error");

            $block = $result[0];

            $this->db->where("id", $dst_block);
            $data = array(

                'version'   => $dst_version,
                'name'      => "",
                'content'   => $block->content,
                'style'     => $block->style,
                'static_style'     => "",
                'classes'   => $block->classes,
                'active'    => 'false',
                'global'    => $block->global,
                'area'    => $dst_area,
                'type'    => $block->type,

            );
            $this->db->update('blocks', $data);

        }
        public function copy_blocks_to_new_version($old_version, $new_version)
        {
            $this->db->where('version', $old_version);
            $query = $this->db->get("blocks");
            $result = $query->result();

            foreach($result as $block)
            {
                $data = array(
                    'id'        => $block->id,
                    'version'   => $new_version,
                    'name'      => $block->name,
                    'content'   => $block->content,
                    'style'     => $block->style,
                    'static_style'     => $block->static_style,
                    'classes'   => $block->classes,
                    'active'    => 'false',
                    'global'    => $block->global,
                    'area'    => $block->area,
                    'type'    => $block->type,

                );
                $this->db->insert('blocks', $data);
            }
        }
        public function get_pending_version($id)
        {
            $query_str = "select be_blocks.* from be_blocks LEFT JOIN be_page_versions on be_blocks.version=be_page_versions.id where be_page_versions.status='pending' and (be_blocks.id='$id' or be_blocks.name='$id')";

            echo $query_str;
            $query = $this->db->query($query_str);
            $result = $query->result();
            
            if($result)
                return $result[0]->version;
            else
                return -1;
            
               
        }
        
        public function get_active_version($id)
        {
            $this->db->select("version");
           
            $this->db->where("(`id` = '$id' OR `name` = '$id') AND `active` = 'true'");
            
            $query = $this->db->get("blocks");
            
            $result = $query->result();
            if($result)
                return $result[0]->version;
            else
                return -1;   
        }
        public function get_block_name_by_id($id)
        {
            $this->db->select("name");
            $this->db->where('id', $id);
            $this->db->or_where('name', $id);
            
            $query = $this->db->get("blocks");
            
            $result = $query->result();
            return $result[0]->name;
          
        }
        
        public function get_block_id_by_name($id)
        {
            $this->db->select("id");
            $this->db->where('id', $id);
            $this->db->or_where('name', $id);

            
            $query = $this->db->get("blocks");
            
            $result = $query->result();
            return $result[0]->id;
          
        }
        
        
        function get_page_path($block_id)
        {
            $query_str = "select be_page_versions.path from be_blocks LEFT JOIN be_page_versions on be_blocks.version=be_page_versions.id where be_page_versions.status='submitted' and (be_blocks.id='$block_id' or be_blocks.name='$block_id') ORDER BY be_page_versions.id DESC LIMIT 1";

            echo $query_str;
            $query = $this->db->query($query_str);
            $result = $query->result();
            
            if($result)
                return $result[0]->path;
            else
                return -1;
        }

            

    }*/
?>
