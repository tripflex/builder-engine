<?=get_header();?>

<!-- Index Content Page Starts -->

<div class="content">
   <div class="container">
      <div class="row">	  	  <div class="span12">
            <?

              $slide_titles = array("Theme Title #1","Theme Title #2","Theme Title #3","Theme Title #4","Theme Title #5");
              $slide_texts = array(
                "Select EDIT and click on this block to display the banner slider settings. Add / Edit images, titles and this description text for each slide.",
                "Select EDIT and click on this block to display the banner slider settings. Add / Edit images, titles and this description text for each slide.",
                "Select EDIT and click on this block to display the banner slider settings. Add / Edit images, titles and this description text for each slide.",
                "Select EDIT and click on this block to display the banner slider settings. Add / Edit images, titles and this description text for each slide.",
                "Select EDIT and click on this block to display the banner slider settings. Add / Edit images, titles and this description text for each slide.",
                );

              $slide_images = array(
                get_theme_path()."img/be_banner1.jpg",
                get_theme_path()."img/be_banner2.jpg",
                get_theme_path()."img/be_banner3.jpg",
                get_theme_path()."img/be_banner4.jpg",
                get_theme_path()."img/be_banner5.jpg",

                );
              $slide_urls = array(
                "#",
                "#",
                "#",
                "#",
                "#",
                );
            ?>
			
<!-- Content Starts -->
			
            <? 
            $content_holder = new Block("be-theme-pro-home-content-holder");
            $content_holder->set_resizable(false);
            $line1 = new Block("be-theme-pro-home-slider"); 
            $line1->html("<div class=''>{content}</div>");
            $line1->set_data('slide_title', $slide_titles);
            $line1->set_data('slide_image', $slide_images);
            $line1->set_data('slide_text', $slide_texts);
            $line1->set_data('slide_url', $slide_urls);
            $line1->set_data('style',array('margin-left'=>'0px'));
            $line1->set_type('slider'); 
            $line1->set_size('span12'); 
            ?>    
			
<!-- 2nd Line of Blocks -->

			<? $line2 = new Block("be-theme-pro-line-2")?>
            <? $line2->html('<div class="row">{elements}</div>'); ?>
            <? $line2->set_resizable(false); ?>
            <? $block1 = new Block("be-theme-metro2-home-line-2-col-1");?>
            <? $block1->set_size('span7');?>
            <? $block1->html("{content}");?>
            <? $block1->set_content("
              <h2>Welcome to the Default Theme</h2>
              <p class=\"main-meta\">Quick tour around the BuilderEngine Editing</p>
              <p>At the bottom of this page in the footer, you will find the EDIT THIS WEBSITE link to log into your website to start editing. </p> 
              <p>To start editing this page, you need to activate the editors - do this by clicking on the \"ADMIN\" button to the top right of your screen. This will now display an top bar on your screen with editing options. Follow the rest of the quick instructions below or visit the BuilderEngine website for detailed tutorials <a href=\"http://www.builderengine.com\">BuilderEngine Website.</a></p>
            ");?>
            <? $block2 = new Block("be-theme-metro2-home-line-2-col-2");?>
            <? $block2->set_size('span5');?>
            <? $block2->html("<div class=\"main-box\">
                              {content}
                              </div>");?>
            <? $block2->set_content("
                <h4>Overview of Editing</h4>
                <p>There is only an few things to know with BuilderEngine in order to edit / create an website.</p>
                <ul>
                  <li>Editing is done on the page itself (inline), top bar.</li>
                  <li>Use the Builder Menu for adding new Blocks + more.</li>
                  <li>Admin-CP is for behind the scenes settings.</li>
                </ul>
                <div class=\"button\"><a href=\"http://builderengine.com/page-support.html\">View Tutorials</a></div>
            ");?>

            <? $line2->add_block($block1); ?>
            <? $line2->add_block($block2); ?>
			
<!-- 3rd Line of Blocks -->

            <? $line3 = new Block("be-theme-pro-line-3")?>
            <? $line3->add_css_class('features'); ?>
            <? $line3->html('
              <div class="row">
              <!-- Features -->
                <div class="ifeature">
                  <div class="ifeat">
                    {elements}
                  <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              '); ?>
            <? $line3->set_resizable(false); ?>
            <? $block1 = new Block('be-theme-pro-home-line-3-col-1'); ?>
            <? $block1->set_size('span6'); ?>
            <? $block1->html("{content}"); ?>
            <? $block1->set_content('
                <h4>EDIT / RESIZE / MOVE</h4>
                <p>Click EDIT, then click on any part of this page to begin changing the text and images. Click Edit again to stop editing. </p> 
                <p>Using RESIZE you can expand or reduce the size of every block. The MOVE option allows you to drag and drop blocks around the page.</p>
            '); ?>
            <? $line3->add_block($block1);?>
            <? $block2 = new Block('be-theme-pro-home-line-3-col-2'); ?>
            <? $block2->set_size('span6'); ?>
            <? $block2->html("{content}"); ?>
            <? $block2->set_content('
                <img src="'.get_theme_path().'img/beland1.jpg" alt="" />
                '); ?>
            <? $line3->add_block($block2);?>
			
<!-- 4th Line of Blocks --> 
			
            <? $line4 = new Block("rpost-test");?>
            <? $line4->set_type('pro_rpost'); ?>
            <?
            $line4->set_size('span12');
            $content_holder->add_block($line1);
            $content_holder->add_block($line2);
            $content_holder->add_block($line3);
            $content_holder->add_block($line4);
            $content_holder->show();
            ?>
            </div>           
         </div>
      </div>
</div> 

<!-- Content ends --> 

<?=get_footer();?>