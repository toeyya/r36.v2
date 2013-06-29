<div id="title">ข้อมูลการสัมผัสโรค - รายเดือน</div>
<div id="search">
<?php if(empty($cond)): ?>
<form action="report/index/2" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
		<table class="tb_patient1">
			  <tr>
				<th>เขตความรับผิดชอบ</th>
				<td>
					<select name="area" class="styled-select widthselect"  id="area" onchange="ListGroupByArea();">
						<option value="-">กรุณาเลือกเขต</option>
						<option value="1">รูปแบบเดิม (12 เขต)</option>
						<option value="2">รูปแบบใหม่ (19 เขต)</option>
					</select>
				</td>
				<th>เขตที่</th>
				<td>
				<span id="grouplist">
					<select name="group" class="styled-select widthselect" id="group">
						<option value="">ทั้งหมด</option>
					</select>
				</span></td>

				<th>จังหวัด</th>
				<td>
				<span id="provincelist">
					<select name="province" class="styled-select widthselect">
						<option value="">ทั้งหมด</option>
					</select>
				</span></td>
			  </tr>
		  <tr>
			<th>อำเภอ</th>
			<td><span id="amphurlist"><select name="amphur" class="styled-select"><option value="">ทั้งหมด</option></select></span></td>
			<th>ตำบล</th>
			<td><span id="districtlist"><select name="district" class="styled-select" id="district"><option value="">ทั้งหมด</option></select></span></td>
			<th>สถานบริการ</th>
			<td>
				<span id="hospitallist">
				<select name="hospital" class="styled-select widthselect">
					<option value="">ทั้งหมด</option>
				</select>
				</span>
			</td>
			</tr>
			<tr>
		    <th>ปี</th>
		    <td>
				<select name="year_start" class="styled-select">
				<option value="">ทั้งหมด</option>
				<?
				$syear = (date('Y')+543)-10;
				for($i=$syear;$i<=(date('Y')+543);$i++){
				?>
					<option value="<?=$i;?>"><?=$i;?></option>
				<?
				}
				?>
				</select>
			</td>
	      </tr>
	  </table>
  <div class="btn_inline">
      <ul>
      	<li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      
      </ul>
</div>	
</form>
<?php endif; ?>
</div>
<?php if(!empty($cond)): ?>
<div id="report">
		<div id="title">				  
		<p>รายงานผู้สัมผัสโรครายเดือน</p>
	    <p>เขตความรับผิดชอบ (<?php echo $textarea;?>) :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>โรงพยาบาล <?php echo $texthospital;?>  ปี  <?php echo $textyear;?>  เดือน  <?php echo $textmonth;?></p>				
		</div>
	
	<table class="tbreport" style="width:70%;margin-left:15%;margin-right:15%;">
		<thead>
			<tr><td colspan="14" style="text-align:right;">หน่วย:คน</td></tr>
			<tr>
				<th rowspan="2">ข้อมูล</th>
				<th colspan="14">เดือน (N = <? echo number_format($total_n) ?>)</th>
			</tr>		
			<tr>
				<th>ม.ค.</th>
				<th>ก.พ.</th>
				<th>มี.ค.</th>
				<th>เม.ย.</th>
				<th>พ.ค.</th>
				<th>มิ.ย.</th>
				<th>ก.ค.</th>
				<th>ส.ค.</th>
				<th>ก.ย.</th>
				<th>ต.ค.</th>
				<th>พ.ย.</th>
				<th>ธ.ค.</th>
				<th >รวม</th>
			</tr>
		</thead>
		<tbody>
		<tr class="para1">
			<td align="left"><strong>ผู้สัมผัสโรคพิษสุนัขบ้า</strong></td>
			<?php for($i=1;$i<13;$i++): ?>
				<td><? echo number_format(${'total_m'.$i}) ?></td>
			<?php endfor; ?>
			<td><? echo number_format($total_n); ?></td>	
		</tr>
		<tr ><td colspan="14"><strong>เพศ</strong></td></tr>
		<tr class="para1">
			<td class="pad-left">ชาย</td>			
			<td><?php echo number_format($total_gender11) ?> <p class="percentage"><?php echo compute_percent($total_gender11,$total_m1); ?></p></td>
			<td><?php echo number_format($total_gender12) ?> <p class="percentage"><?php echo compute_percent($total_gender12,$total_m2); ?></p></td>
			<td><?php echo number_format($total_gender13) ?> <p class="percentage"><?php echo compute_percent($total_gender13,$total_m3); ?></p></td>
			<td><?php echo number_format($total_gender14) ?> <p class="percentage"><?php echo compute_percent($total_gender14,$total_m4); ?></p></td>
			<td><?php echo number_format($total_gender15) ?> <p class="percentage"><?php echo compute_percent($total_gender15,$total_m5); ?></p></td>
			<td><?php echo number_format($total_gender16) ?> <p class="percentage"><?php echo compute_percent($total_gender16,$total_m6); ?></p></td>
			<td><?php echo number_format($total_gender17) ?> <p class="percentage"><?php echo compute_percent($total_gender17,$total_m7); ?></p></td>
			<td><?php echo number_format($total_gender18) ?> <p class="percentage"><?php echo compute_percent($total_gender18,$total_m8); ?></p></td>
			<td><?php echo number_format($total_gender19) ?> <p class="percentage"><?php echo compute_percent($total_gender19,$total_m9); ?></p></td>
			<td><?php echo number_format($total_gender110) ?> <p class="percentage"><?php echo compute_percent($total_gender110,$total_m10); ?></p></td>
			<td><?php echo number_format($total_gender111) ?> <p class="percentage"><?php echo compute_percent($total_gender111,$total_m11); ?></p></td>
			<td><?php echo number_format($total_gender112) ?> <p class="percentage"><?php echo compute_percent($total_gender112,$total_m12); ?></p></td>
			<td><?php echo number_format($total_gender_all1) ?> <p class="percentage"><?php echo compute_percent($total_gender_all1,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left">หญิง</td>
			<td><?php echo  number_format($total_gender21) ?> <p class="percentage"><?php echo compute_percent($total_gender21,$total_m1); ?></p></td>
			<td><?php echo  number_format($total_gender22) ?> <p class="percentage"><?php echo compute_percent($total_gender22,$total_m2); ?></p></td>
			<td><?php echo  number_format($total_gender23) ?> <p class="percentage"><?php echo compute_percent($total_gender23,$total_m3); ?></p></td>
			<td><?php echo  number_format($total_gender24) ?> <p class="percentage"><?php echo compute_percent($total_gender24,$total_m4); ?></p></td>
			<td><?php echo  number_format($total_gender25) ?> <p class="percentage"><?php echo compute_percent($total_gender25,$total_m5); ?></p></td>
			<td><?php echo  number_format($total_gender26) ?> <p class="percentage"><?php echo compute_percent($total_gender26,$total_m6); ?></p></td>
			<td><?php echo  number_format($total_gender27) ?> <p class="percentage"><?php echo compute_percent($total_gender27,$total_m7); ?></p></td>
			<td><?php echo  number_format($total_gender28) ?> <p class="percentage"><?php echo compute_percent($total_gender28,$total_m8); ?></p></td>
			<td><?php echo  number_format($total_gender29) ?> <p class="percentage"><?php echo compute_percent($total_gender29,$total_m9); ?></p></td>
			<td><?php echo  number_format($total_gender210) ?> <p class="percentage"><?php echo compute_percent($total_gender210,$total_m10); ?></p></td>
			<td><?php echo  number_format($total_gender211) ?> <p class="percentage"><?php echo compute_percent($total_gender211,$total_m11); ?></p></td>
			<td><?php echo  number_format($total_gender212) ?> <p class="percentage"><?php echo compute_percent($total_gender212,$total_m12); ?></p></td>
			<td><?php echo  number_format($total_gender_all2) ?> <p class="percentage"><?php echo compute_percent($total_gender_all2,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td><?php echo  number_format($total_gender01) ?> <p class="percentage"><?php echo compute_percent($total_gender01,$total_m1); ?></p></td>
			<td><?php echo  number_format($total_gender02) ?> <p class="percentage"><?php echo compute_percent($total_gender02,$total_m2); ?></p></td>
			<td><?php echo  number_format($total_gender03) ?> <p class="percentage"><?php echo compute_percent($total_gender03,$total_m3); ?></p></td>
			<td><?php echo  number_format($total_gender04) ?> <p class="percentage"><?php echo compute_percent($total_gender04,$total_m4); ?></p></td>
			<td><?php echo  number_format($total_gender05) ?> <p class="percentage"><?php echo compute_percent($total_gender05,$total_m5); ?></p></td>
			<td><?php echo  number_format($total_gender06) ?> <p class="percentage"><?php echo compute_percent($total_gender06,$total_m6); ?></p></td>
			<td><?php echo  number_format($total_gender07) ?> <p class="percentage"><?php echo compute_percent($total_gender07,$total_m7); ?></p></td>
			<td><?php echo  number_format($total_gender08) ?> <p class="percentage"><?php echo compute_percent($total_gender08,$total_m8); ?></p></td>
			<td><?php echo  number_format($total_gender09) ?> <p class="percentage"><?php echo compute_percent($total_gender09,$total_m9); ?></p></td>
			<td><?php echo  number_format($total_gender010) ?> <p class="percentage"><?php echo compute_percent($total_gender010,$total_m10); ?></p></td>
			<td><?php echo  number_format($total_gender011) ?> <p class="percentage"><?php echo compute_percent($total_gender011,$total_m11); ?></p></td>
			<td><?php echo  number_format($total_gender012) ?> <p class="percentage"><?php echo compute_percent($total_gender012,$total_m12); ?></p></td>
			<td><?php echo  number_format($total_gender_all0) ?> <p class="percentage"><?php echo compute_percent($total_gender_all0,$total_n); ?></p></td>
		</tr>
		<tr ><td colspan="14"><strong>กลุ่มอายุ</strong></td></tr>
		<?php $age=array(1=>'ต่ำกว่า 1 ปี',2=>'1-5 ปี',3=>'6-10 ปี',4=>'11-15 ปี',5=>'16-25 ปี'
						,6=>'26-35 ปี',7=>'36-45 ปี',8=>'46-55 ปี',9=>'56-65 ปี',10=>'66 ปีขึ้นไป',11=>'ไม่ระบุ'); ?>
		<?php  for($i=1;$i<12;$i++):?>			
		<tr class="para1">
			<td class="pad-left"><? echo $age[$i];?></td>
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_age'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_age'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_age_all'.$i});?><p class="percentage"><?php echo compute_percent(${'total_age_all'.$i},$total_n); ?></p></td>
		</tr>
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_age11'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_age11'.$j},$total_m11); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_age_all11); ?><p class="percentage"><?php echo compute_percent($total_age_all11,$total_n); ?></p></td>
			
		</tr>
		
						
		<tr ><td colspan="14"><strong>สถานที่สัมผัสโรค</strong></td></tr>
		<?php $place= array(1=>'เขต กทม.',2=>'เขตเมืองพัทยา',3=>'เขตเทศบาล',4=>'เขต อบต.',5=>'ไม่ระบุ'); ?>	
		<?php for($i=1;$i<6;$i++): ?>
		<tr class="para1">			
			<td class="pad-left"><?php echo $place[$i]; //if($i==5)$i=0;?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_place'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_place'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_place_all'.$i});?><p class="percentage"><?php echo compute_percent(${'total_place_all'.$i},$total_n); ?></p></td>
		<?php endfor; ?>
		</tr>
			
		<tr><td colspan="14"><strong>ชนิดสัตว์นำโรค</strong></td></tr>
	<?php $animal = array(1=>'สุนัข',2=>'แมว',3=>'ลิง',4=>'ชะนี',5=>'หนู',6=>'อื่นๆ',7=>'ไม่ระบุ'); ?>	
		<?php for($i=1;$i<8;$i++): ?>
		<tr class="para1">			
			<td class="pad-left"><?php echo $animal[$i]; //if($i==7)$i=0;?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_animal'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_animal'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_animal_all'.$i});?><p class="percentage"><?php echo compute_percent(${'total_animal_all'.$i},$total_n); ?></p></td>
		<?php endfor; ?>
		</tr>


		<tr ><td colspan="14"><strong>อายุสัตว์</strong></td></tr>	
		<?php $ageanimal = array(1=>'น้อยกว่า 3 เดือน',2=>'3-6 เดือน',3=>'6-12 เดือน',4=>'มากกว่า 1 ปี',5=>'ไม่ทราบ',6=>'ไม่ระบุ');  ?>
		<?php for($i=1;$i<7;$i++):?>
		<tr class="para1">			
			<td class="pad-left"><?php echo $ageanimal[$i];  //if($i==6)$i=0;?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_ageanimal'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_ageanimal'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_ageanimal_all'.$i})?><p class="percentage"><?php echo compute_percent(${'total_ageanimal_all'.$i},$total_n); ?></p></td>
		<?php endfor; ?>
		</tr>		
		
	<tr class="page-break"><td colspan="14"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong></td></tr>	
		<?php 
		$array[0][0] = "ไม่ระบุ";	
		$array[1][1] = "ตายเองภายใน 10 วัน";
		$array[1][2] = "ไม่ตายภายใน 10 วัน";
		$array[2][0] = "กักขังไม่ได้";
		$array[3][0] = "ถูกฆ่าตาย";
		$array[4][0] = "หนีหาย / จำไม่ได้";
		?>
		<tr class="para1">
			<td class="pad-left">กักขังได้ / ติดตามได้</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all10); ?> <p class="percentage"><?php echo compute_percent($total_detain_all10,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left2">ตายภายใน 10 วัน</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain11'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain11'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all11); ?> <p class="percentage"><?php echo compute_percent($total_detain_all11,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain12'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain12'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all12); ?> <p class="percentage"><?php echo compute_percent($total_detain_all12,$total_n); ?></p></td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">กักขังไม่ได้</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all20); ?> <p class="percentage"><?php echo compute_percent($total_detain_all20,$total_n); ?></p></td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ถูกฆ่าตาย</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain30'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain30'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all30); ?> <p class="percentage"><?php echo compute_percent($total_detain_all30,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">หนีหาย / จำไม่ได้</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain40'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain40'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all40); ?> <p class="percentage"><?php echo compute_percent($total_detain_all40,$total_n); ?></p></td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all00); ?> <p class="percentage"><?php echo compute_percent($total_detain_all00,$total_n); ?></p></td>
		</tr>
	<tr><td colspan="14"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ทราบ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all10); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all10,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่เคยฉีด</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all20); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all20,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">เคยฉีด 1 ครั้ง</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog30'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog30'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all30); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all30,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left" colspan="14">เคยฉีด 1 ครั้งสุดท้าย</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left2">ภายใน 1 ปี</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog41'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog41'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all41); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all41,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left2">เกิน 1 ปี</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog42'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog42'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all42); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all42,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog40'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog40'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all40); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all40,$total_n); ?></p></td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all00); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all00,$total_n); ?></p></td>

		</tr>	
	<tr><td colspan="14"><strong>สาเหตุที่ถูกกัด</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">ถูกกัดโดยไม่มีสาเหตุโน้มนำ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_reason10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_reason_all10); ?> <p class="percentage"><?php echo compute_percent($total_reason_all10,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left" colspan="14">ถูกกัดโดยมีสาเหตุโน้มนำ</td>
			<?php $reason = array(1=>'ทำให้สัตว์เจ็บปวด โมโห หรือตกใจ',2=>'พยายามแยกสัตว์ที่กำลังต่อสู้กัน',3=>'เข้าใกล้สัตว์แม่ลูกอ่อน',4=>'รบกวนสัตว์ขณะกินอาหาร',5=>'เข้าไปในบริเวณที่สัตว์คิดว่าเป็นเจ้าของ',6=>'อื่นๆ'); ?>				
		</tr>		
		<?php for($i=1;$i<7;$i++): ?>
		<tr class="para1">
			<td class="pad-left2"><?php echo $reason[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_reason2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason2'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_reason_all2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason_all2'.$i},$total_n); ?></p></td>
		</tr>
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_reason20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_reason_all20); ?> <p class="percentage"><?php echo compute_percent($total_reason_all20,$total_n); ?></p></td>
		</tr>		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_reason00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_reason_all00); ?> <p class="percentage"><?php echo compute_percent($total_reason_all00,$total_n); ?></p></td>
		</tr>	
	<tr><td colspan="14"><strong>การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ได้ล้าง</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_wash10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_wash_all10); ?> <p class="percentage"><?php echo compute_percent($total_wash_all10,$total_n); ?></p></td>

		</tr>				
		<tr class="para1">
			<td class="pad-left" colspan="14">ล้าง</td>	
			<?php $wash = array(1=>'น้ำ',2=>'น้ำและสบู่ / ผงซักฟอก',3=>'อื่นๆ'); ?>							
		</tr>
		<?php for($i=1;$i<4;$i++): ?>
		<tr class="para1">
			<td class="pad-left2"><?php echo $wash[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_wash2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash2'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_wash_all2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash_all2'.$i},$total_n); ?></p></td>
		</tr>	
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_wash20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_wash_all20); ?> <p class="percentage"><?php echo compute_percent($total_wash_all20,$total_n); ?></p></td>

		</tr>		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_wash00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_wash_all00); ?> <p class="percentage"><?php echo compute_percent($total_wash_all00,$total_n); ?></p></td>

		</tr>		

	<tr><td colspan="14"><strong>การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ได้ใส่ยา</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_drug10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_drug_all10); ?> <p class="percentage"><?php echo compute_percent($total_drug_all10,$total_n); ?></p></td>

		</tr>	
		<tr class="para1"><td class="pad-left" colspan="14">ใส่ยา</td>	</tr>
		<?php $drug = array(1=>'สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์ฯ',2=>'ทิงเจอร์ไอโอดีนแอลกอฮอล์ฯ',3=>'อื่นๆ'); ?>
		<?php for($i=1;$i<4;$i++): ?>
		<tr class="para1">
			<td class="pad-left2"><?php echo $drug[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_drug2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug2'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_drug_all2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug_all2'.$i},$total_n); ?></p></td>
		</tr>	
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_drug20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_drug_all20); ?> <p class="percentage"><?php echo compute_percent($total_drug_all20,$total_n); ?></p></td>

		</tr>		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_drug00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_drug_all00); ?> <p class="percentage"><?php echo compute_percent($total_drug_all00,$total_n); ?></p></td>

		</tr>	
	<tr><td colspan="14"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัส</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_historyprotect10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_historyprotect_all10); ?> <p class="percentage"><?php echo compute_percent($total_historyprotect_all10,$total_n); ?></p></td>

		</tr>	
		<tr class="para1"><td class="pad-left" colspan="14">ใส่ยา</td>	</tr>
		<?php $historyprotect = array(1=>'ภายใน 6 เดือน',2=>'เกิน 6 เดือน',3=>'อื่นๆ'); ?>
		<?php for($i=1;$i<4;$i++): ?>
		<tr class="para1">
			<td class="pad-left2"><?php echo $historyprotect[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_historyprotect2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect2'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_historyprotect_all2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect_all2'.$i},$total_n); ?></p></td>
		</tr>	
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_historyprotect20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_historyprotect_all20); ?> <p class="percentage"><?php echo compute_percent($total_historyprotect_all20,$total_n); ?></p></td>

		</tr>		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_historyprotect00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_drug_all00); ?> <p class="percentage"><?php echo compute_percent($total_drug_all00,$total_n); ?></p></td>

		</tr>
		</tbody>																							
	</table>
	
		<hr class="hr1">
		<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>			
		<div id="btn_printout"><a href="report/index/2/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>
<?php endif; ?>