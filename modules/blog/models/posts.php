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

    class posts extends CI_Model
    {
        function search($search = "")
        {
            if($search != ""){
                $query = $this->db->query("
                    SELECT tmp.*, MATCH (tmp.`title`) AGAINST ('*$search*' IN BOOLEAN MODE) as score_title 
                    FROM ( 
                        SELECT be_posts.*, count(be_post_comments.name) as comment_num, be_blocks.data from `be_posts` 
                        LEFT JOIN `be_blocks`  on `be_posts`.`block` = be_blocks.id 
                        LEFT JOIN `be_post_comments`  on `be_posts`.`id` = be_post_comments.post_id 
                        WHERE be_blocks.active='yes'
                        ) tmp 
                WHERE MATCH (tmp.`title`) AGAINST ('*$search*' IN BOOLEAN MODE) 
                OR tmp.`data` like '%$search%' ORDER BY (score_title*2) DESC");
                
            }else{
               $query = $this->db->query("
                    SELECT tmp.* 
                    FROM ( 
                        SELECT be_posts.*, count(be_post_comments.name) as comment_num, be_blocks.data from `be_posts` 
                        LEFT JOIN `be_blocks`  on `be_posts`.`block` = be_blocks.id 
                        LEFT JOIN `be_post_comments`  on `be_posts`.`id` = be_post_comments.post_id 
                        WHERE be_blocks.active='yes'
                        ) tmp 
                 ");
                
            }
            return $query->result();
        }// DO NOT TOUCH CODE BELOW END
        function get($id = -1)
        {
            if($id != -1)
                $this->db->where("id", mysql_real_escape_string($id));

            $query = $this->db->get("posts");
            $result = $query->result();
            if(!$result)
                return false;
            else
                if($id != -1)
                    return $result[0];
                else
                    return $result;
        }
        function upload_image()
        {
            if(!is_dir("files"))
                mkdir("files");
 
            if(!is_dir("files/images"))
                mkdir("files/images");

            $file = "image";
            $this->load->library('upload');
            $config['file_name'] = md5(time()).".jpg";
            $config['upload_path'] = 'files/images/';
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
                return $config['file_name'];
            }
            return "";
        }
        function map_post_to_block($post, $block)
        {
            $update = array ("block" => $block);
            $this->db->where("id", $post);
            $this->db->update("posts", $update);
        }
        function add($post, $author)
        {
            $image = $this->upload_image();

            $data = array( 
                "title" => $post['title'],
                "date_created" => time(),
                "author" => $author,
                "image" => $image
            );

            $this->db->insert("posts", $data);
            return $this->db->insert_id();

        }

        function edit($id, $contents)
        {
            $image = $this->upload_image();

            $data = array( 
                "title" => $contents['title'],
                "image"    => $image,
            );
            $this->db->where('id', $id);
            $this->db->update('posts', $data);        
        }
        function delete($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('posts');
        }
    }
?>
