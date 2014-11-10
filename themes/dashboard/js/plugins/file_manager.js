    $(document).ready(function () {
        $(document).find('input:file').each(function() {
            if($(this).attr('rel') != "file_manager")
                return;
            $(this).attr('onClick','file_manager(\'' + this.name + '\')');
            file = $(this).attr('file_value');
            $("<input type='hidden' />").attr({ value: $(this).attr('file_value'), name: this.name  }).insertBefore(this);

            this.name = this.name + "_old";
            if(file != "")
            {
                var file_name_string = file;

                var file_name_array = file_name_string.split(".");
                var file_extension = file_name_array[file_name_array.length - 1];

                $('[name="'+this.name + '"]').parent().parent().append('<div class="controls controls-row"><img class="file_preview" style="float: left" src="" alt="No Image" height="120px;" width="120px"></div>');
                $('[name="'+this.name + '"]').parent().parent().find(".file_preview").attr('src', file);
            }
        });
    });
    function file_manager(target)
    {
        window.open("/admin/files/show/embedded?target="+target,"myWindow","width=1000,height=420");
    }
    function file_selected(file, target){
        var file_name_string = file;

        var file_name_array = file_name_string.split(".");
        var file_extension = file_name_array[file_name_array.length - 1];
        if(file_extension == "jpg" || file_extension == "png")
        {
            $('[name="'+target + '"]').parent().parent().find(".file_preview").remove();
            $('[name="'+target + '"]').parent().parent().append('<div class="controls controls-row"><img class="file_preview" src="" alt="No Image" height="120px;" width="120px"></div>');
            $('[name="'+target + '"]').parent().parent().find(".file_preview").attr('src', file);

        }    
        $('[name="'+target + '"]').attr('value',file);
        $('[name="'+target + '"]').parent().find(".filename").html(file);
    }
