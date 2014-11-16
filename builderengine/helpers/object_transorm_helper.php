<?

function arrays_to_objects($array)
{
	foreach($array as $key=>$value)
	{
		$array[$key] = (object)$value;
	}

	return $array;
}

?>