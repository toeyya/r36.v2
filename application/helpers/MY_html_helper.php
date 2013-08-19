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
if(!function_exists('cycle'))
{
	function cycle()
	{
		static $i;	
		
		if (func_num_args() == 0)
		{
			$args = array('even','odd');
		}
		else
		{
			$args = func_get_args();
		}
		return 'class="'.$args[($i++ % count($args))].'"';
	}
}
if(!function_exists('menu_active2'))
{
    function menu_active2($module,$controller = FALSE,$class='active')
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
if(!function_exists('avatar'))
{
    function avatar($img=FALSE,$size = NULL)
    {
        return ($img)?'uploads/users/'.$size.$img:'themes/default/media/images/webboards/noavatar.gif';
    }
}
function get_option($value,$text,$table,$order = FALSE,$where =FALSE)
{
	$CI =& get_instance();
	//$CI->db->debug = TRUE;
	$order = ($order) ? ' order by '.$order : NULL;
	$where = ($where) ? ' where '.$where:NULL;
	$result = $CI->db->GetAssoc('select '.$value.','.$text.' from '.$table.$where.$order);
	array_walk($result,'dbConvert');
	return $result;
}

function pagebreak($content){
	$break = '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>';
	return substr("$content",0,strpos($content,$break)+strlen($break));
	//return    strstr($content, '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>',TRUE); // for PHP 5.3.0
}

function getIP(){
    $ip = (getenv(HTTP_X_FORWARDED_FOR)) ? getenv(HTTP_X_FORWARDED_FOR): getenv(REMOTE_ADDR);
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
				$CI->load->model('amphur/amphur_model','amphur');
				$CI->load->model('logs/log_model','log');
				
				$hospital_name = $CI->session->userdata('R36_HOSPITAL_NAME');
				$amphur_id = $CI->session->userdata('R36_HOSPITAL_AMPHUR');
				$province_id = $CI->session->userdata('R36_HOSPITAL_PROVINCE');
				$data['uid'] = $CI->session->userdata('R36_UID');
				
				$arr_action=array('save'=>'เพิ่ม','insert'=>'เพิ่ม','update'=>'แก้ไข','delete'=>'ลบ','view'=>'ดู','login'=>'เข้าใช้ระบบ','logout'=>'ออกจากระบบ');
				
				if($action=="edit"){
					 $data['detail']=$arr_action[$action].$title." จาก ".$old." เป็น ".$new;
				 }else if($action=="login" || $action=="logout"){
				 	$data['detail']=$arr_action[$action];
				}else if($action=="insert"){
					if($this->session->userdata('R36_HOSPITAL')!=''){
						$rs=$this->amphur->select("amphur_name,province_name")->join("LEFT JOIN n_province on n_amphur.province_id=n_province.province_id")
										  ->where("n_amphur.province_id='".$province_id."' and amphur_id='".$amphur_id."'")->get();
					
						$data['detail']=$arr_action[$action].$title.$new.$old."<br/>" .$hospital_name." อ.".$rs['amphur_name']." จ.".$rs['province_name'];
					}
				 }else{
				 	$data['detail']=$arr_action[$action].$title." ชื่อ ".$new;
				 }		
				$data['action'] = $arr_action[$action];
				$data['created'] = date('Y-m-d H:i:s');
				$CI->log->save($data);						
				//$sql=" INSERT INTO n_logs(action,detail,uid,created) VALUES('".$arr_action[$action]."','".$detail."','".$_SESSION['R36_UID']."','".$created."')";				 				
				//$CI->db->Execute($sql);
				
				return false;
			}

function generate_password($length=5) {
      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $password = '';
      for ( $i = 0; $i < $length; $i++ )
         $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		 
      return $password;
} 

function file_extension($val){
	$ext=array('xlsx','pdf', 'xls', 'doc', 'docx', 'ppt', 'pptx', 'rar','zip' );
	return in_array($val, $ext);	
}
function image_extension($val){
	$ext=array('gif','jpg', 'jpeg');
	return in_array($val, $ext);	
}

function compute_percent($val, $fullval,$n=2){
	if($fullval==0){
		return number_format(0,$n);
	}else{
		$percent = ($val*100)/$fullval;
		return number_format($percent,$n);
	}
}
function getLevel($area,$total)
{	
		$i=($area=="1") ? 0:1;	
		for($i;$i<=$total;$i++){
			
			$data[$i] = ($i==0) ? 'กทม.':'เขตที่ '.$i;
		}
		return $data;		
	
}
function sum_vertical($sum,$val){
	
	return $sum + $val;
}

function downloadFile($file){
    $file_name = $file;
    $mime = 'application/force-download';
    header('Pragma: public');  // required
    header('Expires: 0');  // no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private',false);
    header('Content-Type: '.$mime);
	header("Content-Type: application/excel");
    header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
    header('Content-Transfer-Encoding: binary');
    header('Connection: close');
    //readfile($file_name);  // push it out
    
}
function check_delete_setting($module,$province_id=FALSE,$amphur_id=FALSE,$district_id=FALSE){
	$CI =& get_instance();
	if($module =="amhur"){
		$where = array(" hospital_amphur_id = ? and hospital_province_id = ? "
					  ," hospitalamphur = ? and hospitalprovince = ? "
					  ," (amphurid = ? and provinceid = ?)  or (amphuridplace = ?  and provinceidplace = ?) "
					  ,"useramphur = ?  and userprovince = ? ");	
	    $val = array(array($amphur_id,$province_id),array($amphur_id,$province_id,$amphur_id,$province_id));
	}else if($module =="province"){
	    	$where = array(" hospital_province_id = ? "
	    				  ," hospitalprovince = ? "
	    				  ," provinceid = ? or  provinceidplace =  "
	    				  ," userprovince = ? ");	
	    	$val = array($province_id,array($province_id,$province_id));		
	}else if($module =="district"){
		$where = array(" hospital_amphur_id = ? and hospital_province_id = ? and hospital_district_id = ? "
					  ," hospitalamphur = ? and hospitalprovince = ?  and substring(hospitalcode,5,2) = ? "
					  ," (amphurid = ? and provinceid = ? and districtid = ? )  or (amphuridplace = ?  and provinceidplace = ? and districtidplace = ? ) "
					  ," useramphur = ? and userprovince = ? and userdistrict = ? ");	
	    $val = array(array($amphur_id,$province_id,$district_id),array($amphur_id,$province_id,$district_id,$amphur_id,$province_id,$district_id));
		
	}
	$hospital_id = $CI->db->GetOne("select hospital_id from n_hospital_1 where ".$where[0],$val[0]);
	$inform_id = $CI->db->GetOne("select id from n_information where ".$where[1],$val[0]);
	$history_id = $CI->db->GetOne("select historyid from n_history where  ".$where[1],$val[0]);
	$dead_id = $CI->db->GetOne("select id  id from n_historydead where ".$where[2],$val[1]);
	$user_id = $CI->db->GetOne("select uid from n_user where  ".$where[3],$val[0]);
	if($hospital_id || $inform_id ||  $history_id || $dead_id || $user_id){	    
		return false;
	}else{
		return true;	   
	}
}







?>