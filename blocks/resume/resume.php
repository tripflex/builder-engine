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

	class resume_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Resume Full Page";
			$info['block_icon'] = "fa-envelope-o";
			
			return $info;
		}
		public function generate_admin()
		{
			$name = $this->block->data('name');
			$title = $this->block->data('title');
			$bio = $this->block->data('bio');

			$education_names 		= array_values($this->block->data('education_names'));
			$education_titles		= array_values($this->block->data('education_titles'));
			$education_descriptions	= array_values($this->block->data('education_descriptions'));
			$num_educations = is_array($education_names) ? count($education_names) : 0;

			$link_urls = $this->block->data('link_urls');
			$link_types = $this->block->data('link_types');
			$num_links = is_array($link_urls)? count($link_urls) : 0;

			$skills = $this->block->data('skills');

			if(!is_array($education_names) || empty($education_names))
			{
				$title = "BuilderEngine Links";
				$slide_titles[0] = "Example Slide";
				$slide_url[0] = "#";
				$slide_images[0] = "http://www.asge.org/uploadedImages/Patients/National_Colorectal_Cancer_Awareness_Month/NCCAM_Banner_36x12.jpg";
				$slide_texts[0] = "This is a nice new slider. Click edit to customize.";

			}
			?>

			<!-- Nav tabs -->
    		<script>
    		var num_slides = <?=$num_links?>;
    		var num_edus = <?=$num_educations?>;
    		<? if($num_links == 0): ?>
    		var num_slides = 1;
        	<? endif;?>

			<? if($num_educations == 0): ?>
    		var num_edus = 1;
        	<? endif;?>

    		$(document).ready(function (){
	    		$("#myTab a").click(function (e) {
				  e.preventDefault();
				  $(this).tab("show");
				});
	    		$(".delete-link").bind("click.delete_link",function (e) {
	    			link = $(this).attr('link');
	    			$("#link-section-" + link).remove();
	    			$("#link-section-tab-" + link).remove();

	    		});

				$("#add-link").click(function (e) {
					num_slides++;
					$("#link-section-tabs").append('<li id="link-section-tab-' + num_slides +'"><a href="#link-section-' + num_slides + '" data-toggle="tab">Link ' + num_slides + '</a></li>');
				
					$("#link-sections").append('\
						<div class="tab-pane" id="link-section-' + num_slides + '">\
		                  \
		                </div>\
			                ');
					e.preventDefault();

					html = $("#link-section-1").html();
					$("#link-section-" + num_slides).html(html);
					$('#slides a:last').tab('show');
					$('#link-section-' + num_slides).find('.delete-link').attr('slide', num_slides);
					$('#link-section-' + num_slides).find('[name="link_types[0]"]').attr('name', 'link_types[' + (num_slides-1) + ']');
					$('#link-section-' + num_slides).find('[name="link_urls[0]"]').attr('name', 'link_urls[' + (num_slides-1) + ']');
					$(".delete-link").unbind("click.delete_link");
					$(".delete-link").bind("click.delete_link",function (e) {
		    			slide = $(this).attr('slide');
		    			$("#link-section-" + slide).remove();
		    			$("#link-section-tab-" + slide).remove();
		    			$('#links a:first').tab('show');
		    		});
				});

	    		$(".delete-education").bind("click.delete_slide",function (e) {
	    			edu = $(this).attr('education');
	    			$("#education-section-" + edu).remove();
	    			$("#education-section-tab-" + edu).remove();

	    		});

			
				$("#add-education").click(function (e) {
					num_edus++;
					$("#education-section-tabs").append('<li id="education-section-tab-' + num_edus +'"><a href="#education-section-' + num_edus + '" data-toggle="tab">Education ' + num_edus + '</a></li>');
				
					$("#education-sections").append('\
						<div class="tab-pane" id="education-section-' + num_edus + '">\
		                  \
		                </div>\
			                ');
					e.preventDefault();

					html = $("#education-section-1").html();
					$("#education-section-" + num_edus).html(html);
					$('#education a:last').tab('show');
					$('#education-section-' + num_edus).find('.delete-slide').attr('slide', num_edus);
					$('#education-section-' + num_edus).find('[name="education_descriptions[0]"]').attr('name', 'education_descriptions[' + (num_edus-1) + ']');
					$('#education-section-' + num_edus).find('[name="education_names[0]"]').attr('name', 'education_names[' + (num_edus-1) + ']');
					$('#education-section-' + num_edus).find('[name="education_titles[0]"]').attr('name', 'education_titles[' + (num_edus-1) + ']');
					$(".delete-slide").unbind("click.delete_slide");
					$(".delete-slide").bind("click.delete_slide",function (e) {
		    			slide = $(this).attr('education');
		    			$("#education-section-" + slide).remove();
		    			$("#education-section-tab-" + slide).remove();
		    			$('#education a:first').tab('show');
		    		});
				});
			});
			</script>
			<div style="border-width: 1px;border-color: #ddd;border-radius: 4px 4px 0 0;border-style: solid;">
				<ul id="myTab" class="nav nav-tabs">
					<li class="active"><a href="#about-me" data-toggle="tab">About Me</a></li>
					<li><a href="#education" data-toggle="tab">Education</a></li>
				  	<li><a href="#links" data-toggle="tab">Links</a></li>
				  	<li><a href="#skills" data-toggle="tab">Skills</a></li>

				</ul>

				<!-- Tab panes -->
				<div class="tab-content">

					<div class="tab-pane active" id="about-me">
			  		<?
						$this->admin_input('name','text','Name: ', $name);
						$this->admin_input('title','text','Title: ', $title);
						$this->admin_textarea('bio','Bio: ', $bio);
					?>
					</div>
					<div class="tab-pane " id="education">
						<div class="tabbable tabs-left">
			              <ul class="nav nav-tabs" id="education-section-tabs">
			              	<li><span id="add-education" class="btn bt-primary">Add Education</span></li>
			              	<? for($i = 0; $i < $num_educations; $i++): ?>
			                <li class="<?if($i == 0) echo'active'?>" id="education-section-tab-<?=$i+1?>"><a href="#education-section-<?=$i+1?>" data-toggle="tab">Education <?=$i+1?></a></li>
			            	<? endfor; ?>

			            	<? if($num_educations == 0): ?>
			                <li class="active"><a href="#education-section-1" data-toggle="tab">Education 1</a></li>
			            	<? endif;?>
			              

			              </ul>
			              <div class="tab-content" id="education-sections">

			              	<? for($i = 0; $i < $num_educations; $i++): ?>
			                <div class="tab-pane <?if($i == 0) echo'active'?>" id="education-section-<?=$i+1?>">
		                  	<?
		                    	$this->admin_input('education_names['.$i.']','text','Name: ', $education_names[$i]);
		                    	$this->admin_input('education_titles['.$i.']','text','Title: ', $education_titles[$i]);
		                    	$this->admin_textarea('education_descriptions['.$i.']','Overview: ', $education_descriptions[$i]);
							?>
							<span class="btn btn-warn delete-education" education="<?=$i+1?>">Delete Education</span>
			                </div>
			            	<? endfor; ?>


			            	<? if($num_educations == 0): ?>
			                <div class="tab-pane active" id="education-section-1">
			                  <?
		                    	$this->admin_input('education_names[0]','text','Name: ');
		                    	$this->admin_input('education_titles[0]','text','Title: ');
		                    	$this->admin_textarea('education_descriptions[0]','Description: ');

							?>
			                </div>
			            	<? endif;?>

			              </div>
			            </div>
					</div>

					<div class="tab-pane " id="links">
						<div class="tabbable tabs-left">
			              <ul class="nav nav-tabs" id="link-section-tabs">
			              	<li><span id="add-link" class="btn bt-primary">Add Link</span></li>
			              	<? for($i = 0; $i < $num_links; $i++): ?>
			                <li class="<?if($i == 0) echo'active'?>" id="link-section-tab-<?=$i+1?>"><a href="#link-section-<?=$i+1?>" data-toggle="tab">Link <?=$i+1?></a></li>
			            	<? endfor; ?>

			            	<? if($num_links == 0): ?>
			                <li class="active"><a href="#link-section-1" data-toggle="tab">Link 1</a></li>
			            	<? endif;?>
			              

			              </ul>
			              <div class="tab-content" id="link-sections">

			              	<? for($i = 0; $i < $num_links; $i++): ?>
			                <div class="tab-pane <?if($i == 0) echo'active'?>" id="link-section-<?=$i+1?>">
			                  <?
		                    $this->admin_select('link_types['.$i.']',array("facebook" => "Facebook","google-plus" => "Google+", "twitter" => "Twitter", "linkedin" => "LinkedIN", "pinterest" => "Pinterest", "skype" => "Skype"),'Type', $link_types[$i]);
							$this->admin_input('link_urls['.$i.']','text','Link Address: ', $link_urls[$i]);
							?>
							<span class="btn btn-warn delete-link" link="<?=$i+1?>">Delete Link</span>
			                </div>
			            	<? endfor; ?>


			            	<? if($num_links == 0): ?>
			                <div class="tab-pane active" id="link-section-1">
			                  <?
			                  	$this->admin_select('link_types[0]',array("facebook" => "Facebook","google-plus" => "Google+", "twitter" => "Twitter", "linkedin" => "LinkedIN", "pinterest" => "Pinterest", "skype" => "Skype"),'Type');
								$this->admin_input('link_urls[0]','text','Link Address: ');

							?>
			                </div>
			            	<? endif;?>

			              </div>
			            </div>
					</div>

					<div class="tab-pane" id="skills">
			  		<?
						$this->admin_textarea('skills','Skills: ', $skills);
					?>
					</div>

				</div>
			</div>
			<?
			

		}
		public function generate_content()
		{
			$name = $this->block->data('name');
			$title = $this->block->data('title');
			$skills = $this->block->data('skills');
			$education_names 		= $this->block->data('education_names');
			$education_titles		= $this->block->data('education_titles');
			$education_descriptions	= $this->block->data('education_descriptions');

			if(!$name)
				$this->block->set_data('name', "John Doe");
			if(!$title)
				$this->block->set_data('title', "Professional Web Guru");
			if(!$skills)
				$this->block->set_data('skills', "HTML5,CSS3,jQuery,BuilderEngine,Twitter Bootstrap,Photoshop");
			if(!$education_names)
				$this->block->set_data('education_names', array("B.Tech (Information Technology)"));
			if(!$education_titles)
				$this->block->set_data('education_titles', array("MIT, USA"));
			if(!$education_descriptions)
				$this->block->set_data('education_descriptions', array("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vulputate eros nec odio egestas in dictum nisi vehicula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse porttitor luctus imperdiet. Praesent ultricies enim ac ipsum aliquet pellentesque. Nullam justo nunc, dignissim at convallis posuere, sodales eu orci."));

			return $this->output();
			
		}

		function output()
		{
			$name = $this->block->data('name');
			$title = $this->block->data('title');
			$bio = $this->block->data('bio');
			$skills = $this->block->data('skills');
			
			$link_urls = $this->block->data('link_urls');
			$link_types = $this->block->data('link_types');

			$education_names 		= $this->block->data('education_names');
			$education_titles		= $this->block->data('education_titles');
			$education_descriptions	= $this->block->data('education_descriptions');


			$output = "      
                     <!-- About -->
                     <div class=\"rblock\">
                        <div class=\"row\">
                           <div class=\"span3\">
                              <h4>About Me</h4>                            
                           </div>
                           <div class=\"span9\">
                              <div class=\"rinfo\">
                                 <h5>$name</h5>
                                 <div class=\"rmeta\">$title</div>
                                 <p>$bio</p>
                                 ";
                                 if(is_array($link_urls) && count($link_urls) > 0)
                                 {
                                 	$education_names = array_values($education_names);
                                 	$education_titles = array_values($education_titles);
                                 	$education_descriptions = array_values($education_descriptions);

                                 	$output .= "
                             				<!-- Social media icons -->
                             				<div class=\"social\">";
                             		for($i = 0; $i < count($link_urls); $i++)
                             		{
                             			$output .= "<a style='color: #c98900' href=\"".$link_urls[$i]."\"><i class=\"fa fa-".$link_types[$i]."\"></i></a>";
                             		}
                             		$output .= "</div>";
                                 }
                                    
                                           
     							$output .= "
                                           
                              </div>
                           </div>
                        </div>
                     </div>";


	                 if(is_array($education_names) && count($education_names) > 0)
                     {
                     	$output .= "
     					<!-- Education -->
		                 <div class=\"rblock\">
		                    <div class=\"row\">
		                       <div class=\"span3\">
		                          <h4>Education</h4>                            
		                       </div>";

                 		for($i = 0; $i < count($education_names); $i++)
                 		{
                 			$offset = "";
                 			if($i > 0 )
                 				$offset = "offset3";
                 			$output .= "
                 				<div class=\"span9 $offset\">
		                          <div class=\"rinfo\">
		                             <!-- Title -->
		                             <h5>".$education_names[$i]."</h5>
		                             <!-- Meta -->
		                             <div class=\"rmeta\">".$education_titles[$i]."</div>
		                             <!-- Details -->
		                             <p>".$education_descriptions[$i]."</p>
		                          </div>
		                       </div>
		                       ";
                 		}
                 		$output .= "
                 			</div>
		                 </div>";
                     }   
		                 
		                       
		                    
                     $output .= "
                     <!-- Skills -->
                     <div class=\"rblock\">
                        <div class=\"row\">
                           <div class=\"span3\">
                              <h4>Skills</h4>                            
                           </div>
                           <div class=\"span9\">
                              <div class=\"rinfo\">
                                 <!-- Class \"rskills\" is important -->
                                 <div class=\"rskills\">";

                                 foreach(explode(",", $skills) as $skill)
                                 	$output .= "<span>$skill</span> ";
                                 $output .= "</div>
                              </div>
                           </div>
                        </div>
                     </div> ";
			return $output;
		}
	}
?>