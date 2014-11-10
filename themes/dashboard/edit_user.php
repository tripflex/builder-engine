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
        
        $("#validate").validate({
             ignore: null,
            ignore: 'input[type="hidden"]',
             rules: {
                 select1: "required",
                email: {
                    required: true,
                    remote: {
                        url: "/index.php/admin/user/validate_email/" + encodeURIComponent("<?php echo $user_data->email?>"),
                        type: "post"
                    }
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
                        <h1><i class="icon20 i-dashboard"></i> Edit User</h1>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-stack-checkmark"></i></div> 
                                    <h4>User Details</h4>
                                    
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content">
                                    <form id="validate" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $user_data->id?>">

                                        <div class="control-group">
                                            <label class="control-label" for="required">Username</label>
                                            <div class="controls controls-row">
                                                <input type="text" id="unique_username" autocomplete="off" name="username" class="span12" disabled value="<?php echo $user_data->username?>" >
                                            </div>
                                        </div><!-- End .control-group  -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="required">Name</label>
                                            <div class="controls controls-row">
                                                <input type="text" name="name" class="span12" autocomplete="off" value="<?php echo $user_data->name?>" >
                                            </div>
                                        </div><!-- End .control-group  -->
                                        <div class="control-group">
                                            <label class="control-label" for="avatar">Avatar</label>
                                            <div class="controls controls-row">
                                                <div class="profile-avatar">
                                                <?php if(file_exists("files/avatars/".$user_data->username.".jpg")): ?>
                                                    <img src="/files/avatars/<?php echo $user_data->username?>.jpg" alt="SuggeElson">
                                                <?php else: ?>
                                                    <img src="<?php echo get_theme_path()?>/images/avatars/no_avatar.jpg" alt="SuggeElson">
                                                <?php endif; ?>
                                                    
                                                </div>
                                                <input type="file" name="avatar">
                                            </div>
                                        </div><!-- End .control-group  -->
                                        <div class="control-group">
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls controls-row">
                                                <input id="password" name="password" type="password" autocomplete="off" class="span12" placeholder="New Password" />
                                            </div>
                                        </div><!-- End .control-group  -->
                                        <div class="control-group">
                                            <label class="control-label" for="password1">Confirm password</label>
                                            <div class="controls controls-row">
                                                <input id="confirm_password" name="confirm_password" autocomplete="off" type="password" class="span12" placeholder="Confirm New Password" />
                                            </div>
                                        </div><!-- End .control-group  -->
                                        <div class="control-group">
                                            <label class="control-label" for="required">Email</label>
                                            <div class="controls controls-row">
                                                <input type="text" id="unique_email" name="email" autocomplete="off" class="required email span12" value="<?php echo $user_data->email?>">
                                            </div>
                                        </div><!-- End .control-group  -->
                                       
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="tags">Groups</label>
                                            <div class="controls controls-row">
                                                <input class="span12" id="groups" type="text" name="groups" value="<?php echo $user_data->groups_string?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Edit User</button>
                                        </div>
                                    </form>
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