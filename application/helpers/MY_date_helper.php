

<?php 

if(!function_exists('get_year_option'))
{
	function get_year_option($start=FALSE,$plus = 0)
	{
		$year = (date('Y') + 543) + $plus;
		$start ="2546";
		$data = array();
		for($year;$year >= $start;$year--)
		{
			$data[$year] = $year;
		}
		return $data;
	}
}

	function DB2DateTime($Dt){ 
		if($Dt!=NULL){
			list($date,$time) = explode(" ",$Dt);
			list($y,$m,$d)   = explode("-",$date);
	                $showtime = ($time)?$time:'';
			$y=($y=="0000")?"0000":$y+543;
			return $d."/".$m."/".($y).' '.$showtime;
		}else{ return $Dt; }
	}
	

	
	function DateTH2DB($date){
		list($d,$m,$y) = explode('-', $date);
	    //$y-=543;
	    return $y.'/'.$m.'/'.$d ;
	
	}


if ( ! function_exists('DateTime2DB'))
{
	function DateTime2DB($Dt){
		if($Dt!=NULL && $Dt!="")
		{
			list($date,$time)=explode(" ",$Dt);	
			list($y,$m,$d) = explode('-', $date);
			$showtime = ($time)?$time:'';
	    	$y-=543;
	    	return $y.'-'.$m.'-'.$d.' '.$showtime;
		}else{
			$Dt="";	
			return $Dt;
		}

	}
}


	function DBdate($date){
		if($date!=NULL && $date!="0000-00-00")
		{
			list($y,$m,$d) = explode('-', $date);
	    	$y-=543;
	    	return $y.'-'.$m.'-'.$d;
		}else{
			$date="";
			return $date;
		}

	}

		
if ( ! function_exists('db_to_th'))
{
function db_to_th($datetime = '', $time = FALSE ,$format = 'F',$dayofweek = FALSE)
	{
		if($format == 'F')
		{
			$month_th = array(1 =>'มกราคม',2 => 'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',7=>'กรกฏาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม');
			$date_th=array(0=>'อาทิตย์',1=>'จันทร์',2=>'อังคาร',3=>'พุธ',4=>'พฤหัสบดี',5=>'ศุกร์',6=>'เสาร์');
		}
		else
		{
			$month_th = array( 1 =>'ม.ค.',2 => 'ก.พ.',3=>'มี.ค.',4=>'เม.ย',5=>'พ.ค.',6=>'มิ.ย',7=>'ก.ค.',8=>'ส.ค.',9=>'ก.ย.',10=>'ต.ค.',11=>'พ.ย.',12=>'ธ.ค.');
		}
		
		$datetime = mysql_to_unix($datetime);
		if($dayofweek)
		{
			$r =$date_th[date('w',$datetime)].'ที่ '.date('d', $datetime).' '.$month_th[date('n', $datetime)].' '.(date('Y', $datetime) + 543); 
		}
		else
		{
			$r =date('d', $datetime).' '.$month_th[date('n', $datetime)].' '.(date('Y', $datetime) + 543);
		}

		if($time)
		{
				$r .= ' - '.date('H', $datetime).':'.date('i', $datetime);
		}
	
		return $r;
	}
}

if ( ! function_exists('unix_to_human_date'))
{
	function unix_to_human_date($time = '')
	{
		return date('Y', $time).'-'.date('m', $time).'-'.date('d', $time);
	}
}

if(! function_exists('DateDiff'))
{
	function DateDiff($strDate1,$strDate2)
	{
		return (strtotime($strDate2) - strtotime($strDate1))/(60 * 60 * 24 ); // 1 day = 60*60*24
	}
}

if(! function_exists('timespan'))
{
	function timespan($rightside = 1, $leftside = '',$module = FALSE)
	{			
		if ( ! is_numeric($rightside))
		{
			$rightside = 1;
		}
	 
		if ( ! is_numeric($leftside))
		{
			$leftside = time();
		}
	 
		if ($leftside <= $rightside)
		{
			$rightside = 1;
			if($module=="asset_list"){return "หมดเวลารับประกัน";	}					
		}		
		else
		{
			$rightside = $leftside - $rightside;						
		}
	 	
		$str = '';
		$asset_list='';
		$years = bcdiv($rightside,31536000);
	 	
		if ($years > 0)
		{	
			$str .= $years.' ปี, ';
			
		}	
	 	
		$rightside -= $years * 31536000;		
		$months = bcdiv($rightside,2628000);
	 	
		if ($years > 0 || $months > 0)
		{
			if ($months > 0)
			{	
				$str .= $months.' เดือน, ';
				
			}	
	 
			$rightside -= $months * 2628000;			
		}	   
		$weeks = bcdiv($rightside,604800);
	 
		if ($years > 0 || $months > 0 || $weeks > 0)
		{
			if ($weeks > 0)			
			{	
				$str .= $weeks.' สัปดาห์, ';
				
			}
	 
			$rightside -= $weeks * 604800;			
		}				 
		$days = bcdiv($rightside,86400);

		if ($months > 0 || $weeks > 0 || $days > 0)
		{
			if ($days > 0)
			{	
				$str .= $days.' วัน, ';
				
			}
	 
			$rightside -= $days * 86400;			
		}
	 
		/*$hours = floor($rightside / 3600);
	 
		if ($days > 0 || $hours > 0)
		{
			if ($hours > 0)
			{
				$str .= $hours.' ชั่วโมง, ';
			}
	 
			$rightside -= $hours * 3600;
			//$rightside =$rightside-($hours * 3600);
		}
	 
		$minutes = floor($rightside / 60);
	 
		if ($days > 0 || $hours > 0 || $minutes > 0)
		{
			if ($minutes > 0)
			{	
				$str .= $minutes.' นาที, ';
			}
	 
			$rightside -= $minutes * 60;
			//$rightside =$rightside-($minutes * 60);
		}
	 
		if ($str == '')
		{
			$str .= $rightside.' วินาที';
		}*/

			return substr(trim($str), 0, -1);
		
	}
}
function convert_month($month,$language){
	if($language=='longthai'){
		if($month=='01'){
			$month = 1;
		}elseif($month=='02'){
			$month = 2;
		}elseif($month=='03'){
			$month = 3;
		}elseif($month=='04'){
			$month = 4;
		}elseif($month=='05'){
			$month = 5;
		}elseif($month=='06'){
			$month = 6;
		}elseif($month=='07'){
			$month = 7;
		}elseif($month=='08'){
			$month = 8;
		}elseif($month=='09'){
			$month = 9;
		}elseif($month=='10'){
			$month = 10;
		}elseif($month=='11'){
			$month = 11;
		}elseif($month=='12'){
			$month = 12;
		}
		return $month;
	}elseif($language=='shortthai'){
		if($month=='01'){
			$month = "ม.ค.";
		}elseif($month=='02'){
			$month = "ก.พ.";
		}elseif($month=='03'){
			$month = "มี.ค.";
		}elseif($month=='04'){
			$month = "เม.ย.";
		}elseif($month=='05'){
			$month = "พ.ค.";
		}elseif($month=='06'){
			$month = "มิ.ย.";
		}elseif($month=='07'){
			$month = "ก.ค.";
		}elseif($month=='08'){
			$month = "ส.ค.";
		}elseif($month=='09'){
			$month = "ก.ย.";
		}elseif($month=='10'){
			$month = "ต.ค.";
		}elseif($month=='11'){
			$month = "พ.ย.";
		}elseif($month=='12'){
			$month = "ธ.ค.";
		}
		return $month;
	}elseif($language=='shorteng'){
		if($month=='01'){
			$month = "Jan";
		}elseif($month=='02'){
			$month = "Feb";
		}elseif($month=='03'){
			$month = "Mar";
		}elseif($month=='04'){
			$month = "Apr";
		}elseif($month=='05'){
			$month = "May";
		}elseif($data[1]=='06'){
			$month = "Jun";
		}elseif($month=='07'){
			$month = "Jul";
		}elseif($month=='08'){
			$month = "Aug";
		}elseif($month=='09'){
			$month = "Sep";
		}elseif($month=='10'){
			$month = "October";
		}elseif($month=='11'){
			$month = "Nov";
		}elseif($month=='12'){
			$month = "Dec";
		}
		return $month;
	}elseif($language=='longeng'){
		if($month=='01'){
			$month = "January";
		}elseif($month=='02'){
			$month = "February";
		}elseif($month=='03'){
			$month = "March";
		}elseif($month=='04'){
			$month = "April";
		}elseif($month=='05'){
			$month = "May";
		}elseif($month=='06'){
			$month = "June";
		}elseif($month=='07'){
			$month = "July";
		}elseif($month=='08'){
			$month = "August";
		}elseif($month=='09'){
			$month = "September";
		}elseif($month=='10'){
			$month = "October";
		}elseif($month=='11'){
			$month = "November";
		}elseif($month=='12'){
			$month = "December";
		}
	}
}



function cld_date2my($date_input){//format dd/mm/year_th -> year_th-mm-dd
	if(!$date_input){return false;}
		$arr_date=explode ("/",$date_input);

		$d=$arr_date[0];
		$m=$arr_date[1];
		$year_th=$arr_date[2];
	return $year_th."-".$m."-".$d;
}
function date2DB($date_input){
	if(!$date_input){return false;}
		@list($date, $time) = explode(" ",$date_input); 
		$arr_date=explode ("/",$date_input);
		$d=$arr_date[0];
		$m=$arr_date[1];
		$year_eng=$arr_date[2]-543;
		return $year_eng."-".$m."-".$d;
}
function DB2date($date_input,$show_time=FALSE){
	if(!$date_input){return false;}
		if($show_time){
			list($date, $time) = explode(" ",$date_input);
			$arr_date = explode ("-",$date); 	
		}else{
			$arr_date = explode ("-",$date_input);
		}				
		$d=(strlen($arr_date[2])>2) ? substr($arr_date[2],0,2):$arr_date[2];
		$m=$arr_date[1];
		$year_th=$arr_date[0]+543;
		if($show_time==FALSE){$time='';}
	return $d.'/'.$m.'/'.$year_th.' '.$time;				
}
function cld_my2date($date_input){//format year_th-mm-dd -> dd/mm/year_th
	if(!$date_input){return false;}			
		$arr_date = explode ("-",$date_input); 		
		$d=$arr_date[2];
		$m=$arr_date[1];
		$year_th=$arr_date[0];
	return $d.'/'.$m.'/'.$year_th;
}


	

if(!function_exists('get_month'))
{
	function get_month()
	{
		return array('1'=>'มกราคม','2'=>'กุมภาพันธ์','3'=>'มีนาคม','4'=>'เมษายน','5'=>'พฤษภาคม','6'=>'มิถุนายน','7'=>'กรกฏาคม','8'=>'สิงหาคม','9'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	}
}

function mysql_to_date($date,$is_date_thai = FALSE,$lang)
{
	//$month['th'] = array('','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12');
	$month['th'] = array('','01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน','07'=>'กรกฏาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	$month['en'] = array('','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
	@list($y,$m,$d) = @explode('-', $date);
	$y = ($is_date_thai) ? $y  : $y;
	return @$date ? $d.' '.$month[$lang][$m].' '.$y : NULL;
}

function dateDiff($dformat, $endDate, $beginDate)
{
    $date_parts1=explode($dformat, $beginDate);
    $date_parts2=explode($dformat, $endDate);
    $start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
    $end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
    return $end_date - $start_date;
}

function check_to_day($today,$lastday){
//รวมวันนี้ด้วย ถ้าไม่ต้องการร่วมวันนี้ให้เอา ''+1''ออก
return round(abs(strtotime($today)-strtotime($lastday))/86400);
}
?>