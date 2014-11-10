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
                <h4>Add Page</h4>
                
            </div><!-- End .widget-title -->
        
            <div class="widget-content">
                <form id="validate" class="form-horizontal" method="post">
                    <div class="control-group">
                        <label class="control-label" for="required">Title</label>
                        <div class="controls controls-row">
                            <input id="title" type="text" name="title" class="required span12" >
                        </div>
                    </div><!-- End .control-group  -->
                    
                    <div class="control-group">
                        <label class="control-label" for="required">Slug</label>
                        <div class="controls controls-row">
                            <input id="slug" type="text" name="slug" class="required span12" >
                        </div>
                    </div><!-- End .control-group  -->

                    <div class="control-group">
                    <label class="control-label" for="required">Template</label>
                        <div class="controls controls-row">
                            <select name="template">
                                <option value="__blank__">Blank Page</option>
                                <? foreach($theme_pages as $theme_page): ?>
                                <option value="<?=$theme_page?>"><?=$theme_page?></option>
                                <? endforeach; ?>
                            </select>
                        </div>

                    </div><!-- End .control-group  -->

                    <div class="control-group">
                    <label class="control-label" for="required">Content</label>
                        <div class="controls controls-row">
                            <span>When you submit this form you will be redirected to the new website page where you can edit its contents.
                                <br>If you have chosen a template your new page will have its initial content loaded from that template (if your currently active theme offers any page templates).</span>
                        </div>

                    </div><!-- End .control-group  -->

                   
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Add Page">
                    </div>
                </form>
            </div><!-- End .widget-content -->
        </div><!-- End .widget -->
    </div><!-- End .span12  --> 
</div><!-- End .row-fluid  -->