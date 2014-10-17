<script>
	$(document).ready(function (){
		$( "#paypal_form" ).submit();
	});
</script>
<?

$encoded_settings = $this->BuilderEngine->get_option('be_builderpayment_paypal_settings');
$settings = json_decode($encoded_settings);

?>
<div class="container">
	<div class="content">
		<h2 style="text-align:center">Please wait, we are redirecting you to the payment gateway...</h2>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal_form">
			<input type="hidden" name="cmd" value="_cart">

			<? $i = 1;?>
			<? foreach($order->product->get() as $product):?>
			<input name="item_name_<?=$i?>" type="hidden" value="<?=$product->name?>">
		    <input name="amount_<?=$i?>" type="hidden" value="<?=$product->price?>">
		    <input name="quantity_<?=$i?>" type="hidden" value="<?=$product->quantity?>">
			<? $i++?>
			<? endforeach?>

		    <input name="currency_code" type="hidden" value="<?=$order->currency?>">
		    <input name="return" type="hidden" value="<?=base_url('/builderpayment/order_success')?>">
		    <input name="cancel_return" type="hidden" value="<?=base_url('/builderpayment/order_canceled')?>">
		    <input name="notify_url" type="hidden" value="<?=base_url('/builderpayment/paypalgateway/ipn')?>">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="cmd" value="_cart">
		    <input name="business" type="hidden" value="<?=$settings->paypal_address?>">
		    
		    <input type="hidden" name="no_shipping" value="1">

		    <input name="custom" type="hidden" value="<?=$order->id?>">
		    </form>

	</div>
</div>