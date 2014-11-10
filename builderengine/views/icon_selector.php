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
$(document).ready( function () {
    var target_icon = "#"+'<?=$target?>';
    var last_choice = null;
    $("#color-picker").spectrum({
        preferredFormat: "hex6",
        color: $(target_icon).css("color"),
        showInput: true,
        showInitial: true,     
        clickoutFiresChange: true,
        chooseText: "Select",
        cancelText: "Close"
    });
    $("#admin-window-close").click( function () {
        $('.sp-container').remove();
    });
    $("#color-picker").change( function () {
        target_icon = "#"+'<?=$target?>';
        $(target_icon).css("color",  $("#color-picker").attr("value"));

        $.post("/index.php/admin/ajax/save_block",
        {
            style: "color: " + $(".sp-preview-inner").css("background-color") + ";",
            id:$(target_icon).attr("blockid")
        },
        function(data,status){

        });
    });

    $(".biggy-icon").click( function () {
        if(last_choice != null)
            $(last_choice).css("color", "#000");
   
        last_choice = "#" + $(this).attr("id"); 
        $(this).css("color", "green");
        $(target_icon).removeClass();
        $(target_icon).addClass($(this).attr("classname"));
        $(target_icon).css("color",  $(".sp-preview-inner").css("background-color"));
        $.post("/index.php/admin/ajax/save_block",
        {
            classes:$(this).attr("classname"),
            style: "color: " + $(".sp-preview-inner").css("background-color")  + ";",
            id:$(target_icon).attr("blockid")
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
                        <h4>Icon Selector</h4>

                        <a href="#" id="admin-window-close" class="close i-close-2"></a>
                    </div><!-- End .widget-title -->

                    <div class="widget-content">
                        <form class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label" for="colorpicker">Color picker</label>
                                <div class="controls controls-row">
                                    <input type="text" id="color-picker" />
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="span12">
                                        <?
                                        $i = 1;
                                        foreach($classes as $class):?>
                                            <i id="icon-sample-<?=$i?>" class=" <?=$class?> biggy-icon" classname="<?=$class?>"></i>
                                        <?$i++;
                                        endforeach;?>
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