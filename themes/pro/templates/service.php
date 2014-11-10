<?=get_header()?>


<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- Service starts -->
            
               <div class="row">
                  <div class="span12">
                    <? $holder = new Block('business-commodore-1-theme-service-holder')?>
                        <? $holder->set_resizable(false)?>
                        <? $holder->html('{elements}');?>
<!-- 1st Line of Blocks -->
                        <? $line1 = new Block('business-commodore-1-theme-service-line1')?>
                        <? $line1->set_resizable(false)?>
                        <? $line1->set_content('
                           <div class="row">
                              <div class="hero span12">
                                 <!-- Title -->
                                 <h3><span>Service</span></h3>
                                 <!-- para -->
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                           </div>

                        ')?>
<!-- 2nd Line of Blocks -->
                     
                     <!-- Service list -->
					 <? $line2 = new Block('business-commodore-1-theme-service-line2')?>
                        <? $line2->set_resizable(false)?>
                        <? $line2->html('
                        <div class="">
                           <div class="row">
                              {elements}
                              <div class="clearfix"></div>
                           </div>
                        </div>');?>
     
                        <? $block1 = new Block('business-commodore-1-theme-service-line2-col1')?>
                        <? $block1->set_size('span6')?>
                        <? $block1->set_content('
                           <div class="serv-a">
                                 <div class="serv">
                                    <div class="simg">
                                       <!-- Font awesome icon. -->
                                       <i class="icon-gift"></i>
                                    </div>
                                    <!-- Service title -->
                                    <h4>Service #1</h4>
                                    <!-- Service para -->
                                    <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, tellus magna nec enim. Nunc dapibus varius interdum.</p>
                                 </div>
                              </div>
                              ')?>
							  
                        <? $block2 = new Block('business-commodore-1-theme-service-line2-col2')?>
                        <? $block2->set_size('span6')?>
                        <? $block2->set_content('
							<div class="serv-a">
                                 <div class="serv">
                                    <div class="simg">
                                       <i class="icon-home"></i>
                                    </div>
                                    <h4>Service #2</h4>
                                    <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, tellus magna nec enim. Nunc dapibus varius interdum.</p>
                                 </div>
                              </div>
						   ')?>
						   
						<? $block3 = new Block('business-commodore-1-theme-service-line2-col3')?>
                        <? $block3->set_size('span6')?>
                        <? $block3->set_content('
							<div class="serv-a">
                                 <div class="serv">
                                    <div class="simg">
                                       <i class="icon-bullhorn"></i>
                                    </div>
                                    <h4>Service #3</h4>
                                    <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, tellus magna nec enim. Nunc dapibus varius interdum.</p>
                                 </div>
                              </div>
						   ')?>
						   
						<? $block4 = new Block('business-commodore-1-theme-service-line2-col4')?>
                        <? $block4->set_size('span6')?>
                        <? $block4->set_content('
							<div class="serv-a">
                                 <div class="serv">
                                    <div class="simg">
                                       <i class="icon-cloud"></i>
                                    </div>
                                    <h4>Service #4</h4>
                                    <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, tellus magna nec enim. Nunc dapibus varius interdum.</p>
                                 </div>
                              </div>
						   ')?>
						
						
                        <? $line2->add_block($block1);?>
                        <? $line2->add_block($block2);?>
						<? $line2->add_block($block3);?>
						<? $line2->add_block($block4);?>
					 
<!-- 3rd Line of Blocks -->					 

                     <? $line3 = new Block('business-commodore-1-theme-service-cta'); ?>
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

<!-- Content ends --> 
	

<?=get_footer()?>