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

	class be_breadcrumb
	{
		private $data = array();
		private $css_class = array();
		private $settings = array();

		public function __construct()
		{
			$this->default_settings();
		}
		private function default_settings()
		{
			$this->settings['disable_divider'] = false;
		}
		public function add_css_class($class)
		{
			array_push($this->css_class, $class);
		}
		public function insert($arg, $url = "", $title = "")
		{
			if(is_array($arg))
			{
				if(!isset($arg['name']))
					throw("You did not provide a name for you breadcrumb entry.");

				if(!isset($arg['url']))
					$arg['url'] = "";

				if(!isset($arg['title']))
					$arg['title'] = "";

				$name = $arg['name'];
			}else
			{
				$name = $arg;
			}

			$entry['name']	= $name;
			$entry['url']	= $url;
			$entry['title']	= $title;

			array_push($this->data, (object)$entry);
		}

		public function get()
		{
			return $this->data;
		}

		public function generate()
		{
			$html = '<ul class="breadcrumb';
			foreach($this->css_class as $css_class)
				$html .= " ".$css_class;

			$html .='">';

			$i = 1;
			foreach($this->data as $entry)
			{
				if (count($this->data) != $i)
					if($this->settings['disable_divider'])
						$html .= '<li><a href="'.$entry->url.'" title="'.$entry->title.'">'.$entry->name.'</a></li>';
					else
						$html .= '<li><a href="'.$entry->url.'" title="'.$entry->title.'">'.$entry->name.'</a> <span class="divider">/</span></li>';
				else
					$html .= '<li class="active"><a href="'.$entry->url.'" title="'.$entry->title.'">'.$entry->name.'</a></li>';

				$i++;
			}

			$html .= '</ul>';
			
			return $html;
		}

		// Settings functions
		public function disable_divider()
		{
			$this->settings['disable_divider'] = true;
		}
	}
	class be_presentation extends CI_Model
	{
		public $breadcrumb = null;

		public function __construct()
		{
			$this->breadcrumb = new be_breadcrumb();
		}
	}