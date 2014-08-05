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

	class address_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Address";
			$info['block_icon'] = "fa-envelope-o";
			
			return $info;
		}
		public function generate_admin()
		{
			$this->admin_input('home_address','text','Home Address');
			$this->admin_input('phone_number','text','Phone Number');
			$this->admin_input('email_address','text','Email Address');

		}
		public function generate_content()
		{
			//$this->block->auto_refresh(1000);
			$output = '
			
			<h5>Contact</h5>
			<hr />
			<div class="social">
				<a href="https://www.facebook.com/BallybaneEnterpriseCentre"><i class="icon-facebook facebook">&nbsp;</i></a>
				<a href="https://twitter.com/bbecentre"><i class="icon-twitter twitter">&nbsp;</i></a>
				<a href="http://www.linkedin.com/groups/SCCUL-Entrepreneur-Year-Awards-4203663?gid=4203663"><i class="icon-linkedin linkedin">&nbsp;</i></a>
				<a href="#"><i class="icon-google-plus google-plus">&nbsp;</i></a> 
			</div>
			<hr />
			<i class="icon-home">&nbsp;</i> &nbsp; '.$this->block->data("home_address").'
			<hr />
			<i class="icon-phone">&nbsp;</i> &nbsp; '.$this->block->data("phone_number").'
			<hr />
			<i class="icon-envelope-alt">&nbsp;</i> &nbsp; <a href="mailto:'.$this->block->data("email_address").'">'.$this->block->data("email_address").'</a>
			<hr />';

			return $output;
		}
	}
?>