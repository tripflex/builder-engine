<?php
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
 echo get_header();?>

                <script src="<?php echo get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
                <script src="<?php echo get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
                <script src="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.js"></script> 
                <script src="<?php echo get_theme_path()?>/js/pages/form-validation.js"></script><!-- Init plugins only for page -->
                <link href="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.css" rel="stylesheet" />
                
                <script>
                    $(document).ready(function() {
                        $("#groups").select2({tags:[ <?php foreach ($groups as $group): ?>"<?php echo $group->name?>", <?endforeach;?>]});
                        $("#tags").select2({tags:[]});
                    });
                </script>
                <div class="container-fluid">

                    <div id="heading" class="page-header">
                        <h1><i class="icon20 i-dashboard"></i> Website Theme Selection</h1>
                    </div>
                    

                    <div class="row-fluid">
                        <h2>Currently Active Theme</h2>
                            <div class="span6">
                                <div class="widget">
                                    <div class="widget-title">
                                        <div class="icon"><i class="icon20 i-cube"></i></div> 
                                        <h4><?php echo $active_theme['name']?></h4>
                                        
                                    </div><!-- End .widget-title -->
                                    <img src="<?php echo $active_theme['screenshot_url']?>" style="float: left; height: 120px;margin:10px;">
                                    <div class="widget-content" style="min-height: 170px;">
                                        <?php echo $active_theme['description']?>
                                    </div><!-- End .widget-content -->
                                </div><!-- End .widget -->
                            </div><!-- End .span6  -->
                    </div>
<h2>Available Themes</h2>
                    <div class="row-fluid">
                        <?foreach($themes as $theme):?>
                        <div class="span3">
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-cube"></i></div> 
                                    <h4><?php echo $theme['name']?></h4>
                                    <div class="w-right">
                                        <form action='' method='post'>
                                            <input type="hidden" name="theme" value="<?php echo $theme['name']?>">
                                        <?if($theme['name'] == $active_theme['name']):?>
                                            <button class="btn btn-success btn-mini disabled" disabled> Already Active </button>
                                        <?else:?>
                                            <input type=submit class="btn btn-success btn-mini " value="Activate">  
                                        <?endif;?>
                                        </form>
                                        </div>
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content center">
                                    <img src="<?php echo $theme['screenshot_url']?>"  style="height: 120px;margin:10px;">
                                </div><!-- End .widget-content -->
                            </div><!-- End .widget -->
                        </div><!-- End .span3  -->
                        <?endforeach;?>
                         
                    </div><!-- End .row-fluid  -->




                </div> <!-- End .container-fluid  -->
            </div> <!-- End .wrapper  -->
        </section>
    </div><!-- End .main  -->
  </body>
</html>