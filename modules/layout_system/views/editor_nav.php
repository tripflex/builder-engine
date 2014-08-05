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
?>
<link href="/themes/dashboard/css/bootstrap/bootstrap.css" rel="stylesheet" />
<link href="/themes/dashboard/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
<script src="/builderengine/public/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="/builderengine/public/js/frontend-editor.js"></script>
<script type="text/javascript" src="/builderengine/public/js/versions-management.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>

<script>
  function reload_angular()
  {
    angular.bootstrap(document, []);
    
    //setTimeout(function (){reload_angular()}, 1000);
  }

    
function showAdminWindow(content)
{
  $("#admin-window").remove();
  $('body').append( "<div id='admin-window' style='position:fixed; top: 100px;'> asdasd</div>" );
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
function notifyChange()
{
    if($("#publish-button").hasClass("disabled"))
      initialize_publish_button();
      
}
function initialize_publish_button()
{
    $("#publish-button").removeClass("disabled");
    $("#publish-button").html("Publish");

    $( "#publish-button" ).bind( "click.publish",function () {
        $("#publish-button").html("Publishing...");
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
        $("#publish-button").html("This page is published");
    });
}
$(document).ready(function (){


  $('#content-frame').contents().find('a').bind('click.intercept',function(e) {
      
    if(!($(this).length > 0)){
      alert()
      return;
    }
      var editor_mode;
      window.location=$(this).attr('href');https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQozN4tJI63m-tuJFkCLYIm5YWZl2oLdbGJeK6UZg8QJNXH360c
      e.preventDefault();


  });

  angular.bootstrap(document, []);
});




PC::debug("asdasdasd");
</script>
        <? if($user->is_member_of("Administrators") || $user->is_member_of("Frontend Editor") || $user->is_member_of("Frontend Manager") ): ?>
        <div class="be-navbar navbar navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container">
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              
              <div class="nav-collapse collapse">
                <ul class="nav navbar-nav">
                
                    <li><a href="#" id='edit-button' editor-mode-switch='edit'>Edit</a></li>
                    <li><a href="#" id='resize-button' editor-mode-switch='resize'>Resize</a></li>
                    <li><a href="#" id='move-button' editor-mode-switch='move'>Move</a></li>
                    <li><a href="#" id='style-button' editor-mode-switch='style'>Style</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Blocks <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#" id="add-block-button" editor-mode-switch='addBlock'>Add</a></li>
                        <li><a href="#" id="copy-block-button" >Copy</a></li>
                        <li class="disabled"><a href="#" id="paste-block-button">Paste</a></li>
                        <li><a href="#" id="delete-block-button" editor-mode-switch='deleteBlock'>Delete</a></li>
                      </ul>
                    </li>
                    <?if($user->is_member_of("Frontend Manager")):?>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Versions <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#" id='page-versions-button'>Page Versions</a></li>
                        <li><a href="#" id='layout-versions-button'>Global Versions</a></li>
                      </ul>
                    </li>


                    <?endif;?>

                </ul>

                    <? if($versions->get_pending_page_version_id(get_page_path()) || $versions->get_pending_page_version_id("layout")):?>
                    <button id="publish-button" class="btn btn-primary pull-right" page="<?=get_page_path()?>">Publish</button>
                    <?else:?>
                    <button id="publish-button" class="btn btn-primary disabled pull-right" page="<?=get_page_path()?>">This page is published</button>
                    <?endif;?>
                    <a href="/admin"><span class="btn btn-primary pull-right" style="margin-right:15px">Admin CP</span></a>
                    <span onclick="stopEditor()" class="btn btn-primary pull-right" style="margin-right:15px">Stop Editor</span>
              </div><!--/.nav-collapse -->
            </div>
          </div>
        </div>
        <? endif; ?>