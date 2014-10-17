<?
/***********************************************************
* BuilderEngine v2.0.12
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2014. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2014-23-04 | File version: 2.0.12
*
***********************************************************/
?><div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- Blog starts -->
            
            <div class="blog">
               <div class="row">
                  <div class="span12">
                     
                     <!-- Blog Posts -->
                     <div class="row">
                        <div class="span8">
                           <div class="posts">
                           
                              <!-- Each posts should be enclosed inside "entry" class" -->
                              <!-- Post one -->
                                <?foreach($post as $entry):?>
                                <div class="entry">
                                    <h2><a href="<?=base_url("/blog/".$entry->id)?>"><?=$entry->title?></a></h2>
                                     
                                    <!-- Meta details -->
                                    <div class="meta">
                                       <i class="icon-calendar"></i> <?=date("M d, Y",$entry->date_created)?> <i class="icon-user"></i> <?=$entry->author->username?> <i class="icon-folder-open"></i> <a href="#">General</a> <span class="pull-right"><i class="icon-comment"></i> <?=$entry->comment_num?> Comments</span>
                                    </div>
                                     
                                    <? if($entry->image): ?>
                                    <!-- Thumbnail -->
                                    <div class="bthumb">
                                       <a href="<?=base_url("/blog/".$entry->id)?>"><img src="/files/images/<?=$entry->image?>" alt="" /></a>
                                    </div>
                                    <? endif;?>
                                    <p><?=substr(strip_tags($entry->text),0,150)?></p>
                                    <div class="button"><a href="<?=base_url("/blog/".$entry->id)?>">Read More...</a></div>
                                </div>
                                    
                                <?endforeach;?>
                              
                              
                              
                              
                              <!-- Pagination 
                              <div class="paging">
                                 <span class='current'>1</span>
                                 <a href='#'>2</a>
                                 <span class="dots">&hellip;</span>
                                 <a href='#'>6</a>
                                 <a href="#">Next</a>
                              </div> -->
                              
                              <div class="clearfix"></div>
                              
                           </div>
                        </div>                        
                        <? $right = new Block('be-module-blog-entry-right');?> 
                        <? $right->set_size('span4');?>
                        <? $right->html('
                          <div class="sidebar" style="float: left">
                            <div class="row-fluid">
                              {elements}
                            </div>
                          </div>
                        ');?>   

                        <? $recent_posts = "";?>
                        <?foreach($recent as $entry):?>
                            <? $recent_posts .= "<li><a href='".base_url('/blog/'.$entry->id)."'>{$entry->title}</a></li>";?>
                        <?endforeach?>  

                        <? $block1 = new Block('be-module-blog-entry-right-recent-posts');?>
                        <? $block1->add_css_class('row-fluid');?>
                        <? $block1->set_type('blog_recent_posts');?>
                        
                        <? $block2 = new Block('be-module-blog-entry-right-about');?>
                        <? $block2->set_size('row-fluid');?>
                        <? $block2->set_default("
                        <div class=\"widget\">
                        <h4>About</h4>
                        <p>Nulla facilisi. Sed justo dui, id erat. Morbi auctor adipiscing tempor. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat. Proin rutrum, erat eget posuere semper, <em>arcu mauris posuere tortor</em>,velit at <a href=\"#\">magna sollicitudin cursus</a> ac ultrices magna. Aliquam consequat, purus vitae auctor ullamcorper, sem velit convallis quam, a pharetra justo nunc et mauris. </p>
                      </div>");?>
                        <? $right->add_block($block1);?>
                        <? $right->add_block($block2);?>
                        <? $right->show();?>
                     </div>
                     
                     
                     
                  </div>
               </div>
            </div>
            
            
            <!-- Service ends -->
            
            <!-- CTA starts -->
            
            <div class="cta">
               <div class="row">
                  <div class="span9">
                     <!-- First line -->
                     <p class="cbig">Lorem ipsum consectetur dolor sit amet, consectetur adipiscing.</p>
                     <!-- Second line -->
                     <p class="csmall">Duis vulputate consectetur malesuada eros nec odio consect eturegestas et netus et in dictum nisi vehicula.</p>
                  </div>
                  <div class="span2">
                     <!-- Button -->
                     <div class="button"><a href="#">Get A Free Trail</a></div>
                  </div>
               </div>
            </div>
            
            <!-- CTA Ends -->
            
         </div>
      </div>
   </div>
</div> 