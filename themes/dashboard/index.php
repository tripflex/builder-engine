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
        $("#recover-pass-button").click(function (event) {
            $.post("/index.php/admin/main/login",
            {
                forgot: "true",
                email:encodeURIComponent($("#forgot-email").val()),
            },
            function(data,status){
                $("#forgotten-div").html("<b>Please check your email for instructions on how to reset your password.</b>");
            });
            event.preventDefault();
        });

        $("#forgot-password").validate({
            ignore: null,
            ignore: 'input[type="hidden"]',
            rules: {
                email: {
                    required: true,
                    remote: {
                        url: "/index.php/admin/user/email_exists/",
                        type: "post"
                    }
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
             messages: {
                 email: {
                    required: "Please provide your email!",
                    remote: "We do not have an account with that email!"
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
                    <div id="avatar">
                        <img src="<?php echo get_theme_path()?>/images/avatars/no_avatar.jpg" style="width: 78px; height: 78px;" alt="SuggeElson">
                    </div>
                    <div class="page-header">
                        <h3 class="center">Please login</h3>
                    </div>
                    <form id="login-form" class="form-horizontal" action="dashboard.html">
                        <div class="row-fluid">
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-user"></i></div>
                                    <input class="span12" type="text" name="user" id="user" placeholder="Username" value="">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-key"></i></div>
                                    <input class="span12" type="password" name="password" id="password" placeholder="Password" value="">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="form-actions full">
                                <label class="checkbox pull-left">
                                    <input type="checkbox" value="1" name="remember">
                                    <span class="pad-left5">Remember me ?</span>
                                </label>
                                <button id="loginBtn" type="submit" class="btn btn-primary pull-right span5">Login</button>
                            </div>
                        </div><!-- End .row-fluid  -->
                    </form>
                    <p class="center">Don`t have an account? <a href="#" id="register"><strong>Create one now</strong></a></p>
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
                                    <input class="span12" type="password" name="password1" id="password_again" placeholder="Confirm Password">
                                </div>
                            </div><!-- End .control-group  -->
                            <div class="control-group">
                                <div class="controls-row">
                                    <div class="icon"><i class="icon20 i-envelop-2"></i></div>
                                    <input class="span12" type="text" name="email" id="email-field" placeholder="Your Email">
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
                    <div id="forgotten-div">
                        <form id="forgot-password" class="form-horizontal" method="post" action="">
                            <div class="row-fluid">
                   
                                <div class="control-group">
                                    <div class="controls-row">
                                        <div class="icon"><i class="icon20 i-envelop-2"></i></div>
                                        <input class="span12" type="text" name="email" id="forgot-email" placeholder="Your email">
                                    </div>
                                </div><!-- End .control-group  -->
                                <div class="form-actions full">
                                    <input type="submit" id="recover-pass-button" name="forgot" class="btn btn-large btn-block btn-success" value="Recover my password">
                                </div>
                            </div><!-- End .row-fluid  -->
                        </form>
                    </div>
                </div>
            </div>
            <div id="bar" data-active="log">
                <div class="btn-group btn-group-vertical">
                    <a id="log" href="#" class="btn tipR" title="Login"><i class="icon16 i-key"></i></a>
                    <?if($BuilderEngine->get_option("registration_allowed") == "yes"):?>
                    <a id="reg" href="#" class="btn tipR" title="Register account"><i class="icon16 i-user-plus"></i></a>
                    <?endif;?>
                    <a id="forgot" href="#" class="btn tipR" title="Forgot password"><i class="icon16 i-question"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
  </body>
</html>