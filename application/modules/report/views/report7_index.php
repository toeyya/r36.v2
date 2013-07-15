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
	<?php echo form_dropdown('province',get_option('province_id','province_name','n_province'),$_GET['province'],'class="styled-select" id="prvince"','ทั้งหมด','all');?>
				
	</td> 
	<th>ปีที่สัมผัสโรค</th>	
	<td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>			
	  </tr>  
	</table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul>
</div>
</form>
</div><!--search -->
<? if($cond): ?>
<div id="report" style="width:100%;margin:0px;">
<div id="title">
	<p>รายงานผู้เสียชีวิต</p>
	<p>รายจังหวัด : <?php echo $textprovince;?></p>	
</div>
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
		$gender=array('',"ชาย","หญิง");
		$occupation=array("นักเรียน นักศึกษา","ในปกครอง","เกษตร ทำนา ทำสวน","ข้าราชการ","กรรมกร","รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)","ค้าขาย","งานบ้าน","ทหาร ตำรวจ","ประมง","ครู","เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร","ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ","สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า","อาสาสมัครฉีดวัคซีนสุนัข","เจ้าหน้าที่สวนสัตว์","ไปรษณีย์","ป่าไม้","พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า","อื่นๆ (ระบุ)","ไม่ระบุ");		
		$placetouch=array("ไม่ระบุ","เขต กทม.","เขตเมืองพัทยา","เขตเทศบาล","เขตอบต.");
		foreach($result as $key=>$item): ?>
		<tr style="text-align: center;">
			<td><? echo ++$key ?></td>			
			<td><? echo (!empty($item['enddate'])) ? db_to_th($item['enddate']):''; ?></td>			
			<td><? echo $gender[$item['gender']] ?></td>
			<td><? echo $item['age'] ?></td>
			<td><? echo $item['occupation'] ?></td>		
			<td><? echo $placetouch[$item['area_id']] ?>(จ.<? echo $item['province_name'] ?> อ.<?echo $item['amphur_name'] ?> ต.<? echo $item['district_name'] ?>)</td>
			<td><? echo (!empty($item['datetouch'])) ? db_to_th($item['datetouch']):''; ?></td>
			<td><? echo (!empty($item['startdate'])) ? db_to_th($item['startdate']):'' ?></td>
			<td></td>	
		 	<td>สำนักสุขศาสตร์สัตว์และสุขศึกษาที่ 5 จ.เชียงใหม่ ผล:positive</td>	
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
		$statusanimal = array(''=>"ไม่ระบุ","มีเจ้าของ","ไม่มีเจ้าของ","ไม่ทราบ",''=>"ไม่ระบุ");
		$historyvacine= array(''=>'ไม่ระบุ',"ไม่ทราบ","ไม่ได้รับ","ได้รับ");
		foreach($result as $key=>$item):
		 ?>
		<tr style="text-align: center;">
			<td><? echo ++$key ?></td>
			<td><? echo $typeanimal[$item['animal']] ?></td>
			<td><? echo $statusanimal[$item['statuanimal']]?></td>
			<td><? echo $ageanimal[$item['age_animal']]?></td>		
			<td><? echo $historyvacine[$item['historyvaccine']] ?></td>
			<td></td>
			<td></td>	
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
