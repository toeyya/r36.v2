<div id="title">ข้อมูลการสัมผัสโรค - รายไตรมาส</div>
<div id="search">
<form action="report/index/3" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
<table class="tb_patient1">
<?php require 'include/conditionreport.php'; ?>
<tr><th>ปีที่สัมผัสโรค</th>
	 <td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>
</tr>
</table>
<div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul>
</div>	
</form>
</div>
<div id="report">
	<?php if($cond): ?>
		<div id="title">				  
		<p>รายงานผู้สัมผัสโรครายไตรมาส</p>
	    <p>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></p>				
	</div>
	<table class="tbreport">
		<thead>
		<tr><td colspan="6" style="text-align:right;">หน่วย:คน</td></tr>
		<tr>
			<th rowspan="2">ข้อมูล</th>
			<th colspan="5">ไตรมาส (N=<?php echo number_format($total_n); ?>)</th>
		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th >รวม</th>
		</tr>
		</thead>
		<tbody>
		<tr class="para1">
			<td align="left"><strong>ผู้สัมผัสโรคพิษสุนัขบ้า</strong></td>
			<td><? echo number_format($q1) ?></td>
			<td><? echo number_format($q2) ?></td>
			<td><? echo number_format($q3) ?></td>
			<td><? echo number_format($q4) ?></td>
			<td><? echo number_format($total_n); ?></td>
		</tr>
		<? foreach($module as $field =>$name): ?>
			<tr ><td colspan="6"><strong><? echo $name; ?></strong></td></tr>
			<? foreach(${$field} as $key =>$i): ?>
			<tr class="para1">
				<td class="pad-left"><? echo $i ?></td>		
				<? for($j=1;$j<5;$j++): ?>
					<td><? echo number_format(${$field.$key.$j}) ?><p class="percentage">(<?php echo compute_percent(${$field.$key.$j},${$field.$key}); ?>)</p></td>
				<? endfor; ?>
				<td><? echo number_format(${$field.$key}); ?></td>
			</tr>
			<? endforeach; ?>
		<? endforeach; ?>		
	<tr><td colspan="6"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left" colspan="6">กักขังได้ / ติดตามได้</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">กักขังได้ / ติดตามได้</td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_detain10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all10); ?> <p class="percentage"><?php echo compute_percent($total_detain_all10,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left2">ตายภายใน 10 วัน</td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_detain11'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain11'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all11); ?> <p class="percentage"><?php echo compute_percent($total_detain_all11,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_detain12'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain12'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all12); ?> <p class="percentage"><?php echo compute_percent($total_detain_all12,$total_n); ?></p></td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">กักขังไม่ได้</td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_detain20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all20); ?> <p class="percentage"><?php echo compute_percent($total_detain_all20,$total_n); ?></p></td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ถูกฆ่าตาย</td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_detain30'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain30'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all30); ?> <p class="percentage"><?php echo compute_percent($total_detain_all30,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">หนีหาย / จำไม่ได้</td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_detain40'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain40'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all40); ?> <p class="percentage"><?php echo compute_percent($total_detain_all40,$total_n); ?></p></td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_detain00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all00); ?> <p class="percentage"><?php echo compute_percent($total_detain_all00,$total_n); ?></p></td>
		</tr>
		</tbody>				
	</table>
			<hr class="hr1">
		<div id="reference"><?php echo $reference?></div>			
		<div id="btn_printout"><a href="report/index/3<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
	<?php endif; ?>
</div>
