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
?>
<style>
.hero-right {
  margin-left: 0px !important;
}
.bthumb2 {
  position: relative;
  z-index: 9999 !important;
}
.bthumb2-no-image {
  background-color: #eee;
  color: #aaa;
  height: 135px;
  width: 180px;
  text-align: center;
  font-weight: bold;

}
.bthumb2-no-image span {
  margin-top: 27px;
  float: left;
  width: 100%;
  text-align: center;
  font-weight: bold;
  font-size: 15px;

}
.bthumb2-image:hover span {
  visibility: visible;
}
.bthumb2-image span {
  position: absolute;
  visibility: hidden;
  top: 0px;
  width: 100%;
  height: 100%;
  background-color: #000;
  opacity: 0.5;
}
.bthumb2-image span span{
  text-align: center;
  font-weight: bold;
  opacity: 1;
  font-size: 15px;
  margin-top: 55px;
  height: 30px;
  color: #fff;
}
#blog-image-upload-button {
  cursor: pointer;
}
#blog-image-upload {
  display: none;
}
#blog-image-upload-form {
  margin: 0px;
}

</style>
<script>
$(document).ready( function () {
  <?if(isset($_GET['edit'])):?>
    setTimeout('$("<?=$_GET['edit']?>").focus()', 600);
  <?endif;?>
  $("#blog-image-upload-button").click( function () {
    $("#blog-image-upload").click();
  });
  $('#blog-image-upload').change(function() {
    $('#blog-image-upload-form').submit();
  });
});


</script>

<div class="content">
    <div class="container">

      <div class="blog">
               <div class="row">
                  <div class="span12">
                             
                      <?if($this->user->is_member_of("Administrators")):?>
                      <form method="post" action="/index.php/admin/module/blog/edit_post/<?=$post->id?>" enctype="multipart/form-data" id="blog-image-upload-form">
                        <input type="hidden" name="id" value="<?=$post->id?>">
                        <input type="hidden" name="title" value="<?=$post->title?>">
                        <input type="hidden" name="invoker" value="frontend">
                        <input id="blog-image-upload" type="file" name="image">
                      </form>
                      <?endif;?>
                
                     <!-- Blog Posts -->
                     <div class="row">
                        <div class="span8">
                           <div class="posts">
                           
                              <!-- Each posts should be enclosed inside "entry" class" -->
                              <!-- Post one -->
                              <div class="entry">

                                 <h2><i class="icon-arrow-right title-icon"></i> <?=$post->title?></h2>
                                 
                                 <!-- Meta details -->
                                 <div class="meta">
                                    <i class="icon-calendar"></i> <?=date("M d, Y",$post->date_created)?> <i class="icon-user"></i> <?=$post->author->username?> <!--<i class="icon-folder-open"></i> <a href="#">General</a> <span class="pull-right"><i class="icon-comment"></i> <a href="#">2 Comments</a></span>-->
                                 </div>
                                 
                                 <?if($post->image):?>
                                   <?if($this->user->is_member_of("Administrators")):?>

                                   <!-- Thumbnail -->
                                   <div class="bthumb2 bthumb2-image" id="blog-image-upload-button">
                                      <img src="/files/images/<?=$post->image?>" alt="<?=$post->title?>" />
                                      <span class="edit-blog-image"><span>Upload Image</span></span>
                                   </div>
                                    
                                   <?else:?>
                                      <div class="bthumb2">
                                        <img src="/files/images/<?=$post->image?>" alt="<?=$post->title?>" />
                                     </div>
                                   <?endif;?>
                                 <?else:?>
                
                                 <div class="bthumb2 bthumb2-no-image" id="blog-image-upload-button">
                                    <span class="add-blog-image"><span>Upload Image</span></span>
                                 </div>
                    
                                 <?endif;?>
                                 
                              <? $block = new Block("module-be-blog-post-".$post->id, "hero-right blog-post", "min-height: 150px")?>
                              <? if($block->is_new())
                              { 
                                set_current_page_version_to_pending();
                              }?> 
                              <? $block->set_default("Click here to compose your post...");?>
                              <? $block->set_size('span8'); ?>
                              <? $block->html('<div class="row"> {content} {elements} </div>')?>
                              <? $block->show();?>
                              <?if($post->block == 0) 
                                {
                                  $this->posts->map_post_to_block($post->id, $block->get_id());
                                }
                                  ?>
                              </div>


                              <!--
                              <div class="post-foot well">
                                 <!-- Social media icons 
                                 <div class="social">
                                    <h6>Sharing is Sexy: </h6>
                                    <a href="#" class="bblue"><i class="icon-facebook"></i></a>
                                    <a href="#" class="blightblue"><i class="icon-twitter"></i></a>
                                    <a href="#" class="bviolet"><i class="icon-linkedin"></i></a>
                                    <a href="#" class="bred"><i class="icon-pinterest"></i></a>
                                    <a href="#" class="borange"><i class="icon-google-plus"></i></a>
                                 </div>
                              </div> -->    

                               <hr />

                               <!-- Comment section -->
                              <!--
                              <div class="comments">
                                 
                                    <div class="title"><h5>2 Comments</h5></div>
                                    
                                    <ul class="comment-list">
                                      <li class="comment">
                                        <a class="pull-left" href="#">
                                          <img class="avatar" src="http://placekitten.com/64/64">
                                        </a>
                                          <div class="comment-author"><a href="#">Paddy</a></div>
                                          <div class="cmeta">Commented on 25/02/2013</div>
                                          <p>Nulla facilisi. Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat.</p>
                                          <div class="clearfix"></div>
                                      </li>
                                      <li class="comment reply">
                                        <a class="pull-left" href="#">
                                          <img class="avatar" src="http://placekitten.com/64/64">
                                        </a>
                                          <div class="comment-author"><a href="#">Paddy</a></div>
                                          <div class="cmeta">Commented on 25/02/2013</div>
                                          <p>Nulla facilisi. Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat.</p>
                                          <div class="clearfix"></div>
                                      </li>
                                    </ul>
                              </div>
                              -->
                              <!-- Comment posting -->
                              <!--
                              <div class="respond well">
                                 <div class="title"><h4>Post Reply</h4></div>
                                 
                                 <div class="form">
                                   <form class="form-horizontal">
                                       <div class="control-group">
                                         <label class="control-label" for="name">Name</label>
                                         <div class="controls">
                                           <input type="text" class="input-large" id="name">
                                         </div>
                                       </div>
                                       <div class="control-group">
                                         <label class="control-label" for="email">Email</label>
                                         <div class="controls">
                                           <input type="text" class="input-large" id="email">
                                         </div>
                                       </div>
                                       <div class="control-group">
                                         <label class="control-label" for="website">Website</label>
                                         <div class="controls">
                                           <input type="text" class="input-large" id="website">
                                         </div>
                                       </div>
                                       <div class="control-group">
                                         <label class="control-label" for="comment">Comment</label>
                                         <div class="controls">
                                           <textarea class="input-xlarge" id="comment" rows="3"></textarea>
                                         </div>
                                       </div>
                                       <div class="form-actions">
                                         <button type="submit" class="btn btn-info">Submit</button>
                                         <button type="reset" class="btn btn-inverse">Reset</button>
                                       </div>
                                   </form>
                                 </div>
                              </div>
                              -->
                              <!-- Navigation -->
                              <!--
                              <div class="navigation">  
                                    <div class="pull-left"><a href="#" class="btn btn-info">&laquo; Previous Post</a></div>
                                    <div class="pull-right"><a href="#" class="btn btn-info">Next Post &raquo;</a></div>
                                    <div class="clearfix"></div>
                              </div>
                              -->
                              <div class="clearfix"></div>
                              
                           </div>
                           <!-- Comment section -->
                  
                              <div class="comments well">
                                 
                                    <div class="title"><h4><?=count($post->comments)?> Comments</h4></div>
                                    
                                    <ul class="comment-list">
                                      <? foreach( $post->comments as $comment):?>
                                      <li class="comment">
                                        <a class="pull-left" href="#">
                                          <img class="avatar" style="width:64px" src="<?=base_url('/modules/blog/img/avatar.png')?>">
                                        </a>
                                          <div class="comment-author"><a href="#"><?=$comment->name?></a></div>
                                          <div class="cmeta">Commented on <?=date("d/m/Y H:i:s",$comment->time)?></div>
                                          <p><?=$comment->text?></p>
                                          <div class="clearfix"></div>
                                      </li>
                                    <? endforeach;?>
                                      
                                    </ul>
                              </div>
                              
                              <!-- Comment posting -->
                              
                              <div class="respond well">
                                 <div class="title"><h4>Post Reply</h4></div>
                                 
                                 <div class="form">
                                   <form class="form-horizontal" method="post">
                                      <input type="hidden" name="post_comment" value="true">
                                       <div class="control-group">
                                         <label class="control-label" for="name">Name</label>
                                         <div class="controls">
                                           <input type="text" class="input-large" name="name">
                                         </div>
                                       </div>
              
                                       <div class="control-group">
                                         <label class="control-label" for="comment">Comment</label>
                                         <div class="controls">
                                           <textarea class="input-xlarge" name="text" rows="3"></textarea>
                                         </div>
                                       </div>
                                       <div class="form-actions">
                                         <button type="submit" class="btn">Submit</button>
                                         <button type="reset" class="btn">Reset</button>
                                       </div>
                                   </form>
                                 </div>
                              </div>
                        </div>
                        <? $right = new Block('be-module-blog-entry-right');?> 
                        <? $right->set_size('span4');?>
                        <? $right->html('
                          <div class="sidebar" style="float: left">
                            <div class="row">
                              {elements}
                            </div>
                          </div>
                        ');?>   

                        <? $recent_posts = "";?>
                        <?foreach($recent as $entry):?>
                            <? $recent_posts .= "<li><a href='".base_url('/blog/'.$entry->id)."'>{$entry->title}</a></li>";?>
                        <?endforeach?>  

                        <? $block1 = new Block('be-module-blog-entry-right-recent-posts');?>
                        <? $block1->set_size('span4');?>
                        <? $block1->force_data_modification()?>
                        <? $block1->set_data('content','
                              <!-- Widget -->
  
                              <div class="widget">
                                 <h4>Recent Posts</h4>
                                 <ul>
                                    '.$recent_posts.'
                                 </ul>
                              </div>', true);?>

                        <? $block1->save()?>
                        <? $block2 = new Block('be-module-blog-entry-right-about');?>
                        <? $block2->set_size('span4');?>
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
            </div>

    </div>
  </div>