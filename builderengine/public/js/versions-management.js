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

function initialize_versions_manager(data)
{
    $("#admin-window").html(data);      
    $("#versions-close").click(function () {
        $(".block-editor").remove();    
    });
}