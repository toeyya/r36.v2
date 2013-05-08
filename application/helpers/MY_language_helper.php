<?php

if(!function_exists('lang_encode'))
{
	function lang_encode($data)
	{
		if(is_array($data))
		{
			$result = array();
			foreach($data as $key => $value)
			{
				$result[] = '"'.trim($key).'":"'.str_replace("\n", "<n/>",htmlspecialchars($value)).'"';	
			} 
			return '{'.implode(',', $result).'}';
		}
	}
}

if(!function_exists('lang_decode'))
{
	function lang_decode($data,$select_lang = FALSE)
	{
		$CI =& get_instance();
		$lang ='th';
		$obj = json_decode($data);
		$result = (is_object($obj)) ? @($obj->$lang ? htmlspecialchars_decode(str_replace("<n/>", "\n",$obj->$lang)) : htmlspecialchars_decode(str_replace("<n/>", "\n",$obj->en))) : $data;	
		return $result;
	}
}

function lang_filter($orm)
{
	$CI =& get_instance();
	if($CI->session->userdata('lang')=="en")
	{
		return $orm->where('title NOT REGEXP \'"en":""}$\'');
	}
	else
	{
		return $orm;
	}
}

function censor($string)
{
	$CI =& get_instance();
	$CI->load->helper('text');
	$word = new Webboard_bad_word(1);
	$word = explode("\n",$word->badword);
	
	$wordchange = "<img src=\"media/tiny_mce/plugins/emotions/img/cry.gif\">"; //ข้อความที่ต้องการให้เปลี่ยนเป็น

    for ( $i = 0 ; $i < sizeof( $word ) ; $i++ )
    {
         $string = str_replace( $word[$i] , $wordchange , $string );
    };
	 
	return $string;
	
	//return word_censor($string,$word,'<img src="media/tiny_mce/plugins/emotions/img/cry.gif">');
}

function link_filter($string)
{
	$CI =& get_instance();
	$CI->load->helper('text');
	$link = new Webboard_bad_word(2);
	$link = explode("\n",$link->badword);
	return word_censor($string,$link,'<span style=display:none;></span>');
}

if ( !function_exists('json_decode') ){

function json_decode($json)

{ 

    // Author: walidator.info 2009

    $comment = false;

    $out = '$x=';

   

    for ($i=0; $i<strlen($json); $i++)

    {

        if (!$comment)

        {

            if ($json[$i] == '{')        $out .= ' array(';

            else if ($json[$i] == '}')    $out .= ')';

            else if ($json[$i] == ':')    $out .= '=>';

            else                         $out .= $json[$i];           

        }

        else $out .= $json[$i];

        if ($json[$i] == '"')    $comment = !$comment;

    }

    eval($out . ';');

    return $x;

} 

}





?>