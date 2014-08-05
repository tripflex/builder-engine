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

	class faq_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Social Links";
			$info['block_icon'] = "fa-envelope-o";
			
			return $info;
		}
		public function generate_admin()
		{

			$questions = $this->block->data('questions');
			$answers = $this->block->data('answers');
			

			$num_questions = count($questions);
			?>

			<!-- Nav tabs -->
    		<script>
    		var num_slides = <?=$num_questions?>;
    		<? if($num_questions == 0): ?>
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
					$("#slide-section-tabs").append('<li id="slide-section-tab-' + num_slides +'"><a href="#slide-section-' + num_slides + '" data-toggle="tab">Question ' + num_slides + '</a></li>');
				
					$("#slide-sections").append('\
						<div class="tab-pane" id="slide-section-' + num_slides + '">\
		                  \
		                </div>\
			                ');
					e.preventDefault();

					html = $("#slide-section-1").html();
					$("#slide-section-" + num_slides).html(html);
					$('#slides a:last').tab('show');
					$('#slide-section-' + num_slides).find('.delete-slide').attr('slide', num_slides);
					$('#slide-section-' + num_slides).find('[name="questions[0]"]').attr('name', 'questions[' + (num_slides-1) + ']');
					$('#slide-section-' + num_slides).find('[name="answers[0]"]').attr('name', 'answers[' + (num_slides-1) + ']');
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
				  	<li class="active"><a href="#slides" data-toggle="tab">Questions</a></li>

				</ul>

				<!-- Tab panes -->
				<div class="tab-content">



				<div class="tab-pane active" id="slides">

					<div class="tabbable tabs-left">
		              <ul class="nav nav-tabs" id="slide-section-tabs">
		              	<li><span id="add-slide" class="btn bt-primary">Add Quesiton</span></li>
		              	<? for($i = 0; $i < $num_questions; $i++): ?>
		                <li class="<?if($i == 0) echo'active'?>" id="slide-section-tab-<?=$i+1?>"><a href="#slide-section-<?=$i+1?>" data-toggle="tab">Question <?=$i+1?></a></li>
		            	<? endfor; ?>

		            	<? if($num_questions == 0): ?>
		                <li class="active"><a href="#slide-section-1" data-toggle="tab">Question 1</a></li>
		            	<? endif;?>
		              

		              </ul>
		              <div class="tab-content" id="slide-sections">
		              	<? $types = $this->block->data('type');?>
		              	<? $colors = $this->block->data('color');?>
		              	<? for($i = 0; $i < $num_questions; $i++): ?>
		                <div class="tab-pane <?if($i == 0) echo'active'?>" id="slide-section-<?=$i+1?>">
		                  <?
						$this->admin_input('questions['.$i.']','text','Question: ', $questions[$i]);
						$this->admin_input('answers['.$i.']','text','Answer: ', $answers[$i]);
						?>
						<span class="btn btn-warn delete-slide" slide="<?=$i+1?>">Delete Question</span>
		                </div>
		            	<? endfor; ?>


		            	<? if($num_questions == 0): ?>
		                <div class="tab-pane active" id="slide-section-1">
		                  <?
						$this->admin_input('questions[0]','text','Question: ');
						$this->admin_input('answers[0]','text','Answer: ');
						echo '<span class="btn btn-warn delete-slide" slide=1>Delete Question</span>';

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
			$questions = $this->block->data('questions');
			$answers = $this->block->data('answers');


			if(!is_array($questions) || empty($questions))
			{
				$this->block->force_data_modification();
				$this->block->set_data('questions', array("Hello"));

				$this->block->set_data('answers', array("Hello there"));
			}
			return $this->output();
			
		}

		function output()
		{
			
			$questions = $this->block->data('questions');
			$answers = $this->block->data('answers');
			

			$num_questions = count($questions);

			$output = "
			<div class=\"faq\">
               <div class=\"row\">
			<div class=\"accordion\" id=\"accordion2\">
			";


			for($i = 0; $i < $num_questions; $i++)
			{

				$output .= "
				<div class=\"accordion-group\">
                         <div class=\"accordion-heading\">
                           <a class=\"accordion-toggle collapsed\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse{$i}\">
                              <!-- Title. Don't forget the <i> tag. -->
                             <h5><i class=\"icon-plus\"></i> {$questions[$i]}</h5>
                           </a>
                         </div>
                         <div id=\"collapse{$i}\" class=\"accordion-body collapse\">
                           <div class=\"accordion-inner\">
                              <!-- Para -->
                             <p>{$answers[$i]}</p>
                           </div>
                         </div>
                       </div>
				";
			}
            $output .= "
            </div>
            </div>
            </div>

			";
			return $output;
		}
	}
?>