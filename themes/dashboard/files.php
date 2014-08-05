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
?><?if(!$embedded):?>
<?php echo get_header();?> 
    <!-- Core stylesheets do not remove -->

    <link href="<?php echo get_theme_path()?>css/icons.css" rel="stylesheet" />
    <link href="<?php echo get_theme_path()?>css/builderengine-theme/jquery.ui.genyx.css" rel="stylesheet" />
    <!-- Plugins stylesheets -->
    <link href="<?php echo get_theme_path()?>js/plugins/upload/elfinder/css/elfinder.min.css" rel="stylesheet" />
    <link href="<?php echo get_theme_path()?>js/plugins/upload/elfinder/css/theme.css" rel="stylesheet">
 
    <link href="<?php echo get_theme_path()?>js/plugins/upload/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" /> 


	<!-- Upload plugins -->
    <script src="<?php echo get_theme_path()?>js/plugins/upload/elfinder/js/elfinder.min.js"></script>
    <script src="<?php echo get_theme_path()?>js/plugins/upload/plupload/plupload.full.js"></script>
    <script src="<?php echo get_theme_path()?>js/plugins/upload/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>

    <!-- Init plugins -->

    <script src="<?php echo get_theme_path()?>js/pages/file-manager.js"></script><!-- Init plugins only for page -->
<script>
$(document).ready(function () {
    setTimeout("initialize_file_manager();", 500);

});
</script>
<style>
.elfinder-button {
    width: 24px !important;
    height: 24px !important;
}

</style>
    <div class="container-fluid">
        <div id="heading" class="page-header">
            <h1><i class="icon20 i-dashboard"></i> Add New User</h1>
        </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-tree-3"></i></div> 
                                    <h4>File manager</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content noPadding">
                                    <div id="elfinder"></div>
                                </div><!-- End .widget-content -->
                            </div><!-- End .widget -->    
                        </div><!-- End .span12  --> 
                    </div><!-- End .row-fluid  -->
            

                </div> <!-- End .container-fluid  -->

                
            </div> <!-- End .wrapper  -->
        </section>
    </div><!-- End .main  -->
  </body>
</html>



<?else:?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>BuilderEngine File Manager</title>

        <!-- jQuery and jQuery UI (REQUIRED) -->
        <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" media="screen" href="/themes/dashboard/js/plugins/upload/elfinder/css/elfinder.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/themes/dashboard/js/plugins/upload/elfinder/css/theme.css">

        <!-- elFinder JS (REQUIRED) -->
        <script type="text/javascript" src="/themes/dashboard/js/plugins/upload/elfinder/js/elfinder.min.js"></script>

        <!-- elFinder translation (OPTIONAL) -->
        <script type="text/javascript" src="/themes/dashboard/js/plugins/upload/elfinder/js/i18n/elfinder.ru.js"></script>

        <!-- elFinder initialization (REQUIRED) -->
        <script type="text/javascript" charset="utf-8">
            // Helper function to get parameters from the query string.
            function getUrlParam(paramName) {
                var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
                var match = window.location.search.match(reParam) ;
                
                return (match && match.length > 1) ? match[1] : '' ;
            }

            $().ready(function() {
                var funcNum = getUrlParam('CKEditorFuncNum');

                var elf = $('#elfinder').elfinder({
                    url : '/admin/files/connector/',
                    getFileCallback : function(file) {
                        if(typeof window.opener.CKEDITOR != "undefined")
                            window.opener.CKEDITOR.tools.callFunction(funcNum, file);
                        <?php if(isset($_GET['target'])):?>
                        if ( typeof window.opener.file_selected == 'function' ) { 
                            window.opener.file_selected( file,'<?php echo $_GET['target']?>');
                        }
                        <?endif;?>
                        
                        window.close();
                    },
                    resizable: false
                }).elfinder('instance');
            });
        </script>


    </head>
    <body>

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

    </body>
</html>
<?endif?>