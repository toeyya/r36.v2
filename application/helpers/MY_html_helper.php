<?php 
if(!function_exists('menu_active'))
{
	function menu_active($module,$controller = FALSE,$class='active')
	{
		$CI =& get_instance();
		if($controller)
		{
			return ($CI->router->fetch_module() == $module && $CI->router->fetch_class() == $controller) ? 'class='.$class : '';	
		}
		else
		{
			return ($CI->router->fetch_module() == $module) ? 'class='.$class : '';	
		}
	}
}

function cycle($key,$odd = 'odd',$even = '')
{
	return ($key&1) ? 'class="'.$even.'"' : 'class="'.$odd.'"';
}

function get_option($value,$text,$table,$order = FALSE,$where =FALSE)
{
	$CI =& get_instance();
	//$CI->db->debug = TRUE;
	$order = ($order) ? ' order by '.$order : NULL;
	$where = ($where) ? ' where '.$where:NULL;
	return $CI->db->GetAssoc('select '.$value.','.$text.' from '.$table.$where.$order);
	
}

function pagebreak($content){
	$break = '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>';
	return substr("$content",0,strpos($content,$break)+strlen($break));
	//return    strstr($content, '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>',TRUE); // for PHP 5.3.0
}

function getIP(){
    $ip = (getenv(HTTP_X_FORWARDED_FOR))
    ?  getenv(HTTP_X_FORWARDED_FOR)
    :  getenv(REMOTE_ADDR);
    return $ip;
}

function currency_rate($price)
{
	$CI =& get_instance();
	$CI->load->model('currency/currency_model');
	$currency = $CI->currency_model->get_active_rate($CI->session->userdata('currency'));
	return number_format(($price * $currency['rate']),2).' '.$currency['currency'];
}

// js syntaghighlight

			function reversechar($str){
				$start =array("'", "\\", "\"");
				$end = array("&#039;", "", "");
				$value = str_replace($start,$end,$str);
				return $value;
			}
			function copyobject($size, $name, $temp, $prefix, $url, $oldimage=''){
				if($size>0){
					$arr = explode(".",$name);
					$number = count($arr);
					$destination = $prefix.$arr[0].".".$arr[$number-1];
					copy($temp, $url.$destination);
					@unlink($url.$oldimage);
				}else{
					$destination = $oldimage;
				}
				return $destination;
			}

			function Generate_Color($patiant,$allpeople){
				$avg_prov = ($patiant*100000)/$allpeople;
				$level1 = $avg_prov-50;
				$level2 = $avg_prov+50;
				$level3 = $avg_prov+51;
				$level4 = $avg_prov+150;
				
				if($avg_prov<$level1){
					$color = "#99CD2B";//Green
				}elseif($avg_prov>=$level1 && $avg_prov<=$level2){
					$color = "#33CCFF";//Blue
				}elseif($avg_prov>=$level3 && $avg_prov<=$level4){
					$color = "#CC99FF";//violet
				}elseif($avg_prov>$level4){
					$color = "#FF0000";//red
				}
				return $color;
			}
			function convert_encode($str){
				$str= iconv('UTF-8','tis-620',$str);
				 return $str;
			}
			
			function multiply_array(&$item,$key,$data)
			{		
					switch($key){
						case 0:$data[0][$key]=$item*13;break;
						case 1:$data[0][$key]=$item*12;break;
						case 2:$data[0][$key]=$item*11;break;
						case 3:$data[0][$key]=$item*10;break;
						case 4:$data[0][$key]=$item*9;break;
						case 5:$data[0][$key]=$item*8;break;
						case 6:$data[0][$key]=$item*7;break;
						case 7:$data[0][$key]=$item*6;break;
						case 8:$data[0][$key]=$item*5;break;
						case 9:$data[0][$key]=$item*4;break;
						case 10:$data[0][$key]=$item*3;break;
						case 11:$data[0][$key]=$item*2;break;					
					}	
				
			}

			function chk_idcard($array,$digit_last)
			{

					$result=array();
					array_walk($array,"multiply_array",array(&$result));
					$sum=array_sum($result);
					$mod=$sum % 11;
					$digit=($mod<11)? 11-$mod:$mod-11;
					if(strlen($digit)>1){$digit=substr($digit,1,1);}
					$chk_compare=($digit==$digit_last)? "yes":"no";
					return $chk_compare;
			}
			function get_ip(){
				
			}
			function save_log($action,$title=FALSE,$new=FALSE,$old=FALSE){			
				$CI->load->model('district/district_model','district');
				$arr_action=array('save'=>'เพิ่ม','insert'=>'เพิ่ม','update'=>'แก้ไข','delete'=>'ลบ','view'=>'ดู','login'=>'เข้าใช้ระบบ','logout'=>'ออกจากระบบ');
				if($action=="edit"){
					 $detail=$arr_action[$action].$title." จาก ".$old." เป็น ".$new;
				 }else if($action=="login" || $action=="logout"){
				 	$detail=$arr_action[$action];
				}else if($action=="insert"){
					if($this->session->userdata('R36_HOSPITAL')!=''){
						$rs=$DB->FETCHARRAY($DB->QUERY("SELECT amphur_name,province_name FROM n_amphur 
													LEFT JOIN n_province on n_amphur.province_id=n_province.province_id												
													WHERE n_amphur.province_id='".$_SESSION['R36_HOSPITAL_PROVINCE']."' and amphur_id='".$_SESSION['R36_HOSPITAL_AMPHUR']."'"));					
						
					/*$rs=$DB->district->select("amphur_name,province_name,district_name")
														 ->join("LEFT JOIN n_province  on n_district.province_id=n_province.province_id
														 			  LEFT JOIN n_amphur on n_district.amphur_id=n_amphur.amphur_id and n_amphur.province_id=n_a")->get();*/
					
						$detail=$arr_action[$action].$title.$new.$old."<br/>" .$_SESSION['R36_HOSPITAL_NAME']." อ.".$rs['amphur_name']." จ.".$rs['province_name'];
					}
				 }else{
				 	$detail=$arr_action[$action].$title." ชื่อ ".$new;
				 }		
			
				$created=date('Y-m-d H:i:s');						
				$sql=" INSERT INTO n_logs(action,detail,uid,created) VALUES('".$arr_action[$action]."','".$detail."','".$_SESSION['R36_UID']."','".$created."')";				 				
				$DB->QUERY($sql);
				
				return false;
			}

function generate_password($length=5) {
      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $password = '';
      for ( $i = 0; $i < $length; $i++ )
         $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		 
      return $password;
 } 



















?>