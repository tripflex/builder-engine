var editor_mode = "";
var span_step = 0;
function notifyChange()
{
    window.parent.notifyChange();
}
$(document).ready( function () {

  //alert(screen.width);
	CKEDITOR.on( 'instanceCreated', function( event ) {
        var editor = event.editor,
            element = editor.element;
        // Customize editors for headers and tag list.
        // These editors don't need features like smileys, templates, iframes etc.

        editor.on( 'focus', function() {
            $(".cke_voice_label").css("display", "block");
            $(".cke_voice_label").css("width", "90%");
            $(".cke_voice_label").css("text-align", "center");
            $(".cke_voice_label").css("font-size", "9px");
            $("#cke_414").css("display", "none");
            $("#cke_492").css("display", "none");

            
        });
        editor.on( 'blur', function() {
            $.post("/layout_system/ajax/save_block",
            {
                page_path: page_path,
                content:editor.getData(),
                name:element.getAttribute("block-name")
            },
            function(data,status){

            });
            
            notifyChange();

        });

    });

	


  
});
function initialize_publish_button()
{
    $("#publish-button").removeClass("disabled");
    $("#publish-button").html("Publish");

    $( "#publish-button" ).bind( "click.publish",function () {
        $("#publish-button").html("Publishing...");
        setTimeout("publish_button_action();", 1000);
        
    });
}

function runFunction(name, arguments)
{
    var fn = window[name];
    if(typeof fn !== 'function')
        return;

    fn.apply(window, arguments);

    if($('#content-frame').length > 0)
      $('#content-frame')[0].contentWindow["runFunction"](name,arguments);
}


function fire_event(event_name,data)
{
  jQuery(document).trigger(event_name, data);

}
function showAdminWindow(content)
{
  window.parent.showAdminWindow(content);

  
}

function showAdminWindowIframe(url)
{
  window.parent.showAdminWindowIframe(url);

  
}
function initializeCustomEditorClickEvent()
{
  $("[block-editor='custom']").each(
    function ()
    {
      var attr = $(this).attr('block-editor');
      if (typeof attr === 'undefined' || attr === false) 
        return;

      if(attr == 'custom')
      {
        $(this).unbind("click.custom_block_admin");
        $(this).bind("click.custom_block_admin",function (){

          showAdminWindowIframe('/layout_system/ajax/block_admin/' + $(this).attr('block-name') + '?page_path=' + page_path);
          /*$.post('/layout_system/ajax/block_admin/' + $(this).attr('block-name'),
          {
              page_path: page_path
          },
          function(data) {
              
              showAdminWindow(data);
              
          });*/
        });
        

        $("#edit-button").parent().addClass("active");
      }

    }
  );
}
function initializeStyleEditorClickEvent()
{
  
  

  //$(".block").append("<div class='block-overlay' style='top:0px;position: absolute; background-color:#000; opacity: 0.5; z-index: 999; width: " + $(this).css('width') + "; height: " + $(this).css('height') + ";'></div>");
  $(".block").prepend("<i class='fa fa-pencil-square style-icon' style='cursor:pointer;background-color:#fff;position:absolute;z-index:9999; width: 19px;height:19px; font-size: 22px;'></i>");

  $(".style-icon").unbind("click.custom_block_admin");
  $(".style-icon").bind("click.custom_block_admin",function (){
    showAdminWindowIframe('/layout_system/ajax/block_styler/' + $(this).parent().attr('name') + '?page_path=' + page_path);
  });
  $(".style-icon").hover(function (e){
    $('.block-overlay').remove();
    $(this).parent().append("<div class='block-overlay' style='top:0px; position: absolute; background-color:#0f0; opacity: 0.5; z-index: 999; width: " + $(this).parent().css('width') + "; height: " + $(this).parent().css('height') + ";'></div>");
  }, function (){
    $(".block-overlay").remove();
  },true);
}
function blockStyleModeEnable()
{
  initializeStyleEditorClickEvent();
}
function blockStyleModeDisable()
{
  $(".style-icon").unbind("click.custom_block_admin");
  $(".style-icon").remove();
}
function editModeEnable()
{
  console.log('editModeEnable()');
  initializeCustomEditorClickEvent();
  
	$("[block-editor='ckeditor']").each(
		function ()
		{
			var attr = $(this).attr('block-editor');
			if (typeof attr === 'undefined' || attr === false) 
				return;

			if(attr == 'ckeditor')
			{
				$(this).attr("contenteditable", "true");
				

				$("#edit-button").parent().addClass("active");
			}

		}
	);
	CKEDITOR.inlineAll();
}

function editModeDisable()
{
	$(".block-content").attr("contenteditable", "false");
    var editor;
    for (editor in CKEDITOR.instances) {
        CKEDITOR.instances[editor].destroy();
    }
    $("[block-editor='custom']").unbind("click.custom_block_admin");
    $("#edit-button").parent().removeClass("active");

}


function moveModeEnable()
{

  
  $(".block").each(function (){
    if(!$(this).parent().hasClass('block-children'))
      return;
    if($(this).contents().find('.block-children').length > 0)
      $(this).prepend("<i class='fa fa-arrows style-icon sortable-handle' style='left:-20px;cursor:pointer;background-color:#fff;position:absolute;z-index:9999; width: 19px;height:19px; font-size: 22px;'></i>");
    else  
      $(this).prepend("<i class='fa fa-arrows style-icon sortable-handle' style='cursor:pointer;background-color:#fff;position:absolute;z-index:9999; width: 19px;height:19px; font-size: 22px;'></i>");


  })


  $(".block-children").sortable({
        handle: ".sortable-handle",
        helper: 'clone',
        revert: 'invalid',
        /*connectWith: '.block-children-connectable',*/
        forceHelperSize: true,
        start: function(e, ui){
            ui.placeholder.height(ui.item.height() - 4);
            ui.placeholder.width(ui.item.width() - 4);
        },
        stop: function (e, ui) {
          obj = ui.item;
          block_name = obj.attr('name');
          var parent_name = obj.parent().attr('block-name');
        
          var children=new Array(); 
          i = 0;
          obj.parent().children().each(function () {
            if($(this).hasClass('block')){
                
              children[i] = $(this).attr('name');
              i++;
            }
          });
          $.post("/layout_system/ajax/save_block_children",
          {
              children:JSON.stringify(children),
              name:parent_name,
              page_path: page_path
          },
          function(data,status){
            notifyChange();
          }).error(function() { alert('There was an error saving your changes.\nPlease contact customer support.'); });

          
            
        },
    });
}

function moveModeDisable()
{
  $(".block-children").sortable("destroy");
  $('.sortable-handle').remove();
}
function detectSpanWidth(tester)
{
  span = parseInt(get_element_span(tester));
  span -= 1;
  width = parseInt($(tester).css('width'));
  width -= 80;

  return Math.round(width/span);
  //alert(Math.round(width/span));
}
/* Block Resize Functions Begin*/
function resizeModeEnable()
{
    $(".resizable").each(function () {
      $(this).resizable({

        resize: function () {
            if(span_step == 0)
              span_step = detectSpanWidth($(this));

            current_width = parseInt($(this).css("width"));
            $(this).css("width", "");

            
            span = get_element_span(this);
            if(current_width > (span * span_step) + 70)
            {

              current_span = get_element_span(this);
              if(current_span != 12 && check_total_span_sum($(this).parent()) != 12)
              {
                $(this).removeClass("span" + current_span);
                current_span++;
                $(this).addClass("span" + current_span);
                $(this).css("width", "");
                
              }
            }

            if(current_width < ((span-2) * span_step) + 70)
            {

              current_span = get_element_span(this);
              if(current_span != 1)
              {
                $(this).removeClass("span" + current_span);
                current_span--;
                $(this).addClass("span" + current_span);
                $(this).css("width", "");
              }
            }


          },
        start: function (event, ui) {
                $(this).attr('resizing', 'true');
                block = ui.originalElement;
                min_height = block.css('min-height');
                height = block.css('height');
                if(parseInt(min_height) > parseInt(height))
                  height = min_height;

                block.css('height', height);
                block.css('min-height', '0px');
                
        }, 
        stop: function (event, ui) {
                $(this).attr('resizing', 'false');
                block = ui.originalElement;
                height = block.css('height');
                block.css('height', 'auto');
                block.css('min-height', height);
                span_count = get_element_span(block);
                span = "span" + span_count;
                block_name = block.attr('name');
                $.post("/layout_system/ajax/save_block",
                  {
                      page_path: page_path,
                      size:span,
                      height:block.css('min-height'),
                      name:block_name,
                  },
                  function(data,status){
                    notifyChange();
                  }).error(function() { alert('There was an error saving your changes.\nPlease contact customer support.'); });

              }
      });

      $(this).hover( function(){
        $(this).prepend("<div class='block-overlay'></div>");
        $(this).find(".block-overlay").css('position', 'absolute');
        $(this).find(".block-overlay").css('top', '0px');
        $(this).find(".block-overlay").css('left', '0px');
        $(this).find(".block-overlay").css('width', '100%');
        $(this).find(".block-overlay").css('height', '100%');
        $(this).find(".block-overlay").css('opacity', '0.5');
        $(this).find(".block-overlay").css('border', '2px dotted green');
        $(this).find(".block-overlay").css('z-index', '1');
        if($(this).hasClass('row')){
          $(this).find(".block-overlay").css('left', '20px');  
          width = parseInt($(this).find(".block-overlay").css('width'));
          new_width = width - 20;
          $(this).find(".block-overlay").css('width', new_width + 'px');  

        }
          
      },function (){
        if($(this).hasClass('resizable'))
          $(this).find(".block-overlay").remove();
      }
      )
      
    });
  

    

    

    function check_total_span_sum(element)
    {
      
      sum = 0;
      element.children().each(function (){
        sum += get_element_span(this);

      });
      return sum;
    }

}

function get_element_span(element)
    {
      if($(element).hasClass("span1"))
        return 1;
      if($(element).hasClass("span2"))
        return 2;
      if($(element).hasClass("span3"))
        return 3;
      if($(element).hasClass("span4"))
        return 4;
      if($(element).hasClass("span5"))
        return 5;
      if($(element).hasClass("span6"))
        return 6;
      if($(element).hasClass("span7"))
        return 7;
      if($(element).hasClass("span8"))
        return 8;
      if($(element).hasClass("span9"))
        return 9;
      if($(element).hasClass("span10"))
        return 10;
      if($(element).hasClass("span11"))
        return 11;
      if($(element).hasClass("span12"))
        return 12;

    }
function resizeModeDisable()
{
    $(".resizable").resizable("destroy");
    $(".block-overlay").remove();
    $(".resizable").each(function () {
      $(this).unbind('mouseenter mouseleave');
    });
}

function addBlockModeEnable(block_type)
{
  while(getting_block == true){};
  $(".block-children").each(function (){
    
    if($(this).contents().find('.block-children').length > 0)
      $(this).prepend("<i class='fa fa-plus-square style-icon addable-handle' style='left:-20px;cursor:pointer;background-color:#fff;position:absolute;z-index:9999; width: 19px;height:19px; font-size: 22px;'></i>");
    else  
      $(this).prepend("<i class='fa fa-plus-square style-icon addable-handle' style='cursor:pointer;background-color:#fff;position:absolute;z-index:9999; width: 19px;height:19px; font-size: 22px;'></i>");

    
  });
  $('.addable-handle').hover(function (){

    
    $(this).parent().append("<div class='add-demo' style='background-color: #999; min-height:160px; width: 100%; float:left; clear:both;'><span style='position:relative; display:block;width:100%;line-height:66px;font-size:66px;margin-top:45px; text-align:center; font-weight: bold'>Add Block Here</span></div>");
  }, function (){
    $('.add-demo').remove();
  });  
  $(".block-children").bind( "click.add_block",function (event) {
    addBlockModeDisable();
    event.stopPropagation();
    var parent = $(this);
    $.post("/layout_system/ajax/add_block/" + $(this).attr("block-name") + "/" + block_type, 
      {
        page_path: page_path
      },

      function(data) {
      parent.append(data);
    })
      .fail(function() {
        alert('There was an error performing this operation.\nPlease contact customer support.') ;
      });

  });

  






}

function addBlockModeDisable()
{
  $(".add-demo").remove();
  $(".addable-handle").remove();

  $(".block-children").unbind( "click.add_block");

  $(".block-children").hover(function(){
    $(this).css("background-color","transparent");

    },function(){
    $(this).css("background-color","transparent");
  });
  $(".block-children").css("border", "none");
  $(".block-children").css("cursor", "auto");

}
function deleteBlockModeEnable()
{
  $('a').unbind('click.intercept');
  $('a').bind('click.disable', function(e){
    e.preventDefault();
  });
  $(".block-children").each(
    function (){
      
      deletable_blocks = $(this).children();
      deletable_blocks.hover(function(){
        $(this).css("background-color","red");

        },function(){
        $(this).css("background-color","transparent");
      });

      deletable_blocks.bind( "click.delete_block",function (event) {
        event.stopPropagation();
        event.preventDefault();
        confirmation_text = "Are you sure you want to delete this block?";
        if(!confirm(confirmation_text))
          return;

        var block_obj_to_delete = $(this);
        var parent_name = $(this).parent().attr('block-name');
        $.ajax("/layout_system/ajax/delete_block/" + $(this).attr("name") + "/" + parent_name + "?page_path=" + page_path).error(function() {
          var success = false; 
          alert('There was an error performing this operation.\nPlease contact customer support.') 
        }).success(function()
        {
          
        });

        block_obj_to_delete.remove();
        block_obj_to_delete = null;
      });
    });

  
}

function deleteBlockModeDisable()
{
  $(".block-children").each(
    function (){

      deletable_blocks = $(this).children();
      deletable_blocks.hover(function(){
        $(this).css("background-color","transparent");

        },function(){
        $(this).css("background-color","transparent");
      });

      deletable_blocks.unbind( "click.delete_block");
    });
  $('a').unbind('click.disable');
  $('a').bind('click.intercept',function(e) {
        window.parent.location=$(this).attr('href');
        e.preventDefault();
     });
 
}