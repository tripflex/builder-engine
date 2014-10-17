<?

	class Module extends DataMapper 
	{	
		/* DataMapper specific members below*/
		var $table = 'modules';
		var $has_one = array();
		var $has_many = array(
		"group_permission"	=> array(
		        'class' => 'Group_module_permission',
		        'other_field' => 'module',
				'join_self_as' => 'module',
				'join_other_as' => 'permission',
				 ), 
		);
	}
?>