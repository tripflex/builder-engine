<?php include("header.php");?>

                <script src="<?php echo get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
                <script src="<?php echo get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
                <script src="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.js"></script> 
                <script src="<?php echo get_theme_path()?>/js/pages/form-validation.js"></script><!-- Init plugins only for page -->
                <link href="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.css" rel="stylesheet" />

<script>


    
var installation_completed = false;
var updates = 0;
var current_update = 1;
function progress(percent, instant)
{    

    if(instant){
        $('#progress').animate({"width": percent/100*1046}, 1, "linear", function(){});
    }                                                                            
    else
        $('#progress').animate({"width": percent/100*1046}, 1500, "linear", function(){});
}
function get_updates_num()
{
    $.get("http://" + document.domain + '/index.php/admin/update/get_updates_num', function (data) {
        updates = data;
    });
}
function finish()
{
    installation_completed = true;
    $("#status-message-2").html("&nbsp;");
        
    $("#status-message").html("Congratulations! Your website update is successfully completed.");
    $("#install-button").html("Redirect to Website");
}
function finishing()
{                                                          
    $("#status-message").html("Finishing Update...");
    
    $.get("http://" + document.domain + '/index.php/admin/update/finish', function (data) {

        if(data == "success"){
            progress(100,false);    
            setTimeout("finish()", 2000)
        }else if(data == "repeat"){
            progress(100, false);
            current_update++;
            
            
            setTimeout("progress(0, true);", 2500);
            
            setTimeout("prepare_update()", 3000);

                
    
        }
        else{
            $("#status-message").html("<span style='color: red'>" + data + "</span>");
        }
            
    });
      
}

function update_database()
{
    $("#status-message").html("Updating database...");

    
    $.get("http://" + document.domain + '/index.php/admin/update/update_db', function (data) {

        if(data == "success"){
            progress(80, false);    
            setTimeout("finishing()", 2000)
        }else {
            $("#status-message").html("<span style='color: red'>" + data + "</span>");
        }
            
    });  
}
function update_php()
{

    $("#status-message").html("Updating files...");
    progress(60,false);
    
    $.get("http://" + document.domain + '/index.php/admin/update/update_files', function (data) {
        if(data == "success")    
            setTimeout("update_database()", 2000)
        else
            $("#status-message").html("<span style='font-color: red'>" + data + "</span>");
    });    
}
function download_update()
{
    $("#status-message").html("Downloading Update...");
    
    $.get("http://" + document.domain + '/index.php/admin/update/download/', function (data) {

        if(data == "success"){
            progress(40,false);    
            setTimeout("update_php()", 2000)
        }else {
            $("#status-message").html("<span style='color: red'>" + data + "</span>");
        }
            
    });
            
}
function prepare_update()
{

    $("#status-message").html("Preparing update...");
    $("#status-message-2").html("Processing update " + current_update + " of " + updates);


    
    $("#status-message").html("Preparing update...");
    progress(20,false);
    setTimeout("download_update()", 2000);
}
$(document).ready(function(){
    get_updates_num();
    $("#button-next").click(function (){

        <?php if(in_array(false, $requirements)):?>
        setTimeout("$(\"#button-next\").attr(\"disabled\", \"disabled\");", 1000);
        <?endif?>
    });
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
        progress(0);
    });
    $("#install-button").click(function(){
        if(installation_completed)
            window.location = "/admin";
        else{                                   
            prepare_update();
        }
                    
    });
    ;
       
});


</script>                
                <div class="container-fluid">
                    <div id="heading" class="page-header">
                        <h1><i class="icon20 i-dashboard"></i>BuilderEngine Update Facility</h1>
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
                                        <div class="step" id="overview">
                                            <span data-icon="i-screen-2" data-text="Overview"></span>
                                            
                                            
                                            

                                        
                                         
                                            <div class="control-group">
                                                <h2>Website Update</h2>
                                                <p>
                                                    <b>
                                                        Click NEXT to continue with your website update.    
                                                    </b>
                                                </p>

                                            </div>
   
                                        
                                            
                                            
                                        </div>
                                        
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
                                                            <td><div class="btn rounded btn-success icon16 <?if($requirements['php_version']):?> btn-success i-checkmark-3<?else:?>btn-danger i-close<?endif?>"></div><?if($requirements['php_version']):?> PHP <?php echo get_php_version();?><?else:?>At least version 5.0 required<?endif?></td>
                                                            <td><div class="btn rounded btn-success icon16 i-checkmark-3"></div>Image Manipulation Available</td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><div class="btn rounded btn-success icon16 i-checkmark-3"></div> JavaScript Enabled</td>
                                                            <td><div class="btn rounded btn-success icon16  <?if($requirements['mod_rewrite']):?> btn-success i-checkmark-3<?else:?>btn-danger i-close<?endif?>"></div> <?if($requirements['mod_rewrite']):?> Supports BuilderEngine request URLs<?else:?>No mod_rewrite available or .htaccess file error<?endif?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><div class="btn rounded btn-success icon16 <?if($requirements['mysql_available']):?> btn-success i-checkmark-3<?else:?>btn-danger i-close<?endif?>"></div><?if($requirements['mysql_available']):?> MySQL Available<?else:?>No MySQL connector available<?endif?></td>
                                                            <td><div class="btn rounded icon16 <?if($requirements['writable']):?> btn-success i-checkmark-3<?else:?>btn-danger i-close<?endif?>"></div><?if($requirements['writable']):?> Website folder is writable<?else:?>Website folder is NOT writable<?endif?></td>
                                                        </tr>
                                     
                                                        
                                             
                                                    </tbody>
                                                </table>
                                            </div><!-- End .control-group  -->
   
                                        
                                            
                                        </div>
                                
                                        <div class="step submit_step" id="account">
                                            <span data-icon="i-checkmark-circle-2" data-text="Update"></span>
                                           
                                                <div id="status-message-2" style="font-weight: bold; width: 100%; text-align: center; color: green">&nbsp;</div>
                                                <div id="status-message" style="font-weight: bold; width: 100%; text-align: center">We have collected enough information to update your website. When you feel you are ready, please click the update button.</div>
                                      
                                            <div style="padding-left: 50%;">
                                                <div style="margin-left: -523px; width: 1046px">
                               
                                                    <div class="">
                                                        <div class="progress progress-striped active tip rounded" title="40%" style="height: 23px; width: 1046px;">
                                                            <div id="progress" class="bar "></div>
                                                        </div>
                                                    </div>
                                                    <div style="padding-left: 50%;">
                                                        <button id="install-button" style="margin-left: -80px; margin-top: 10px; font-weight: bold" class="btn btn-primary rounded">Begin Update</button>
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