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

	class Group extends DataMapper 
	{
		/* DataMapper specific members below*/
		var $table = 'user_groups';
		var $has_one = array(
		 "module_permission"	=> array(
		        'class' => 'Group_module_permission',
		        'other_field' => 'group',
				'join_self_as' => 'group',
				'join_other_as' => 'permission',
				 ),);
		var $has_many = array(
			"module"	=> array(
				'join_table' => 'link_groups_modules',
				'join_self_as' => 'group',
				'join_other_as' => 'module',
				 ), 
			"user"	=> array(
				'join_table' => 'link_groups_users',
				'join_self_as' => 'group',
				'join_other_as' => 'user',
				 ),
		);

		/* Group specific members below*/


	}
?>