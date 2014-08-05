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

function endswith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, -$testlen) === 0;
}

function get_blocks()
{
    $results = scandir(APPPATH . "../blocks");

    $blocks = array();

    $blocks['Generic']['type'] = 'block';
    $blocks['Generic']['folder'] = "generic";
    $blocks['Generic']['icon'] = "fa-th";
    foreach($results as $block)
    {
        if($block == "." || $block == "..")
            continue;

          if(!file_exists(APPPATH . "../blocks/$block/{$block}.php"))
            continue;
        include_once(APPPATH . "../blocks/$block/{$block}.php");
        $classname = $block."_block_handler";
        $handler = new $classname();

        $info = $handler->info();

        $entry = array();
        if(isset($info['category_name']) && $info['category_name'] != ""){
            $blocks[$info['category_name']]['type'] = 'category';
            $blocks[$info['category_name']]['icon'] = $info['category_icon'];
            if(!isset($blocks[$info['category_name']]['blocks']))
                $blocks[$info['category_name']]['blocks'] = array();

            
            $blocks[$info['category_name']]['blocks'][$info['block_name']]['type'] = 'block';
            $blocks[$info['category_name']]['blocks'][$info['block_name']]['folder'] = $block;
            $blocks[$info['category_name']]['blocks'][$info['block_name']]['icon'] = $info['block_icon'];

        }
            
        else{
            $blocks[$info['block_name']]['type'] = 'block';
            $blocks[$info['block_name']]['folder'] = $block;
            $blocks[$info['block_name']]['icon'] = $info['block_icon'];
        }
            

    }
    return $blocks;

}
?>
<script src="/builderengine/public/js/jquery.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" ></script>

<script type="text/javascript" src="/themes/dashboard/js/plugins/tables/datatables/jquery.dataTables.min.js"></script><!-- Init plugins only for page -->
<link href="/themes/dashboard/css/icons.css" rel="stylesheet" />
<link rel="stylesheet" media="screen" type="text/css" href="/builderengine/public/js/editor/custom.css" />
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<link href="http://vitalets.github.io/angular-xeditable/dist/css/xeditable.css" rel="stylesheet" />

<link href="/builderengine/public/css/block-editor.css" rel="stylesheet" />
<link href="/builderengine/public/css/fix.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="/builderengine/public/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="/builderengine/public/css/demo.css" />
<link rel="stylesheet" type="text/css" href="/builderengine/public/css/icons.css" />
<link rel="stylesheet" type="text/css" href="/builderengine/public/css/component.css" />

<link rel='stylesheet' id='font-awesome-4-css'  href='/builderengine/public/css/font-awesome.css?ver=4.0.3' type='text/css' media='all' />
    <link href="/builderengine/public/jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
<script src="/builderengine/public/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>

<script type="text/javascript" src="/builderengine/public/js/versions-management.js"></script>
<style>
body {
	margin: 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.scroller{
    overflow-y:hidden !important;
}
.dl-menuwrapper a:hover {
    text-decoration: none !important;
}
.dl-menuwrapper ul
{
    margin-left: 0px !important;
}
</style>
<script>
var page_path = '<?=$BuilderEngine->get_page_path()?>';
var base_path = "<?=$this->config->base_url();?>";

function page_url_change(new_url)
{
  page_path = new_url;
  $( "#publish-button" ).attr('page', page_path);
  $( "#publish-button" ).unbind( "click.publish");
  $( "#publish-button" ).html( "Loading...");

  $.post("/index.php/layout_system/ajax/is_page_pending_submission",
  {
      page_path:page_path,
  },
  function(data,status){
    if(data == 'true')
      initialize_publish_button();
    else if(data == 'false')
    {
      $( "#publish-button" ).html( "PUBLISHED");
    }else
      alert('There was an error processing a system operation.\nPlease contact customer support.');

  });
  

}
function reload_block(block_name, page_path, forced)
{
	runFunction("reload_block", [block_name, page_path, forced]);
    
}
function initialize_versions_manager_controls() {
   $("#layout-versions-button").click(function () {

        $(this).parent().addClass("active");
        $("#layout-versions-button").parent().removeClass("active");

        $("#admin-window").remove();
        $( "body" ).append( "<div id='admin-window' style='position:fixed; top: 100px;'> </div>" );

        
        
        $.post('/layout_system/ajax/versions_window/layout',
        {
            'page_path':encodeURIComponent(page_path)
        },
        function(data) {
            initialize_versions_manager(data);
            $("#admin-window").css("z-index", "999");
            width = parseInt($("#admin-window").css("width"));
            half_width = width/2;
            screen_width = $( window ).width();
            left = (screen_width/2) - half_width;


            left = Math.round(left)+"px";
            $("#admin-window").css("left", left);

            $("#versions-close").click(function (event) {
                $("#page-versions-button").parent().removeClass("active");
                event.preventDefault();
            });
        });
        

    });

    $("#page-versions-button").click(function (e) {
        $(this).parent().addClass("active");
        $("#page-versions-button").parent().removeClass("active");

        $("#admin-window").remove();
        $( "body" ).append( "<div id='admin-window' style='position:fixed; top: 100px;'> </div>" );

        $.post('/layout_system/ajax/versions_window/page',
        {
            'page_path':encodeURIComponent(page_path)
        },
        function(data) {
            $("#admin-window").html(data);
            $("#admin-window").css("z-index", "999");

            width = parseInt($("#admin-window").css("width"));
            half_width = width/2;
            screen_width = $( window ).width();
            left = (screen_width/2) - half_width;


            left = Math.round(left)+"px";
            $("#admin-window").css("left", left);

            $("#versions-close").click(function (event) {
                $(".block-editor").remove();    
                $("#layout-versions-button").parent().removeClass("active");
                event.preventDefault();
            });
        });
        
        e.preventDefault();
    });
}
<?php if( isset($_GET['force-editor-mode'])):?>
function do_magic()
{
  $("[editor-mode-switch!='']").each(
        function ()
        {
          var attr = $(this).attr('editor-mode-switch');

          // For some browsers, `attr` is undefined; for others,
          // `attr` is false.  Check for both.
          if (typeof attr === 'undefined' || attr === false)
            return;

          if(attr == '<?=$_GET['force-editor-mode']?>')
          {

            current_editor_mode = editor_mode;
            if(editor_mode != "")
            {
              $(this).removeClass('active');
              mode = editor_mode + 'ModeDisable';
              runFunction('fire_event', ['editor_mode_change',mode]);
              while(window.frames[0].window.getting_block){}
              runFunction( editor_mode + 'ModeDisable', ['']);
              
              
              editor_mode = "";
            }
            if(current_editor_mode != attr)
            {
                $(this).addClass('active');
                mode = attr + 'ModeEnable';

                runFunction('fire_event', ['editor_mode_change', mode]);
                while(window.frames[0].window.getting_block){}

                if(mode == 'addBlockModeEnable')
                    runFunction( attr + 'ModeEnable', [$(this).attr('block-type')]);
                else
                    runFunction( attr + 'ModeEnable', ['']);
                    
              
              
              editor_mode = attr;
            }
          }
        }
        );
}
<?php endif;?>
$(window).ready(function (){
  <?php if( isset($_GET['force-editor-mode'])):?>
  $(window.frames[0].window).ready(function (){
    
        setTimeout("do_magic()", 1000);
      
  });
    <?php endif;?>

    initialize_versions_manager_controls();
    <? if($versions->get_pending_page_version_id(get_page_path()) || $versions->get_pending_page_version_id("layout")):?>
    initialize_publish_button();
    <? endif;?>
	$('#content-frame').load(function (){$(this).contents().find(".be-edit-btn").remove();});

	$('#content-frame').css("height",$(window).height() - 42);
	$( window ).resize(function() {
		$('#content-frame').css("height",$(window).height() -42 );
	});
	$('#content-frame').css("border","none");

	/*$.get("/layout_system/editor_nav?page_path="+page_path+"&iframed=true", function(data) {
		$( "#editor-nav" ).html(data);
		initialize_versions_manager_controls();
		if(!$("#publish-button").hasClass("disabled"))
        	initialize_publish_button();
	});*/
	

    $("[editor-mode-switch!='']").each(
    function ()
    {
      var attr = $(this).attr('editor-mode-switch');

      // For some browsers, `attr` is undefined; for others,
      // `attr` is false.  Check for both.
      if (typeof attr === 'undefined' || attr === false) 
        return;

      $(this).click(function (event){
        $("[editor-mode-switch!='']").each(
          function ()
          {
            var attr = $(this).attr('editor-mode-switch');

            // For some browsers, `attr` is undefined; for others,
            // `attr` is false.  Check for both.
            if (typeof attr === 'undefined' || attr === false) 
              return;
            $(this).removeClass('active');
          });



        current_editor_mode = editor_mode;
        if(editor_mode != "")
        {
          $(this).removeClass('active');
          mode = editor_mode + 'ModeDisable';
          runFunction('fire_event', ['editor_mode_change',mode]);
          while(window.frames[0].window.getting_block){}
          runFunction( editor_mode + 'ModeDisable', ['']);
          
          
          editor_mode = "";
        }
        if(current_editor_mode != attr)
        {
            $(this).addClass('active');
            mode = attr + 'ModeEnable';

            runFunction('fire_event', ['editor_mode_change', mode]);
            while(window.frames[0].window.getting_block){}

            if(mode == 'addBlockModeEnable')
                runFunction( attr + 'ModeEnable', [$(this).attr('block-type')]);
            else
                runFunction( attr + 'ModeEnable', ['']);
                
          
          
          editor_mode = attr;
        }
        
        event.preventDefault();
      });
    }
  );

});
</script>

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
<script type="text/javascript">
var editor_mode = "";
function initialize_publish_button()
{
    $("#publish-button").removeClass("disabled");
    $("#publish-button").html("Publish");

    $( "#publish-button" ).bind( "click.publish",function () {
        $("#publish-button").html("PUBLISHING...");
        setTimeout("publish_button_action();", 1000);
        
    });
}
function publish_button_action()
{
    $.post("/layout_system/ajax/publish_version",
    {
        page:$("#publish-button").attr("page")
    },
    function(data,status){
        $("#publish-button").unbind( "click.publish");
        $("#publish-button").addClass("disabled");
        $("#publish-button").html("PUBLISHED");
    });
}
function notifyChange()
{
    if($("#publish-button").hasClass("disabled"))
      initialize_publish_button();
      
}
function runFunction(name, arguments)
{

    if($('#content-frame').length > 0)
      $('#content-frame')[0].contentWindow["runFunction"](name,arguments);
}
	function stopEditor()
	{
		window.top.location.href = $('#content-frame').attr('src');
	}
  function MainCtrl($scope) {
    $scope.updateIframe = function() {

      document.getElementById('content-frame').contentWindow.updatedata($scope);
    };
    
  }

function showAdminWindowIframe(url)
{
    $("#admin-window").remove();
    $('body').append( "<div id='admin-window' style='position:fixed; top: 70px;'></div>" );

      $.get('/layout_system/ajax/admin_popup',
      {
          //'asd':'asd'
      },
      function(data) {
          $("#admin-window").html(data);
          $("#admin-window-content").html("<iframe src='" + url + "' style='width:100%; border:none; min-height:460px'></iframe>");
          $("#admin-window").css("z-index", "999");

          width = parseInt($("#admin-window").css("width"));
          half_width = width/2;
          screen_width = $( window ).width();
          left = (screen_width/2) - half_width;


          left = Math.round(left)+"px";
          $("#admin-window").css("left", left);

          $("#popup-close").click(function (event) {
              $(".block-editor").remove();    
              event.preventDefault();
          });
          
          //$('#content-frame')[0].contentWindow["runFunction"]("reload_angular",['']);

        });


}


function showAdminWindow(content)
{
  $("#admin-window").remove();
  $('body').append( "<div id='admin-window' style='position:fixed; top: 100px;'> </div>" );
  $.get('/layout_system/ajax/admin_popup',
  {
      //'asd':'asd'
  },
  function(data) {
      $("#admin-window").html(data);
      $("#admin-window-content").html(content);
      $("#admin-window").css("z-index", "999");

      width = parseInt($("#admin-window").css("width"));
      half_width = width/2;
      screen_width = $( window ).width();
      left = (screen_width/2) - half_width;


      left = Math.round(left)+"px";
      $("#admin-window").css("left", left);

      $("#popup-close").click(function (event) {
          $(".block-editor").remove();    
          event.preventDefault();
      });
      
      //$('#content-frame')[0].contentWindow["runFunction"]("reload_angular",['']);

    });
}
</script>



<script src="/builderengine/public/js/modernizr.custom.js"></script>

<body ng:app ng:controller="MainCtrl">
   
                        <style>
                        body
                        {
                          overflow-y:hidden;
                          overflow-x:hidden;
                        }
                        .be-edit-btn{
                            -webkit-background-clip: border-box;
                            -webkit-background-origin: padding-box;
                            -webkit-background-size: auto;
                            background-attachment: scroll;
                            background-clip: border-box;
                            background-color: rgb(88, 95, 105);
                            background-image: none;
                            background-origin: padding-box;
                            background-size: auto;
                            border-bottom-left-radius: 0px;
                            border-bottom-right-radius: 0px;
                            border-top-left-radius: 0px;
                            border-top-right-radius: 0px;
                            color: rgb(255, 255, 255);
                            cursor: pointer;
                            display: block;
                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                            font-size: 18px;
                            font-style: italic;
                            height: 28px;
                            line-height: 28.799999237060547px;
                            padding-bottom: 7px;
                            padding-left: 9px;
                            padding-right: 9px;
                            padding-top: 7px;
                            position: fixed;
                            right: -105px;
                            top: 37px;
                            width: 135px;
                            z-index: 555555;
                        }
                        #launch_editor {
                            display:none;
                        }
                        .top-nav .active
                        {
                          background: #606c88; /* Old browsers */
                          background: -moz-linear-gradient(top,  #606c88 0%, #3f4c6b 100%); /* FF3.6+ */
                          background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#606c88), color-stop(100%,#3f4c6b)); /* Chrome,Safari4+ */
                          background: -webkit-linear-gradient(top,  #606c88 0%,#3f4c6b 100%); /* Chrome10+,Safari5.1+ */
                          background: -o-linear-gradient(top,  #606c88 0%,#3f4c6b 100%); /* Opera 11.10+ */
                          background: -ms-linear-gradient(top,  #606c88 0%,#3f4c6b 100%); /* IE10+ */
                          background: linear-gradient(to bottom,  #606c88 0%,#3f4c6b 100%); /* W3C */
                          filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#606c88', endColorstr='#3f4c6b',GradientType=0 ); /* IE6-9 */

                        }
                        </style>
                        <script>
                            $(document).ready(function (){

                                $('.be-edit-btn').hover(function () {
                                    $('.be-edit-btn').animate({right: '0px'}, 500);
                                },
                                function () {
                                    $('.be-edit-btn').animate({right: '-105px'}, 500);
                                }
                                );

                            })
                        </script>
                        <form action='' method='post' id='launch_editor'>
                        <input type=hidden name='be_launch_editor'>
                        </form>
                        <!--<i class="be-edit-btn" id='trigger'>Edit This Page</i>-->

<?
    $params = array_merge($_GET, array("iframed" => "true"));
    $params = http_build_query($params);

    $url = strtok($url, '?');

    if(endswith($url, "/editor"))
        $url = str_replace("/editor", "", $url); 
    else
        $url = str_replace("/editor/", "/", $url);

?>
<!--<div id="editor-nav"></div>-->
<div class="containers">
            <!-- Push Wrapper -->
            <div class="mp-pusher" id="mp-pusher">

                <!-- mp-menu -->
                <nav id="mp-menu" class="mp-menu">
                    <div class="mp-level">
                        <h2 class="icon icon-world">Builder Menu</h2>
                        <ul>
                          <li class="icon icon-arrow-left">
                              <a href="#"><i class="fa fa-square-o" style="font-size: 40px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Blocks</a>
                              <div class="mp-level">
                                  <h2>Blocks</h2>
                                  <a class="mp-back" href="#">back</a>
                                  <ul>
                                    <li class="icon icon-arrow-left">
                                        <a href="#"><i class="fa fa-lightbulb-o"></i>&nbsp;&nbsp;&nbsp;Add Block</a>
                                        <div class="mp-level">
                                            <h2 class="icon icon-display" style="font-weight: bold">Available Blocks</h2>
                                            <a class="mp-back" href="#">back</a>
                                            <ul>
                                                <?foreach(get_blocks() as $name => $block):?>
                                                    <? if($block['type'] == "block"):?>
                                                        <li>
                                                            <a href="#" block-type="<?=$block['folder']?>" editor-mode-switch="addBlock"><i class="fa <?=$block['icon'];?>" style="font-size: 40px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;<?=$name?></a>
                                                        </li>
                                                    <? else: ?>
                                                        <li class="icon icon-arrow-left">
                                                            <a href="#"><i class="fa <?=$block['icon'];?>" style="font-size: 40px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;<?=$name?></a>
                                                            <div class="mp-level">
                                                                <h2><?=$name?> Blocks</h2>
                                                                <a class="mp-back" href="#">back</a>
                                                                <ul>
                                                                    <? foreach($block['blocks'] as $sub_name => $sub_block): ?>
                                                                    <li><a href="#" block-type="<?=$sub_block['folder']?>" editor-mode-switch="addBlock"><i class="fa <?=$sub_block['icon'];?>" style="font-size: 40px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;<?=$sub_name?></a></li>
                                                                    <? endforeach;?>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    <? endif; ?>
                                                <?endforeach;?>
                                                
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="" href="#" editor-mode-switch="blockStyle"><i class="fa fa-eye-slash"></i>&nbsp;&nbsp;&nbsp;Style Block</a>
                                    </li>
                                    <li>
                                        <a class="" href="#" editor-mode-switch="deleteBlock"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;&nbsp;Delete Block</a>
                                    </li>
                                  </ul>
                              </div>
                          </li>
                            
                            
                            <li class="icon icon-arrow-left">
                                <a href="#"><i class="fa fa-camera-retro" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Versions</a>
                                <div class="mp-level">
                                    <h2 class="icon icon-shop">Versions</h2>
                                    <a class="mp-back" href="#">back</a>
                                    <ul>
                                        <li>
                                            <a class="icon icon-t-shirt" href="#" id="page-versions-button">Page Versions</a>
                                        </li>
                                        <li>
                                            <a class="icon icon-diamond" href="#" id="layout-versions-button">Website Versions</a>
                                        </li>
                                        <li>
                                            <a class="" href="<?=base_url('/layout_system/erase_all_blocks')?>" onclick="return confirm('This will erase all your website content and will revert it to stock. Are you sure you want to do that?')"><i class="fa fa-undo"></i>&nbsp;&nbsp;&nbsp;Revert Site to Stock</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="<?=base_url('/admin/module/page/show_pages')?>"><i class="fa fa-book" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Pages</a></li>
                            <li><a href="<?=base_url('/admin/links/show')?>"><i class="fa fa-external-link" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Main Menu</a></li>
                            <li><a href="<?=base_url('/admin/user/search')?>"><i class="fa fa-users" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Users</a></li>
                            <li><a href="<?=base_url('/admin/module/blog/show_posts')?>"><i class="fa fa-pencil" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Blog</a></li>
                            <li><a href="<?=base_url('/admin/themes/show')?>"><i class="fa fa-picture-o" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Themes</a></li>
                            <li><a href="<?=base_url('/admin/files/show')?>"><i class="fa fa-file-text-o" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;File Manager</a></li>
                            <li><a href="<?=base_url('/admin')?>"><i class="fa fa-wrench" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Admin CP</a></li>
                            <li><a href="<?=base_url()?>" id="exit_editor"><i class="fa fa-sign-out" style="font-size: 35px;margin-top: -5px; float:left"></i>&nbsp;&nbsp;&nbsp;Exit Editor</a></li>
                        </ul>
                            
                    </div>
                </nav>
                <!-- /mp-menu -->
<script>
$(document).ready(function() {
    function pulsate() {
        $("#the-builderengine-logo").animate({ opacity: 0.1 }, 500, 'linear')
                     .animate({ opacity: 1 }, 500, 'linear', pulsate);
        }

    pulsate();
});
</script>

                <div class="scroller"><!-- this is for emulating position fixed of the nav -->
                    <div class="scroller-inner">
                        <!-- Top Navigation -->
                        <div class="codrops-top clearfix top-nav">
                            <a href="#" id="trigger" style="height: 40px; float: left" class=""><img alt="" id="the-builderengine-logo" style="height: 40px" src="/builderengine/public/be_logo_minimal.png"/></a>
                            <a class="codrops-icon fa-icon fa-edit" href="#" style="margin-left: 20px;" editor-mode-switch="edit"><span>EDIT</span></a>
                            <a class="codrops-icon fa-icon fa-arrows-alt" href="#" editor-mode-switch="resize"><span>RESIZE</span></a>
                            <a class="codrops-icon fa-icon fa-arrows" href="#" editor-mode-switch="move"><span>MOVE</span></a>
                            <? if($versions->get_pending_page_version_id(get_page_path()) || $versions->get_pending_page_version_id("layout")):?>
                            <span class="right"><a class="codrops-icon fa-icon fa-check" href="#" id="publish-button" page="<?=get_page_path()?>"><span>PUBLISH</span></a></span>
                            <? else: ?>
                            <span class="right"><a class="codrops-icon fa-icon fa-check disabled" href="#" id="publish-button" page="<?=get_page_path()?>"><span>PUBLISHED</span></a></span>
                            <? endif; ?>
                        </div>
                        
                    </div><!-- /scroller-inner -->
                    <iframe id="content-frame" src="<?=$url?>?<?=$params?>" style="width:100%; border:none"></iframe>
                </div><!-- /scroller -->

            </div><!-- /pusher -->

        </div><!-- /container -->
        <style>
          .be-edit-btn{
              -webkit-background-clip: border-box;
              -webkit-background-origin: padding-box;
              -webkit-background-size: auto;
              background-attachment: scroll;
              background-clip: border-box;
              background-color: rgb(88, 95, 105);
              background-image: none;
              background-origin: padding-box;
              background-size: auto;
              border-bottom-left-radius: 0px;
              border-bottom-right-radius: 0px;
              border-top-left-radius: 0px;
              border-top-right-radius: 0px;
              color: rgb(255, 255, 255);
              cursor: pointer;
              display: block;
              font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
              font-size: 18px;
              font-style: italic;
              height: 28px;
              line-height: 28.799999237060547px;
              padding-bottom: 7px;
              padding-left: 9px;
              padding-right: 9px;
              padding-top: 7px;
              position: fixed;
              
              height: 40px;
              width: 135px;
              z-index: 555555;
          }

          #page-styler
          {
              right: -80px;
              top: 87px;
          }
          </style>
        <script>
            $(document).ready(function (){

                $('#page-styler').hover(function () {
                    $(this).animate({right: '0px'}, 500);
                },
                function () {
                    $(this).animate({right: '-80px'}, 500);
                }
                );
                $('#page-styler').click( function (){
                    showAdminWindowIframe('/layout_system/ajax/block_styler/be_body_styler_'+'<?=$this->BuilderEngine->get_option("active_frontend_theme")?>'+'?page_path=page/index');
                });
                
            })
        </script>

        <i class="be-edit-btn" id='page-styler'>Style Page</i>
        <script src="/builderengine/public/js/classie.js"></script>
        <script src="/builderengine/public/js/mlpushmenu.js"></script>
        <script>
            new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
        </script>


</body>