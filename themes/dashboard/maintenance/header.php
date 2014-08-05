    
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BuilderEngine Update Facility</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="BuilderEngine" />

    <!-- Headings -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700' rel='stylesheet' type='text/css'>
    <!-- Text -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:800" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->
    
    <!-- Core stylesheets do not remove -->
    <link href="<?php echo get_theme_path()?>/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo get_theme_path()?>/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="<?php echo get_theme_path()?>/css/icons.css" rel="stylesheet" />

    <!-- Plugins stylesheets -->
    <link href="<?php echo get_theme_path()?>/js/plugins/misc/fullcalendar/fullcalendar.css" rel="stylesheet" /> 
    <link href="<?php echo get_theme_path()?>/js/plugins/forms/uniform/uniform.default.css" rel="stylesheet" /> 
    <link href="<?php echo get_theme_path()?>/js/plugins/ui/jgrowl/jquery.jgrowl.css" rel="stylesheet" /> 

    <!-- app stylesheets -->
    <link href="<?php echo get_theme_path()?>/css/app.css" rel="stylesheet" /> 

    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="<?php echo get_theme_path()?>/css/custom.css" rel="stylesheet" /> 

    <!--[if IE 8]><link href="css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_theme_path()?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_theme_path()?>/images/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_theme_path()?>/images/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo get_theme_path()?>/images/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?php echo get_theme_path()?>/images/ico/favicon.png">
    <!-- Le javascript
    ================================================== -->
    <!-- Important plugins put in all pages -->
    <script src="<?php echo get_theme_path()?>/js/jquery.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/jquery-ui.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/conditionizr.min.js"></script>  
    <script src="<?php echo get_theme_path()?>/js/bootstrap/bootstrap.js"></script>  
    <script src="<?php echo get_theme_path()?>/js/plugins/core/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/core/jrespond/jRespond.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/jquery.genyxAdmin.js"></script>

    
    <!-- Charts plugins -->
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/flot/jquery.flot.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/flot/jquery.flot.orderBars.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/flot/jquery.flot.time.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/sparklines/jquery.sparkline.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/flot/date.js"></script> <!-- Only for generating random data delete in production site-->
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/gauge/justgage.1.0.1.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/charts/gauge/raphael.2.1.0.min.js"></script>

    

    <!-- Form plugins -->
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/wizard/jquery.form.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/wizard/jquery.form.wizard.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
    
    <script src="<?php echo get_theme_path()?>/js/jquery.mousewheel.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/autosize/jquery.autosize-min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/inputlimit/jquery.inputlimiter.1.3.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/mask/jquery.mask.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/switch/bootstrapSwitch.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/globalize/globalize.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/spectrum/spectrum.js"></script><!--  Color picker -->
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/datepicker/bootstrap-datepicker.js"></script> 
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.js"></script> 
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/multiselect/ui.multiselect.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script> 
    
    <!-- Misc plugins -->
    <script src="<?php echo get_theme_path()?>/js/plugins/misc/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script> 
    <link href="<?php echo get_theme_path()?>/js/plugins/forms/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" />
    
    <!-- UI plugins -->
    <script src="<?php echo get_theme_path()?>/js/plugins/ui/jgrowl/jquery.jgrowl.min.js"></script>

    <!-- Init plugins -->
    <script src="<?php echo get_theme_path()?>/js/app.js"></script><!-- Core js functions -->
    <script src="<?php echo get_theme_path()?>/js/pages/form-elements.js"></script><!-- Init plugins only for page -->                         
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
    <?php if(isset($login)): ?>
    <script src="<?php echo get_theme_path()?>/js/pages/login.js"></script><!-- Init plugins only for page -->
    <?php else: ?>
    <script src="<?php echo get_theme_path()?>/js/pages/dashboard.js"></script><!-- Init plugins only for page -->
    <?php endif; ?>
    

    <script>
    $(document).ready(function() {
        <?php if(isset($this->user))
        foreach($this->user->get_notifications() as $notification): ?>
        setTimeout(function() {
            $.jGrowl("<i class='icon16 i-checkmark-3'></i> <?php echo $notification['message']?>", {
                group: '<?php echo $notification['type']?>',
                position: 'center',
                sticky: false,
                closeTemplate: '<i class="icon16 i-close-2"></i>',
                animateOpen: {
                    width: 'show',
                    height: 'show'
                }
            });
        }, 250);
        <?endforeach;?>
    });
    </script>
  </head>

  <?php if(!isset($login)): ?>
  <body>

    <header id="header" class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" <?php echo href("admin", "main/dashboard")?>><img src="<?php echo get_theme_path()?>/images/builderengine_logo_white.png" alt="BuilderEngine Admin"></a>
                <div class="nav-no-collapse">
                    
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </header> <!-- End #header  -->
    
    <div class="main">
        <?php include ("sidebar.php");?>

        <section id="content">
            <div class="wrapper">
                <div class="crumb">
                    <ul class="breadcrumb">
                      <li class="active"><a class="active"><i class="icon16 i-home-4"></i>Admin</a> <span class="divider">/</span></li>
        
                      <li class="active">Installation</li>
                    </ul>
                </div>
                
                <?endif;?>