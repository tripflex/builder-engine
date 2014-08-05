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

	class slider_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Slider";
			$info['block_icon'] = "fa-envelope-o";
			
			return $info;
		}
		public function generate_admin()
		{
			
			$slide_titles = $this->block->data('slide_title');
			$slide_url = $this->block->data('slide_url');
			$slide_images = $this->block->data('slide_image');
			$slide_texts = $this->block->data('slide_text');
			
			if(!is_array($slide_titles) || empty($slide_titles))
			{
				$slide_titles[0] = "Example Slide";
				$slide_url[0] = "#";
				$slide_images[0] = "#";
				$slide_texts[0] = "This is a nice new slider. Click edit to customize.";

			}
			$num_slides = count($slide_titles);
			?>

			<!-- Nav tabs -->
    		<script>
    		var num_slides = <?=$num_slides?>;
    		<? if($num_slides == 0): ?>
    		var num_slides = 1;
        	<? endif;?>

    		$(document).ready(function (){
	    		$("#myTab a").click(function (e) {
				  e.preventDefault();
				  $(this).tab("show");
				});

	    		$(".delete-slide").bind("click.delete_slide",function (e) {
	    			slide = $(this).attr('slide');
	    			$("#slide-section-" + slide).remove();
	    			$("#slide-section-tab-" + slide).remove();

	    		});

				$("#add-slide").click(function (e) {
					num_slides++;
					$("#slide-section-tabs").append('<li id="slide-section-tab-' + num_slides +'"><a href="#slide-section-' + num_slides + '" data-toggle="tab">Slide ' + num_slides + '</a></li>');
				
					$("#slide-sections").append('\
						<div class="tab-pane" id="slide-section-' + num_slides + '">\
		                  \
		                </div>\
			                ');
					e.preventDefault();

					html = $("#slide-section-1").html();
					$("#slide-section-" + num_slides).html(html);
					$('#slides a:last').tab('show');
					$('#slide-section-' + num_slides).find('[name="slide_image[0]"]').attr('name', 'slide_image[' + (num_slides-1) + ']');
					$('#slide-section-' + num_slides).find('.delete-slide').attr('slide', num_slides);
					$('#slide-section-' + num_slides).find('[name="slide_title[0]"]').attr('name', 'slide_title[' + (num_slides-1) + ']');
					$('#slide-section-' + num_slides).find('[name="slide_url[0]"]').attr('name', 'slide_url[' + (num_slides-1) + ']');
					$('#slide-section-' + num_slides).find('[name="slide_text[0]"]').attr('name', 'slide_text[' + (num_slides-1) + ']');
					$('#slide-section-' + num_slides).find('[name="slide_image[0]_old"]').attr('onclick', 'file_manager(\'slide_image[' + (num_slides-1) + ']\')');
					$('#slide-section-' + num_slides).find('[name="slide_image[0]_old"]').attr('name', 'slide_image[' + (num_slides-1) + ']_old');
					$(".delete-slide").unbind("click.delete_slide");
					$(".delete-slide").bind("click.delete_slide",function (e) {
		    			slide = $(this).attr('slide');
		    			$("#slide-section-" + slide).remove();
		    			$("#slide-section-tab-" + slide).remove();
		    			$('#slides a:first').tab('show');
		    		});
				});
			});
			</script>
			<div style="border-width: 1px;border-color: #ddd;border-radius: 4px 4px 0 0;border-style: solid;">
				<ul id="myTab" class="nav nav-tabs">
				  <li class="active"><a href="#general" data-toggle="tab">General</a></li>
				  <li><a href="#settings" data-toggle="tab">Settings</a></li>
				  <li><a href="#slides" data-toggle="tab">Slides</a></li>

				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane active" id="general">
			  		<?
					$this->admin_select('slider_type',array("flexslider" => "FlexSlider"),'Slider Type');
					?>
					</div>
					<div class="tab-pane" id="settings">
						<div class="tabbable tabs-left">
			              <ul class="nav nav-tabs" id="slider-settings">
			                <li class="active"><a href="#slider-settings-flexslider" data-toggle="tab">FlexSlider</a></li>
			              </ul>
			              <div class="tab-content" id="" style="height: 240px; overflow-y: scroll">
			                <div class="tab-pane active" id="slider-settings-flexslider" >
			                 	<?
								$this->admin_select('flexslider_settings_direction',array("horizontal" => "Horizontal","vertical" => "Vertical"),'Direction');
								$this->admin_input('flexslider_settings_slideshowSpeed',"text",'Speed (ms)', '10000');
								$this->admin_select('flexslider_settings_pauseOnHover',array("true" => "Yes","false" => "No"),'Pause on hover');
								$this->admin_select('flexslider_settings_directionNav',array("true" => "Yes","false" => "No"),'Direction Nav');
								$this->admin_select('flexslider_settings_controlNav',array("true" => "Yes","false" => "No"),'Control Nav');


								?>
			                </div>
			            	

			              </div>
			            </div>
					</div>
				<div class="tab-pane" id="slides">

					<div class="tabbable tabs-left">
		              <ul class="nav nav-tabs" id="slide-section-tabs">
		              	<li><span id="add-slide" class="btn bt-primary">Add Slide</span></li>
		              	<? for($i = 0; $i < $num_slides; $i++): ?>
		                <li class="<?if($i == 0) echo'active'?>" id="slide-section-tab-<?=$i+1?>"><a href="#slide-section-<?=$i+1?>" data-toggle="tab">Slide <?=$i+1?></a></li>
		            	<? endfor; ?>

		            	<? if($num_slides == 0): ?>
		                <li class="active"><a href="#slide-section-1" data-toggle="tab">Slide 1</a></li>
		            	<? endif;?>
		              

		              </ul>
		              <div class="tab-content" id="slide-sections">
		              	<? for($i = 0; $i < $num_slides; $i++): ?>
		                <div class="tab-pane <?if($i == 0) echo'active'?>" id="slide-section-<?=$i+1?>">
		                  <?
						$this->admin_input('slide_title['.$i.']','text','Title: ', $slide_titles[$i]);
						$this->admin_input('slide_url['.$i.']','text','Link Address: ', $slide_url[$i]);
						$this->admin_file('slide_image['.$i.']','Image: ', $slide_images[$i]);
						$this->admin_textarea('slide_text['.$i.']','Slide Text: ', $slide_texts[$i]);
						?>
						<span class="btn btn-warn delete-slide" slide="<?=$i+1?>">Delete Slide</span>
		                </div>
		            	<? endfor; ?>


		            	<? if($num_slides == 0): ?>
		                <div class="tab-pane active" id="slide-section-1">
		                  <?
						$this->admin_input('slide_title[0]','text','Title: ');
						$this->admin_input('slide_url[0]','text','Link Address: ');
						$this->admin_file('slide_image[0]','Image: ');
						$this->admin_textarea('slide_text[0]','Slide Text: ');
						?>
		                </div>
		            	<? endif;?>

		              </div>
		            </div>
		            
				</div>

				</div>
			</div>
			<?
			

		}
		public function generate_content()
		{
			$slide_titles = $this->block->data('slide_title');


			if(!is_array($slide_titles) || empty($slide_titles))
			{
				$this->block->force_data_modification();

				$this->block->set_data('slide_title', array("Example Slide"));
				$this->block->set_data('slide_url', array("#"));
				$this->block->set_data('slide_image', array("#"));
				$this->block->set_data('slide_text', array("This is a nice new slider. Click edit to customize."));
				$this->block->set_data('slider_type', 'flexslider');
			}
			switch ($this->block->data('slider_type'))
			{
				case "flexslider":
					return $this->output_flexslider();
					break;

				default:
					return $this->output_flexslider();
					break;
			}
			
		}

		function output_flexslider()
		{
			$direction = $this->block->data('flexslider_settings_direction');
			if(!$direction)
			{
				$this->block->set_data('flexslider_settings_direction', "horizontal");
				$this->block->set_data('flexslider_settings_controlNav', "false");
				$this->block->set_data('flexslider_settings_directionNav', "true");
				$this->block->set_data('flexslider_settings_pauseOnHover', "true");
				$this->block->set_data('flexslider_settings_slideshowSpeed', "5000");
			}
			$output = "
			<script type=\"text/javascript\" src=\"/builderengine/public/slider/flexslider/jquery.flexslider-min.js\"></script><!-- Init plugins only for page -->
			<link href=\"/builderengine/public/slider/flexslider/css/flexslider.css\" rel=\"stylesheet\" />
			
			<script>
				$(document).ready(function () {

					$('#flexslider-{$this->block->name}').flexslider({
				      direction: \"{$this->block->data('flexslider_settings_direction')}\",
				      controlNav: {$this->block->data('flexslider_settings_controlNav')},
				      directionNav: {$this->block->data('flexslider_settings_directionNav')},
				      pauseOnHover: {$this->block->data('flexslider_settings_pauseOnHover')},
				      slideshowSpeed: {$this->block->data('flexslider_settings_slideshowSpeed')}      
				   });
				});

			</script>
			<div class=\"flex-image flexslider\" id=\"flexslider-{$this->block->name}\">
              <ul class=\"slides\">";

            $slide_titles = $this->block->data('slide_title');
			$slide_images = $this->block->data('slide_image');
			$slide_texts = $this->block->data('slide_text');
			$slide_urls = $this->block->data('slide_url');
			$num_slides = count($slide_titles);
			for($i = 0; $i < $num_slides; $i++)
			{
				$output .= "<li>";
				$caption = "
					<div class=\"flex-caption\">
						<!-- Title -->
						<h3><span>".$slide_titles[$i]."</span></h3>
						<!-- Para -->
						<p>".$slide_texts[$i]."</p>
					</div>
				";
				$output .="
					<img src=\"".$slide_images[$i]."\" />
				";
				if($slide_texts[$i] != "" && $slide_titles[$i] != "")
					$output .= $caption;
				if($slide_urls[$i] != "")
					$output = "<a href='{$slide_urls[$i]}'>".$output."</a>";

				$output .= "</li>";
			}
            $output .= "
                
              </ul>
            </div>

			";
			return $output;
		}
	}
?>