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
<script src="/builderengine/public/js/editor/ckeditor.js">

</script>
<script src="/builderengine/public/js/editor/adapters/jquery.js"></script>
<script>
$(document).ready( function () {


    $( '#post_contents').ckeditor({
        toolbarGroups: [
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },

            { name: 'forms' },
            '/',

            { name: 'styles' },
            { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
            { name: 'insert' },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'colors' },
            { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
            
            { name: 'links' },
        ]

        // NOTE: Remember to leave 'toolbar' property with the default value (null).
    });

});
</script>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-title">
                <div class="icon"><i class="icon20 i-stack-checkmark"></i></div> 
                <h4>Add Blog Post</h4>
                
            </div><!-- End .widget-title -->
        
            <div class="widget-content">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="control-group">
                        <label class="control-label" for="required">Title</label>
                        <div class="controls controls-row">
                            <input type="text" name="title" class="required span12" >
                        </div>
                    </div><!-- End .control-group  -->
                    <div class="control-group">
                        <label class="control-label" for="image">Image</label>
                        <div class="controls controls-row">
            
                            <input type="file" name="image">
                        </div>
                    </div><!-- End .control-group  -->


                   
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Add Post">
                    </div>
                </form>
            </div><!-- End .widget-content -->
        </div><!-- End .widget -->
    </div><!-- End .span12  --> 
</div><!-- End .row-fluid  -->

