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
 if(!isset($_GET['ajax'])):?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BuilderEngine Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="BuilderEngine" />
    <meta name="description" content="BuilderEngine admin template - new premium responsive admin template. This template is designed to help you build the site administration without losing valuable time.Template contains all the important functions which must have one backend system.Build on great twitter boostrap framework" />
    <meta name="keywords" content="admin, admin template, admin theme, responsive, responsive admin, responsive admin template, responsive theme, themeforest, 960 grid system, grid, grid theme, liquid, jquery, administration, administration template, administration theme, mobile, touch , responsive layout, boostrap, twitter boostrap" />
    <meta name="application-name" content="BuilderEngine admin template" />

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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
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

    <!-- Misc plugins -->
    <script src="<?php echo get_theme_path()?>/js/plugins/misc/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>

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

    function ajax_load(target, url)
    {
        if(url == "#")
            return;
        $.ajax({
            type: 'GET',
            url:  url+"?ajax=true",
            
            success: function(data) { 
                $("" + target).html(data);
                $(".breadcrumb a").click(function ( event ) {
                    url = $(this).attr("href");
                    if(url == "#")
                        return;
                    ajax_load("#content", url);
                    history.pushState('data', '', url);
                    event.preventDefault();
                });
            },
            data: {},
            async: false
        });
    }
    $(document).ready(function() {
        $(window).bind('popstate', function (e) {
            if (!e.originalEvent.state)
                return;
    
            ajax_load("#content", location.href);
        });


        $("#mainnav a").click(function ( event ) {
            url = $(this).attr("href");
            if(url == "#")
                return;
            ajax_load("#content", url);
            history.pushState('data', '', url);
            event.preventDefault();
        });

        $(".breadcrumb a").click(function ( event ) {
            url = $(this).attr("href");
            if(url == "#")
                return;
            ajax_load("#content", url);
            history.pushState('data', '', url);
            event.preventDefault();
        });
        <?php 
        if(isset($user))
        foreach($user->get_notifications() as $notification): ?>

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
        <?php endforeach;?>
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
                    <?php if(is_installed()): ?>
                    <div id="top-search">
                        <form action="#" method="post" class="form-search">
                            <div class="input-append">
                                <input type="text" name="tsearch" id="tsearch" placeholder="Search here ..." class="search-query">
                                <button type="submit" class="btn"><i class="icon16 i-search-2 gap-right0"></i></button>
                            </div>
                        </form>
                    </div>


                    <ul class="nav pull-right">
                        <li class="divider-vertical"></li>
                        <li class="">
                            <a href="/" >
                                <b style="font-weight: bold; font-size: 18px">Frontend</b>
                            </a>
                            
                        </li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon24 i-bell-2"></i>
                                <?php if(isset($user)):?>
                                    <?php if(count($user->get_alerts()) > 0): ?>
                                        <span class="notification red"><?php echo count($user->get_alerts())?></span>
                                    <?php endif;?>
                                <?php endif;?>
                            </a>
                            <ul class="dropdown-menu">
                            <?php 
                            if(isset($user)):?>
                                <?php if( count($user->get_alerts()) == 0): ?>
                                    <li><a href="javascript: void(0)" class=""><i class="icon16 i-info"></i> There are no notifications...</a></li>
                                <?php else:?>   
                                <?php foreach($user->get_alerts() as $alert): ?>
                                    <li><a href="<?php echo $alert->url?>" class=""><i class="icon16 <?php echo $alert->icon?>"></i><?php echo $alert->text?></a></li>
                                <?php endforeach;?>
                                <?php endif;?>   
                            <?php endif;?>
                            </ul>
                        </li>
                        
                        <li class="divider-vertical"></li>
                        <li class="dropdown user">
                             <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                             <?php if(file_exists("files/avatars/".$user->get_username().".jpg")): ?>
                                <img src="/files/avatars/<?php echo $user->get_username()?>.jpg" alt="sugge">

                             <?php else: ?>
                                <img src="<?php echo get_theme_path()?>/images/avatars/no_avatar.jpg" alt="sugge">
                             <?php endif; ?>
                                <span class="more"><i class="icon16 i-arrow-down-2"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a <?php echo href("admin", "main/settings")?> class=""><i class="icon16 i-cogs"></i> Settings</a></li>
                                <li><a <?php echo href("admin", "user/edit/{$user->get_id()}")?> class=""><i class="icon16 i-user"></i> Profile</a></li>
                                <li><a <?php echo href("admin", "main/logout")?> class=""><i class="icon16 i-exit"></i> Logout</a></li>
                            </ul>
                        </li>
                        <li class="divider-vertical"></li>
                    </ul>
                    <?php endif; ?>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </header> <!-- End #header  -->

    <div class="main">
        <?php echo get_sidebar();?>

        <section id="content">
            <?php endif;?>
            <?php endif;?>
            <div class="wrapper">
                <div class="crumb">
                    <ul class="breadcrumb">
                      <li class="active"><a class="active" href="/admin/main/dashboard"><i class="icon16 i-home-4"></i>Admin</a> </li>

                      <?php foreach($breadcrumb as $segment):?>
                          <?php if($segment['url']):?>
                          <li class="active"><span class="divider">/</span><a href="<?php echo $segment['url']?>"><?php echo $segment['name']?></a></li>
                          <?php else:?>
                          <li class="active"><span class="divider">/</span><?php echo $segment['name']?></li>
                          <?php endif;?>
                      <?php endforeach;?>
               
                    </ul>
                </div>

                