<!-- Inner Container end -->   
</div></div>
	
<!-- Footer -->
<footer>
  <div class="container">
    <? $footer = new Block('be-theme-pro-footer'); ?>
    <? $footer->html('{elements}');?>
    <? $footer->set_global(true);?>
    <? $footer->set_resizable(false);?>
    <? $footer->add_css_class("row");?>

      <? $block1 = new Block('be-theme-pro-footer-col-1'); ?>
      <? $block1->set_global(true);?>
      <? $block1->set_size('span4');?>
      <? $block1->html('<div class="widget">{content}</div>');?>
      <? $block1->set_content('
        <h4>About Us</h4>
        <p>BuilderEngine biz1vides an complete 360 eco-system between CMS, Cloud, Support & Services. View the websites for more information, help and support.</p>
        '); ?>

      <? $block2 = new Block('be-theme-pro-footer-col-2'); ?>
      <? $block2->set_global(true);?>
      <? $block2->set_size('span4');?>
      <? $block2->html('{content}');?>
      <? $block2->set_type('links');?>

      <? $block3 = new Block('be-theme-pro-footer-col-3'); ?>
      <? $block3->set_global(true);?>
      <? $block3->set_size('span4');?>
      <? $block3->html('<div class="widget">{content}</div>');?>
      <? $block3->html('{content}');?>
      <? $block3->set_content('            
        <h4>Developers</h4>
       <img alt="" class="footer-logo" src="/themes/pro/img/footer-logo.png" />
');?>


      <? $block4 = new Block('be-theme-pro-footer-col-4'); ?>
      <? $block4->set_global(true);?>
      <? $block4->set_size('span12');?>
      <? $block4->html('{content}');?>
      <? $block4->set_content('<hr />                  
        <p class="copy">
        <!-- Copyright Bar -->
        Copyright &copy; <a href="/index.php">Your Site</a> | Powered by <a href="http://www.builderengine.com">BuilderEngine</a> | <a href="/admin">Edit this website</a>
        </p>
      ');?>


      
      <? $footer->add_block($block1);?>
      <? $footer->add_block($block2);?>
      <? $footer->add_block($block3);?>
      <? $footer->add_block($block4);?>
      <? $footer->show();?>

  </div>
</footer>		
</div>
</div>

<!-- JS -->
<script src="<?=get_theme_path()?>js/bootstrap.js"></script>
<script src="<?=get_theme_path()?>js/jquery.flexslider-min.js"></script>
<script src="<?=get_theme_path()?>js/jquery.isotope.js"></script>
<script src="<?=get_theme_path()?>js/jquery.prettyPhoto.js"></script>
<script src="<?=get_theme_path()?>js/filter.js"></script>

<script src="<?=get_theme_path()?>js/custom.js"></script>
<script type="text/javascript">
/* Flex Slider */

$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: true,
    pauseOnHover: true,
    slideshowSpeed: 15000
  });
});
</script>
<script type="text/javascript">
/* Isotope */
var $container = $('#portfolio');
// initialize isotope
$container.isotope({
  // options...
});
</script>
<?=$BuilderEngine->get_option('google_analytics_code')?>
</body>
</html>