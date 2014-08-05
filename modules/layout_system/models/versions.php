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

    /**
     * @file
     * Keeps track and provides control of website page versions.
     */

    class Versions extends CI_Model
    {
        private static $active_version = array();
        private static $pending_version = array();

        private static $page_block = array();
        private $area_indexed_blocks = array();

        private static $block_relations = array();

        public function Versions()
        {
            parent::__construct();
            if(empty(self::$page_block)){
                
                $this->load_page_blocks();

            }
        }

        public function delete($version_id)
        {
            $this->db->where('id', $version_id);
            $this->db->delete('page_versions'); 
        }
        public function get_or_create_pending_version($page_path)
        {
        	$pending_version = $this->get_pending_page_version_id($page_path);
        	if(!$pending_version)
        	{
        		$pending_version = $this->create_version($page_path);
        		$this->copy_blocks_to_new_version($this->get_active_page_version_id($page_path) , $pending_version);
        	}
        	return $pending_version;
        }
        private function copy_blocks_to_new_version($old_version, $new_version)
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
                    'global'    => $block->global,
                    'type'      => $block->type,
                    'data'      => $block->data,
                    'active'    => 'no',
                );
                $this->db->insert('blocks', $data);
            }

            $this->db->where('version', $old_version);
            $query = $this->db->get("block_relations");
            $result = $query->result();

            foreach($result as $entry)
            {
                $data = array(
                    'parent'        => $entry->parent,
                    'child'         => $entry->child,
                    'version'       => $new_version,
                    'sort_order'    => $entry->sort_order,

                );
                $this->db->insert('block_relations', $data);
            }
        }
        public function get_current_page_version()
        {
            global $active_controller;

            $user = $active_controller->user;

            
            if(($user->is_member_of("Administrators") || $user->is_member_of("Frontend Editor") || $user->is_member_of("Frontend Manager")) && $this->get_pending_page_version_id($active_controller->get_page_path()) !== false )
                return $this->get_pending_page_version_id($active_controller->get_page_path()); 
            else
                return $this->get_active_page_version_id($active_controller->get_page_path());  

        }
        public function get_current_layout_version()
        {
            global $active_controller;

            $user = $active_controller->user;

            if(($user->is_member_of("Administrators") || $user->is_member_of("Frontend Editor") || $user->is_member_of("Frontend Manager")) && $this->get_pending_page_version_id("layout") !== false)
            {
                return $this->get_pending_page_version_id("layout"); 
            }else{
                return $this->get_active_page_version_id("layout");
                }   
            

        }

        public function get_pending_or_active_page_version_id($page_path)
        {
            $pending_version = $this->get_pending_page_version_id($page_path);
            if(!$pending_version){
                PC::pruc('No pending version');
                return $this->get_active_page_version_id($page_path);
            
            }else{
                PC::pruc('Pending version '.$pending_version);
                return $pending_version;
            }
        }

        public function get_active_page_version_id($page_path)
        {
            if(array_key_exists($page_path, self::$active_version)){
                PC::prucpruc('Got cached page version '.self::$active_version[$page_path].' path '.$page_path);
                return self::$active_version[$page_path];
            }

            $this->db->where("path", $page_path);
            $this->db->where("active", "yes");
            $query = $this->db->get("page_versions");
            $result = $query->result();
            
            if($result){
                PC::prucpruc('Found active version '.$result[0]->id." path ".$page_path);
                self::$active_version[$page_path] = $result[0]->id;
                return $result[0]->id;    
            }else{
                $new_version = $this->create_initial_page_version($page_path);
                PC::prucpruc('New active version '.$new_version.' Page '.$page_path);
                self::$active_version[$page_path] = $new_version;
                return $new_version;   
            }    
        }
        public function get_pending_page_version_id($page_path)
        {
            
            if(array_key_exists($page_path, self::$pending_version))
                return self::$pending_version[$page_path];

            
            $this->db->where("path", $page_path);
            $this->db->where("status", "pending");
            $query = $this->db->get("page_versions");
            $result = $query->result();
            
            if($result){
                self::$pending_version[$page_path] = $result[0]->id;
                return $result[0]->id;    
            }else{
                return false;
            }    
        }
        /*public function load_block($id)
        {
            if(empty(self::$page_block))
                $this->load_page_blocks();

            if(array_key_exists($id, self::$page_block))
                return self::$page_block[$id];
            else
                return FALSE;
        }*/
        public function get_page_versions($page_path)
        {
            $this->load->helper("object_transorm_helper");

            $this->db->where("path", $page_path);
            $this->db->order_by("time_created", "DESC"); 
            $query = $this->db->get("page_versions");
            return arrays_to_objects($query->result());
        }
        
        public function load_block($block)
        {

            if(empty(self::$page_block)){
                PC::debug('Block not found!');
                //return $this->load_block_directly($block);
            }
            //print_r(self::$page_block);
            if(array_key_exists($block->name, self::$page_block)){
                $block->initialize(self::$page_block[$block->name]);
                
                return true;
            }else
                return FALSE;

        }

        private function load_block_directly($block)
        {

            PC::debug("Loading block directly.");
            $page_path = $this->blocks->get_page_path_of($block->name);
            PC::debug("versions::load_block_directly() Page Path: $page_path");
            if($page_path === false){
                PC::error("Coudn't find page path of block name '{$block->name}'");
                return;
            }
            $pending_version = $this->get_pending_or_active_page_version_id($page_path);
            PC::debug("Loading block from version $pending_version","versions::load_block_directly");
            $this->db->where("version", $pending_version);
            $this->db->where("`name` = '{$block->name}'");

            $query = $this->db->get("blocks");
            $result = $query->result_array();


            if($result)
            {
                $this->db->where("version", $result[0]['version']);
                $this->db->where("parent", $result[0]['name']);
                $this->db->order_by('sort_order ASC');
                $query = $this->db->get("block_relations");
                $children_result = $query->result();
                if($children_result)
                {
                    $children = array();
                    foreach($children_result as $entry)
                    {
                        array_push($children, $entry->child);
                    }
                    $result[0]['children'] = $children;
                }else
                    $result[0]['children'] = array();

                $result[0] = (object)$result[0];
                $block->initialize($result[0]);
                return true;
            }else{
                return false;

            }
        }
        private function load_block_relations()
        {
            if(!empty(self::$block_relations))
                return;

            $page_version = $this->get_current_page_version();
            $layout_version = $this->get_current_layout_version();

            $this->db->where("(`version` = '$page_version'");
            $this->db->or_where("`version` = '$layout_version')");

            $this->db->order_by('sort_order ASC');

            $query = $this->db->get("block_relations");
            $result = $query->result();


            foreach($result as $entry)
            {
                if(!isset(self::$block_relations[$entry->parent]))
                    self::$block_relations[$entry->parent] = array();

                array_push(self::$block_relations[$entry->parent], $entry->child);
            }
        }

        public function load_page_blocks()
        {
            
            if(!empty(self::$page_block) && !empty(self::$block_relations))
                return;


            if($this->BuilderEngine->get_page_path() == "{error:no_path_specified}"){
                return;
            }

            $this->load_block_relations();

            $page_version = $this->get_current_page_version();
            $layout_version = $this->get_current_layout_version();

            PC::load_page_blocks("Loading blocks on page version: $page_version layout version: $layout_version");
            $this->db->where("(`version` = '$page_version'");
            $this->db->or_where("`version` = '$layout_version')");

            $this->db->order_by("ID ASC");
            $query = $this->db->get("blocks");
            $result = $query->result_array();
            foreach($result as $key => $row)
            {
                //print_r($result);
                
                if($row['version'] == 0)
                    if($row->global == "true"){
                        $this->bind_block_to_page_version($row['id'], $layout_version);
                        $result[$key]['version'] = $layout_version;
                    }else{
                        $this->bind_block_to_page_version($row['id'], $page_version);
                        $result[$key]['version'] = $page_version;
                    }

                if(isset(self::$block_relations[$row['name']])){
                    $result[$key]['children'] = self::$block_relations[$row['name']];
                }else
                    $result[$key]['children'] = array();
                $result[$key] = (object)$result[$key];
                self::$page_block[$row['name']] = $result[$key];

            }

        }
        public function create_initial_page_version($page_path)
        {
            $data = array(
                'path'          =>  $page_path,
                'author'        =>  0,
                'approver'      =>  0,
                'name'          =>  'Initial Version',
                'status'        =>  'submitted',
                'active'        =>  'yes',
                'time_created'  => time()
            );
            $this->db->insert('page_versions', $data);
            return $this->db->insert_id();
        }
        public function create_version($page_path)
        {

            global $active_controller;

            $latest_name = $this->get_last_page_version_name($page_path);


            $number = (int)preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$latest_name);
            if($number > 0)
            {
                $old_number = $number;
                $number++;
                $new_name = str_replace($old_number, $number,$latest_name); 
            }
            else
            {
                $new_name = str_replace($number, "",$latest_name);
                $new_name = trim($new_name, " ");
                $new_name .= " (1)";
            }
            $data = array(
                'path'          =>  $page_path,
                'author'        =>  $active_controller->user->get_id(),
                'name'          =>  $new_name,
                'status'        =>  'pending',
                'active'        =>  'no',
                'time_created'  =>  time()
            );
            $this->db->insert('page_versions', $data);
            return $this->db->insert_id();    
        }

        private function get_last_version($page_path)
        {
            $this->db->where("path", $page_path);
            $this->db->order_by("time_created", "DESC");
            $this->db->order_by("id", "DESC");
            $this->db->limit(1);
            
            $query = $this->db->get("page_versions");
            $result = $query->result();

            return $result;
        }
        public function get_last_page_version_name($page_path)
        {
            $result = $this->get_last_version($page_path);
            
            if($result){
                return $result[0]->name;    
            }else{
                return false;   
            }
        }

        public function rename($version_id, $new_name)
        {
            $data = array(
                "name"  => $new_name,
                );

            $this->db->where('id', $version_id);
            $this->db->update('page_versions', $data); 
        }

        public function activate_version($version_id)
        {
            $page_path = $this->get_version_path_by_id($version_id);
            $active_version = $this->get_active_page_version_id($page_path);

            $this->db->trans_start();
            $this->deactivate_version($active_version);

            $data = array(
                "active" => 'yes');

            $this->db->where('id', $version_id);
            $this->db->update('page_versions', $data);

            $this->db->where('version', $version_id);
            $this->db->update('blocks', $data);
            $this->db->trans_complete();
        }
        public function deactivate_version($version_id)
        {
            $data = array(
                "active" => 'no');

            $this->db->where('id', $version_id);
            $this->db->update('page_versions', $data);

            $this->db->where('version', $version_id);
            $this->db->update('blocks', $data);


        }
        public function approve_version($version_id)
        {
            global $active_controller;
            $data = array(
                "approver"  => $active_controller->user->get_id(),
                "status"    => 'submitted',

                );

            $this->db->where('id', $version_id);
            $this->db->update('page_versions', $data); 
        }
        public function disapprove_version($version_id)
        {
            global $active_controller;
            $data = array(
                "approver"  => -1
                );

            $this->db->where('id', $version_id);
            $this->db->update('page_versions', $data); 
        }
        public function is_version_approved($version_id)
        {
            $this->db->where('id', $version_id);
            $query = $this->db->get("page_versions");
            $result = $query->result();

            return $result[0]->approver != -1;
        }
        public function get_version_path_by_id($id)
        {
            $this->db->select("path");
            $this->db->from("page_versions");
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->result();
            
            if($result)
                return $result[0]->path;
            else
                return false;
            
        }
          

    }

?>