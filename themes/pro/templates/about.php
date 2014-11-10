<?=get_header()?>

<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- About starts -->
            
            <div class="about">
               <div class="row">
                  <div class="span12">
                     <? $holder= new Block("business-commodore-1-theme-about-holder")?>
                     <? $holder->set_resizable(false)?>
                     <? $holder->html('<div class="row">{elements}</div>')?>
					 
<!-- 1st Line of Blocks -->

                     <? $line1 = new Block("business-commodore-1-theme-about-line1")?>
                     <? $line1->set_content('
                     <!-- About hero -->
                     <div class="about-hero">
                        <p>BuilderEngine CMS is an amazing new HTML5 platform for building Websites.</p>
                     </div>
                     ')?>
					 
<!-- 2nd Line of Blocks -->

                     <? $line2 = new Block("business-commodore-1-theme-about-line2")?>
                     <? $line2->add_css_class('teams')?>
                     <? $line2->html('{elements}')?>
                     <? $line2->set_resizable(false)?>   
                           <? $block1 = new Block("business-commodore-1-theme-about-line2-col1")?>
                           <? $block1->set_size('span3')?>
                           <? $block1->set_content('
                              <!-- Staff #1 -->
                              <div class="staff">
                                 <!-- Picture -->
                                 <div class="pic">
                                    <img src="'.get_theme_path().'img/kk.jpg" alt="" />
                                 </div>
                                 <!-- Details -->
                                 <div class="details">
                                    <!-- Name and designation -->
                                    <div class="desig pull-left">
                                       <p class="name">Keith Killilea</p>
                                       <em>Founder / CEO </em>
                                    </div>
                                    <!-- Social media details. Replace # with profile links -->
                                    <div class="asocial pull-right">
                                       <a href="#"><i class="icon-facebook"></i></a>
                                       <a href="#"><i class="icon-twitter"></i></a>
                                       <a href="#"><i class="icon-linkedin"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- Description -->
                                    <p class="adesc">Driven technology leader with experience building highly-skilled teams for cms platforms, games engines, and web software. </p>
                                 </div>
                              </div>
                           ')?>

                           <? $block2 = new Block("business-commodore-1-theme-about-line2-col2")?>
                           <? $block2->set_size('span3')?>
                           <? $block2->set_content('
                              <!-- Staff #2 -->
                              <div class="staff">
                                 <div class="pic">
                                    <img src="'.get_theme_path().'img/dk.jpg" alt="" />
                                 </div>
                                 <div class="details">
                                    <div class="desig pull-left">
                                       <p class="name">Dimitar Krastev</p>
                                       <em>Co-Founder / CTO </em>
                                    </div>
                                    <div class="asocial pull-right">
                                       <a href="#"><i class="icon-facebook"></i></a>
                                       <a href="#"><i class="icon-twitter"></i></a>
                                       <a href="#"><i class="icon-linkedin"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p class="adesc">Professional Games Development Programmer, Content Management Systems and Web Developer. BuilderEngine Wizard. </p>
                                 </div>
                              </div>
                           ')?>

                           <? $block3 = new Block("business-commodore-1-theme-about-line2-col3")?>
                           <? $block3->set_size('span3')?>
                           <? $block3->set_content('
                              <!-- Staff #3 -->
                              <div class="staff">
                                 <div class="pic">
                                    <img src="'.get_theme_path().'img/jb.jpg">
                                 </div>
                                 <div class="details">
                                    <div class="desig pull-left">
                                       <p class="name">John Breslin</p>
                                       <em>Semantic Social Web</em>
                                    </div>
                                    <div class="asocial pull-right">
                                       <a href="#"><i class="icon-facebook"></i></a>
                                       <a href="#"><i class="icon-twitter"></i></a>
                                       <a href="#"><i class="icon-linkedin"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p class="adesc">Founder of boards.ie, Ireland’s largest discussion community, and researcher at DERI, world’s top Semantic Web institute.. </p>
                                 </div>
                              </div>
                           ')?>

                           <? $block4 = new Block("business-commodore-1-theme-about-line2-col4")?>
                           <? $block4->set_size('span3')?>
                           <? $block4->set_content('
                              <!-- Staff #4 -->
                              <div class="staff">
                                 <div class="pic">
                                    <img src="'.get_theme_path().'img/jm.jpg" alt="" />
                                 </div>
                                 <div class="details">
                                    <div class="desig pull-left">
                                       <p class="name">Jim Murren</p>
                                       <em>Enterprise & Advisor</em>
                                    </div>
                                    <div class="asocial pull-right">
                                       <a href="#"><i class="icon-facebook"></i></a>
                                       <a href="#"><i class="icon-twitter"></i></a>
                                       <a href="#"><i class="icon-linkedin"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p class="adesc">Regional manager of the Industrial Development Authority Ireland for over 12 years, and business strategy advisor. </p>
                                 </div>
                              </div>
                           ')?>
                           <? $line2->add_block($block1)?>
                           <? $line2->add_block($block2)?>
                           <? $line2->add_block($block3)?>
                           <? $line2->add_block($block4)?>
                           
<!-- 3rd Line of Blocks -->						   
						   
                           <? $line3 = new Block('business-commodore-1-theme-about-line3'); ?>
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
</div>   

<!-- Content ends --> 
<?=get_footer()?>