<?=get_header()?>

<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- Portfolio starts -->
            
            <div class="portfolio">
               <div class="row">
                  <div class="span12">
                    <? $holder = new Block("business-commodore-1-theme-portfolio-holder")?>
                    <? $holder->html("{elements")?>
                    <? $holder->set_resizable(false)?>


                    <? $line1 = new Block("business-commodore-1-theme-portfolio-line1")?>
                    <? $line1->html("{content}")?>
                    <? $line1->set_resizable(false)?>
                    <? $line1->set_content('
                     <!-- Portfolio hero -->
                     <div class="hero">
                        <!-- Title -->
                        <h3><span>Portfolio</span></h3>
                        <!-- para -->
                        <p>Praesent at tellus porttitor nisl porttitor sagittis. Mauris in massa ligula, a tempor nulla. Ut tempus interdum mauris vel vehicula. Nulla ullamcorper tortor commodo in sagittis est accumsan.</p>
                     </div>
                     <!-- Portfolio -->
                     ');?>
                     <? $line1->show();?>
                     <p>
                        <!-- Add filter names inside "data-filter". For example ".web-design", ".seo", etc., Filter names are used to filter the below images. -->
                        <div class="button">
                           <ul id="filters">
                             <li><a href="#" data-filter="*" >All</a></li>
                             <li><a href="#" data-filter=".one" >One</a></li>
                             <li><a href="#" data-filter=".two" >Two</a></li>
                             <li><a href="#" data-filter=".three" >Three</a></li>
                             <li><a href="#" data-filter=".four" >Four</a></li>
                             <li><a href="#" data-filter=".five" >Five</a></li>
                           </ul>
                        </div>
                    </p>
                        
                        
                    <div id="portfolio">
                        <!-- Add the above used filter names inside div tag. You can add more than one filter names. For image lightbox you need to include "a" tag pointing to image link, along with the class "prettyphoto".-->
                       <div class="element one three"><a href="/themes/pro/img/photos/s1.jpg" class="prettyphoto">
                           <img src="/themes/pro/img/photos/s1.jpg" alt=""/>
                           <!-- Portfolio caption -->
                           <div class="pcap">
                              <h5>Lorem ipsum dolor</h5>
                              <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat.</p>
                           </div>
                       </a></div>
                       <div class="element two one"><a href="/themes/pro/img/photos/s2.jpg" class="prettyphoto">
                           <img src="/themes/pro/img/photos/s2.jpg" alt=""/>
                           <div class="pcap">
                              <h5>Lorem ipsum dolor</h5>
                              <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat.</p>
                           </div>                           
                       </a></div>
                       <div class="element three five"><a href="/themes/pro/img/photos/s3.jpg" class="prettyphoto">
                           <img src="/themes/pro/img/photos/s3.jpg" alt=""/>
                           <div class="pcap">
                              <h5>Lorem ipsum dolor</h5>
                              <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat.</p>
                           </div>                           
                       </a></div>
                       <div class="element four two"><a href="/themes/pro/img/photos/s4.jpg" class="prettyphoto">
                           <img src="/themes/pro/img/photos/s4.jpg" alt=""/>
                           <div class="pcap">
                              <h5>Lorem ipsum dolor</h5>
                              <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat.</p>
                           </div>                           
                       </a></div>
                       <div class="element five one"><a href="/themes/pro/img/photos/s5.jpg" class="prettyphoto">
                           <img src="/themes/pro/img/photos/s5.jpg" alt=""/>
                           <div class="pcap">
                              <h5>Lorem ipsum dolor</h5>
                              <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat.</p>
                           </div>                           
                       </a></div> 
                       <div class="element four five"><a href="/themes/pro/img/photos/s6.jpg" class="prettyphoto">
                           <img src="/themes/pro/img/photos/s6.jpg" alt=""/>
                           <div class="pcap">
                              <h5>Lorem ipsum dolor</h5>
                              <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat.</p>
                           </div>                           
                       </a></div> 
                       <div class="element three one"><a href="/themes/pro/img/photos/s7.jpg" class="prettyphoto">
                           <img src="/themes/pro/img/photos/s7.jpg" alt=""/>
                           <div class="pcap">
                              <h5>Lorem ipsum dolor</h5>
                              <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat.</p>
                           </div>                           
                       </a></div>
                       <div class="element three one"><a href="/themes/pro/img/photos/s8.jpg" class="prettyphoto">
                           <img src="/themes/pro/img/photos/s8.jpg" alt=""/>
                           <div class="pcap">
                              <h5>Lorem ipsum dolor</h5>
                              <p>Sed justo dui, scelerisque ut consectetur vel, eleifend id erat.</p>
                           </div>                           
                       </a></div>
                    </div>
                    <!-- CTA starts -->
            
                    <div class="cta">
                       <div class="row">
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
                       </div>
                    </div>
                    
                    <!-- CTA Ends -->
                  </div>
               </div>
            </div>
            
            
            <!-- Service ends -->
            
            
            
         </div>
      </div>
   </div>
</div>   

<!-- Content ends --> 
	

<?=get_footer()?>
