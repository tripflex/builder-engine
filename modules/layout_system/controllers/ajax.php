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

	class Ajax extends Module {
		public function versions_window($mode)
		{
			$this->user->require_group("Frontend Manager");
			
	        $page_path = urldecode($_REQUEST['page_path']);
	        if($mode == "page")
	            $page_versions = $this->versions->get_page_versions($page_path);
	        else
	            $page_versions = $this->versions->get_page_versions("layout");
	        foreach($page_versions as &$version)
	        {

	            if($version->author == 0)
	                $version->author = "System";
	            else
	            {
	                $author = $this->users->get_by_id($version->author);

	                $version->author = ($author->name != "") ? $author->name : $author->username;
	            }

	            if($version->approver == 0)
	                $version->approver = "System";
	            else if($version->approver == -1)
	            {
	                $version->approver = "N/A";
	            }else
	            {
	                $approver = $this->users->get_by_id($version->approver);
	                $version->approver = ($approver->name != "") ? $approver->name : $approver->username;
	            }


	        }
	        $data['mode'] = $mode;
	        $data['page_versions'] = $page_versions;


	        $this->load->view("versions_manager", $data);
    	}
    	function admin_popup()
    	{
    		$this->load->view('admin_popup');
    	}
    	function block_admin($block_name)
    	{
    		$page_path = $_GET['page_path'];
    		PC::debug("Setting page path to ".$page_path);
        	$this->BuilderEngine->set_page_path($page_path);

    		$block = new Block($block_name);

    		$block->load();
    		PC::debug($block, "ajax::block_admin");
    		if(isset($_POST['block_save']))
    		{
    			foreach($_POST as $key => $value)
    			{
    				$block->set_data($key, $value, true);
    			}
    			$block->save();
    		}
    		echo '
    			<script src="/builderengine/public/js/jquery.js"></script>
				<link href="/themes/dashboard/css/bootstrap/bootstrap.css" rel="stylesheet" />
				<link href="/themes/dashboard/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
				<script src="/builderengine/public/js/bootstrap.js"></script> <!-- Bootstrap -->
    			<script>
    			$(document).ready(function () {
    				$("#block-admin-save").click(function (event){
    					$("#block-admin-save").html("Saving...");
    					$.ajax( {
					        url: "/index.php/layout_system/ajax/block_admin/'.$block_name.'?page_path='.$page_path.'",
					        async: false,
					        type: "post",          
					        data: $("#block-admin-form").serialize(),
					    }).fail(function (data){alert(console.log(data))});
						window.parent.reload_block(\''.$block_name.'\', window.parent.page_path, true);
						$("#admin-window").remove();

					event.preventDefault();
						
    				});
				});
    			</script>
    			<script src="/themes/dashboard/js/plugins/file_manager.js"></script>
    		';
    		echo '<div class="container">
    		


    		<form class="form-horizontal" id="block-admin-form" method="post">
    		<input type="hidden" name="block_save" name="">
    		<input type="hidden" name="page_path" value="'.$page_path.'">';
    		
    		$block->generate_admin();
    		echo '

    			<div class=\"control-group\">
	            	<div class=\"controls controls-row\">
	            		<input id="block-admin-save" type="submit" class="btn btn-primary" value="Save">
            		</div>
            	</div>
	            		';
    		echo '</form></div>';
    	}

    	function block_styler($block_name)
    	{
    		
    		$page_path = $_GET['page_path'];
    		PC::debug("Setting page path to $page_path");
        	$this->BuilderEngine->set_page_path($page_path);

    		$block = new Block($block_name);

    		$block->load();
    		if($block->is_global()){
    			PC::WARNING("Block $block_name is global so we change page path");
    			$this->BuilderEngine->set_page_path('layout');
    		}
    		PC::debug($block, "ajax::block_styler");

    		if(isset($_POST['block_save']))
    		{
    			PC::WARNING($_POST);
    			unset($_POST['page_path']);
    			unset($_POST['block_save']);

    			$block->set_data("style", $_POST, true);
    			$block->save();
    		}
    		echo '
    			<script src="/builderengine/public/js/jquery.js"></script>
				<link href="/themes/dashboard/css/bootstrap/bootstrap.css" rel="stylesheet" />
				<link href="/themes/dashboard/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
				<script src="/builderengine/public/js/bootstrap.js"></script> <!-- Bootstrap -->
    			<script>
    			function enable_disable_font_fields()
    			{
    				$("[name=\'color\']").attr(\'disabled\',!$("[name=\'font-color_override\']").attr("checked"));
    				$("[name=\'color\']").spectrum({
	                        preferredFormat: "hex6",
	                        color: $(this).attr("value"),
	                        showInput: true,
	                        showInitial: true,     
	                        clickoutFiresChange: true,
	                        chooseText: "Select",
	                        cancelText: "Close"
                    	});
    				$("[name=\'color_old\']").attr(\'disabled\',!$("[name=\'font-color_override\']").attr("checked"));

    				$("[name=\'font-family\']").attr(\'disabled\',!$("[name=\'font-color_override\']").attr("checked"));
					$("[name=\'font-family-2\']").attr(\'disabled\',!$("[name=\'font-color_override\']").attr("checked"));
					$("[name=\'font-weight\']").attr(\'disabled\',!$("[name=\'font-color_override\']").attr("checked"));
					$("[name=\'font-size\']").attr(\'disabled\',!$("[name=\'font-color_override\']").attr("checked"));
    			}
    			function enable_disable_bg_color_fields()
    			{
    				$("[name=\'background-color\']").attr(\'disabled\',!$("[name=\'background-color_override\']").attr("checked"));
    				$("[name=\'background-color_old\']").attr(\'disabled\',!$("[name=\'background-color_override\']").attr("checked"));

					$("[name=\'background-color\']").spectrum({
	                        preferredFormat: "hex6",
	                        color: $("[name=\'background-color\']").attr("value"),
	                        showInput: true,
	                        showInitial: true,     
	                        clickoutFiresChange: true,
	                        chooseText: "Select",
	                        cancelText: "Close"
                    	});
    				
    			}

    			function enable_disable_border_fields()
    			{
    				$("[name=\'border-color\']").attr(\'disabled\',!$("[name=\'border_override\']").attr("checked"));
    				$("[name=\'border-color_old\']").attr(\'disabled\',!$("[name=\'border_override\']").attr("checked"));
    				$("[name=\'border-style\']").attr(\'disabled\',!$("[name=\'border_override\']").attr("checked"));
					$("[name=\'border-width\']").attr(\'disabled\',!$("[name=\'border_override\']").attr("checked"));

					$("[name=\'border-color\']").spectrum({
	                        preferredFormat: "hex6",
	                        color: $("[name=\'border-color\']").attr("value"),
	                        showInput: true,
	                        showInitial: true,     
	                        clickoutFiresChange: true,
	                        chooseText: "Select",
	                        cancelText: "Close"
                    	});
    				
    			}

    			function enable_disable_bg_image_fields()
    			{
	  
    				$("[name=\'background-image_old\']").attr(\'disabled\',!$("[name=\'background-image_override\']").attr("checked"));
					$("[name=\'background-image\']").attr(\'disabled\',!$("[name=\'background-image_override\']").attr("checked"));
					$("[name=\'background-repeat\']").attr(\'disabled\',!$("[name=\'background-image_override\']").attr("checked"));

    			}
    			$(document).ready(function () {
    				enable_disable_font_fields();
    				enable_disable_bg_color_fields();
    				enable_disable_bg_image_fields();
    				enable_disable_border_fields();

    				$("[name=\'font-color_override\']").click(function(){
						enable_disable_font_fields(); 
					});
					$("[name=\'background-color_override\']").click(function(){
						enable_disable_bg_color_fields(); 
					});

					$("[name=\'background-image_override\']").click(function(){
						enable_disable_bg_image_fields(); 
					});
					$("[name=\'border_override\']").click(function(){
						enable_disable_border_fields(); 
					});

    				$(".color-picker").each(function () {
    					$(this).spectrum({
	                        preferredFormat: "hex6",
	                        color: $(this).attr("value"),
	                        showInput: true,
	                        showInitial: true,     
	                        clickoutFiresChange: true,
	                        chooseText: "Select",
	                        cancelText: "Close"
                    	});
					});

    				$("#block-admin-save").click(function (event){
    					block_name = "'.$block_name.'";

    					$("#block-admin-save").html("Saving...");
    					$.ajax( {
					        url: "/index.php/layout_system/ajax/block_styler/'.$block_name.'?page_path='.$page_path.'",
					        async: false,
					        type: "post",          
					        data: $("#block-admin-form").serialize(),
					    }).fail(function (data){alert(console.log(data))});
						window.parent.reload_block(\''.$block_name.'\', window.parent.page_path, true);
						$("#admin-window").remove();
						if(block_name == "be_body_styler"){
							setTimeout(\'var iframe = window.parent.document.getElementById("content-frame");iframe.src = iframe.src;\',1500);
							
            				
						}
					event.preventDefault();
						
    				});
				});
    			</script>
    			<script src="/themes/dashboard/js/plugins/file_manager.js"></script>
    		';
    		echo '<div class="container">
    		


    		<form class="form-horizontal" id="block-admin-form" method="post">
    		<input type="hidden" name="block_save" name="">
    		<input type="hidden" name="page_path" value="'.$page_path.'">';
    		
?>			<link href="/themes/dashboard/js/plugins/forms/spectrum/spectrum.css" rel="stylesheet" /> 

            <script src="/themes/dashboard/js/plugins/forms/spectrum/spectrum.js"></script><!--  Color picker -->
			<div style="border-width: 1px;border-color: #ddd;border-radius: 4px 4px 0 0;border-style: solid;">
				<ul id="myTab" class="nav nav-tabs">
				  <li class="active"><a href="#general" data-toggle="tab">General</a></li>
				  <li><a href="#position" data-toggle="tab">Position</a></li>
				  <li><a href="#border" data-toggle="tab">Border</a></li>
				  <li><a href="#font" data-toggle="tab">Font</a></li>
				  <li><a href="#background" data-toggle="tab">Background</a></li>
				  <li><a href="#custom" data-toggle="tab">Advanced</a></li>

				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  	<div class="tab-pane active" id="general">
			  			<?
			  			$block->admin_select('display',array(
			  				"inline" 				=> "Inline (Default)",
			  				"block" 				=> "Block",
			  				"initial"	 			=> "Initial",
			  				
			  				"inline-block" 			=> "Inline-Block",
			  				"inline-table" 			=> "Inline-Table",
			  				"list-item" 			=> "List-Item",
			  				"run-in" 				=> "Run-In",
			  				"table" 				=> "Table",
			  				"table-caption" 		=> "Table-Caption",
			  				"table-column-group" 	=> "Table-Column-Group",
			  				"table-header-group" 	=> "Table-Header-Group",
			  				"table-footer-group" 	=> "Table-Footer-Group",
			  				"table-row-group" 		=> "Table-Row-Group",
			  				"table-cell" 			=> "Table-Cell",
			  				"table-column" 			=> "Table-Column",
			  				"table-row" 			=> "Table-Row",
			  				"none" 					=> "None",
			  				"inherit" 				=> "Inherit"
			  				),'Display');
			  			$block->admin_select('position',array(
			  				"static" 		=> "Static (Default)",
			  				"relative" 		=> "Relative",
			  				"initial" 		=> "Initial",
			  				"absolute" 		=> "Absolute",
			  				
			  				"inherit" 		=> "Inherit"),'Position');

			  			$block->admin_input('z-index',"text",'Z-Index');
			  				
			  				?>

						
					</div>
					<div class="tab-pane" id="position">
						<div class="tabbable tabs-left">
			              <ul class="nav nav-tabs" id="slider-settings">
			                <li class="active"><a href="#positions" data-toggle="tab">Position</a></li>
			                <li><a href="#margin" data-toggle="tab">Margin</a></li>
			                <li><a href="#padding" data-toggle="tab">Padding</a></li>
			              </ul>
			              <div class="tab-content" id="some-tabs" style="height: 240px; overflow-y: scroll">
			                <div class="tab-pane active" id="positions" >
			                	<?
								$block->admin_input('top',"text",'Top', '', 'Sets the top edge position in px, cm, etc. Negative values are allowed.');
								$block->admin_input('right',"text",'Right', '', 'Sets the right edge position in px, cm, etc. Negative values are allowed.');
								$block->admin_input('bottom',"text",'Bottom', '', 'Sets the bottom edge position in px, cm, etc. Negative values are allowed.');
								$block->admin_input('left',"text",'Left', '', 'Sets the top left position in px, cm, etc. Negative values are allowed.');
								?>
			                </div>
			                <div class="tab-pane" id="position" >
								<?
								$block->admin_input('margin-top',"text",'Top', '', 'Specifies a margin in px, pt, cm, etc. Default value is 0px');
								$block->admin_input('margin-right',"text",'Right', '', 'Specifies a margin in px, pt, cm, etc. Default value is 0px');
								$block->admin_input('margin-bottom',"text",'Bottom', '', 'Specifies a margin in px, pt, cm, etc. Default value is 0px');
								$block->admin_input('margin-left',"text",'Left', '', 'Specifies a margin in px, pt, cm, etc. Default value is 0px');
								?>
			                </div>
			                <div class="tab-pane" id="margin" >
								<?
								$block->admin_input('margin-top',"text",'Top', '', 'Specifies a margin in px, pt, cm, etc. Default value is 0px');
								$block->admin_input('margin-right',"text",'Right', '', 'Specifies a margin in px, pt, cm, etc. Default value is 0px');
								$block->admin_input('margin-bottom',"text",'Bottom', '', 'Specifies a margin in px, pt, cm, etc. Default value is 0px');
								$block->admin_input('margin-left',"text",'Left', '', 'Specifies a margin in px, pt, cm, etc. Default value is 0px');
								?>
			                </div>

			                <div class="tab-pane" id="padding" >
			                	<?
								$block->admin_input('padding-top',"text",'Top', '', 'Defines a fixed padding (in pixels, pt, em, etc.)');
								$block->admin_input('padding-right',"text",'Right', '', 'Defines a fixed padding (in pixels, pt, em, etc.)');
								$block->admin_input('padding-bottom',"text",'Bottom', '', 'Defines a fixed padding (in pixels, pt, em, etc.)');
								$block->admin_input('padding-left',"text",'Left', '', 'Defines a fixed padding (in pixels, pt, em, etc.)');
								?>
			                </div>
			            	

			              </div>
			            </div>
					</div>
					<div class="tab-pane" id="border">
			  			<?
			  			$block->admin_input("border_override","checkbox", "Enable");
			  			$block->admin_select('border-style',array(
			  				"none" => "None",
			  				"hidden" => "Hidden",
			  				"dotted" => "Dotted",
			  				"dashed" => "Dashed",
			  				"solid" => "Solid",
			  				"double" => "Double",
			  				"groove" => "Groove",
			  				"ridge" => "Ridge",
			  				"inset" => "Inset",
			  				"outset" => "Outset",
			  				"initial" => "Initial",
			  				"inherit" => "Inherit",
							),'Border');

						$block->admin_input('border-width',"text",'Width', '', 'Default value is 0px');


			  			$block->admin_color_picker("border-color","Color");
			  				?>
					</div>
					<div class="tab-pane" id="font">
			  			<?

			  			$block->admin_input("font-color_override","checkbox", "Enable");
			  			$block->admin_color_picker("color","Color");
			  			$block->admin_input("font-size","text", "Font Size",'','Font size in pixels. (Example 10px)');
			  			$block->admin_select('font-family',array(
			  				"Times New Roman" => "Times New Roman",
			  				"Arial" => "Arial",
			  				"Verdana" => "Verdana",
						),'Family');
			  			$block->admin_select('font-family-2',array(
			  				"sans-serif" => "Sans-Serif",
			  				"serif" => "Serif",
			  				"cursive" => "Cursive",
			  				"fantasy" => "Fantasy",
			  				"monospace" => "Monospace",

						),'Type');
						$block->admin_select('font-weight',array(
			  				"normal" => "Normal",
			  				"bold" => "Bold",
			  				"bolder" => "Bolder",
			  				"lighter" => "Lighter",
			  				"100" => "100",
							"200" => "200",
							"300" => "300",
							"400" => "400",
							"500" => "500",
							"600" => "600",
							"700" => "700",
							"800" => "800",
							"900" => "900",
							"inherit" => "Inherit",

						),'Weight');
			  			?>
					</div>
					<div class="tab-pane" id="background">
						<div class="tabbable tabs-left">
			              <ul class="nav nav-tabs" id="slider-settings">
			                <li class="active"><a href="#bg-color" data-toggle="tab">Color</a></li>
			                <li><a href="#bg-image" data-toggle="tab">Image</a></li>
			              </ul>
			              <div class="tab-content" id="" style="height: 240px; overflow-y: scroll">
			                <div class="tab-pane active" id="bg-color" >
			                	<?

					  			$block->admin_input("background-color_override","checkbox", "Enable");
					  			$block->admin_color_picker("background-color","Color");
					  			
					  			?>
			                </div>

			                <div class="tab-pane" id="bg-image" >
								<?

					  			$block->admin_input("background-image_override","checkbox", "Enable");
					  			$block->admin_file('background-image','Image: ');
					  			$block->admin_select('background-repeat',array(
					  				"repeat" => "Repeat",
					  				"repeat-x" => "Repeat-X",
					  				"repear-y" => "Repeat-Y",
					  				"no-repeat" => "No-Repeat",
					  				"initial" => "Initial",
									"inherit" => "Inherit",

								),'Repeat: ');
					  			?>
			                </div>
			            	

			              </div>
			            </div>
					</div>
					<div class="tab-pane" id="custom">

						<?
						$block->admin_input("custom_classes","text", "Classes");
						$block->admin_textarea('custom',"CSS");
						if($block->name == "be_body_styler_".$this->BuilderEngine->get_option('active_frontend_theme'))
							$block->admin_textarea('custom_code',"Code");
						?>
					</div>

				</div>
			</div>

<?
    		echo '

    			<div class=\"control-group\">
	            	<div class=\"controls controls-row\">
	            		<input id="block-admin-save" type="submit" class="btn btn-primary" value="Save">
            		</div>
            	</div>
	            		';
    		echo '</form></div>';
    	}
    	function is_page_pending_submission()
    	{
    		$page_path = $_POST['page_path'];

    		$version_id = $this->versions->get_pending_page_version_id($page_path);
	        if($version_id)
	        	echo 'true';
	        else
	        	echo 'false';
    	}
    	function delete_version($id)
		{
		    $this->user->require_group("Frontend Manager");
		    $this->versions->delete($id);
		}
    	function version_set_name()
        {
            $this->user->require_group("Frontend Manager");
            $version    = $_REQUEST['id'];
            $new_name   = urldecode($_REQUEST['new_name']);
            $this->versions->rename($version, $new_name);
        }

        public function save_block_children()
	    {
	    	$this->BuilderEngine->set_page_path($_REQUEST['page_path']);

	        $name 		= $_REQUEST['name'];
	        //$page_path 	= mysql_real_escape_string($_REQUEST['page']);
	        $children 	= json_decode($_REQUEST['children']);
	        //$version_id = $this->versions->get_pending_page_version_id($page_path);
	        $block = new Block($name);
	        $block->load();
	        $block->remove_children();

	        foreach($children as $child_name)
	        {
	        	$child = new Block($child_name);
	        	$block->add_block($child);
	        }
	        $block->save();
	        
	        


	        //$this->db->query("UNLOCK TABLES");
	    }

        function save_block()
        {
        	PC::blabla($_POST['page_path']);
        	$page_path = $_POST['page_path'];
        	$this->BuilderEngine->set_page_path($page_path);
        	PC::Block("Saving block with page path". $this->BuilderEngine->get_page_path());
	        $name 		= $_REQUEST['name'];

	        $block = new Block($name);
	        $block->load();
	       // PC::Block($block);
	        $block->force_data_modification();

	        if(isset($_REQUEST['content']))
	       		$block->set_data('content', $_REQUEST['content'], true);

			if(isset($_REQUEST['size'])){
	       		$block->set_data('size', $_REQUEST['size'], true);
	       		$block->set_css('min-height', $_REQUEST['height']);
	       	}
	       	//PC::Block($block);
	        $block->save();

        }

        public function publish_version()
	    {
	        //$this->db->query("LOCK TABLE be_blocks WRITE, be_page_versions WRITE, be_user_groups WRITE");
	        $page_path = mysql_real_escape_string($_REQUEST['page']);
	        $version_id = $this->versions->get_pending_page_version_id($page_path);
	        if($version_id)
	        {  
	            $this->toggle_version_approved($version_id);
	            $this->version_activate($version_id);
	        }
	        $page_path = "layout";
	        $version_id = $this->versions->get_pending_page_version_id($page_path);
	        if($version_id)
	        {
	            $this->toggle_version_approved($version_id);
	            $this->version_activate($version_id);
	        }


	        //$this->db->query("UNLOCK TABLES");
	    }
	    function toggle_version_approved($id)
	    {
	        $this->user->require_group("Frontend Manager");
	        if($this->versions->is_version_approved($id))
	            echo "Approved";
	        else
	            echo "Not Approved";
	        ($this->versions->is_version_approved($id)) ? $this->versions->disapprove_version($id) : $this->versions->approve_version($id);
	    }

	    function version_activate($id)
	    {
	        $this->user->require_group("Frontend Manager");
	        $this->versions->activate_version($id);
	    }
	    function delete_block($name, $parent)
	    {
	    	echo $name;
	    	$page_path = $_GET['page_path'];
	    	PC::page_paths($page_path);
	    	$this->BuilderEngine->set_page_path($page_path);

	        $block = new Block($parent);
	        $block->load();

	        echo count($block->blocks);
	        $block->remove_child($name);
	        
	        $block->save();

	    }
	    function test()
	    {
	    	print_r(scandir("."));
	    }
	    function get_block($block_name)
	    {
	    	$page_path = $_POST['page_path'];
	    	PC::page_paths($page_path);
	    	$this->BuilderEngine->set_page_path($page_path);
	    	$this->versions->load_page_blocks();
	    	$block = new Block($block_name);
	    	$block->show();
	    }
	    function add_block($parent, $type)
	    {
	    	$page_path = $_POST['page_path'];
	    	PC::page_paths($page_path);
	    	$this->BuilderEngine->set_page_path($page_path);
	    	//$this->blocks->set_page_path($this->blocks->get_page_path_of($parent));
	    	$max_id = $this->blocks->get_max_block_id();
	        
	    	$new_id = $max_id + 1;
	    	$new_block_name = "custom-block-".$new_id;

	    	$block = new Block($parent);
	        $block->load();
	        $new_block = new Block($new_block_name);
	        $new_block->set_type($type);
	        $block->add_block($new_block);
	        $block->save();

	        $new_block->set_content("Your new block.");

	        $new_block->show();
	        
	    }
	}

?>