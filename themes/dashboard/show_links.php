<?php
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
 echo get_header();?>

    <script src="<?php echo get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
    <script src="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.js"></script> 
    <script src="<?php echo get_theme_path()?>js/plugins/tables/datatables/jquery.dataTables.min.js"></script><!-- Init plugins only for page -->
    <link href="<?php echo get_theme_path()?>/js/plugins/forms/select2/select2.css" rel="stylesheet" />
    <link href="<?php echo get_theme_path()?>/js/plugins/tables/datatables/jquery.dataTables.css" rel="stylesheet" />
    <script src="<?php echo get_theme_path()?>/js/pages/data-tables.js"></script><!-- Init plugins only for page -->
    
    
                <div class="container-fluid">
                    <div id="heading" class="page-header">
                        <h1><i class="icon20 i-dashboard"></i> Main Menu Links</h1>
                    </div>

                    <div class="row-fluid">
                        
                        <div class="span12">
                            
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-table"></i></div> 
                                    <h4>Search Results</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content">
                                
                                    <table  class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Target</th>
                                            <th>Title</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?foreach($this->links->get_all() as $link): ?>
                                        <? if($link['parent'] != 0) continue?>
                                        <tr>
                                            <td><?php echo $link['name']?></td>
                                            <td><?php echo $link['target']?></td>
                                            <td><?php echo $link['title']?></td>
                                            <td><a href="/index.php/admin/links/edit/<?php echo $link['id']?>"><span class="i-quill-2"></span></a> <a href="/index.php/admin/links/delete/<?php echo $link['id']?>" onclick="return confirm('Are you sure you want to permanently delete this link?')"><span class="i-remove-4"></span></a></td>
                                        </tr>
                                        <?if($link['childs']):?>
                                            <?foreach($link['childs'] as $sub_link): ?>
                                                <tr>
                                                    <td>^=><?php echo $sub_link['name']?></td>
                                                    <td><?php echo $sub_link['target']?></td>
                                                    <td><?php echo $sub_link['title']?></td>
                                                    <td><a href="/index.php/admin/links/edit/<?php echo $sub_link['id']?>"><span class="i-quill-2"></span></a> <a href="/index.php/admin/links/delete/<?php echo $sub_link['id']?>" onclick="return confirm('Are you sure you want to permanently delete this link?')"><span class="i-remove-4"></span></a></td>
                                                </tr>
                                            <?endforeach;?>    
                                        <?endif;?>
                                    <?endforeach;?>
                                       
                                    </tbody>
                                </table>
                            
                             </div><!-- End .widget-content -->
                            </div><!-- End .widget -->
                                                
                        </div><!-- End .span12  -->                     
                                            
                    </div><!-- End .row-fluid  -->

                </div> <!-- End .container-fluid  -->
            </div> <!-- End .wrapper  -->
        </section>
    </div><!-- End .main  -->
  </body>
</html>