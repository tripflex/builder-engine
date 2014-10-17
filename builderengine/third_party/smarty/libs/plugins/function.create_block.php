<?
function smarty_function_create_block($params, &$smarty)
{
	global $smarty_blocks;
	$block = new Block($params['name']);
    
    $block->set_content($params['content']);
    $block->output(false);
    $smarty_blocks[$params['name']] = $block;

    if(isset($params['parent']))
   		$smarty_blocks[$params['parent']]->add_block($block);
	return "";
	//return "qweqwe";
}
?>