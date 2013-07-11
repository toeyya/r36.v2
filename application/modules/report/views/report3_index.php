<div id="title">ข้อมูลการสัมผัสโรค - รายไตรมาส</div>
<div id="search">
<form action="report/index/3" method="post" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
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
			<th colspan="5">ไตรมาส (N=70,305)</th>
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
			<td>34,335</td>
			<td>15,437</td>
			<td>4,023</td>
			<td>15,623</td>
			<td>69,418</td>
		</tr>
		<tr ><td colspan="6"><strong>เพศ</strong></td></tr>
		<tr class="para1">
			<td class="pad-left">ชาย</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">หญิง</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr ><td colspan="6"><strong>กลุ่มอายุ</strong></td></tr>
		<tr class="para1">
			<td class="pad-left">ต่ำกว่า 1 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>												
		</tr>
		<tr class="para1">
			<td class="pad-left">1-5 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">6-10 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">11-15 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">16-25 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">26-35 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>	
		<tr class="para1">
			<td class="pad-left">36-45 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>	
		<tr class="para1">
			<td class="pad-left">46-55 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>	
		<tr class="para1">
			<td class="pad-left">56-65 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>	
		<tr class="para1">
			<td class="pad-left">66 ปีขึ้นไป</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>
		<tr ><td colspan="6"><strong>สถานที่สัมผัสโรค</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">เขต กทม.</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">เขตเมืองพัทยา</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">เขตเทศบาล</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">เขต อบต.</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
		</tr>	
		<tr ><td colspan="6"><strong>ชนิดสัตว์นำโรค</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">สุนัข</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr class="para1">
			<td class="pad-left">แมว</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr class="para1">
			<td class="pad-left">ลิง</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>	
		<tr class="para1">
			<td class="pad-left">ชะนี</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		


		</tr>	
		<tr class="para1">
			<td class="pad-left">หนู</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr class="para1">
			<td class="pad-left">อื่นๆ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr ><td colspan="6"><strong>อายุสัตว์</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">น้อยกว่า 3 เดือน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr class="para1">
			<td class="pad-left">3-6 เดือน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		


		</tr>
		<tr class="para1">
			<td class="pad-left">6-12 เดือน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>	
		<tr class="para1">
			<td class="pad-left">มากกว่า 1 ปี</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ทราบ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>

	<tr><td colspan="6"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">กักขังได้ / ติดตามได้</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr class="para1">
			<td class="pad-left2">ตายภายใน 10 วัน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr class="para1">
			<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>	
		<tr class="para1">
			<td class="pad-left">กักขังไม่ได้</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>	
		<tr class="para1">
			<td class="pad-left">ถูกฆ่าตาย</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>
		<tr class="para1">
			<td class="pad-left">หนีหาย / จำไม่ได้</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>				
			
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
