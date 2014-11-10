<?=get_header();?>
<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="span12">
            
            <!-- Full width starts -->
            
            <div class="full-width">
               <div class="row">
                  <div class="span12">
                  
                     <!-- Full width -->
                     <? $holder = new Block("business-commodore-1-theme-blank-holder-".$page->id);?>
                     <? $holder->set_resizable(false);?>
                     <? $holder->html('{elements}');?>
                     <? $holder->add_css_class('row');?>


                     <? $block = new Block("business-commodore-1-theme-blank-block-".$page->id);?>
                     <? $block->set_size('span12');?>
                     <? $block->set_content('
                        <h1>Blank Page</h1>
                        <p>Edit this block or add an new block.</p>
                        ');?>

                     <? $holder->add_block($block);?>
                     <? $holder->show();?>
                     
                  </div>
               </div>
            </div>          
            
         </div>
      </div>
   </div>
</div>   

<!-- Content ends --> 
<?=get_footer();?>