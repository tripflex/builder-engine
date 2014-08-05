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

	class youtube_block_handler extends  block_handler{
		public function defaults()
		{

		}
		public function info()
		{
			$info['category_name'] = "Video";
			$info['category_icon'] = "fa-video-camera";

			$info['block_name'] = "YouTube";
			$info['block_icon'] = "fa-youtube-square";

			return $info;
		}
		public function generate_admin()
		{
			$this->admin_input('youtube_url','text','YouTube URL');
			$this->admin_select('youtube_embed_type',array("html5" => "Forced HTML5", "default" => "Visitor's Default"),'Embed type');
		}
		public function generate_content()
		{
			$url = $this->block->data('youtube_url');
			?>
			<style>
				.masked-iframe {
					background-color: #aaa;
					background-image: url(/blocks/youtube/images/youtube.png);
					background-position: center center;
					background-repeat: no-repeat;
					width: 100%;
					
				}
				.masked-iframe-content {
					margin-top: 50%;
					margin-left: 40%;
					font-weight: bold;
					color: #f00;
				}
			</style>
			<script>
				var youtube_block_js_loaded = false;
				$(document).ready(function (){
					if(youtube_block_js_loaded)
						return;

					youtube_block_js_loaded = true;
					jQuery(document).bind('editor_mode_change',  function (event, action){
						if(action == "editModeEnable" || action == 'resizeModeEnable' || action == 'moveModeEnable' || action == 'deleteBlockModeEnable')
						{
							
							
							$( '.youtube-block-frame' ).each(function (){
								height = $(this).parent().css('height');
								$(this).parentsUntil( ".block" ).each(function (){
									
									$(this).parent().contents().find('.youtube-block-frame').css("height", height);
									

								});
								//alert($(this).attr('html5'));
								if(/*$(this).attr('html5') != 'true'*/true){
									
									$(this).parent().append("<div class='masked-iframe'></div>");
									$(this).parent().parent().css("height", $(this).css('height'));
									$(this).hide();
									
								}

								$( '.youtube-block-frame' ).each(function (){

									$(this).parentsUntil( ".block" ).each(function (){
										height = $(this).parent().css('height');
										$(this).parent().contents().find('.youtube-block-frame').css("height", height);
										$(this).parent().contents().find('.masked-iframe').css("height", height);
									});
								});
							});
						}

						if(action == "editModeDisable" || action == 'resizeModeDisable' || action == 'moveModeDisable' || action == 'deleteBlockModeDisable')
						{
							$( '.masked-iframe' ).remove();
							$( '.youtube-block-frame').show();
						}

					});


					
					$( '.youtube-block-frame' ).each(function (){

						$(this).parentsUntil( ".block" ).each(function (){
							height = $(this).parent().css('height');
							$(this).parent().contents().find('.youtube-block-frame').css("height", height);
							$(this).parent().contents().find('.masked-iframe').css("height", height);
						});
					});
					


					$( '.youtube-block-frame' ).each(function (){
						
						$(this).parentsUntil( ".block" ).each(function (){
							$(this).parent().resize(function() {
								
								$(this).contents().find('.youtube-block-frame').css("height", $(this).css('height'));
								$(this).contents().find('.masked-iframe').css("height", $(this).css('height'));
							});
						});
					});	
				});

			</script>
			<?
			if($this->block->data('youtube_embed_type') == 'html5'){
				$url_suffix = "?html5=1";
				$html5 = 'true';
			}else{
				$html5 = 'false';
				$url_suffix = "";
			}
			$video_url = $url.$url_suffix;
			$output = "
			<div class='youtube-block-frame-holder'>
				<iframe class='youtube-block-frame' style='width: 100%;' html5='{$html5}' src=\"$video_url\" frameborder=\"0\" allowfullscreen></iframe>
			</div>";
			return $output;
		}

	}

?>