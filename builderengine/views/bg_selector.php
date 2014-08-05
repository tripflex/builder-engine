<link href="<?=get_theme_path()?>js/plugins/forms/spectrum/spectrum.css" rel="stylesheet" /> 
<script src="<?=get_theme_path()?>js/plugins/forms/spectrum/spectrum.js"></script><!--  Color picker -->
<style>
#admin-window .biggy-icon {
    margin-right: 5px;
    margin-bottom: 5px;

    width: 34px !important;
    height: 34px !important;
    font-size: 24px !important;
    cursor: pointer;
    color: #000;
}
.sp-container {
    z-index: 9999999 !important;
}
</style>



<script>
function explode(file)
{
   
    target_bg = "#"+'<?=$target?>';
    var target = $(target_bg);
    target.style("background-image", "url('" + file + "')", "important");

    $.post("/index.php/admin/ajax/save_block",
    {
        style: $(target_bg).attr("style"),
        id:$(target_bg).attr("blockid")
    },
    function(data,status){

    });
}
$(document).ready( function () {
    var target_bg = "#"+'<?=$target?>';
    var last_choice = null;
    $("#color-picker").spectrum({
        preferredFormat: "hex6",
        color: $(target_bg).css("color"),
        showInput: true,
        showInitial: true,     
        clickoutFiresChange: true,
        chooseText: "Select",
        cancelText: "Close"
    });
    $("#admin-window-close").click( function () {
        $('.sp-container').remove();
    });

    

    $("#no-bg-button").click( function () {
        target_bg = "#"+'<?=$target?>';
        var target = $(target_bg);
        target.style("background-image", "none", "important");

        $.post("/index.php/admin/ajax/save_block",
        {
            style: "background-image: none; background-color: " + target.css("background-color") + " !important;",
            id:$(target_bg).attr("blockid")
        },
        function(data,status){

        });
    });

    $("#color-picker").change( function () {
        target_bg = "#"+'<?=$target?>';
        var target = $(target_bg);
        target.style("background-image", "none");

        target.style("background-color",  $("#color-picker").attr("value"), "important");

        $.post("/index.php/admin/ajax/save_block",
        {
            style: $(target_bg).attr("style"),
            id:$(target_bg).attr("blockid")
        },
        function(data,status){

        });
    });

    
});
</script>

<div id="block-editor" style="position:relative; width: 740px;">

    <div class="block-editor"  style="width: 740px; position: absolute">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget second">
                    <div class="widget-title">
                        <div class="icon"><i class="icon20 i-menu-6"></i></div>
                        <h4>Designer</h4>

                        <a href="#" id="admin-window-close" class="close i-close-2"></a>
                    </div><!-- End .widget-title -->

                    <div class="widget-content">
                        <form class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label" for="colorpicker">Background Color</label>
                                <div class="controls controls-row">
                                    <input type="text" id="color-picker" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="colorpicker">Background Image</label>
                                <div class="controls controls-row">
                                    <a href="#" id="no-bg-button"><span class="btn btn-primary">None</span></a> <b>OR</b>

                                    <a href="/admin/files/show/embedded/?type=Images" onclick="window.open(this.href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=900,height=300'); return false;"><span class="btn btn-primary">Browse Server</span></a>

                                </div>
                            </div>
                            


                        </form>

                    </div><!-- End .widget-content -->

                </div><!-- End .widget -->
            </div><!-- End .span6  -->
        </div>
    </div>
</div>