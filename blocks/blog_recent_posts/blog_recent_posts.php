<?
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

	class blog_recent_posts_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "Blog";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Recent Posts";
			$info['block_icon'] = "fa-envelope-o";
			
			return $info;
		}
		
		public function generate_content()
		{
			
			return $this->output();
			
		}

		function output()
		{
			$CI = & get_instance();
			$CI->load->module('blog');
			$CI->load->model('posts');


			$CI->db->limit(5);
			$CI->db->order_by('date_created DESC');
        	$recent = $CI->posts->get();

			$recent_posts = "";
			foreach($recent as $entry):
				$recent_posts .= "<li><a href='".base_url('/blog/'.$entry->id)."'>{$entry->title}</a></li>";
			endforeach;  

			$output = '
			<!-- Widget -->
  
              <div class="widget">
                 <h4>Recent Posts</h4>
                 <ul>
                    '.$recent_posts.'
                 </ul>
              </div>
			';
			return $output;
		}
	}
?>