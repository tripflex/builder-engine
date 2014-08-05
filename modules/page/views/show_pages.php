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
    <script src="<?=get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
    <script src="<?=get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
    <script src="<?=get_theme_path()?>/js/plugins/forms/select2/select2.js"></script> 
    <script src="<?=get_theme_path()?>js/plugins/tables/datatables/jquery.dataTables.min.js"></script><!-- Init plugins only for page -->
    <link href="<?=get_theme_path()?>/js/plugins/forms/select2/select2.css" rel="stylesheet" />
    <link href="<?=get_theme_path()?>/js/plugins/tables/datatables/jquery.dataTables.css" rel="stylesheet" />
    <script src="<?=get_theme_path()?>/js/pages/data-tables.js"></script><!-- Init plugins only for page -->
<div class="row-fluid">
                        
                        <div class="span12">
                            
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-table"></i></div> 
                                    <h4>Search Results</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content">
                                    <form method="post" action="">
                                        <table><tr><td><input type="text" name="search"></td><td><input class="btn-primary" type="submit" style="margin-top: -10px; margin-left: 5px; height: 36px; width: 66px" value="Search"></td></tr></table>
                                    </form>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Publish Date</th>
                                                <th>Author</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? foreach($pages as $result): ?>
                                            <tr class="gradeX">
                                                <td><?=$result->title?></td>
                                                <td style="width: 155px;" class="center"><?=date("G:i:s d-m-Y", $result->date_created)?></td>
                                                <td style="width: 125px;" class="center"><?=$result->author->name?></td>
                                                <td class="center"><a href="/index.php/admin/module/page/edit_page/<?=$result->id?>"><span class="i-quill-2"></span></a> <a href="/index.php/admin/module/page/delete_page/<?=$result->id?>" onclick="return confirm('Are you sure you want to permanently delete this post?')"><span class="i-remove-4"></span></a></td>
                                            </tr>
                                            <? endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Title</th>
                                                <th>Publish Date</th>
                                                <th>Author</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- End .widget-content -->
                            </div><!-- End .widget -->
                                                
                        </div><!-- End .span12  -->                     
                                            
                    </div><!-- End .row-fluid  -->