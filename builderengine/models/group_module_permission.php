<?

	class Group_module_permission extends DataMapper 
	{	
		/* DataMapper specific members below*/
		var $table = 'module_permissions';
		/*var $has_one = array(
		  );*/
		var $has_one = array(
			"module"	=> array(
			    'class' => 'module',
			    'other_field' => 'group_permission',
				'join_self_as' => 'permission',
				'join_other_as' => 'module',
			), 
			"group"	=> array(
			    'class' => 'group',
			    'other_field' => 'module_permission',
				'join_self_as' => 'permission',
				'join_other_as' => 'group',
			),
		);
	}
?>