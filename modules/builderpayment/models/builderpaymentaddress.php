<?php
	class BuilderPaymentAddress extends Datamapper
	{
	    var $table = 'be_builderpayment_addresses';

	    var $has_one = array(
	    	/*"shipped_user" => array(
				'class' => 'User',
				'join_table' => 'be_builderpayment_link_ship_user',
				'join_other_as'=> 'user',
				'join_self_as'=> 'shippingAddress',
				'other_field'=>"shippingAddress"
			),*/
			"billingaddress" => array(
	    		'class' 		=> 'BuilderPaymentOrder',
	    		'other_field'	=> 'billingAddress',
	    		'join_other_as' => 'order',
	    		'join_self_as' => 'billingaddress',
	    	),
	    	"shippingaddress" => array(
	    		'class' 		=> 'BuilderPaymentOrder',
	    		'other_field'	=> 'shippingAddress',
	    		'join_other_as' => 'order',
	    		'join_self_as' => 'shippingaddress',
	    	),
	    );
	}
?>