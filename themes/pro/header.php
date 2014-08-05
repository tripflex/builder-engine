<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">

  <title><?=$BuilderEngine->get_option('website_title')?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?=$BuilderEngine->get_option('website_description')?>">
  <meta name="keywords" content="<?=$BuilderEngine->get_option('website_keywords')?>">
  <meta name="author" content="BuilderEngine">
  <?=$BuilderEngine->integrate_builderengine_styles()?>
  <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>

  <!-- Stylesheets -->
  <link href="<?=get_theme_path()?>style/bootstrap.css" rel="stylesheet">
  <link href="<?=get_theme_path()?>style/flexslider.css" rel="stylesheet">
  <link href="<?=get_theme_path()?>style/prettyPhoto.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=get_theme_path()?>style/font-awesome.css">
  <!--[if IE 7]>
  <link rel="stylesheet" href="style/font-awesome-ie7.css">
  <![endif]-->		
  <link href="<?=get_theme_path()?>style/style.css" rel="stylesheet">
<!-- Color Stylesheet -->
  <link href="<?=get_theme_path()?>style/black.css" rel="stylesheet">    
  <link href="<?=get_theme_path()?>style/bootstrap-responsive.css" rel="stylesheet">
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?=get_theme_path()?>img/favicon/favicon.png">
    <?=$BuilderEngine->integrate_builderengine_js()?>

    <style>
      .open
      {
        position:relative;
      }
    </style>
</head>
<body>

<!-- Header starts -->

<header>
   <div class="container">
      <div class="row">
        <? $block1 = new Block('be-theme-pro-header-sitename');?>
         <? $block1->set_global(true); ?>
         <? $block1->html('<div class="logo">{content}</div>');?>
         <? $block1->set_content('<h1><a href="/">Default Theme</a></h1>');?>
         <? $block1->set_size('span5');?>
         <? $block1->show(); ?>

       
         <? $block2 = new Block('be-theme-pro-header-social');?>
         <? $block2->set_global(true); ?>
         <? $block2->add_css_class('offset3');?>
		 <? $block2->set_type('social_links'); ?>
         <? $block2->set_size('span4'); ?>
         <? $block2->show(); ?>


      </div>
   </div>
</header>

<!-- Navigation Starts -->

    <div class="navbar">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            Menu
          </a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <?foreach(get_links() as $link): ?>
                <li>
                        <?if(count($link->childs) > 0):?>
                        <a href="<?=$link->target?>" class="dropdown-toggle" data-toggle="dropdown"><?=$link->name?>
                            <b class="caret"></b>                           
                        </a>
                        <ul class="dropdown-menu">
                            <?foreach($link->childs as $sub_link): ?>
                            <li><a href="<?=$sub_link->target?>"><?=$sub_link->name?></a></li>
                            <?endforeach;?>
                        </ul>
                        <?else:?>
                         <a href="<?=$link->target?>"><?=$link->name?></a>
                        <?endif;?>
                </li>
              <?endforeach;?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
<!-- Navigation Ends -->   
<!-- Header ends -->

<!-- Inner Container Starts -->
<div id="over">
<div id="out_container" class="boxed">