<style>
.product-header-image
{
    width: 135px;
    float:left;
}
.product-header-info
{
    margin-left:15px;
    width: 300px;
    float:left;

}
.product-header-info h3
{
    color: #222;
    font-family: Myriad;
    -webkit-font-smoothing: antialiased;
}

.product-header-info h4
{
    size : 10px;
    color: #333;
    font-weight: 200;
    font-family: Myriad;
    -webkit-font-smoothing: antialiased;
}
.modal-header-product
{
    height: 160px;
}
.be-item 
{
    margin-bottom: 30px;
}
.modal-body-product
{
    height: 200px;
    width: 100%;
}
.modal-body-product  .images
{
    position: absolute;
    display:block;
    height:150px;
  white-space: nowrap;
    scrollbar-base-color:#ffeaff;
    overflow:scroll;    



}
.modal-body-product .images img
{
    float: left;
    display: inline;
}
.product-price
{
    color: #07f;
    border: 1.5px solid #07f;
    border-radius:3px;
    float:left;
    padding-left: 2px;
    padding-right: 2px;
    margin-top: 50px;
}

.product-price-free
{
    color: #091;
    border: 1.5px solid #091;
    border-radius:3px;
    float:left;
    padding-left: 5px;
    padding-right: 5px;
    margin-top: 50px;
}
.product-description
{
    text-align: left;
    color: #333;
}
</style>

<script>
function install_product(id)
{
    $('.install-button').html('Please wait...');
    $.get("<?=base_url('admin/module/builder_market/install_product/')?>/" + id, function(){
    $('.install-button').html('Installed');

    });
}
$(document).ready(function (){
    
    $('.modal-body .images').each(function() {
        width = 0;
        $(this).find('img').each(function() {
            width += $(this).outerWidth( true ) + 25;
        });
        $(this).css('width', width);
    });

    $('.install-button').click(function (){
        product_id = $(this).attr('product-id');
        
        install_product(product_id);
        $(this).html('Installed');
    });


});

</script>
                    <div class="row">
                    <? if($response->status == "error"):?>
                        <script>
                            $(document).ready(function (){
                                $("#modal-message").modal('show');
                            }); 
                        </script>
                    <!-- Modal -->
                        <div id="modal-message" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-header modal-header" style="clear: both">
                                <strong>Error occurred!</strong>
                          </div>
                          <div class="modal-body">
                                <p><?=$response->message?></p>
                          </div>
                          <div class="modal-footer">
                          <div class="product-description">
                          
                          </div> 
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            
                          </div>
                        </div>  
                    <? else:?>
                    <? $response->products = (array)$response->products;?>
                        <? foreach($response->products as $product):?>
                            <div class="be-item span3">
                                <div class="widget">
                                    <div class="widget-title">
                                        <div class="icon"><i class="icon20 i-cube"></i></div> 
                                        <h4><?=$product->name?></h4>
                                        <div class="w-right">
                                            <form action='' method='post'>
                                                <input type="hidden" name="product_id" value="<?=$product->id?>">
                                                <!--<input type=submit class="btn btn-success btn-mini " value="Download"> --> 
                                                
                                            </form>
                                        </div>
                                    </div><!-- End .widget-title -->
                                
                                    <div class="widget-content center">
                                        <a href="#product-<?=$product->id?>" role="button"data-toggle="modal"><img src="<?=$product->image?>"  style="height: 120px;margin:10px;"></a>
                                    </div><!-- End .widget-content -->
                                </div><!-- End .widget -->
                            </div><!-- End .span3  -->

                            <!-- Modal -->
                            <div id="product-<?=$product->id?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-header modal-header-product" style="clear: both">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <div class="product-header-image">
                                        <img src="<?=$product->image?>"  style="border: 1px solid #888; border-radius: 25px;height: 120px; width: 120px;margin:10px;">
                                    </div>
                                    <div class="product-header-info">
                                        <h3 id="myModalLabel"><?=$product->name?></h3>
                                        <h4><?=$product->publisher?></h4>
                                        <? if($product->price > 0):?>
                                        <div class="product-price"><?=$product->price?> $</div>
                                        <? else:?>
                                        <div class="product-price-free">Free</div>
                                        <? endif;?>
                                    </div>
                              </div>
                              <div class="modal-body modal-body-product">
                                <div class="images">
                                    <? foreach($product->screenshots as $screenshot):?>
                                    <img src="<?=$screenshot?>" style="width:200px;border: 1px solid #888; margin-right: 25px">
                                    <? endforeach?>
                                </div>
                              </div>
                              <div class="modal-footer modal-footer-product">
                              <div class="product-description">
                              <strong>Description</strong>
                              <?=$product->description?>
                              </div> 
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

                                <? if($product->price > 0):?>
                                <button class="btn btn-primary">Purchase</button>
                                <? else:?>
                                <button class="btn btn-success install-button" product-id="<?=$product->id?>">Install</button>
                                <? endif;?>
                              </div>
                            </div>  
                        <? endforeach;?>
                    <? endif;?>
 

                    </div><!-- End .row-fluid  -->
