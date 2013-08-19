<script type="text/javascript">
	$(document).ready(function(){
	 $('#multiAccordion').multiAccordion({
            heightStyle: "content",
        	 active:0 
        });	

	})
</script>
<? error_reporting(E_ALL ^ E_NOTICE); ?>
<div id="title">ข้อมูลผู้เสียชีวิต</div>
<div id="search">
<form action="report/index/7" method="get">
<table  class="tb_patient1">
  <tr>	
	<th>จังหวัด</th>
	<td>			
	<?php echo form_dropdown('province',get_option('province_id','province_name','n_province order by province_name asc'),$_GET['province'],'class="styled-select" id="prvince"','ทั้งหมด','all');?>
				
	</td> 
	<th>ปีที่เสียชีวิต</th>	
	<td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>			
	  </tr>  
	</table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul>
</div>
</form>
</div><!--search -->
<div id="loading"><img src="media/images/loading2.gif" width="98px" height="20px"></div>
<? if($cond): ?>
<div id="report">
<div id="title">
	<p>รายงานผู้เสียชีวิต</p>
	<p>รายจังหวัด : <?php echo $textprovince;?></p>	
</div>
<div style="float:right;margin-top:-40px;clear: both;width:20%;text-align:right;">
<a href="report/index/7<?php echo '?'.$_SERVER['QUERY_STRING'].'&excel=excel' ?>" class="excel" name="btn_excel"></a></div> 
<div class="right">หน่วย: ราย</div>
<div id="multiAccordion" style="width:100%;margin:0px;">
	<h3><a href="javascript:void(0)">ประวัติผู้เสียชีวิต</a></h3>
	<div id="section1">
	<table class="tbreport">
		<tr>
			<th>ราย</th>
			<th>วันที่เสียชีวิต</th>
			<th>เพศ</th>	
			<th>อายุ</th>
			<th>อาชีพ</th>	
			<th>สถานที่สัมผัสโรค</th>
			<th>วันที่สัมผัสโรค</th>
			<th>วันเริ่มมีอาการ</th>
			<th>ระยะฟักตัว</th>
			<th>ผลตรวจทางห้องปฏิบัติการ</th>
		</tr>
		<? 
		$gender=array(''=>'',0=>'ไม่ระบุ',"ชาย","หญิง");
		$occupationname_b=array(''=>"-","นักเรียน นักศึกษา","ในปกครอง","เกษตร ทำนา ทำสวน","ข้าราชการ","กรรมกร","รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)","ค้าขาย","งานบ้าน","ทหาร ตำรวจ","ประมง","ครู","เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร","ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ","สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า","อาสาสมัครฉีดวัคซีนสุนัข","เจ้าหน้าที่สวนสัตว์","ไปรษณีย์","ป่าไม้","พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า","อื่นๆ (ระบุ)","ไม่ระบุ");		
		$placetouch=array(''=>"","ไม่ระบุ","เขต กทม.","เขตเมืองพัทยา","เขตเทศบาล","เขตอบต.");
		$brain_tumor_lo =array("ไม่ระบุ","สถาบันวิจัยวิทยาศาสตร์สาธารณสุข  กรมวิทยาศาสตร์การแพทย์  ","โรงพยาบาลปกเกล้า  ","ศูนย์วิทยาศาสตร์การแพทย์เชียงราย","ศูนย์วิทยาศาสตร์การแพทย์ขอนแก่น  ","ศูนย์วิทยาศาสตร์การแพทย์นครราชสีมา","คณะแพทยศาสตร์ศิริราชพยาบาล (ภาควิชาจุลชีววิทยา)","คณะแพทยศาสตร์มหาวิทยาลัยเชียงใหม่  ","ศูนย์ปฏิบัติการโรคทางสมอง  โรงพยาบาลจุฬาลงกรณ์","สถานเสาวภา  สภากาชาดไทย",''=>"ไม่ระบุ");
		$saliva_headache_lo=array("ไม่ระบุ","สถาบันวิจัยวิทยาศาสตร์สาธารณสุข  กรมวิทยาศาสตร์การแพทย์  ","โรงพยาบาลปกเกล้า  ","ศูนย์วิทยาศาสตร์การแพทย์เชียงราย","ศูนย์วิทยาศาสตร์การแพทย์ขอนแก่น  ","ศูนย์วิทยาศาสตร์การแพทย์นครราชสีมา","คณะแพทยศาสตร์ศิริราชพยาบาล (ภาควิชาจุลชีววิทยา)","คณะแพทยศาสตร์มหาวิทยาลัยเชียงใหม่  ","ศูนย์ปฏิบัติการโรคทางสมอง  โรงพยาบาลจุฬาลงกรณ์","สถานเสาวภา  สภากาชาดไทย",''=>"ไม่ระบุ");
		$csf_lo =array("ไม่ระบุ","สถาบันวิจัยวิทยาศาสตร์สาธารณสุข  กรมวิทยาศาสตร์การแพทย์  ","โรงพยาบาลปกเกล้า  ","ศูนย์วิทยาศาสตร์การแพทย์เชียงราย","ศูนย์วิทยาศาสตร์การแพทย์ขอนแก่น  ","ศูนย์วิทยาศาสตร์การแพทย์นครราชสีมา","คณะแพทยศาสตร์ศิริราชพยาบาล (ภาควิชาจุลชีววิทยา)","คณะแพทยศาสตร์มหาวิทยาลัยเชียงใหม่  ","ศูนย์ปฏิบัติการโรคทางสมอง  โรงพยาบาลจุฬาลงกรณ์","สถานเสาวภา  สภากาชาดไทย",''=>"ไม่ระบุ");
		$piss_lo=array("ไม่ระบุ","สถาบันวิจัยวิทยาศาสตร์สาธารณสุข  กรมวิทยาศาสตร์การแพทย์  ","โรงพยาบาลปกเกล้า  ","ศูนย์วิทยาศาสตร์การแพทย์เชียงราย","ศูนย์วิทยาศาสตร์การแพทย์ขอนแก่น  ","ศูนย์วิทยาศาสตร์การแพทย์นครราชสีมา","คณะแพทยศาสตร์ศิริราชพยาบาล (ภาควิชาจุลชีววิทยา)","คณะแพทยศาสตร์มหาวิทยาลัยเชียงใหม่  ","ศูนย์ปฏิบัติการโรคทางสมอง  โรงพยาบาลจุฬาลงกรณ์","สถานเสาวภา  สภากาชาดไทย",''=>"ไม่ระบุ");
		$root_lo =array("ไม่ระบุ","สถาบันวิจัยวิทยาศาสตร์สาธารณสุข  กรมวิทยาศาสตร์การแพทย์  ","โรงพยาบาลปกเกล้า  ","ศูนย์วิทยาศาสตร์การแพทย์เชียงราย","ศูนย์วิทยาศาสตร์การแพทย์ขอนแก่น  ","ศูนย์วิทยาศาสตร์การแพทย์นครราชสีมา","คณะแพทยศาสตร์ศิริราชพยาบาล (ภาควิชาจุลชีววิทยา)","คณะแพทยศาสตร์มหาวิทยาลัยเชียงใหม่  ","ศูนย์ปฏิบัติการโรคทางสมอง  โรงพยาบาลจุฬาลงกรณ์","สถานเสาวภา  สภากาชาดไทย",''=>"ไม่ระบุ");
		$occipital_skin_lo=array("ไม่ระบุ","สถาบันวิจัยวิทยาศาสตร์สาธารณสุข  กรมวิทยาศาสตร์การแพทย์  ","โรงพยาบาลปกเกล้า  ","ศูนย์วิทยาศาสตร์การแพทย์เชียงราย","ศูนย์วิทยาศาสตร์การแพทย์ขอนแก่น  ","ศูนย์วิทยาศาสตร์การแพทย์นครราชสีมา","คณะแพทยศาสตร์ศิริราชพยาบาล (ภาควิชาจุลชีววิทยา)","คณะแพทยศาสตร์มหาวิทยาลัยเชียงใหม่  ","ศูนย์ปฏิบัติการโรคทางสมอง  โรงพยาบาลจุฬาลงกรณ์","สถานเสาวภา  สภากาชาดไทย",''=>"ไม่ระบุ");
		$corneal_cells_lo =array("ไม่ระบุ","สถาบันวิจัยวิทยาศาสตร์สาธารณสุข  กรมวิทยาศาสตร์การแพทย์  ","โรงพยาบาลปกเกล้า  ","ศูนย์วิทยาศาสตร์การแพทย์เชียงราย","ศูนย์วิทยาศาสตร์การแพทย์ขอนแก่น  ","ศูนย์วิทยาศาสตร์การแพทย์นครราชสีมา","คณะแพทยศาสตร์ศิริราชพยาบาล (ภาควิชาจุลชีววิทยา)","คณะแพทยศาสตร์มหาวิทยาลัยเชียงใหม่  ","ศูนย์ปฏิบัติการโรคทางสมอง  โรงพยาบาลจุฬาลงกรณ์","สถานเสาวภา  สภากาชาดไทย",''=>"ไม่ระบุ");
		$saliva_headache_po_ne=array("-","Positive","Negative",''=>"-");
		$brain_tumor_po_ne=array("-","Positive","Negative",''=>"-");
		$csf_po_ne=array("-","Positive","Negative",''=>"-");
		$piss_po_ne=array("-","Positive","Negative",''=>"-");
		$root_po_ne=array("-","Positive","Negative",''=>"-");
		$occipital_skin_po_ne=array("-","Positive","Negative",''=>"-");
		$corneal_cells_po_ne=array("-","Positive","Negative",''=>"-");
		foreach($result as $key=>$item): ?>
		<tr style="text-align: center;">
			<td><? echo ++$key ?></td>			
			<td><? if($item['endate']=='0000-00-00')
			{  echo " ";}
			else {
				echo (!empty($item['endate'])) ? mysql_to_date($item['endate'],true,"th"):''?>
			<?}
			 ?>
				<?// echo (!empty($item['endate'])) ? db_to_th($item['enddate']):''; ?></td>			
			<td><? echo $gender[$item['gender']] ?></td>
			<td><? echo $item['age'] ?></td>
			<td><? echo $occupationname_b[$item['occupationname_b']] ?></td>		
			<td><? echo $placetouch[$item['area_id']] ?>(จ.<? echo $item['province_name'] ?> อ.<?echo $item['amphur_name'] ?> ต.<? echo $item['district_name'] ?>)</td>
			<td><? if($item['datetouch']=='0000-00-00')
			{  echo " ";}
			else {
				echo (!empty($item['datetouch'])) ? mysql_to_date($item['datetouch'],true,"th"):''?>
			<?}
			 ?></td>
			<td><? if($item['startdate']=='0000-00-00')
			{  echo " ";}
			else {
				echo (!empty($item['startdate'])) ? mysql_to_date($item['startdate'],true,"th"):''?>
			<?}
			 ?>
				<? //echo (!empty($item['startdate'])) ? db_to_th($item['startdate']):'' ?></td>
			<td><? if($item['datetouch']=='0000-00-00')
						{  echo " ";}
			else {
				 $today=DBdate($item['datetouch']);//ปี-เดือน-วัน ปัจจุบัน
					$lastday=DBdate($item['startdate']);
					echo check_to_day($today,$lastday)."วัน";
					//echo DBdate($item['datetouch']); 
			}
					//ปี-เดือน ปัจจุบัน t=วันสุดท้ายของเดือน
 			?>
	
				 </td>
		 	<td>
		 	<? if($item['brain_tumor_lo']==''){
		 		echo " ";
		 	}
			else {
			echo "ส่งเนื้องอกสมองตรวจ ที่ ".$brain_tumor_lo[$item['brain_tumor_lo']]." "." ผล :". $brain_tumor_po_ne[$item['brain_tumor_po_ne']];
			}
				if($item['saliva_headache_lo']==''){
		 		echo " ";
		 	}
		else {
			echo "<br/> ส่งน้ำลายปวดศีรษะตรวจ ที่ ".$saliva_headache_lo[$item['saliva_headache_lo']]." "."  ผล :".$saliva_headache_po_ne[$item['saliva_headache_po_ne']];
			}
		 	 if($item['csf_lo']==''){
		 		echo " ";
		 	}
		else {
			echo "<br/> ส่งน้ำไขสันหลังตรวจ ที่ ".$csf_lo[$item['csf_lo']]." "." ผล :". $csf_po_ne[$item['csf_po_ne']];
			}
		 	 if($item['piss_lo']==''){
		 		echo " ";
		 	}
		else {
			echo "<br/> ส่งปัสสาวะตรวจ ที่ ".$piss_lo[$item['piss_lo']]." "." ผล :". $piss_po_ne[$item['piss_po_ne']];
			}
		 	 if($item['brain_tumor_lo']==''){
		 		echo " ";
		 	}
		else {
			echo "<br/> ส่งปมรากผลตรวจ ที่ ".$root_lo[$item['root_lo']]." "." ผล :". $root_po_ne[$item['root_po_ne']];
			}
			 if($item['occipital_skin_lo']==''){
		 		echo " ";
		 	}
		else {
			echo "<br/> ส่งผิวหนังท้ายทอยตรวจ ที่ ".$occipital_skin_lo[$item['occipital_skin_lo']]." "." ผล :". $occipital_skin_po_ne[$item['occipital_skin_po_ne']];
			}
		 	 if($item['corneal_cells_lo']==''){
		 		echo " ";
		 	}
		else {
			echo "<br/> ส่งเซลล์กระจกตาตรวจ ที่ ".$corneal_cells_lo[$item['corneal_cells_lo']]." "." ผล :". $corneal_cells_po_ne[$item['corneal_cells_po_ne']];
			}
		 	?>
		 </td>	
		</tr>
		<?php endforeach; ?>
		</table>
			<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	
			<div id="btn_printout"><a href="report/index/7<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>
	</div>
	<h3><a herf="javascript:void(0)">ประวัติของสัตว์ที่กัด</a></h3>
	<div id="section2">
		<table class="tbreport">
		<tr>
			<th>ผู้สัมผัสรายที่</th>
			<th>ชนิดสัตว์</th>
			<th>สถานภาพ</th>	
			<th>อายุ</th>
			<th>การฉีดวัคซีนป้องกันโรค</th>	
			<th>สาเหตุถูกกัด</th>			
			<th>การส่งตรวจ</th>
		</tr>
		<? 
		$ageanimal = array(''=>"ไม่ระบุ","น้อยกว่า 3 เดือน ","3 - 6 เดือน ","6 - 12 เดือน ","มากกว่า 1 ปี ","ไม่ทราบ");
		$typeanimal = array("สุนัข","แมว","ลิง","ชะนี","หนู","คน","วัว","กระบือ","สุกร","แพะ","แกะ","ม้า","กระรอก","กระแต","พังพอน","กระต่าย","สัตว์ป่า","ไม่ทราบ");
		$statusanimal = array("ไม่ระบุ","มีเจ้าของ","ไม่มีเจ้าของ","ไม่ทราบ",''=>"ไม่ระบุ");
		$historyvacine= array("ไม่ระบุ","ไม่ทราบ","ไม่ได้รับ","ได้รับ",''=>"ไม่ระบุ");
		$reasonbite=  array("ไม่ระบุ","ถูกกัดโดยไม่มีสาเหตุโน้นำ","ถูกกัดโดยมีสาเหตุโน้มนำ",''=>"ไม่ระบุ");
		$headanimal=array("ไม่ระบุ","ไม่ได้ส่งตรวจ","ส่งตรวจ",''=>"ไม่ระบุ");
		$n_reasonbite=array("ไม่ระบุ","ทำร้าย หรือแกล้งสัตว์","พยายามแยกสัตว์ที่กำลังต่อสู้กัน","เข้าใกล้สัตว์แม่ลูกอ่อน","รบกวนสัตว์ขณะกินอาหาร","อื่นๆ",);
		foreach($result as $key=>$item):
		 ?>
		<tr style="text-align: center;">
			<td><? echo ++$key ?></td>
			<td><? echo $typeanimal[$item['animal']] ?></td>
			<td><? echo $statusanimal[$item['statusanimal']]?></td>
			<td><? echo $ageanimal[$item['age_animal']]?></td>		
			<td><? echo $historyvacine[$item['historyvacine']] ?></td>
			<td><? if($item['reasonbite']==1)
			{echo $reasonbite[$item['reasonbite']]; }
			else {
				echo $reasonbite[$item['reasonbite']].$n_reasonbite[$item['n_reasonbite']] ;
			}?>
			</td>
			<td><? echo $headanimal[$item['headanimal']] ?></td>	
		</tr>
		<? endforeach; ?>
		</table>
			<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	
			<div id="btn_printout"><a href="report/index/7<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>
	</div><!--section2 -->

</div><!-- mulicordion -->			

</div><!--report-->
<? endif;?>
