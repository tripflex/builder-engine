<?=get_header();?>
<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- Timeline starts -->
            
            <div class="timeline">
               <div class="row">
                  <div class="span12">
                  
				  <? $holder = new Block("business-commodore-1-theme-timeline-holder")?>
                    <? $holder->html("{elements}")?>
                    <? $holder->set_resizable(false)?>

<!-- 1st Line of Blocks -->

                        <? $line1 = new Block('business-commodore-1-theme-timeline-line1')?>
                        <? $line1->set_resizable(false)?>
                        <? $line1->set_content('
                           <div class="row">
                              <div class="hero span12">
                                 <!-- Title -->
                                 <h3><span>Timeline</span></h3>
                                 <!-- para -->
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                           </div>

                        ')?>
						
<!-- 2nd Line of Blocks -->

                     <!-- Timeline -->
                     
                     <? $line2 = new Block('business-commodore-1-theme-timeline-line2');?>
                     <? $line2->html('{elements}');?>
                     <? $line2->add_css_class('row');?>
                     <? $line2->set_resizable(false);?>
                        <? $block1 = new Block('business-commodore-1-theme-timeline-line2-col1');?>
                        <? $block1->html("{content}");?>
                        <? $block1->set_size('span6');?>
                        <? $block1->set_content('<!-- Timeline #1 -->
                           <div class="time">
                              <div class="tidate">
                                 2008
                              </div>
                              <div class="timatter">
                                 <h5>Nulla ullamcorper</h5>
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           
                           <div class="time">
                              <div class="tidate">
                                 2010
                              </div>
                              <div class="timatter">
                                 <h5>Nulla ullamcorper</h5>
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                              <div class="clearfix"></div>
                           </div>

                           <div class="time">
                              <div class="tidate">
                                 2012
                              </div>
                              <div class="timatter">
                                 <h5>Nulla ullamcorper</h5>
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                              <div class="clearfix"></div>
                           </div>');?>


                        <? $block2 = new Block('business-commodore-1-theme-timeline-line2-col2');?>
                        <? $block2->html("{content}");?>
                        <? $block2->set_size('span6');?>
                        <? $block2->set_content('<div class="time">
                              <div class="tidate">
                                 2009
                              </div>
                              <div class="timatter">
                                 <h5>Nulla ullamcorper</h5>
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                              <div class="clearfix"></div>
                           </div>       
                           
                           <div class="time">
                              <div class="tidate">
                                 2011
                              </div>
                              <div class="timatter">
                                 <h5>Nulla ullamcorper</h5>
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                              <div class="clearfix"></div>
                           </div>

                           <div class="time">
                              <div class="tidate">
                                 2013
                              </div>
                              <div class="timatter">
                                 <h5>Nulla ullamcorper</h5>
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                              <div class="clearfix"></div>
                           </div>');?>
                                 
					 <?$line2->add_block($block1);?>
                     <?$line2->add_block($block2);?>

<!-- 3rd Line of Blocks -->
            
           <? $line3 = new Block('business-commodore-1-theme-features-cta'); ?>
                        <? $line3->add_css_class('row')?>
                        <? $line3->add_css_class('cta')?>
                        <? $line3->set_resizable(false);?>
                        <? $line3->set_content('
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
					  <? $holder->show()?>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>   

<!-- Content ends --> 
	
<?=get_footer();?>