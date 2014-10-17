<?
function smarty_function_display_block($params, &$smarty)
{
	global $smarty_blocks;
	print_r($smarty_blocks);

	return $smarty_blocks[$params['name']]->show();
	//return "qweqwe";
}
?>