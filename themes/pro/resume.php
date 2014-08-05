<?=get_header();?>
<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <? $block = new Block('test22');?>
         <? $block->set_type('resume');?>
         <? $block->show();?>
         <div class="span12">
            
            <!-- Resume starts -->
            
            <div class="resume">
               <div class="row">
                  <div class="span12">
                     <h2>John Doe <span class="rsmall"><span class="color">@</span> Web Guru</span></h2>
                     <p>Duis a risus sed dolor placerat semper quis in urna. Nam risus magna, fringilla sit amet blandit viverra, dignissim eget est. Ut commodo ullamcorper risus nec mattis. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet. Nulla facilisi. Aenean at massa leo. Vestibulum in varius arcu.</p>
                     <hr />
                     <!-- Resume -->
                     
                     <div class="row">
                        <div class="span12">
                        
                           <!-- About -->
                           <div class="rblock">
                              <div class="row">
                                 <div class="span3">
                                    <h4>About Me</h4>                            
                                 </div>
                                 <div class="span9">
                                    <div class="rinfo">
                                       <h5>John Doe</h5>
                                       <div class="rmeta">Professional Web Guru</div>
                                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vulputate eros nec odio egestas in dictum nisi vehicula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse porttitor luctus imperdiet. <a href="#">Praesent ultricies</a> enim ac ipsum aliquet pellentesque. Nullam justo nunc, dignissim at convallis posuere, sodales eu orci. Duis a risus sed dolor placerat semper quis in urna. Nam risus magna, fringilla sit amet blandit viverra, dignissim eget est. Ut <strong>commodo ullamcorper risus nec</strong> mattis. Fusce imperdiet ornare dignissim. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet. Nulla facilisi. Aenean at massa leo. Vestibulum in varius arcu.</p>
                                          <!-- Social media icons -->
                                                 <div class="social">
                                                      <a href="#"><i class="icon-facebook"></i></a>
                                                      <a href="#"><i class="icon-twitter"></i></a>
                                                      <a href="#"><i class="icon-linkedin"></i></a>
                                                      <a href="#"><i class="icon-google-plus"></i></a>
                                                      <a href="#"><i class="icon-pinterest"></i></a>
                                                 </div>  
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                           <!-- Education -->
                           <div class="rblock">
                              <div class="row">
                                 <div class="span3">
                                    <h4>Education</h4>                            
                                 </div>
                                 <div class="span9">
                                    <div class="rinfo">
                                       <!-- Title -->
                                       <h5>B.Tech (Information Technology)</h5>
                                       <!-- Meta -->
                                       <div class="rmeta">MIT, USA</div>
                                       <!-- Details -->
                                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vulputate eros nec odio egestas in dictum nisi vehicula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse porttitor luctus imperdiet. <a href="#">Praesent ultricies</a> enim ac ipsum aliquet pellentesque. Nullam justo nunc, dignissim at convallis posuere, sodales eu orci.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                           <!-- Skills -->
                           <div class="rblock">
                              <div class="row">
                                 <div class="span3">
                                    <h4>Skills</h4>                            
                                 </div>
                                 <div class="span9">
                                    <div class="rinfo">
                                       <!-- Class "rskills" is important -->
                                       <div class="rskills">
                                          <span>HTML5</span> <span>CSS3</span> <span>jQuery</span> <span>BuilderEngine</span> <span>Twitter Bootstrap</span> <span>Photoshop</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>                           
                           
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
            
            
            <!-- Resume ends -->
            
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
</div>   

<!-- Content ends --> 
	
<?=get_footer();?>