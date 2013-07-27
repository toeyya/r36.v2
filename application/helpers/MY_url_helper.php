<?php
function clean_url($text)
{
	$text=strtolower($text);
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','');
	$text = str_replace($code_entities_match, $code_entities_replace, $text);
	$text = @ereg_replace('(--)+', '', $text);
	$text = @ereg_replace('(-)$', '', $text);
	return $text;
} 

if(!function_exists('breadcrumb'))
{
	function breadcrumb($module = FALSE,$class = FALSE)
	{
		$CI =& get_instance();
		
		$label = (get_cookie('eng')=='_eng') ? 'Home' : 'หน้าแรก';
		$delimiter = ' &raquo; ';
		$result = anchor('/',$label);
		if(is_array($module))
		{
			foreach($module as $text => $link)
			{
				$text = $text ? $text : '&nbsp;';
				$result .= $delimiter.anchor($link,$text);
			}
		}
		else
		{
			$result .= $module ? $delimiter.anchor($CI->router->fetch_module(),$module) : '';
			$result .= $class ? $delimiter.anchor($CI->router->fetch_class(),$class) : '';	
		}
		return '<div id="breadcrumb">'.$result.'</div>';
	}
}


?>