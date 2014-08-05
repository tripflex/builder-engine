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

    class pages extends CI_Model
    {
        function search($search = "")
        {
            if($search != ""){
                $query = $this->db->query("SELECT *,MATCH (`title`) AGAINST ('*$search*' IN BOOLEAN MODE) as score_title, MATCH (`content`) AGAINST ('$search') as score_content FROM (`be_posts`) WHERE MATCH (`title`) AGAINST ('*$search*' IN BOOLEAN MODE) OR MATCH (`content`) AGAINST ('$search') ORDER BY ((score_title*2)+score_content) DESC");
            }else{
                $this->db->order_by("date_created DESC");
                $query = $this->db->get("pages");
            }

            return $query->result();
            }
        function get($id)
        {
            $this->db->where("id", mysql_real_escape_string($id));
            $query = $this->db->get("pages");
            $result = $query->result();
            return $result[0];
        }
        
        function get_by_slug($slug)
        {
            $this->db->where("slug", mysql_real_escape_string($slug));
            $query = $this->db->get("pages");
            $result = $query->result();
            if($result)
                return $result[0];
            else
                return null;
        }
        function add($post, $author)
        {
            global $user;
            $data = array( 
                "title" => $post['title'],
                "template" => $post['template'],
                "date_created" => time(),
                "author" => $author, 
                "slug"  => $post['slug']
            );

            $this->db->insert("pages", $data);
        }

        function edit($id, $contents)
        {
            $data = array( 
                "title" => $contents['title'],
                "slug"  => $contents['slug']
            );
            $this->db->where('id', $id);
            $this->db->update('pages', $data);        
        }
        function delete($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('pages');
        }
    }
?>
