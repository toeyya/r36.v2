<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">					  
	<span>รายงานผู้สัมผัสโรคในภาพรวม</span><br/>
	<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span></br>
	<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
	<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></span>				
</div>

<h3>ส่วนที่ 1 : ข้อมูลทั่วไป </h3>
<h6>ตารางที่ 1 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามข้อมูลทั่วไป </h6>
<table class="tbreport"  border="1" width="864">
		<tr>
			<th>ข้อมูลทั่วไป</th>
			<th>จำนวน (N=<?php echo number_format($total_n); ?>)</th>
			<th>ร้อยละ</th>
		</tr>
		<tr><td colspan="3"><strong>เพศ</strong></td></tr>
		<tr class="para1">
			<td style="padding-left:10px;">ชาย</td>
			<td><? echo number_format($total_gender1); ?></td>
			<td><? echo compute_percent($total_gender1,$total_n)?></td>

		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">หญิง</td>
			<td><? echo number_format($total_gender2); ?></td>
			<td><? echo compute_percent($total_gender2,$total_n)?></td>
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">ไม่ระบุ</td>
			<td><? echo number_format($total_gender0); ?></td>
			<td><? echo compute_percent($total_gender0,$total_n)?></td>
		</tr>
		
		<tr ><td colspan="3"><strong>กลุ่มอายุ</strong>
		<?php $age=array(1=>'ต่ำกว่า 1 ปี',2=>'1-5 ปี',3=>'6-10 ปี',4=>'11-15 ปี',5=>'16-25 ปี'
						,6=>'26-35 ปี',7=>'36-45 ปี',8=>'46-55 ปี',9=>'56-65 ปี',10=>'66 ปีขึ้นไป'); ?>										
		</td></tr>
		<?php  for($i=1;$i<11;$i++):?>
		<tr class="para1">
			<td style="padding-left:10px;"><? echo $age[$i];?></td>
			<td><?php echo number_format(${'total_age'.$i}); ?></td>
			<td><?php echo compute_percent(${'total_age'.$i},$total_n); ?></td>
		</tr>
		<?php endfor; ?>
		<tr class="para1">
			<td style="padding-left:10px;">ไม่ระบุ</td>
			<td><?php echo number_format($total_age0); ?></td>
			<td><?php echo compute_percent($total_age0,$total_n); ?></td>		
		</tr>
		<tr><td colspan="3" style="padding-left:10px;" style="padding-left:52px;">
			(<strong>X</strong>=<? echo number_format($avg_age) ?>, 
			<strong>SD</strong>= <? echo number_format($stddev_age) ?>,
			<strong>Min</strong>= <? echo number_format($min_age); ?>, 
			<strong>Max</strong>= <? echo number_format($max_age); ?>)</td></tr>
	
		
		<tr><td colspan="3"><strong>อาชีพขณะสัมผัสโรค</strong></td></tr>
<?php $occupationname = array(1=>'นักเรียน นักศึกษา',2=>'ในปกครอง',3=>'เกษตรกรทำนา ทำสวน ',4=>'ข้าราชการ',5=>'กรรมกร'
							 ,6=>'รับจ้าง( เช่น พนักงานบริษัท,ดารานักแสดง )',7=>'ค้าขาย',8=>'งานบ้าน',9=>'ทหาร ตำรวจ',10=>'ประมง'
							 ,11=>'ครู',12=>'เลี้ยงสัตว์ / จับสุนัข ',13=>'นักบวช / ภิกษุสามเณร ',14=>'ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ '
							 ,15=>'สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์ หรือผู้ช่วย ผู้ที่ทำงานในห้องปฎิบัติการโรคพิษสุนัขบ้า',16=>'อาสาสมัครฉีดวัคซีนสุนัข'
							 ,17=>'เจ้าหน้าที่สวนสัตว์',18=>'ไปรษณีย์',19=>'ป่าไม้',20=>'พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า ',21=>'อื่นๆ'); ?>
		<?php  for($i=1;$i<22;$i++):?>			
		<tr class="para1">
			<td style="padding-left:10px;"><? echo $occupationname[$i];?></td>
			<td><?php echo number_format(${'total_occupationname'.$i}); ?></td>
			<td><?php echo compute_percent(${'total_occupationname'.$i},$total_n); ?></td>
		</tr>
		<?php endfor; ?>
		<tr><td colspan="3"><strong>อาชีพผู้ปกครอง</strong></td></tr>		
		<?php $name=array(1=>"เกษตร ทำนา ทำสวน",2=>"ข้าราชการ",3=>"กรรมกร",4=>"รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)"
		,5=>"ค้าขาย",6=>"งานบ้าน",7=>"ทหาร ตำรวจ",8=>"ประมง",9=>"ครู",10=>"เลี้ยงสัตว์ / จับสุนัข",11=>"นักบวช / ภิกษุสามเณร"
		,12=>"ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ",13=>"สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า"
		,14=>"อาสาสมัครฉีดวัคซีนสุนัข",15=>"เจ้าหน้าที่สวนสัตว์",16=>"ไปรษณีย์",17=>"ป่าไม้",18=>"พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า",19=>"อื่นๆ",20=>"ไม่ระบุ"); ?>	
		<?php  for($i=1;$i<21;$i++):?>
		<tr class="para1">
			<td style="padding-left:10px;"><? echo $name[$i];?></td>
			<td><?php echo number_format(${'total_occparentsname'.$i}); ?></td>
			<td><?php echo compute_percent(${'total_occparentsname'.$i},$total_n); ?></td>
		</tr>		
		<?php endfor; ?>
</table>		
<hr class="hr1">		
<div id="reference"><?php echo $reference?></div>			



