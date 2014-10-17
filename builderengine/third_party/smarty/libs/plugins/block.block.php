<?php
/**
 * Smarty plugin to format text blocks
 *
 * @package Smarty
 * @subpackage PluginsBlock
 */

/**
 * Smarty {block}{/block} block plugin
 *
 * Type:     block function<br>
 * Name:     textformat<br>
 * Purpose:  format text a certain way with preset styles
 *           or custom wrap/indent settings<br>
 * Params:
 * <pre>
 * - style         - string (email)
 * - resizable     - string (email)
 * - indent        - integer (0)
 * - wrap          - integer (80)
 * - wrap_char     - string ("\n")
 * - indent_char   - string (" ")
 * - wrap_boundary - boolean (true)
 * </pre>
 *
 * @link http://www.smarty.net/manual/en/language.function.textformat.php {textformat}
 *       (Smarty online manual)
 * @param array                    $params   parameters
 * @param string                   $content  contents of the block
 * @param Smarty_Internal_Template $template template object
 * @param boolean                  &$repeat  repeat flag
 * @return string content re-formatted
 * @author Monte Ohrt <monte at ohrt dot com>
 */

global $smarty_block_stack;
$smarty_block_stack = array();
function smarty_block_block($params, $content, $template, &$repeat)
{
  
    global $smarty_block_stack;
    global $smarty_blocks;

    if(!$content){
        $block = new Block($params['name']);
        apply_block_params($block, $params);
        $block->output(false);

        if(count($smarty_block_stack) > 0)
        {    
            $parent = end($smarty_block_stack);
            $parent->add_block($block);
        }
        array_push($smarty_block_stack, $block);
    }
    else{
        
        $block = end($smarty_block_stack);

        if(count($smarty_block_stack) > 0)
            array_pop($smarty_block_stack);


        if(strpos($content, '{elements}') !== FALSE)
        {
            $count = substr_count($content, '{elements}');
            $count -= 1;
            if($count > 0)
                $content = preg_replace('/{elements}/', "", $content, $count);
        }
        PC::content($content);
        $block->html($content);
        str_replace('{elements}', '', $content);

        if(count($smarty_block_stack) == 0)
        {
            
            return $block->show();
            echo $content;
            return $block->show();
        }    
        else
            return '{elements}';
    }

    
}

function apply_block_params(&$block, $params)
{
    foreach($params as $param_key => $param)
    {
        switch($param_key)
        {
            case "name":
            break;
            case "size":
                $block->set_size($param);
                break;

            
            case "class":
                foreach(explode(" ", $param) as $class)
                    $block->add_css_class($class);
                break;

            case "style":
                foreach(explode(";", $param) as $style){
                    if($style == "")
                        continue;
                    $data = explode(":", $style);
                    if(count($data) == 2)
                        $block->set_css($data[0], $data[1]);
                }
                break;

            case "resizable":
                if(!($param == true || $param == "true"))
                    $block->set_resizable(false);
                break;

            // To be updated BEGIN
            case "global":
                $block->set_global($param == true || $param == "true");
                break;

            case "id":
                $block->set_data('html_id', $param);
                break;
            // To be updated END

            case "type":
                $block->set_type($param);
                break;

            case "data":
                foreach($param as $key => $value)
                    $block->set_data($key, $value);
                break;
        }
    }
}