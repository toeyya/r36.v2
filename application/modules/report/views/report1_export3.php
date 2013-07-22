<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">					  
	<span>รายงานผู้สัมผัสโรคในภาพรวม</span><br/>
	<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span></br>
	<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
	<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></span>				
</div>

<h3>ส่วนที่ 3 : สัตว์นำโรค </h3>
<h6>ตารางที่ 3 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้าแจกแจงตามชนิดและประวัติของสัตว์นำโรค </h6>
<table class="tbreport" border="1" width="864">
	<tr>
		<th>ชนิดและประวัติของสัตว์</th>
		<th>จำนวน (N=<?php echo $total_n; ?>)</th>
		<th>ร้อยละ</th>
	</tr>
	<tr ><td colspan="3"><strong>ชนิดสัตว์</strong></td></tr>
	<?php $animal = array(1=>'สุนัข',2=>'แมว',3=>'ลิง',4=>'ชะนี',5=>'หนู'); $j=0;?>	
	<?php for($i=1;$i<6;$i++): ?>
	<tr class="para1">
		<td style="padding-left:10px;"><?php echo $animal[$i]; ?></td>
		<td><?php echo number_format(${'total_animal'.$i.$j}); ?></td>
		<td><?php echo compute_percent(${'total_animal'.$i.$j},$total_n); ?></td>		
	</tr>
	<? endfor; ?>
	<tr class="para1">
		<td style="padding-left:10px;" colspan="3">อื่นๆ</td>
	</tr>
	<? $typeother = array(1=>'คน',2=>'วัว',3=>'กระบือ',4=>'สุกร',5=>'แพะ',6=>'แกะ',7=>'ม้า',8=>'กระรอก'
						 ,9=>'กระแต',10=>'พังพอน',11=>'กระต่าย',12=>'สัตว์ป่า (เช่น ค้างคาว ฯลฯ)',13=>'ไม่ทราบ'); ?>	
	<?php for($i=1;$i<14;$i++): ?>
	<tr class="para1">
		<td class="pad-left2"><? echo $typeother[$i] ?></td>
		<td><?php echo number_format(${'total_animal6'.$i}); ?></td>
		<td><?php echo compute_percent(${'total_animal6'.$i},$total_n); ?></td>		
	</tr>
	<?php endfor; ?>
	<tr><td colspan="3"><strong>อายุสัตว์</strong></td></tr>
	<?php $ageanimal = array(1=>'น้อยกว่า 3 เดือน',2=>'3-6 เดือน',3=>'6-12 เดือน',4=>'มากกว่า 1 ปี',5=>'ไม่ทราบ',6=>'ไม่ระบุ');  ?>
	<?php for($i=1;$i<7;$i++):?>
	<tr class="para1">			
		<td style="padding-left:10px;"><?php echo $ageanimal[$i];  //if($i==6)$i=0;?></td>						
		<td><?php echo number_format(${'total_ageanimal'.$i}); ?> </td>					
		<td><?php echo compute_percent(${'total_ageanimal'.$i},$total_n)?></td>
	<?php endfor; ?>
	</tr>
	<tr><td colspan="3"><strong>สถานภาพสัตว์</strong></td></tr>	
	<?php $statusanimal = array(1=>'มีเจ้าของ',2=>'ไม่มีเจ้าของ',3=>'ไม่ทราบ'); ?>
	<? for($i=1;$i<4;$i++): ?>
	<tr class="para1">
		<td style="padding-left:10px;"><? echo $statusanimal[$i] ?></td>
		<td><?php echo number_format(${'total_statusanimal'.$i}); ?></td>
		<td><?php echo compute_percent(${'total_statusanimal'.$i},$total_n); ?></td>		
	</tr>
	<? endfor; ?>	
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>
		<td><?php echo number_format($total_statusanimal0); ?></td>
		<td><?php echo compute_percent($total_statusanimal0,$total_n); ?></td>				
	</tr>
	<tr><td colspan="3"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong>				</td></tr>	
	<tr class="para1">
		<td style="padding-left:10px;" colspan="3">กักขังได้ / ติดตามได้</td>	
	</tr>
	<tr class="para1">
		<td class="pad-left2">ตายภายใน 10 วัน</td>	
		<td><?php echo number_format($total_detain11); ?></td>
		<td><?php echo compute_percent($total_detain11,$total_n); ?></td>
	</tr>
	<tr class="para1">
		<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
		<td><?php echo number_format($total_detain12); ?></td>
		<td><?php echo compute_percent($total_detain12,$total_n); ?></td>
	</tr>	
	<tr class="para1">
		<td style="padding-left:10px;">กักขังไม่ได้</td>	
		<td><?php echo number_format($total_detain20); ?></td>
		<td><?php echo compute_percent($total_detain20,$total_n); ?></td>

	</tr>	
	<tr class="para1">
		<td style="padding-left:10px;">ถูกฆ่าตาย</td>	
		<td><?php echo number_format($total_detain30); ?></td>
		<td><?php echo compute_percent($total_detain30,$total_n); ?></td>

	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">หนีหาย / จำไม่ได้</td>	
		<td><?php echo number_format($total_detain40); ?></td>
		<td><?php echo compute_percent($total_detain40,$total_n); ?></td>

	</tr>	
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>	
		<td><?php echo number_format($total_detain00); ?></td>
		<td><?php echo compute_percent($total_detain00,$total_n); ?></td>
	</tr>	
	<tr><td colspan="3"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า</strong>				
	</td></tr>	
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ทราบ</td>						
		<td><?php echo number_format($total_vaccinedog10); ?></td>					
		<td><?php echo compute_percent($total_vaccinedog10,$total_n); ?></td>

	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">ไม่เคยฉีด</td>	
		<td><?php echo number_format($total_vaccinedog20); ?></td>
		<td><?php echo compute_percent($total_vaccinedog20,$total_n); ?></td>

	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">เคยฉีด 1 ครั้ง</td>	
		<td><?php echo number_format($total_vaccinedog30); ?></td>
		<td><?php echo compute_percent($total_vaccinedog30,$total_n); ?></td>		
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">เคยฉีด 1 ครั้งสุดท้าย</td>
		<td><?php echo number_format($total_vaccinedog41+$total_vaccinedog42); ?></td>
		<td><?php echo compute_percent($total_vaccinedog41+$total_vaccinedog42,$total_n); ?></td>			
	</tr>								
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>	
		<td><?php echo number_format($total_vaccinedog00); ?></td>
		<td><?php echo compute_percent($total_vaccinedog00,$total_n); ?></td>		
	</tr>
</table>
<hr class="hr1">		
<div id="reference"><?php echo $reference?></div>	