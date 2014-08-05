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
  <body>
    <script>
    $(document).ready(function (){


        $("#recovery").validate({
            ignore: null,
            ignore: 'input[type="hidden"]',
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
             messages: {
                 password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please cofirm your password",
                    equalTo: "Please please enter the same password"
                }
             }
        });
    });
    </script>
    <div class="container-fluid">
        <div id="login">
            <div class="login-wrapper" data-active="log">
               <a class="brand" href="dashboard.html"><img src="<?php echo get_theme_path()?>/images/builderengine_logo.png" alt="BuilderEngine Admin"></a>
                <div id="log">
                    
                    <div class="page-header">
                        <h3 class="center">Password recovery</h3>
                    </div>
                    <?if(!$token):?>
                        <div class="row-fluid">
                            <div class="control-group">
                                <div class="controls-row">
                                    <h2>Invalid password reset link</h2>   
                                </div>
                            </div><!-- End .control-group  -->
                        </div>
                    <?else:?>
                    <form id="recovery" class="form-horizontal" action="" method="post">
                        <input type="hidden" name="token" value="<?php echo $token?>">
                        <div class="row-fluid">
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-user"></i></div>
                                    <input class="span12" id="password" type="password" name="password"  placeholder="New Password" value="">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-key"></i></div>
                                    <input class="span12" id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password" value="">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="form-actions full">
                                
                                <button type="submit" style="margin-left: 96px" class="btn btn-primary span5">Save Password</button>
                            </div>
                        </div><!-- End .row-fluid  -->
                    </form>
                    <?endif;?>
                                  </div>
                <div id="reg">
                    <div class="page-header">
                        <h3 class="center">Register account</h3>
                    </div>
                    <form class="form-horizontal">
                        <div class="row-fluid">
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-user"></i></div>
                                    <input class="span12" type="text" name="user" id="user" placeholder="Username">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-key"></i></div>
                                    <input class="span12" type="password" name="password" id="password" placeholder="Password">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-key"></i></div>
                                    <input class="span12" type="password" name="password1" id="password_again" placeholder="Re-type password">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-envelop-2"></i></div>
                                    <input class="span12" type="text" name="email" id="email-field" placeholder="Your email">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="form-actions full">
                                <button type="submit" class="btn btn-large btn-block btn-danger">Register my account</button>
                            </div>
                        </div><!-- End .row-fluid  -->
                    </form>
                </div>
                <div id="forgot">
                    <div class="page-header">
                        <h3 class="center">Forgot password</h3>
                    </div>
                    <form class="form-horizontal">
                        <div class="row-fluid">
               
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-envelop-2"></i></div>
                                    <input class="span12" type="text" name="email" id="email-field" placeholder="Your email">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="form-actions full">
                                <button type="submit" class="btn btn-large btn-block btn-success">Recover my password</button>
                            </div>
                        </div><!-- End .row-fluid  -->
                    </form>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
  </body>
</html>