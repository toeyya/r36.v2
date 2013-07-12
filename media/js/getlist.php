<?
//header ("Content-Type:text/plain;Charset=TIS-620");
   //set_time_limit(180);
   //session_start ();
   //include('include/filemaster.php');
    //include("../include/Config_DB.php");
	//include("../include/Connect_DB.php");
	//include("../include/GenData.php");
	//include("../include/function.php");
	//include("../include/libmail.php");
   
//   self.location.href=url;
 $mode=$_GET['mode'];
 
  if ($mode=='s_amphur'){
		echo '<select class="textbox" name="amphur" id="amphur">';
		echo '<option value="">-โปรดเลือก-</option>';
		$query_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur WHERE province_id ='".$_GET['ref1']."' ORDER BY amphur_name ASC");
			while($rec_amphur=$DB->FETCHARRAY($query_amphur)){
				echo '<option value="'.$rec_amphur['amphur_id'].'">'.$rec_amphur['amphur_name'].'</option>';
			}
		echo '</select>';
  }



  if($mode=='Hs_amphur'){
	// onChange="url=\'js/getlist.php?mode=Hs_hospital&ref1=\'+form1.h_province.value+\'&ref2=\'+form1.h_amphur.value;   load_divForm(url,\'input_Hospital\'); "		
		print '<select class="textbox" name="h_amphur" id="h_amphur">';
		print '<option value="">-โปรดเลือก-</option>';
		$query_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur WHERE province_id ='".$ref1."' ORDER BY amphur_name ASC");
			while($rec_amphur=$DB->FETCHARRAY($query_amphur)){
				print '<option value="'.$rec_amphur['amphur_id'].'">'.$rec_amphur['amphur_name'].'</option>';
			}
		print '</select>';
  }
  if ($mode=='Hs_district'){
		print '<select class="textbox" name="h_district" onChange="url=\'js/getlist.php?mode=Hs_hospital&ref1=\'+form1.h_province.value+\'&ref2=\'+form1.h_amphur.value+\'&ref3=\'+form1.h_district.value;   load_divForm(url,\'input_Hospital\'); ">';		
		print '<option value="">-โปรดเลือก-</option>';
		$query_district=$DB->QUERY("SELECT district_id,district_name FROM n_district WHERE province_id='".$ref1."' AND amphur_id ='".$ref2."' ORDER BY district_name ASC");
			while($rec_district=$DB->FETCHARRAY($query_district)){
				print '<option value="'.$rec_district['district_id'].'">'.$rec_district['district_name'].'</option>';
			}
		print '</select>';
  }

  if ($mode=='Hs_hospital'){
		print '<select class="textbox" name="hospital" id="hospital">';		
		print '<option value="">-โปรดเลือก-</option>';
		$sql="SELECT hospital_code,hospital_name FROM n_hospital 
				  WHERE hospital_province_id='".$ref1."' AND hospital_amphur_id ='".$ref2."'  GROUP BY hospital_code,hospital_name ORDER BY hospital_name ASC";
		$query_hospital=$DB->QUERY($sql);
			while($rec_hospital=$DB->FETCHARRAY($query_hospital)){
				print '<option value="'.$rec_hospital['hospital_code'].'">'.$rec_hospital['hospital_name'].'</option>';
			}
		print '</select>';
  }
  //p.inform
  if($mode=='A_amphur'){
	  if($type=='dead'){
		//onChange="url=\'js/getlist.php?mode=A_district&ref1=\'+form1.provinceid.value+\'&ref2=\'+form1.amphurid.value;   load_divForm(url,\'address_district\'); "
		print '<select class="textbox" name="amphurid" id="amphurid" >';
	  }else{
		print '<select class="textbox" name="amphurid" id="amphurid">';
	  }
		print '<option value="">-โปรดเลือก-</option>';
		$query_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur WHERE province_id ='".$ref1."' ORDER BY amphur_name ASC");
			while($rec_amphur=$DB->FETCHARRAY($query_amphur)){
				print '<option value="'.$rec_amphur['amphur_id'].'">'.$rec_amphur['amphur_name'].'</option>';
			}
		print '</select>';
  }
  if ($mode=='A_district'){
		print '<select class="textbox" name="districtid"  id="districtid">';		
		print '<option value="">-โปรดเลือก-</option>';
		$query_district=$DB->QUERY("SELECT district_id,district_name FROM n_district WHERE province_id='".$ref1."' AND amphur_id ='".$ref2."' ORDER BY district_name ASC");
			while($rec_district=$DB->FETCHARRAY($query_district)){
				print '<option value="'.$rec_district['district_id'].'">'.$rec_district['district_name'].'</option>';
			}
		print '</select>';
  }

  if($mode=='History_hospital_amphur'){
		print '<select class="textbox" name="hospitalamphur"  id="hospitalamphur" >';
		//onChange="url=\'js/getlist.php?mode=History_hospital_hospital&ref1=\'+form1.hospitalprovince.value+\'&ref2=\'+form1.hospitalamphur.value;   load_divForm(url,\'input_Hospital\'); "
		print '<option value="">-โปรดเลือก-</option>';
		$query_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur WHERE province_id ='".$ref1."' ORDER BY amphur_name ASC");
			while($rec_amphur=$DB->FETCHARRAY($query_amphur)){
				print '<option value="'.$rec_amphur['amphur_id'].'">'.$rec_amphur['amphur_name'].'</option>';
			}
		print '</select>';
  }

  if ($mode=='History_hospital_hospital'){
		print '<select class="textbox" name="hospital" id="hospital">';		
		print '<option value="">-โปรดเลือก-</option>';
		$query_hospital=$DB->QUERY("SELECT hospital_code,hospital_name FROM n_hospital   WHERE hospital_province_id='".$ref1."' AND hospital_amphur_id ='".$ref2."' GROUP BY 	hospital_code,hospital_name  ORDER BY hospital_name ASC");
		//echo "$query_hospital=".$query_hospital;
			while($rec_hospital=$DB->FETCHARRAY($query_hospital)){
				print '<option value="'.$rec_hospital['hospital_code'].'">'.$rec_hospital['hospital_name'].'</option>';
			}
		print '</select>';
  }

  if($mode=='Export_hospital_amphur'){
		// onChange="url=\'js/getlist.php?mode=Export_hospital_hospital&ref1=\'+form1.hospitalprovince.value+\'&ref2=\'+form1.hospitalamphur.value;   load_divForm(url,\'input_Hospital\'); "
		print '<select class="textbox" name="hospitalamphur" id="hospitalamphur">';
		print '<option value="">- โปรดเลือก -</option>';
		$query_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur WHERE province_id ='".$ref1."' ORDER BY amphur_name ASC");
			while($rec_amphur=$DB->FETCHARRAY($query_amphur)){
				print '<option value="'.$rec_amphur['amphur_id'].'">'.$rec_amphur['amphur_name'].'</option>';
			}
		print '</select>';
  }

  if ($mode=='Export_hospital_hospital'){ 
		print '<select class="textbox" name="hospital">';		
		print '<option value="">- โปรดเลือก -</option>';
		$query_hospital=$DB->QUERY("SELECT hospital_code,hospital_name FROM n_hospital WHERE hospital_province_id='".$ref1."' AND hospital_amphur_id ='".$ref2."' ORDER BY hospital_name ASC");
			while($rec_hospital=$DB->FETCHARRAY($query_hospital)){
				print '<option value="'.$rec_hospital['hospital_code'].'">'.$rec_hospital['hospital_name'].'</option>';
			}
		print '</select>';
  }
  if ($mode=='place_pv'){
	  if($ref1!=''){
		$wh="WHERE province_id='".$ref1."' ";
		$select='selected';
	  }
		print '<select class="textbox" name="provinceidplace" id="provinceidplace">';
		print '<option value="">-โปรดเลือก-</option>';
		$query_provinceidplace=$DB->QUERY("SELECT province_id,province_name FROM n_province ".$wh." ORDER BY province_name ASC");
			while($rec_provinceidplace=$DB->FETCHARRAY($query_provinceidplace)){
				print '<option value="'.$rec_provinceidplace['province_id'].'" '.$select.'>'.$rec_provinceidplace['province_name'].'</option>';
			}
		print '</select>';
		
  }

  if($mode=='place_amp'){
		//onChange="url=\'js/getlist.php?mode=place_district&ref1=\'+form1.provinceidplace.value+\'&ref2=\'+form1.amphuridplace.value;   load_divForm(url,\'input_place_district\'); "
		print '<select class="textbox" name="amphuridplace"  id="amphuridplace">';
		print '<option value="">-โปรดเลือก-</option>';
		$query_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur WHERE province_id ='".$ref1."' ORDER BY amphur_name ASC");
			while($rec_amphur=$DB->FETCHARRAY($query_amphur)){
				print '<option value="'.$rec_amphur['amphur_id'].'">'.$rec_amphur['amphur_name'].'</option>';
			}
		print '</select>';
  }

  if ($mode=='place_district'){
		print '<select class="textbox" name="districtidplace" id="districtidplace">';		
		print '<option value="">-โปรดเลือก-</option>';
		$query_district=$DB->QUERY("SELECT district_id,district_name FROM n_district WHERE province_id='".$ref1."' AND amphur_id ='".$ref2."' ORDER BY district_name ASC");
			while($rec_district=$DB->FETCHARRAY($query_district)){
				print '<option value="'.$rec_district['district_id'].'">'.$rec_district['district_name'].'</option>';
			}
		print '</select>';
		
  }

  if($mode=='place_amppattaya'){
		// onChange="url=\'js/getlist.php?mode=place_district&ref1=\'+form1.provinceidplace.value+\'&ref2=\'+form1.amphuridplace.value;   load_divForm(url,\'input_place_district\'); "
		print '<select class="textbox" name="amphuridplace"  id="amphuridplace">';
		print '<option value="'.$rec_amphur['amphur_id'].'" selected>เมืองพัทยา</option>';
		print '</select>';

  }
  //---Report ปัจจัยรอง-----
  if($_GET['mode']=='D_main'){
	  if($_GET['ref1']=='1'){
	  	$arr_detail_minor =array(1=>'เพศ',2=>'อาชีพ',3=>'อาชีพผู้ปกครอง',4=>'สถานที่สัมผัส',5=>'ชนิดสัตว์นำโรค',6=>'อายุสัตว์',7=>'สถานภาพสัตว์',8=>'สาเหตุที่ถูกกัด',9=>'การล้างแผล',10=>'การใส่ยาฆ่าเชื้อ');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">เพศ</option>';
		echo	'<option value="2">อาชีพ</option>';
		echo	'<option value="3">อาชีพผู้ปกครอง</option>';
		echo	'<option value="4">สถานที่สัมผัส</option>';
		echo	'<option value="5">ชนิดสัตว์นำโรค</option>';
		echo	'<option value="6">อายุสัตว์</option>';
		echo	'<option value="7">สถานภาพสัตว์</option>';
		echo	'<option value="8">สาเหตุที่ถูกกัด</option>';
		echo	'<option value="9">การล้างแผล</option>';
		echo	'<option value="10">การใส่ยาฆ่าเชื้อ</option>';
	    echo '</select>';

	  }else if($_GET['ref1']=='2'){
	  	$arr_detail_minor =array(1=>'ชนิดสัตว์นำโรค',2=>'สถานภาพสัตว์',3=>'ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์',4=>'การส่งหัวสัตว์ตรวจ');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">ชนิดสัตว์นำโรค</option>';
		echo	'<option value="2">สถานภาพสัตว์</option>';
		echo	'<option value="3">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์</option>';
		echo	'<option value="4">การส่งหัวสัตว์ตรวจ</option>';
	    echo '</select>';
	  }else if($_GET['ref1']=='3'){
	  	$arr_detail_minor =array(1=>'สถานภาพสัตว์',2=>'การกักขัง/ติดตามดูอาการสัตว์',3=>'ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์',4=>'การส่งหัวสัตว์ตรวจ');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">สถานภาพสัตว์</option>';
		echo	'<option value="2">การกักขัง/ติดตามดูอาการสัตว์</option>';
		echo	'<option value="3">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์</option>';
		echo	'<option value="4">การส่งหัวสัตว์ตรวจ</option>';
	    echo '</select>';
	  }else if($_GET['ref1']=='4'){
	  	$arr_detail_minor =array(1=>'ชนิดสัตว์นำโรค',2=>'สถานภาพสัตว์',3=>'ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">ชนิดสัตว์นำโรค</option>';
		echo	'<option value="2">สถานภาพสัตว์</option>';
		echo	'<option value="3">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์</option>';
	    echo '</select>';
	  }else if($_GET['ref1']=='5'){
	  	$arr_detail_minor =array(1=>'จำนวนหัวสัตว์ที่ส่งตรวจ');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">จำนวนหัวสัตว์ที่ส่งตรวจ</option>';
	    echo '</select>';
	  }else if($_GET['ref1']=='6'){
	  	$arr_detail_minor =array(1=>'จำนวนหัวสัตว์ที่ส่งตรวจพบเชื้อ');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">จำนวนหัวสัตว์ที่ส่งตรวจพบเชื้อ</option>';
	    echo '</select>';
	  }else if($_GET['ref1']=='7'){
	  	$arr_detail_minor =array(1=>'อาชีพ',2=>'อาชีพผู้ปกครอง',3=>'อายุ',4=>'การฉีดอิมมูโนโกลบุลิน',5=>'จำนวนเข็มของการฉีด',6=>'ผลการส่งหัวสัตว์ตรวจที่พบเชื้อ');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">อาชีพ</option>';
		echo	'<option value="2">อาชีพผู้ปกครอง</option>';
		echo	'<option value="3">อายุ</option>';
		echo	'<option value="4">การฉีดอิมมูโนโกลบุลิน</option>';
		echo	'<option value="5">จำนวนเข็มของการฉีด</option>';
		echo	'<option value="6">ผลการส่งหัวสัตว์ตรวจที่พบเชื้อ</option>';
	    echo '</select>';
	  }else if($_GET['ref1']=='8'){
	  	$arr_detail_minor =array(1=>'ตำแหน่งที่สัมผัสโรค และลักษณะการสัมผัส',2=>'สถานภาพสัตว์',3=>'ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์',4=>'วิธีฉีดวัคซีนในคน');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">ตำแหน่งที่สัมผัสโรค และลักษณะการสัมผัส</option>';
		echo	'<option value="2">สถานภาพสัตว์</option>';
		echo	'<option value="3">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์</option>';
		echo	'<option value="4">วิธีฉีดวัคซีนในคน</option>';
	    echo '</select>';
	  }else if($_GET['ref1']=='9'){
	  	$arr_detail_minor =array(1=>'การกักขังได้/ติดตามได้',2=>'ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์',3=>'การส่งหัวสัตว์ตรวจ');
		//echo form_dropdown('detail_minor',$arr_detail_minor,@$_GET['detail_minor'],'class="styled-select"','ปัจจัยรอง');
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
		echo	'<option value="1">การกักขังได้/ติดตามได้</option>';
		echo	'<option value="2">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์</option>';
		echo	'<option value="3">การส่งหัวสัตว์ตรวจ</option>';
	    echo '</select>';
	  }else{
    	echo '<select name="detail_minor" class="styled-select">';
		echo	'<option value="">ปัจจัยรอง</option>';
	    echo '</select>';
	  }
	  		return true;
  }
  //--End-Report ปัจจัย-----

//-----Report รายงานสรุปรายจังหวัด------
if($mode=='Report_grouplist'){
	if($ref1==1){
		$sql = "select province_level_old as groupno from n_province group by province_level_old order by province_level_old";
	}else if($ref1==2){
		$sql = "select province_level_new as groupno from n_province group by province_level_new order by province_level_new";
	}
	if($ref1!='-'){
//onChange="url=\'js/getlist.php?mode=Report_province&ref1=\'+formreport.area.value+\'&ref2=\'+formreport.group.value;   load_divForm(url,\'provincelist\'); "	
	print '<select class="textbox widthselect"  name="group"  id="group">';
	print '<option value="-" >กรุณาเลือก</option>';
	$query=$DB->QUERY($sql);
	while($rec=$DB->FETCHARRAY($query)){
			  if($rec[groupno]=='0'){
				$groupname = "กทม.";
			  }else{
				$groupname = "เขต ".$rec[groupno];
			  }
		print '<option value="'.$rec[groupno].'">'.$groupname.'</option>';
	}
	print '</select>';
	}else{
//onChange="url=\'js/getlist.php?mode=Report_province&ref1=\'+formreport.area.value+\'&ref2=\'+formreport.group.value;   load_divForm(url,\'provincelist\'); "
	print '<select class="textbox widthselect"  name="group" >';
	print '<option value="-" selected>กรุณาเลือก</option>';
	print '</select>';
	}
}
if($mode=='Report_province'){
		if($ref1=='1'){
			$field = "province_level_old";
		}else if($ref1=='2'){
			$field = "province_level_new";
		}
		if($ref1!='-' && $ref2!='-'){
					print '<select class="textbox widthselect"  name="province">';
					print '<option value="-" selected>กรุณาเลือก</option>';
				    $queryprovince=$DB->QUERY("select province_id, province_name from n_province where ".$field."='".$ref2."' order by province_name asc");
					while($recprovince=$DB->FETCHARRAY($queryprovince)){
						print '<option value="'.$recprovince[province_id].'">'.$recprovince[province_name].'</option>';
					}
					print '</select>';
		}else{
			print '<select class="textbox widthselect"  name="province">';
			print '<option value="-" selected>กรุณาเลือก</option>';
			print '</select>';
		}


}
//--End Report รายงานสรุปรายจังหวัด----
if(isset($_GET['province']) && isset($_GET['amphur']))
{

	$province = mysql_real_escape_string($_GET['province']);
	$amphur = mysql_real_escape_string($_GET['amphur']);
	
}
if($mode=="chkdup_district_name")
{
	if(isset($_GET['district_name']))
	{
		$district_name=mysql_real_escape_string($_GET['district_name']);
		$district_name=convert_encode($_GET['district_name']);

		$sql="SELECT  * FROM n_district WHERE province_id ='".$province."' AND amphur_id='".$amphur."' AND district_name='".$district_name."'";
		$result=$DB->QUERY($sql);
		$Chk_Duplicate=$DB->NUMROWS($result);
		if($Chk_Duplicate==0){
			echo "true";
		}else{
			echo "false";
		}	
	}
}
 if($mode=="chkdup_hospital_name"){
	if(isset($_GET['hospital_name']))
	{
		$hospital_name=mysql_real_escape_string($_GET['hospital_name']);
		$hospital_name=convert_encode($_GET['hospital_name']);
		$hospital_type=mysql_real_escape_string($_GET['hospital_type']);
		$sql="SELECT * FROM n_hospital WHERE hospital_id !='' 
			  AND hospital_amphur_id = '".$amphur."' 
			  AND hospital_province_id ='".$province."' 
			  AND hospital_name='".$hospital_name."'
			  AND hospital_type='".$hospital_type."'
			  AND hospital_id <>'".$_GET['hospital_id']."'";
	    
		$result=$DB->QUERY($sql);
		$Chk_Duplicate=$DB->NUMROWS($result);
		if($Chk_Duplicate==0){
			echo "true";
		}else{
			echo "false";
		}		
	}
}
if($mode=="chkdup_user")
{
	$uid=($_GET['uid']!="undefined" && $_GET['uid'] !="")? " and uid<>".$_GET['uid']:"";
	$sql="SELECT uid FROM  n_user WHERE username ='".$_GET['username']."' ".$uid;
	$Chk_Duplicate=$DB->NUMROWS($DB->QUERY($sql));
	echo ($Chk_Duplicate==0)? "true":"false";
}
if($mode=="chk_oldpassword")
{
	$sql="SELECT uid FROM n_user WHERE uid='".$_GET['uid']."' AND userpassword='".$_GET['oldpassword']."'";
		$Chk_Duplicate=$DB->NUMROWS($DB->QUERY($sql));
		echo ($Chk_Duplicate==0)? "false":"true";
		// ต้อง return false ถึงจะแสดงข้อความ
}
  $DB->END();
?>
