 
                <script src="<?=get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
                <script src="<?=get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
                <script src="<?=get_theme_path()?>/js/plugins/forms/select2/select2.js"></script> 
                <script src="<?=get_theme_path()?>/js/pages/form-validation.js"></script><!-- Init plugins only for page -->
                <link href="<?=get_theme_path()?>/js/plugins/forms/select2/select2.css" rel="stylesheet" />


                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-stack-checkmark"></i></div> 
                                    <h4>Category Details</h4>
                                    
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content">
                                    <form id="edit_category" class="form-horizontal" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="required">Paypal Address</label>
                                            <div class="controls controls-row">
                                                <input type="text" name="paypal_address" class="required span12" placeholder="The address coresponding to your PayPal account" value="<?=$settings->paypal_address?>">
                                            </div>
                                        </div><!-- End .control-group  -->

                                        <div class="control-group">
                                            <label class="control-label" for="required">Active</label>
                                            <div class="controls controls-row">
                                                <select name="active" class="required span12">
                                                    <option value='yes' <?if($settings->active == 'yes') echo "selected"?>>Yes</option>
                                                    <option value='no' <?if($settings->active == 'no') echo "selected"?>>No</option>
                                                </select>
                                            </div>
                                        </div><!-- End .control-group  -->
                                        
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Save Settings">
                                        </div>
                                    </form>
                                </div><!-- End .widget-content -->
                            </div><!-- End .widget -->
                        </div><!-- End .span12  --> 
                    </div><!-- End .row-fluid  -->
