<?=get_header();?>
<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">

         <div class="span12">
            
            <!-- Resume starts -->
            <? $holder = new Block('business-commodore-1-theme-resume-holder'); ?>
            <? $holder->set_resizable(false);?>
			
<!-- 1st Line of Blocks -->

            <? $block1 = new Block('business-commodore-1-theme-resume-upper'); ?>
            <? $block1->set_resizable(false);?>
            <? $block1->add_css_class('resume');?>
            <? $block1->set_content('
               <h2>John Murphy <span class="rsmall"><span class="color">@</span> Web Guru</span></h2>
               <p>Duis a risus sed dolor placerat semper quis in urna. Nam risus magna, fringilla sit amet blandit viverra, dignissim eget est. Ut commodo ullamcorper risus nec mattis. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet. Nulla facilisi. Aenean at massa leo. Vestibulum in varius arcu.</p>
               <hr />
               <!-- Resume -->
            ');?>
            <? $holder->add_block($block1);?>
			
<!-- 2nd Line of Blocks -->

            <? $block2 = new Block('business-commodore-1-theme-resume-content');?>
            <? $block2->set_type('resume');?>
            <? $block2->set_resizable(false);?>
            <? $block2->add_css_class('resume');?>
            
            <? $holder->add_block($block2);?>

<!-- 3rd Line of Blocks -->
            
            <? $block3 = new Block('business-commodore-1-theme-resume-lower'); ?>
            <? $block3->add_css_class('row')?>
            <? $block3->add_css_class('cta')?>
            <? $block3->set_resizable(false);?>
            <? $block3->set_content('
               <div class="span9">
                  <!-- First line -->
                  <p class="cbig">BuilderEngine - The HTML5 Website Builder & CMS Platform</p>
                  <!-- Second line -->
                  <p class="csmall">Design professional looking websites with our complete GUI controlled Design Builder that will revolutionize theme creation & updating with HTML5 / CSS3.</p>
               </div>
               <div class="span2">
                  <!-- Button -->
                  <div class="button"><a href="http://www.builderengine.com">Free Account</a></div>
               </div>
            ');?>
            <? $holder->add_block($block3);?>

            <? $holder->show();?>

            
         </div>
      </div>
   </div>
</div>   

<!-- Content ends --> 
	
<?=get_footer();?>