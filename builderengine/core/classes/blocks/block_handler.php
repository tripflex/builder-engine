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

	class block_handler {
		protected $block = null;

		function info()
		{
			return array();
		}
		function admin_textarea($var, $title, $value = "")
		{
			if($this->block->data($var) != "")
				$value = $this->block->data($var);
			echo"
			<div class=\"control-group\">
	            <label class=\"control-label\" for=\"required\" style='width: 80px'><b>$title</b></label>
	            <div class=\"controls controls-row\" style='margin-left: 85px'>
	                <textarea name=\"$var\" class=\"span11\" value='$value' ng-model='$var'>$value</textarea>
	            </div>
	        </div><!-- End .control-group  -->
	        ";
		}

		function admin_input($var, $type, $title, $value = "")
		{

			if($this->block->data($var) != "")
				$value = $this->block->data($var);
			echo"
			<div class=\"control-group\">
	            <label class=\"control-label\" for=\"required\" style='width: 80px'><b>$title</b></label>
	            <div class=\"controls controls-row\" style='margin-left: 85px'>
	                <input type=\"$type\" name=\"$var\" class=\"span11\" value='$value' ng-model='$var'>
	            </div>
	        </div><!-- End .control-group  -->
	        ";
		}

		function admin_file($var, $title, $value = "")
		{
			if($value == "")
				$value = $this->block->data($var);
			echo"
			<div class=\"control-group\">
	            <label class=\"control-label\" for=\"required\" style='width: 80px'><b>$title</b></label>
	            <div class=\"controls controls-row\" style='margin-left: 85px'>
	                <input type=\"file\" name=\"$var\" class=\"span11\" rel=\"file_manager\" file_value='$value' ng-model='$var'>
	            </div>
	        </div><!-- End .control-group  -->
	        ";
		}

		function admin_select($var, $options, $title, $value = "")
		{
			
			echo"
			<div class=\"control-group\">
	            <label class=\"control-label\" for=\"required\" style='width: 80px'><b>$title</b></label>
	            <div class=\"controls controls-row\" style='margin-left: 85px'>
	                <select name=\"$var\" class=\"span12\" >
	                ";
	                foreach($options as $val => $name)
	                {
	                	if($value == $val)
	                		echo "<option selected value='$val'>$name</option>";
	                	else
	                		echo "<option value='$val'>$name</option>";
	                }
	                echo"
	                </select>
	            </div>
	        </div><!-- End .control-group  -->
	        ";
		}
		function set_block($block)
		{
			$this->block = &$block;
		}


	}

?>