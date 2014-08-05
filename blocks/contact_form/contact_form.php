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

	class contact_form_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Contact Form";
			$info['block_icon'] = "fa-envelope-o";
			
			return $info;
		}
		public function generate_admin()
		{
			
			$this->admin_input('form_title','text','Title');
			$this->admin_input('form_target_email','text','Email To:');
			

		}
		public function generate_content()
		{
			//$this->block->auto_refresh(1000);
			if(isset($_POST['contact_form_submit']))
			{
				$to  = $this->block->data("form_target_email") ; // note the comma

				// subject
				$subject = 'Contact Form Notification';

				// message
				$message = '
				<html>
				<head>
				  <title>Birthday Reminders for August</title>
				</head>
				<body>
				  <p>A visitor submitted your website contact form</p>
				  <b>Name</b> '.$_POST['name'].'<br>
				  <b>Email</b> '.$_POST['email'].'<br>
				  <b>Comment</b> '.$_POST['comment'].'
				</body>
				</html>
				';

				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Additional headers
				$headers .= 'To: <'.$to.'>' . "\r\n";
				//$headers .= 'From: Birthday Reminder <someone@devcms.radianmx.com' . "\r\n";

				// Mail it
				mail($to, $subject, $message, $headers);
			}
			$output = '
			  <!-- Contact form -->
            <h5>'.$this->block->data("form_title").'</h5>
            <hr />
            <div class="form">
              <!-- Contact form (not working)-->
              <form class="form-horizontal" method="post">
                  <!-- Name -->
                  <div class="control-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls">
                      <input type="text" class="input-medium" id="name" name="name">
                    </div>
                  </div>
                  <!-- Email -->
                  <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                      <input type="text" class="input-medium" id="email" name="email">
                    </div>
                  </div>

                  <!-- Comment -->
                  <div class="control-group">
                    <label class="control-label" for="comment">Comment</label>
                    <div class="controls">
                      <textarea class="input-madium" id="comment" rows="3" name="comment"></textarea>
                    </div>
                  </div>
                  <input type=hidden name=contact_form_submit>
                  <!-- Buttons -->
                  <div class="form-actions">
                     <!-- Buttons -->
                    <button type="submit" class="btn">Submit</button>
                    <button type="reset" class="btn">Reset</button>
                  </div>
              </form>
            </div>


			';

			return $output;
		}
	}
?>