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
        
        $("#validate").validate({
             ignore: null,
            ignore: 'input[type="hidden"]',
             rules: {
                 select1: "required",
                email: {
                    required: true
                },
                username: {
                    required: true
                },

                 password: {
                    
                    minlength: 5
                },
                confirm_password: {
                    equalTo: "#password"
                },
                textarea: {
                    required: true,
                    minlength: 10
                },
                rangelenght: {
                  required: true,
                  rangelength: [10, 20]
                },
                range: {
                  required: true,
                  range: [5, 10]
                },
                minval: {
                  required: true,
                  min: 13
                },
                maxval: {
                  required: true,
                  max: 13
                },
                date: {
                  required: true,
                  date: true
                },
                number: {
                  required: true,
                  number: true
                },
                digits: {
                  required: true,
                  digits: true
                },
                ccard: {
                  required: true,
                  creditcard: true
                },
                agree: "required"
             },
             messages: {
                 password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                email: {
                    remote: "This email is already in use.",
                },
                username: {
                    remote: "This username is already in use.",
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as adbove"
                },
                
                agree: "Please accept our policy",
                textarea: "Write some info for you",
             }
         });
    });
     </script>
     
    
                
                <div class="container-fluid">
                    <div id="heading" class="page-header">
                        <h1><i class="icon20 i-dashboard"></i> User Groups</h1>
                    </div>

                    <?php foreach($groups as $group): ?>
                    <div class="row-fluid">
                        <div class="span6">
                                <div class="widget closed">
                                    <div class="widget-title">
                                        <div class="icon"><i class="icon20 i-cube"></i></div> 
                                        <h4><?php echo $group->name?></h4>
                                        
                                        <a href="#" class="minimize disabled"></a>
                                        
                                        <div class="w-right">
                                            <a href="/index.php/admin/user/edit_group/<?php echo $group->id?>"><span class="btn btn-warn btn-mini"> Edit </span> </a>
                                            
                                        </div>
                                    </div><!-- End .widget-title -->
                                
                                    <div class="widget-content">
                                        <?php if($group->description): ?>
                                            <?php echo $group->description?>
                                        <?php else: ?>
                                            No description.
                                        <?php endif; ?>
                                    </div><!-- End .widget-content -->
                                </div><!-- End .widget -->
                            </div><!-- End .span6  --> 
                             
                    </div><!-- End .row-fluid  -->
                    <?php endforeach; ?>
                </div> <!-- End .container-fluid  -->
            </div> <!-- End .wrapper  -->
        </section>
    </div><!-- End .main  -->
  </body>
</html>