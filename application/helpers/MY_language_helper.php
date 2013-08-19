<?php error_reporting(E_ALL ^ E_NOTICE);

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
	$CI->load->model('webboards/webboard_bad_word_model','bad_word');
	$CI->load->helper('text');
	//$word = new Webboard_bad_word(1);
	$word = $CI->bad_word->get_row(1);
	$word = explode("\n",$word['badword']);
	
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
	$CI->load->model('webboards/webboard_bad_word_model','bad_word');
	$link = $CI->bad_word->get_row(1);
	//$link = new Webboard_bad_word(2);
	$link = explode("\n",$link['badword']);
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
function dbConvert(&$value,$key = null,$output='UTF-8')
{
	$encode = array('UTF-8'=>'TIS-620','TIS-620'=>'UTF-8');
	if(is_array($value))
	{
		$value = array_change_key_case($value);
		array_walk($value,'dbConvert',$output);
	}
	else
	{
		$value = iconv($encode[$output],$output,$value);
	}
}
function is_utf8($string) {   
return preg_match('%^(?:  
[\x09\x0A\x0D\x20-\x7E] # ASCII  
| [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte  
| \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs  
| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte  
| \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates  
| \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3  
| [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15  
| \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16  
)*$%xs', $string);
}
function utf8_to_tis620($string) {
   $str = $string;
   $res = "";
   for ($i = 0; $i < strlen($str); $i++) {
      if (ord($str[$i]) == 224) {
        $unicode = ord($str[$i+2]) & 0x3F;
        $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
        $unicode |= (ord($str[$i]) & 0x0F) << 12;
        $res .= chr($unicode-0x0E00+0xA0);
        $i += 2;
      } else {
        $res .= $str[$i];
      }
   }
   return $res;
}
function tis620_to_utf8($in) {
   $out = "";
   for ($i = 0; $i < strlen($in); $i++)
   {
     if (ord($in[$i]))
       $out .= $in[$i];
     else
       $out .= "&#" . (ord($in[$i]) - 161 + 3585) . ";";
   }
   return $out;
}



function ThaiToUtf8($string)
{
    if(false == preg_match('#[\241-\377]#i', $string))
    {
        return $string;
    }
    return strtr($string, array("\xa1" => "\xe0\xb8\x81",
                                "\xa2" => "\xe0\xb8\x82",
                                "\xa3" => "\xe0\xb8\x83",
                                "\xa4" => "\xe0\xb8\x84",
                                "\xa5" => "\xe0\xb8\x85",
                                "\xa6" => "\xe0\xb8\x86",
                                "\xa7" => "\xe0\xb8\x87",
                                "\xa8" => "\xe0\xb8\x88",
                                "\xa9" => "\xe0\xb8\x89",
                                "\xaa" => "\xe0\xb8\x8a",
                                "\xab" => "\xe0\xb8\x8b",
                                "\xac" => "\xe0\xb8\x8c",
                                "\xad" => "\xe0\xb8\x8d",
                                "\xae" => "\xe0\xb8\x8e",
                                "\xaf" => "\xe0\xb8\x8f",
                                "\xb0" => "\xe0\xb8\x90",
                                "\xb1" => "\xe0\xb8\x91",
                                "\xb2" => "\xe0\xb8\x92",
                                "\xb3" => "\xe0\xb8\x93",
                                "\xb4" => "\xe0\xb8\x94",
                                "\xb5" => "\xe0\xb8\x95",
                                "\xb6" => "\xe0\xb8\x96",
                                "\xb7" => "\xe0\xb8\x97",
                                "\xb8" => "\xe0\xb8\x98",
                                "\xb9" => "\xe0\xb8\x99",
                                "\xba" => "\xe0\xb8\x9a",
                                "\xbb" => "\xe0\xb8\x9b",
                                "\xbc" => "\xe0\xb8\x9c",
                                "\xbd" => "\xe0\xb8\x9d",
                                "\xbe" => "\xe0\xb8\x9e",
                                "\xbf" => "\xe0\xb8\x9f",
                                "\xc0" => "\xe0\xb8\xa0",
                                "\xc1" => "\xe0\xb8\xa1",
                                "\xc2" => "\xe0\xb8\xa2",
                                "\xc3" => "\xe0\xb8\xa3",
                                "\xc4" => "\xe0\xb8\xa4",
                                "\xc5" => "\xe0\xb8\xa5",
                                "\xc6" => "\xe0\xb8\xa6",
                                "\xc7" => "\xe0\xb8\xa7",
                                "\xc8" => "\xe0\xb8\xa8",
                                "\xc9" => "\xe0\xb8\xa9",
                                "\xca" => "\xe0\xb8\xaa",
                                "\xcb" => "\xe0\xb8\xab",
                                "\xcc" => "\xe0\xb8\xac",
                                "\xcd" => "\xe0\xb8\xad",
                                "\xce" => "\xe0\xb8\xae",
                                "\xcf" => "\xe0\xb8\xaf",
                                "\xd0" => "\xe0\xb8\xb0",
                                "\xd1" => "\xe0\xb8\xb1",
                                "\xd2" => "\xe0\xb8\xb2",
                                "\xd3" => "\xe0\xb8\xb3",
                                "\xd4" => "\xe0\xb8\xb4",
                                "\xd5" => "\xe0\xb8\xb5",
                                "\xd6" => "\xe0\xb8\xb6",
                                "\xd7" => "\xe0\xb8\xb7",
                                "\xd8" => "\xe0\xb8\xb8",
                                "\xd9" => "\xe0\xb8\xb9",
                                "\xda" => "\xe0\xb8\xba",
                                "\xdf" => "\xe0\xb8\xbf",
                                "\xe0" => "\xe0\xb9\x80",
                                "\xe1" => "\xe0\xb9\x81",
                                "\xe2" => "\xe0\xb9\x82",
                                "\xe3" => "\xe0\xb9\x83",
                                "\xe4" => "\xe0\xb9\x84",
                                "\xe5" => "\xe0\xb9\x85",
                                "\xe6" => "\xe0\xb9\x86",
                                "\xe7" => "\xe0\xb9\x87",
                                "\xe8" => "\xe0\xb9\x88",
                                "\xe9" => "\xe0\xb9\x89",
                                "\xea" => "\xe0\xb9\x8a",
                                "\xeb" => "\xe0\xb9\x8b",
                                "\xec" => "\xe0\xb9\x8c",
                                "\xed" => "\xe0\xb9\x8d",
                                "\xee" => "\xe0\xb9\x8e",
                                "\xef" => "\xe0\xb9\x8f",
                                "\xf0" => "\xe0\xb9\x90",
                                "\xf1" => "\xe0\xb9\x91",
                                "\xf2" => "\xe0\xb9\x92",
                                "\xf3" => "\xe0\xb9\x93",
                                "\xf4" => "\xe0\xb9\x94",
                                "\xf5" => "\xe0\xb9\x95",
                                "\xf6" => "\xe0\xb9\x96",
                                "\xf7" => "\xe0\xb9\x97",
                                "\xf8" => "\xe0\xb9\x98",
                                "\xf9" => "\xe0\xb9\x99",
                                "\xfa" => "\xe0\xb9\x9a",
                                "\xfb" => "\xe0\xb9\x9b"));
}

function fix_latin($instr){
  if(mb_check_encoding($instr,'UTF-8'))return $instr; // no need for the rest if it's all valid UTF-8 already
  global $nibble_good_chars,$byte_map;
  $outstr='';
  $char='';
  $rest='';
  while((strlen($instr))>0){
    if(1==preg_match($nibble_good_chars,$input,$match)){
      $char=$match[1];
      $rest=$match[2];
      $outstr.=$char;
    }elseif(1==preg_match('@^(.)(.*)$@s',$input,$match)){
      $char=$match[1];
      $rest=$match[2];
      $outstr.=$byte_map[$char];
    }
    $instr=$rest;
  }
  return $outstr;
}





?>