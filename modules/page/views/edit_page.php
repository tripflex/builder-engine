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
<script>
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}

$(document).ready(function (){
    $("#post-edit-contents").click( function (event) {
        $("#post-edit-contents").children().html("Preparing Editor...");
        $.ajax("/admin/ajax/set_user_edit_mode/true");
        event.preventDefault();
        setTimeout('window.location = "'+$(this).attr("href") + '"', 1000);
    });

    $("#title").keyup(function() {
        $("#slug").val($("#title").val());
        $("#slug").change();
    });     
    
    $("#slug").keyup(function() {
        $("#slug").change();
    });
    $("#slug").change(function() {
        $("#slug").val(convertToSlug($("#slug").val()));
        
    });
    
         
});

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-title">
                <div class="icon"><i class="icon20 i-stack-checkmark"></i></div> 
                <h4>Edit Page</h4>
                
            </div><!-- End .widget-title -->
        
            <div class="widget-content">
                <form id="validate" class="form-horizontal" method="post">
                    <input type="hidden" name="id" value="<?=$page->id?>">
                    <div class="control-group">
                        <label class="control-label" for="required">Title</label>
                        <div class="controls controls-row">
                            <input type="text" name="title" class="required span12" value="<?=$page->title?>" >
                        </div>
                    </div><!-- End .control-group  -->
                    
                    <div class="control-group">
                        <label class="control-label" for="required">Slug</label>
                        <div class="controls controls-row">
                            <input id="slug" type="text" name="slug" class="required span12" value="<?=$page->slug?>" >
                        </div>
                    </div><!-- End .control-group  -->

                    <div class="control-group">
                    <label class="control-label " for="required">Content</label>
                        <div class="controls controls-row">
                            <a id="post-edit-contents" href="<?=base_url("/editor/page-{$page->slug}.html?force-editor-mode=edit")?>"><span class="btn btn-primary">Edit Contents</span></a>
                        </div>
                    </div><!-- End .control-group  -->

                   
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Edit Page">
                    </div>
                </form>
            </div><!-- End .widget-content -->
        </div><!-- End .widget -->
    </div><!-- End .span12  --> 
</div><!-- End .row-fluid  -->