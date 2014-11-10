<?=get_header();?>

<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- Products starts -->
            
            <div class="products">
               <div class="row">
                  <div class="span12">
                    <? $holder = new Block('business-commodore-1-theme-project-holder')?>
                        <? $holder->set_resizable(false)?>
                        <? $holder->html('{elements}');?>
<!-- 1st Line of Blocks -->
                        <? $line1 = new Block('business-commodore-1-theme-projects-line1')?>
                        <? $line1->set_resizable(false)?>
                        <? $line1->set_content('
                           <div class="row">
                              <div class="hero span12">
                                 <!-- Title -->
                                 <h3><span>Projects</span></h3>
                                 <!-- para -->
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                           </div>

                        ')?>
						
<!-- 2nd Line of Blocks -->
                     
						<? $line2 = new Block('business-commodore-1-theme-features-line3')?>
                        <? $line2->set_resizable(false)?>
                        <? $line2->html('
                        <div class="prod">
                           <div class="row">
                              {elements}
                              <div class="clearfix"></div>
                           </div>
                        </div>');?>
     
                        <? $block1 = new Block('business-commodore-1-theme-features-line3-col1')?>
                        <? $block1->set_size('span8')?>
                        <? $block1->set_content('<!-- Product title -->
                                    <h3>Project #1</h3>
                                    <!-- Product para -->
                                    <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Morbi auctor adipiscing tempor. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat. Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Morbi auctor adipiscing tempor. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat.</p>
                                    <!-- Product image -->
                                    <div class="pimg">
                                       <a href="#"><img src="'.get_theme_path().'img/photos/1.jpg" alt="" /></a>
                                    </div>
									')?>
                        
						<? $block2 = new Block('business-commodore-1-theme-features-line3-col2')?>
                        <? $block2->set_size('span4')?>
                        <? $block2->set_content('
                               <div class="pdetails">
                                       <div class="ptable">
                                          <!-- Product details with font awesome icon. Don\'t forget the span class "pull-right". -->
                                          <div class="pline"><i class="icon-gift"></i> Product Name <span class="pull-right">BuilderEngine</span></div>
                                          <div class="pline"><i class="icon-cloud"></i> License <span class="pull-right">MIT License</span></div>
                                          <div class="pline"><i class="icon-bullhorn"></i> Product Size <span class="pull-right">24 MB</span></div>
                                          <div class="pline"><i class="icon-truck"></i> Price <span class="pull-right">&#36;0.00</span></div>
                                          <div class="clearfix"></div>
                                       </div>
                                       <!-- Buttons -->
                                       <div class="button center"><a href="#"><i class="icon-truck"></i> Learn More</a> <a href="#">Try Now</a></div>
                                    </div>
                              ')?>
                        <? $line2->add_block($block1);?>
                        <? $line2->add_block($block2);?>
						
<!-- 3rd Line of Blocks -->                

                     <? $line4 = new Block("business-commodore-1-theme-projects-line4")?>
                     <? $line4->html('<div class="prod">
                           <div class="row">
                              {elements}
                              <div class="clearfix"></div>
                           </div>
                        </div>')?>
                     <? $line4->set_resizable(false);?>
                     

                        <? $block41 = new Block("business-commodore-1-theme-projects-line4-col1")?>
                        <? $block41->set_size('span3')?>
                        <? $block41->html('
                           <div class="afeature">
                              <div class="afmatter">
                                 {content}
                              </div>
                           </div>')?>
                        <? $block41->set_content('
                           <i class="icon-cloud"></i>
                           <h4>Option #1</h4>
                           <p>Praesent at tellus porttitor  sagittis. Mauris tempor nulla. Ut tempus interdum mauris vel vehicula. </p>
                           ')?>


                        <? $block42 = new Block("business-commodore-1-theme-projects-line4-col2")?>
                        <? $block42->set_size('span3')?>
                        <? $block42->html('
                           <div class="afeature">
                              <div class="afmatter">
                                 {content}
                              </div>
                           </div>')?>
                        <? $block42->set_content('
                              <i class="icon-home"></i>
                              <h4>Option #2</h4>
                              <p>Praesent at tellus porttitor  sagittis. Mauris tempor nulla. Ut tempus interdum mauris vel vehicula. </p>
                           ')?>

                        <? $block43 = new Block("business-commodore-1-theme-projects-line4-col3")?>
                        <? $block43->set_size('span3')?>
                        <? $block43->html('
                           <div class="afeature">
                              <div class="afmatter">
                                 {content}
                              </div>
                           </div>')?>
                        <? $block43->set_content('
                              <i class="icon-home"></i>
                              <h4>Option #2</h4>
                              <p>Praesent at tellus porttitor  sagittis. Mauris tempor nulla. Ut tempus interdum mauris vel vehicula. </p>
                           ')?>

                        <? $block44 = new Block("business-commodore-1-theme-projects-line4-col4")?>
                        <? $block44->set_size('span3')?>
                        <? $block44->html('
                           <div class="afeature">
                              <div class="afmatter">
                                 {content}
                              </div>
                           </div>')?>
                        <? $block44->set_content('
                                  <i class="icon-user"></i>
                                 <h4>Option #4</h4>
                                 <p>Praesent at tellus porttitor  sagittis. Mauris tempor nulla. Ut tempus interdum mauris vel vehicula. </p>
                           ')?>
                       
                       <? $line4->add_block($block41)?>
                       <? $line4->add_block($block42)?>
                       <? $line4->add_block($block43)?>
                       <? $line4->add_block($block44)?>
					   
<!-- 4th Line of Blocks --> 

                       <? $line5 = new Block('business-commodore-1-theme-features-cta'); ?>
                        <? $line5->add_css_class('row')?>
                        <? $line5->add_css_class('cta')?>
                        <? $line5->set_resizable(false);?>
                        <? $line5->set_content('
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
                        <? $holder->add_block($line1)?>
                        <? $holder->add_block($line2)?>
                        <? $holder->add_block($line4)?>
                        <? $holder->add_block($line5)?>
                        <? $holder->show()?>
                        
                  </div>

               </div>
            </div>

            
         </div>
      </div>
   </div>
</div>   

<!-- Content ends --> 
   

	
<?=get_footer()?>