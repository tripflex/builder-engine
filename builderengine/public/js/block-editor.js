
function edit_block(id)
{
    
        $("#admin-window").remove();
        $( "body" ).append( "<div id='admin-window' style='position:absolute;top:0px'> </div>" );
 
        
        $.get('http://devcms.radianmx.com/admin/ajax/load_block_editor', function(data) {
            $("#admin-window").html(data);
            $('#text-editor').html($("#"+id).html()); 
            $('#text-editor').wysihtml5();  

            $("#save-button").click(function (){
                html = $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html();
                $("#"+id).html(html);
                 

                $.post("/index.php/admin/ajax/save_block",
                {
                    contents:encodeURIComponent(html),
                    id:$("#"+id).attr( 'blockid')
                },
                function(data,status){

                });

                $("#block-editor").remove();
            });
            $("#cancel-button").click(function (){
                $("#block-editor").remove();
            });


            $("#admin-window").draggable();  
        });
        
                                                                                                                                          
}
function edit_mode(){
    $(".block").css("border","2px dotted red");
    $(".block").css("float","left");
    
    $(".block").find('a').click(function(e){e.preventDefault();});
    $(".block").click(function(){
        edit_block($(this).attr("id"));
                  
    });
    
    $(".block").hover(function(){
        var old_color =  $(this).css("background-color");
        $(this).css("background-color","#0af");
        $(this).css("cursor","pointer");
        
        $(this).hover(function(){},function(){
            $(this).css("background-color",old_color);    
        });    
    }
    );
    
}
    //------------- WysiHtml5 editor -------------//
    $(document).ready(function(){
        //alert(page_path);
        
    });
