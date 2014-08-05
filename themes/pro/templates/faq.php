<?=get_header();?>
<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <? $holder = new Block('business-commodore-1-theme-page-faq-holder');?>
            <? $holder->set_resizable(false);?>
            <? $holder->html("{elements}");?>
			
<!-- 1st Line of Blocks -->			
			
           <? $line2 = new Block('business-commodore-1-theme-page-faq-top');?>
           <? $line2->html('
            <div class="faq">
               <div class="row">
                     <div class="hero">
                      {content}
                     </div>
               </div>
            </div>
            ');?>
            <? $line2->set_content('                 <!-- Title. -->
                        <h3><span>FAQ</span></h3>
                        <!-- para -->
                        <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
');?>
            <? $line2->set_size('span12');?>
            
<!-- 2nd Line of Blocks -->  
          
            <!-- FAQ -->
                 <? $line3 = new Block('business-commodore-1-theme-page-faq-content');?>
                 <? $line3->set_type('faq');?>

<!-- 3rd Line of Blocks -->		
		 
            <? $line4 = new Block('business-commodore-1-theme-faq-lower'); ?>
            <? $line4->add_css_class('row')?>
            <? $line4->add_css_class('cta')?>
            <? $line4->set_resizable(false);?>
            <? $line4->set_content('
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
            <? 
            $holder->add_block($line2);
            $holder->add_block($line3);
            $holder->add_block($line4);
            $holder->show()?>

            
         </div>
      </div>
   </div>
</div>   

<!-- Content ends --> 
	
<?=get_footer();?>