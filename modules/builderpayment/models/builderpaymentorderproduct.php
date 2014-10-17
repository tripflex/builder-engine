<?php
	class BuilderPaymentOrderProduct extends Datamapper
	{
	    var $table = 'be_builderpayment_order_products';

	    var $has_one = array(
	    	"order" => array(
	    		'class' 		=> 'BuilderPaymentOrder',
	    		'join_other_as'	=> 'order',
	    		'join_self_as'	=> 'product',
	    		'other_field'	=> 'product'
	    	 )
	    );
	}
?>