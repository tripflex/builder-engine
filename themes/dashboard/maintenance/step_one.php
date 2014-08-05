<?php echo get_header();?>

                <script src="<?php echo get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
                <script src="<?php echo get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
                <script src="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.js"></script>
                <script src="<?php echo get_theme_path()?>/js/pages/form-validation.js"></script><!-- Init plugins only for page -->
                <link href="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.css" rel="stylesheet" />

<script>



var installation_completed = false;
function progress(percent)
{
    $('#progress').animate({"width": percent/100*1046}, 1500, "linear", function(){


    });

}

function finish()
{
    installation_completed = true;
    $("#status-message").html("Congratulations! Your website installation is successfully completed.");
    $("#install-button").html("Redirect to Website");
}
function finishing()
{
    $("#status-message").html("Finishing Installation...");

    $.get("http://" + document.domain + '/index.php/admin/install/finish', function (data) {

        if(data == "success"){
            progress(100);
            setTimeout("finish()", 2000)
        }else {
            $("#status-message").html("<span style='color: red'>" + data + "</span>");
        }

    });

}

function create_admin()
{
    $("#status-message").html("Creating Administrator Account...");


    $.post("http://" + document.domain + '/index.php/admin/install/create_admin',
    {
         admin_username:    encodeURIComponent($("#admin_username").val()),
         admin_password:    encodeURIComponent($("#admin_password").val()),
         admin_email:       encodeURIComponent($("#admin_email").val())

    }, function (data) {

        if(data == "success"){
            progress(80);
            setTimeout("finishing()", 2000)
        }else {
            $("#status-message").html("<span style='color: red'>" + data + "</span>");
        }

    });
}
function configure_website()
{

    $("#status-message").html("Configuring Website...");
    progress(60);

    $.post("http://" + document.domain + '/index.php/admin/install/configure/',
    {
        sitename: encodeURIComponent($("#sitename").val()),
        host: encodeURIComponent($("#db_host").val()),
        user: encodeURIComponent($("#db_user").val()),
        password: encodeURIComponent($("#db_pass").val()),
        db: encodeURIComponent($("#db_name").val())
    }, function (data) {
        if(data == "success")
            setTimeout("create_admin()", 2000)
        else
            $("#status-message").html("<span style='font-color: red'>" + data + "</span>");
    });
}
function install_db()
{
    $("#status-message").html("Installing Database...");

    $.post("http://" + document.domain + '/index.php/admin/install/install_db/',
    {
        host: encodeURIComponent($("#db_host").val()),
        user: encodeURIComponent($("#db_user").val()),
        password: encodeURIComponent($("#db_pass").val()),
        db: encodeURIComponent($("#db_name").val()),
    }, function (data) {
        if(data == "success"){
            progress(40);
            setTimeout("configure_website()", 2000)
        }else {
            $("#status-message").html("<span style='color: red'>" + data + "</span>");
        }

    });

}
$(document).ready(function(){
    <?php if(in_array(false, $requirements)):?>
    setTimeout("$(\"#button-next\").attr(\"disabled\", \"disabled\");", 500);
    <?php endif?>
    $("#wizard3").formwizard({
         formPluginEnabled: true,
         validationEnabled: true,
         validationOptions: {
             rules: {
                 sitename: {
                     required: true
                 },
                 admin_username: {
                     required: true
                 },
                 admin_password: {
                     required: true,
                     minlength: 5
                 },
                 admin_password_confirm: {
                     required: true,
                    equalTo: "#admin_password"
                 },
                 db_host: {
                     required: true,
                 },
                 db_user: {
                     required: true
                 },
                 db_pass: {
                     required: true,
                 },
                 db_name: {
                     required: true,
                 }

             },
             messages: {
                 firstname: {
                     required: "I need to know your first name Sir"
                 },
                 email: {
                     required: "You email is required Sir"
                 }
             }
         },
         focusFirstInput : true,
         formOptions :{
            success: function(data){
                //produce success message
            },
            resetForm: false
         },
         disableUIStyles: true,
         showSteps: true //show the step
    });

    $("#reset").click(function(){
        ("#status-message").html("We have collected enough information to install your new website. When you feel you are ready, please click the install button.");
        progress(0,"");
    });
    $("#install-button").click(function(){
        if(installation_completed)
            window.location = "/admin";
        else{
            $("#status-message").html("Preparing installation...");
            progress(20);
            setTimeout("install_db()", 2000);
        }

    });
    ;

});


</script>
                <div class="container-fluid">
                    <div id="heading" class="page-header">
                        <h1><i class="icon20 i-dashboard"></i>BuilderEngine Installation</h1>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-wand"></i></div>
                                    <h4>Installation Progress</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .widget-title -->

                                <div class="widget-content">

                                    <form id="wizard3" class="form-horizontal">
                                        <div class="msg"></div>
                                        <div class="wizard-steps"></div>
                                        <div class="step" id="first">
                                            <span data-icon="i-screen-2" data-text="Environment check"></span>






                                            <div class="control-group">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="span12">Testing Required Items</th>
                                                            <th class="span12"></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        <tr>
                                                            <td><div class="btn rounded btn-success icon16 <?php if($requirements['php_version']):?> btn-success i-checkmark-3<?php else:?>btn-danger i-close<?php endif?>"></div><?php if($requirements['php_version']):?> PHP <?php echo get_php_version();?><?php else:?>At least version 5.0 required<?php endif?></td>
                                                            <td><div class="btn rounded btn-success icon16 <?php if($requirements['short_tags']):?>btn-success i-checkmark-3<?php else:?>btn-danger i-close<?php endif?>"></div>PHP Short Opening Tags <a href="http://www.php.net/manual/en/language.basic-syntax.phptags.php">More Info</a></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><div class="btn rounded btn-success icon16 i-checkmark-3"></div> JavaScript Enabled</td>
                                                            <td><div class="btn rounded btn-success icon16  <?php if($requirements['mod_rewrite']):?> btn-success i-checkmark-3<?php else:?>btn-danger i-close<?php endif?>"></div> <?php if($requirements['mod_rewrite']):?> Supports BuilderEngine request URLs<?php else:?>No mod_rewrite available or .htaccess file error<?php endif?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><div class="btn rounded btn-success icon16 <?php if($requirements['mysql_available']):?> btn-success i-checkmark-3<?php else:?>btn-danger i-close<?php endif?>"></div><?php if($requirements['mysql_available']):?> MySQL Available<?php else:?>No MySQL connector available<?php endif?></td>
                                                            <td><div class="btn rounded icon16 <?php if($requirements['writable']):?> btn-success i-checkmark-3<?php else:?>btn-danger i-close<?php endif?>"></div><?php if($requirements['writable']):?> Website folder is writable<?php else:?>Website folder is NOT writable<?php endif?></td>
                                                        </tr>
                                     
                                                        
                                             
                                                    </tbody>
                                                </table>
                                            </div><!-- End .control-group  -->



      
                                        </div>
                                        <div class="step" id="personal">
                                            <span data-icon="i-file-4" data-text="Website Details"></span>
                                            <div class="control-group" style="padding-left: 50%">
                                                <div style="width: 1000px; margin-left: -500px">
                                                    <div style="float: left; width: 500px;">
                                                        <div style="float: left; width: 500px;">
                                                            <div class="controls controls-row page-header">
                                                                <h4>Site Information</h4>
                                                            </div> <br>
                                                            <label class="control-label" for="phone">Site Name</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input class="span12 ui-wizard-content" name="sitename" id="sitename" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="controls controls-row page-header">
                                                                <h4>Administrator Information</h4>
                                                            </div> <br>
                                                            <label class="control-label" for="phone">Username</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input id="admin_username" class="span12" name="admin_username" type="text">
                                                            </div>
                                                            <label class="control-label" for="phone">Email Address</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input id="admin_email" class="span12" name="admin_email" type="text">
                                                            </div>
                                                            <label class="control-label" for="phone">Password</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input id="admin_password" class="span12" name="admin_password" type="password">
                                                            </div>
                                                            <label class="control-label" for="phone">Confirm Password</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input class="span12" name="admin_password_confirm" type="password">
                                                            </div>
                                                    </div>

                                                    <div style="float: left; width: 500px;">
                                                        <div style="float: left; width: 500px;">
                                                            <div class="controls controls-row page-header">
                                                                <h4>Database Information</h4>
                                                            </div> <br>
                                                            <label class="control-label" for="phone">MySQL Host</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input id="db_host" class="span12" name="db_host" type="text">
                                                            </div>

                                                        </div>
                                                        <div style="float: left; width: 500px">
                                                            <label class="control-label" for="phone">MySQL Username</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input id="db_user" class="span12" name="db_user" type="text">
                                                            </div>
                                                        </div>
                                                        <div style="float: left; width: 500px">
                                                            <label class="control-label" for="phone">MySQL Password</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input id="db_pass" class="span12" name="db_pass" type="password">
                                                            </div>
                                                        </div>
                                                        <div style="float: left; width: 500px">
                                                            <label class="control-label" for="phone">MySQL Database</label>
                                                            <div class="controls controls-row" style="width: 238px">
                                                                <input id="db_name" class="span12" name="db_name" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- End .control-group  -->

                                        </div>
                                        <div class="step submit_step" id="account">
                                            <span data-icon="i-checkmark-circle-2" data-text="Installation"></span>

                                                <div id="status-message" style="font-weight: bold; width: 100%; text-align: center">We have collected enough information to install your new website. When you feel you are ready, please click the install button.</div>

                                            <div style="padding-left: 50%;">
                                                <div style="margin-left: -523px; width: 1046px">

                                                    <div class="">
                                                        <div class="progress progress-striped active tip rounded" title="40%" style="height: 23px; width: 1046px;">
                                                            <div id="progress" class="bar "></div>
                                                        </div>
                                                    </div>
                                                    <div style="padding-left: 50%;">
                                                        <button id="install-button" style="margin-left: -80px; margin-top: 10px; font-weight: bold" class="btn btn-primary rounded">Begin Installation</button>
                                                    </div>
                                                </div>

                                            </div><!-- End .control-group  -->


                                        </div>

                                        <div class="form-actions full">
                                            <button class="btn pull-left" type="reset" id="reset-button"><i class="icon16 i-arrow-left-2"></i> Back</button>
                                            <button id="button-next" class="btn pull-right" type="submit">Next <i class="icon16 i-arrow-right-3"></i></button>
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