<?php
include_once "../../../../../mainfile.php";

$aResponse['error'] = false;
$_SESSION['iQaptcha'] = false;	
	
if(isset($_POST['action']))
{
	if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'qaptcha')
	{
		$_SESSION['iQaptcha'] = true;
		if($_SESSION['iQaptcha'])
			echo jsonencode($aResponse);
		else
		{
			$aResponse['error'] = true;
			echo jsonencode($aResponse);
		}
	}
	else
	{
		$aResponse['error'] = true;
		echo jsonencode($aResponse);
	}
}
else
{
	$aResponse['error'] = true;
	echo jsonencode($aResponse);
}


  function jsonencode($a=false) {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return (float)str_replace(",", ".", (string)$a);
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = jsonencode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = jsonencode($k).':'.jsonencode($v);
      return '{' . join(',', $result) . '}';
    }
  }
