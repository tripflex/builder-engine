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
    <style>
    #dataTable_first, #dataTable_previous, #dataTable_next, #dataTable_last
    {

        -webkit-background-clip: border-box;
        -webkit-background-origin: padding-box;
        -webkit-background-size: auto;
        background-attachment: scroll;
        background-clip: border-box;
        background-color: rgb(140, 140, 140);
        background-image: none;
        background-origin: padding-box;
        background-size: auto;
        border-bottom-color: rgb(125, 125, 125);
        border-bottom-style: solid;
        border-bottom-width: 1px;
        border-collapse: collapse;
        border-image-outset: 0px;
        border-image-repeat: stretch;
        border-image-slice: 100%;
        border-image-source: none;
        border-image-width: 1;
        border-left-color: rgb(125, 125, 125);
        border-left-style: solid;
        border-left-width: 1px;
        border-right-color: rgb(125, 125, 125);
        border-right-style: solid;
        border-right-width: 1px;
        border-top-color: rgb(125, 125, 125);
        border-top-style: solid;
        border-top-width: 1px;
        box-sizing: border-box;
        color: rgb(245,245,245);
        cursor: auto;
        display: inline-block;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 17px;
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
        height: 26px;
        line-height: normal;
        list-style-image: none;
        list-style-position: outside;
        list-style-type: none;
        margin-bottom: 1px;
        margin-left: 1px;
        margin-right: 1px;
        margin-top: 1px;
        outline-color: rgb(245, 245, 245);
        outline-style: none;
        outline-width: 0px;
        padding-bottom: 2px;
        padding-left: 8px;
        padding-right: 8px;
        padding-top: 2px;
        text-align: right;
        text-decoration: none solid rgb(245, 245, 245);
        white-space: normal;
        width: 81px;
        cursor: pointer;
    }

    #dataTable_paginate span a 
    {
        cursor: pointer;
        -webkit-background-clip: border-box;
        -webkit-background-origin: padding-box;
        -webkit-background-size: auto;
        background-attachment: scroll;
        background-clip: border-box;
        background-color: rgb(140, 140, 140);
        background-image: none;
        background-origin: padding-box;
        background-size: auto;
        border-bottom-color: rgb(125, 125, 125);
        border-bottom-style: solid;
        border-bottom-width: 1px;
        border-collapse: collapse;
        border-image-outset: 0px;
        border-image-repeat: stretch;
        border-image-slice: 100%;
        border-image-source: none;
        border-image-width: 1;
        border-left-color: rgb(125, 125, 125);
        border-left-style: solid;
        border-left-width: 1px;
        border-right-color: rgb(125, 125, 125);
        border-right-style: solid;
        border-right-width: 1px;
        border-top-color: rgb(125, 125, 125);
        border-top-style: solid;
        border-top-width: 1px;
        box-sizing: border-box;
        color: rgb(245, 245, 245);
        display: inline-block;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 17px;
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
        height: 26px;
        line-height: normal;
        list-style-image: none;
        list-style-position: outside;
        list-style-type: none;
        margin-bottom: 1px;
        margin-left: 1px;
        margin-right: 1px;
        margin-top: 1px;
        outline-color: rgb(245, 245, 245);
        outline-style: none;
        outline-width: 0px;
        padding-bottom: 2px;
        padding-left: 8px;
        padding-right: 8px;
        padding-top: 2px;
        text-align: right;
        text-decoration: none solid rgb(245, 245, 245);
        white-space: normal;
        width: 27px;
    }
    #paging
    {
        -webkit-background-clip: border-box;
        -webkit-background-origin: padding-box;
        -webkit-background-size: auto;
        background-attachment: scroll;
        background-clip: border-box;
        background-color: rgb(235, 235, 235);
        background-image: none;
        background-origin: padding-box;
        background-size: auto;
        border-collapse: collapse;
        border-top-color: rgb(140, 140, 140);
        border-top-style: solid;
        border-top-width: 1px;
        box-sizing: border-box;
        color: rgb(0, 0, 0);
        cursor: auto;
        display: block;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 17px;
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
        height: 33px;
        line-height: normal;
        padding-bottom: 2px;
        padding-left: 2px;
        padding-right: 2px;
        padding-top: 2px;
        text-align: left;
        white-space: normal;
        width: 805px;
    }
    #dataTable_paginate
    {
        float: right;
    }
    .dataTables_info
    {
        margin-top:5px;
        float: left;
    }
    </style>

    <div id="block-editor" style="position:relative; width: 740px;">
<script>
    
    $("#admin-window").css('display','block');
    $("#admin-window").draggable();
    $(".tip").css("float", "left");

    $(".delete-version").click(function () {
        version_id = $(this).attr("version-id");


        version_name = $("#version-name-" + version_id).html();

        if($("#activate-version-" + version_id).attr("active") == "true")
        {
            alert("You cannot delete a currently active version.");
            return;
        }
        confirmed = confirm("Are you sure you want to delete version '" + version_name + "'");
        
        if(!confirmed)
            return;

        oTable = $('#dataTable').dataTable();
        $(this).parents("TR").fadeOut("fast", function () {
        var pos = oTable.fnGetPosition(this);
        oTable.fnDeleteRow(pos);
        });

        $.get("/layout_system/ajax/delete_version/" + version_id, function(data){});
        
        //$(this).parent().parent().parent().remove();
        var iframe = document.getElementById("content-frame");
            iframe.src = iframe.src;
    });

    $(".rename-version").click(function () {
        version_id = $(this).attr("version-id");

        version_name = $("#version-name-" + version_id).html();
        $("#version-name-" + version_id).html("<input type='text' id='version-new-name-" + version_id + "' value='"+version_name+"'>");
        $("#version-name-" + version_id).addClass("nolink");
        $("#rename-version-" + version_id).css("display", "none");
        $("#save-version-" + version_id).css("display", "block");
        
        //$("#save-version-" + version_id).css("width", "14px");
        

        $("#save-version-" + version_id).click(function () {

            new_name = $("#version-new-name-" + version_id).val();
            $.post('/layout_system/ajax/version_set_name',
            {
                'id'        : version_id,
                'new_name'  : encodeURIComponent(new_name)
            },
            function(data) {
                $("#version-name-" + version_id).html(new_name);
                $("#save-version-" + version_id).css("display", "none"); 
                $("#rename-version-" + version_id).css("display", "block");  
                
            });
            

        });
        
    });

    $('.toggle-version-activate').click(function () {
        if($(this).attr("approved") != "true")
            return;

        version_id = $(this).attr("version-id");
        $.get("/admin/ajax/version_activate/" + version_id, function(data){
            var iframe = document.getElementById("content-frame");
            iframe.src = iframe.src;
        });  
        $( ".toggle-version-activate" ).each(function( index ) {
            $(this).removeClass("green");
            $(this).attr("active", "false");
            if($(this).attr("approved") == "true")
                $(this).attr("data-original-title", "Switch to this version.");

            
        });

        $(this).addClass("green");
        $(this).attr("active", "true");
        $(this).attr("data-original-title", "This version is already active.");
    });

    $('.toggle-version-approve').click(function () {

        version_id = $(this).attr("version-id");

        if($("#activate-version-" + version_id).attr("active") == "true")
        {
            alert("You cannot disapprove a currently active version.");
            return;
        }
        $.get("/admin/ajax/toggle_version_approved/" + version_id, function(data){});  
        
        if($(this).attr("approved") == "true")
        {
            $(this).attr("approved", "false"); 
            $(this).attr("data-original-title", "Version is not approved");  
           


            $(this).removeClass("i-thumbs-up-3");
            $(this).removeClass("green");

            $(this).addClass("i-thumbs-up-4");
            $(this).addClass("red");

            $("#activate-version-" + version_id).removeClass("green");
            $("#activate-version-" + version_id).addClass("red");
            $("#activate-version-" + version_id).attr("data-original-title", "This version is not approved.");
            $("#activate-version-" + version_id).attr("approved", "false");



        }
        else
        {
            $(this).attr("approved", "true");
            $(this).attr("data-original-title", "Version is approved");  
           
            $(this).removeClass("i-thumbs-up-4");
            $(this).removeClass("red");

            $(this).addClass("i-thumbs-up-3");
            $(this).addClass("green");

            $("#activate-version-" + version_id).removeClass("red");
            $("#activate-version-" + version_id).attr("data-original-title", "Switch to this version.");
            $("#activate-version-" + version_id).attr("approved", "true");

        }

    });



    $(".tip").css('cursor', "pointer");
    $(".save-version").css('display', "none");

    $(".tip").tooltip ({placement: 'top'}); 

    $(".tooltip").css('position','absolute');
    $("#admin-window").mousemove(function(e) {
        var x_offset = - parseInt($('.tooltip').css('width'))/2;
        var y_offset = -60;
        left = e.pageX + x_offset - parseInt($("#admin-window").css('left'));
        $('.tooltip').css('left', left).css('top', e.pageY + y_offset- parseInt($("#admin-window").css('top')) );
    });
        //------------- Data tables -------------//
    $('#dataTable').dataTable( {
        "sDom": "<'row-fluid'flt <'#paging'pi>>",
        "sPaginationType": "full_numbers",
        "bJQueryUI": true,
        "bAutoWidth": false,
        "bSort": false,
        "oLanguage": {
            "sSearch": "<span>Filter:</span> _INPUT_",
            "sLengthMenu": "<span>_MENU_ entries</span>",
            "oPaginate": { "sFirst": "First", "sLast": "Last" },
        }
    });

    
    </script>
<style>
.pagination li {
    border: none !important;
    padding: 0px !important;
}
.tooltip {
    margin-top: -8px !important;
    position: absolute;
}
#block-editor .tip {
    width: 20px;
    z-index: 99999999 !important;
}
</style>
    <div class="block-editor"  style="width: 840px; position: absolute">
        <div class="row-fluid" style="position:relative">
            <div class="span12">
                <div class="widget second">
                    <div class="widget-title">
                        <div class="icon"><i class="icon20 i-menu-6"></i></div>
                        <?if($mode == "layout"):?>
                        <h4>Global Versions</h4>
                        <?else:?>
                        <h4>Page Versions</h4>
                        <?endif;?>
                        <a href="#" id="versions-close" class="close i-close-2"></a>
                    </div><!-- End .widget-title -->

                    <div class="widget-content">
                        <form class="form-horizontal">
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="span12">
                                        <div class="datagrid">
                                            <table id="dataTable">
                                            <thead>
                                                <tr><th>Name</th><th>Creator</th><th>Approver</th><th>Date</th><th>Actions</th></tr>
                                            </thead>
                                            
                                            <tbody>
                                                <? foreach($page_versions as $version): ?>
                                                <tr>
                                                    <td id="version-name-<?=$version->id?>"><?=$version->name?></td>
                                                    <td><?=$version->author?></td>
                                                    <td><?=$version->approver?></td>
                                                    <td><?=date("j/n/Y",$version->time_created)." at ".date("g:i A",$version->time_created);?></td>
                                                    <td>
                                                        <div style="width:134px; ">
                                                        <? if($version->approver == "N/A"): ?>
                                                            <span class="tip i-thumbs-up-4 red toggle-version-approve" approved="false" version-id="<?=$version->id?>" data-original-title="Version is rejected"></span>
                                                        <?else:?>
                                                        <span class="tip i-thumbs-up-3 green toggle-version-approve" approved="true" version-id="<?=$version->id?>" data-original-title="Version is approved"></span>
                                                        <?endif;?>
                                                        <? if($version->approver == "N/A"): ?>
                                                        <span id="activate-version-<?=$version->id?>" class="i-checkmark-3 red tip toggle-version-activate" version-id="<?=$version->id?>" active="false" approved="false" data-original-title="Version not approved"></span>

                                                        <?elseif($version->active == "yes"):?>
                                                        <span id="activate-version-<?=$version->id?>" class="i-checkmark-3 green tip toggle-version-activate" version-id="<?=$version->id?>" active="true" approved="true" data-original-title="This version is already active"></span>
                                                        <?else:?>
                                                        <span id="activate-version-<?=$version->id?>" class="i-checkmark-3 tip toggle-version-activate" version-id="<?=$version->id?>" active="false" approved="true" data-original-title="Switch to this version"></span>
                                                        <?endif;?>
                                                        <span class="i-remove-5 tip delete-version" version-id="<?=$version->id?>" data-original-title="Delete version"></span>
                                                        <span id="rename-version-<?=$version->id?>" version-id="<?=$version->id?>" class="rename-version i-pencil tip" data-original-title="Rename version"></span>
                                                        <span id="save-version-<?=$version->id?>" version-id="<?=$version->id?>" class="save-version i-disk tip" data-original-title="Save"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <? endforeach; ?>
                                            </tbody>
                                            </table>
                                        </div>
                                        
                                    </div><!-- End .span12  -->
                                </div><!-- End .controls-row -->
                            </div><!-- End .control-group  -->
                        </form>

                    </div><!-- End .widget-content -->

                </div><!-- End .widget -->
            </div><!-- End .span6  -->
        </div>
    </div>
</div>