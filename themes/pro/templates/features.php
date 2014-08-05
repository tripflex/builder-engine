<?=get_header()?>


<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- Features starts -->
            
            <div class="features">
               <div class="row">
                  <div class="span12">

                     <!-- Features -->

                     <div class="ifeature">
                        <? $holder = new Block('business-commodore-1-theme-features-holder')?>
                        <? $holder->set_resizable(false)?>
                        <? $holder->html('{elements}');?>
<!-- 1st Line of Blocks -->
                        <? $line1 = new Block('business-commodore-1-theme-features-line1')?>
                        <? $line1->set_resizable(false)?>
                        <? $line1->set_content('
                           <div class="row">
                              <!-- Features hero -->
                              <div class="hero span12">
                                 <!-- Title -->
                                 <h3><span>Features</span></h3>
                                 <!-- para -->
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                           </div>

                        ')?>
<!-- 2nd Line of Blocks -->
                        <? $line2 = new Block('business-commodore-1-theme-features-line2')?>
                        <? $line2->set_resizable(false)?>
                        <? $line2->html('
                        <div class="">
                           <div class="row">
                              {elements}
                              <div class="clearfix"></div>
                           </div>
                        </div>');?>
     
                        <? $block1 = new Block('business-commodore-1-theme-features-line2-col1')?>
                        <? $block1->set_size('span6')?>
                        <? $block1->set_content('
                               <!-- Feature 1. Class name - "feat-a" -->
                           <div class="feat-a">
                              <div class="feat">
                                 <!-- Feature title with font awesome icon-->
                                 <h4><i class="icon-gift"></i> Fast Delivery</h4>
                                 <!-- Feature para -->
                                 <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestum libero, tellus magna nec enim.</p>
                              </div>
                           </div>
                           
                           <!-- Feature 2. Class name - "feat-b" -->
                           <div class="feat-b">
                              <div class="feat">
                                 <h4><i class="icon-home"></i> Professional Work</h4>
                                 <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestum libero, tellus magna nec enim.</p>
                              </div>
                           </div>
                           
                           <div class="clearfix"></div>
                           
                           <!-- Feature 3. Class name - "feat-a" -->
                           <div class="feat-a">
                              <div class="feat">
                                 <h4><i class="icon-bullhorn"></i> Mobile Ready</h4>
                                 <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestum libero, tellus magna nec enim.</p>
                              </div>
                           </div>
                           
                           <!-- Feature 4. Class name - "feat-b" -->
                           <div class="feat-b">
                              <div class="feat">
                                 <h4><i class="icon-cloud"></i> Retina Display</h4>
                                 <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestum libero, tellus magna nec enim.</p>
                              </div>
                           </div>
                           
                           <div class="clearfix"></div>
                              ')?>
							  
                        <? $block2 = new Block('business-commodore-1-theme-features-line2-col2')?>
                        <? $block2->set_size('span6')?>
                        <? $block2->set_content('<!-- Feature 5. Class name - "feat-a" -->
                           <div class="feat-a">
                              <div class="feat">
                                 <!-- Feature title with font awesome icon-->
                                 <h4><i class="icon-user"></i> Good Support</h4>
                                 <!-- Feature para -->
                                 <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestum libero, tellus magna nec enim.</p>
                              </div>
                           </div>
                           
                           <!-- Feature 6. Class name - "feat-b" -->
                           <div class="feat-b">
                              <div class="feat">
                                 <h4><i class="icon-truck"></i> 99% Uptime</h4>
                                 <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestum libero, tellus magna nec enim.</p>
                              </div>
                           </div>
                           
                           <div class="clearfix"></div>
                           
                           <!-- Feature 7. Class name - "feat-a" -->
                           <div class="feat-a">
                              <div class="feat">
                                 <h4><i class="icon-github"></i> 24x7 Available</h4>
                                 <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestum libero, tellus magna nec enim.</p>
                              </div>
                           </div>
                           
                           <!-- Feature 8. Class name - "feat-b" -->
                           <div class="feat-b">
                              <div class="feat">
                                 <h4><i class="icon-fire"></i> Fully Automated</h4>
                                 <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestum libero, tellus magna nec enim.</p>
                              </div>
                           </div>
                           
                           <div class="clearfix"></div>  
						   ')?>
						
						
                        <? $line2->add_block($block1);?>
                        <? $line2->add_block($block2);?>

<!-- 3rd Line of Blocks -->

                        <? $line3 = new Block('business-commodore-1-theme-features-line3')?>
                        <? $line3->set_resizable(false)?>
                        <? $line3->html('
                        <div class="ifeat">
                           <div class="row">
                              {elements}
                              <div class="clearfix"></div>
                           </div>
                        </div>');?>
     
                        <? $block3 = new Block('business-commodore-1-theme-features-line3-col1')?>
                        <? $block3->set_size('span6')?>
                        <? $block3->set_content('<img src="'.get_theme_path().'img/beland2.jpg" alt="" />')?>
                        <? $block4 = new Block('be-theme-pro-templated-features-line3-col2')?>
                        <? $block4->set_size('span6')?>
                        <? $block4->set_content('
                              <h4>Donec aliquet convallis</h4>
                              <p>Fusce imperdiet ornare dignissim. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet.</p>
                              <div class="button"><a href="#">Learn More</a></div>
                              ')?>
                        <? $line3->add_block($block3);?>
                        <? $line3->add_block($block4);?>

<!-- 4th Line of Blocks -->        
            
                        <? $line4 = new Block('business-commodore-1-theme-features-line4')?>
                        <? $line4->set_resizable(false)?>
                        <? $line4->html('
                        <div class="hero">
                           <div class="row">
                              {elements}
                              <div class="clearfix"></div>
                           </div>
                        </div>');?>
     
                        <? $block5 = new Block('business-commodore-1-theme-features-line4-col1')?>
                        <? $block5->set_size('span6')?>
                        <? $block5->set_content('
                              <h4>Fusce imperdiet ornare</h4>
                              <p>Fusce imperdiet ornare dignissim. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet.</p>
                              <div class="button"><a href="#">Learn More</a></div>
                              ')?>
                        <? $block6 = new Block('business-commodore-1-theme-features-line4-col2')?>
                        <? $block6->set_size('span6')?>
                        <? $block6->set_content('<img src="'.get_theme_path().'img/beland3.jpg" alt="" />')?>
                        <? $line4->add_block($block5);?>
                        <? $line4->add_block($block6);?>

<!-- 5th Line of Blocks -->
         
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
                        <? $holder->add_block($line3)?>
                        <? $holder->add_block($line4)?>
                        <? $holder->add_block($line5)?>
                        <? $holder->show()?>
                     </div>
                     
                  </div>
               </div>
            </div>
            
            
            <!-- Service ends -->
            
            <!-- CTA starts -->
            
             
            
            <!-- CTA Ends -->
            
         </div>
      </div>
   </div>
</div>   

<!-- Content ends --> 

<?=get_footer()?>