<?=get_header()?>

<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- Contact starts -->
            
            <div class="contact">
               <div class="row">
                  <div class="span12">

                     <div class="contact">
                        <? $holder = new Block('business-commodore-1-theme-contact-holder');?>
                        <? $holder->set_resizable(false);?>
                        <? $holder->html('{elements}');?>
						
<!-- 1st Line of Blocks -->						
						
                        <? $line1 = new Block('business-commodore-1-theme-contact-line1')?>
                        <? $line1->set_resizable(false)?>
                        <? $line1->set_content('
                           <div class="row">
                              <div class="hero span12">
                                 <!-- Title -->
                                 <h3><span>Contact</span></h3>
                                 <!-- para -->
                                 <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                              </div>
                           </div>

                        ')?>

<!-- 2nd Line of Blocks -->
						 
                        <? $line2 = new Block('business-commodore-1-theme-contact-map');?>
                        <? $line2->add_css_class('row')?>
                        <? $line2->set_resizable(false);?>
                        <? $line2->set_content("
                         <div class=\"span12\">
                              <!-- Google maps -->
                              <div class=\"gmap\">
                                 <!-- Google Maps. Replace the below iframe with your Google Maps embed code -->
                                 <iframe height=\"300\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.ie/maps?f=q&amp;source=s_q&amp;hl=en&amp;q=Sean+Mulvoy+Rd,+Galway,+County+Galway&amp;aq=t&amp;sll=53.201733,-9.131381&amp;sspn=1.326075,3.56781&amp;ie=UTF8&amp;geocode=Fe0HLQMdigR2_w&amp;split=0&amp;hq=&amp;hnear=Sean+Mulvoy+Rd,+Galway,+County+Galway&amp;ll=53.282797,-9.042806&amp;spn=0.002585,0.006968&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed\"></iframe>
                              </div>
                              
                           </div>
                           ");?>
						   
<!-- 3rd Line of Blocks -->

                         <!-- Contact -->
                        <? $line3 = new Block('business-commodore-1-theme-contact-line3')?>
                        <? $line3->set_resizable(false);?>
                        <? $line3->add_css_class('row')?>

                           <? $block31 = new Block('business-commodore-1-theme-contact-line3-col1');?>
                           <? $block31->set_size('span6')?>
                           <? $block31->html('<div class="cwell">{content}</div>');?>
                           <? $block31->set_type('contact_form');?>
                           <? $block32 = new Block('business-commodore-1-theme-contact-line3-col2');?>
                           <? $block32->set_size('span6')?>
                           <? $block32->html('<div class="cwell">{content}</div>');?>
                           <? $block32->set_content('
                                <h5>Address</h5>
                                 <hr />
                                 <div class="address">
                                     <address>
                                        <!-- Company name -->
                                        <strong>BuilderEngine</strong><br>
                                        <!-- Address -->
                                        Fairgreen, Eyre Square,<br>
                                        Galway City, Ireland.<br>
                                        <!-- Phone number -->
                                        <abbr title="Phone">P:</abbr> (123) 456-7890.
                                     </address>
                                      
                                     <address>
                                        <!-- Name -->
                                        <strong>Full Name</strong><br>
                                        <!-- Email -->
                                        <a href="mailto:#">info@builderengine.com</a>
                                     </address>
                                     
                                     <!-- Social media icons -->
                                     <strong>Get in touch</strong>
                                     
                                 </div>
                           ');?>
						   
<!-- 4th Line of Blocks -->						   
						   
                          <? $line4 = new Block('business-commodore-1-theme-resume-lower'); ?>
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

                          $line3->add_block($block31);
                          $line3->add_block($block32);
                          $holder->add_block($line1);
                          $holder->add_block($line2);
                          $holder->add_block($line3);
                          $holder->add_block($line4);
                          $holder->show();
                          ?>

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