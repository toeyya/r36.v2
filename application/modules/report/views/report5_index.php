<script type="text/javascript">
$(document).ready(function(){
	$('input[type=submit]').click(function(){
		if($('#area option:selected').val()==""){
			alert("กรุณาเลือกรูปแบบเขตความรับผิดชอบในการออกรายงาน");
		}
	})
})
	
</script>
<div id="title">ข้อมูลการฉีดวัคซีน</div>
<div id="search">
<?php if(empty($cond)): ?>
<form action="report/index/5" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
	  <tr>
		<th>เขตความรับผิดชอบ</th>
		<td>
			<select name="area" id="area" class="styled-select" >
				<option value="-">กรุณาเลือกเขต</option>
				<option value="1" <?php echo (@$_GET['area']=="1")? "selected='selected":''; ?>>รูปแบบเดิม (12 เขต)</option>
				<option value="2" <?php echo (@$_GET['area']=="2")? "selected='selected":''; ?>>รูปแบบใหม่ (19 เขต)</option>
			</select>
		 </td>
		<th>เขตที่</th>
		<td>
			<?php if(empty($_GET['gorup'])): ?>
			<span id="grouplist">
			<select name="group" class="styled-select" id="group"><option value="">ทั้งหมด</option></select>
			</span>
			<?php else: ?>
				
		    <?php endif; ?>
			</td>
		<th>จังหวัด</th>
		<td><span id="provincelist"><select name="province" class="styled-select" id="prvince"><option value="">ทั้งหมด</option></select></span></td>			
	  </tr>
	  <tr>
		<th>อำเภอ</th>
		<td><span id="amphurlist"><select name="amphur" class="styled-select"><option value="">ทั้งหมด</option></select></span></td>
		<th>ตำบล</th>
		<td><span id="districtlist"><select name="district" class="styled-select" id="district"><option value="">ทั้งหมด</option></select></span></td>
		<th>สถานบริการ</td>
		<td><span id="hospitallist"><select name="hospital" class="styled-select" id="hospital"><option value="">ทั้งหมด</option></select></span></td>			
	  </tr>
	  <tr>
	    <th>ปีของวันที่สัมผัสโรค</th>
	    <td><select name="year" class="styled-select"><option value="">ทั้งหมด</option>
			<? $syear = (date('Y')+543)-10;
			for($i=$syear;$i<=(date('Y')+543);$i++){?><option value="<?php echo $i;?>"><?php echo $i;?></option>
			<?}?></select>
		</td>
		<th>เดือนของวันที่สัมผัสโรค</th>
	    <td><select name="month_start" class="styled-select"><option value="">ทั้งหมด</option>
			<? for($i=1;$i<=12;$i++){?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
			<? }?>
			</select> - <select name="month_end" class="styled-select">
			<option value="">ทั้งหมด</option>
			<? for($i=1;$i<=12;$i++){?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
			<? }?></select>			
		</td>
	 </tr>
	 <tr>
	  <th>ปีของวันที่บันทึกรายการ</th>
	    <td><select name="year_report" class="styled-select"><option value="">ทั้งหมด</option>
			<? $syear = (date('Y')+543)-10;
			for($i=$syear;$i<=(date('Y')+543);$i++){?><option value="<?php echo $i;?>"><?php echo $i;?></option>
			<? }?>
			</select>
		</td>		
		<th>เดือนของวันที่บันทึกรายการ</th>
    	<td>
		<select name="month_report_start" class="styled-select">
		<option value="">ทั้งหมด</option>
		<? for($i=1;$i<=12;$i++){ ?>
			<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
		<? }?>
		</select> - <select name="month_report_end" class="styled-select">
		<option value="">ทั้งหมด</option>
		<?for($i=1;$i<=12;$i++){?>
			<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
		<?}?>
		</select></td>
	  </tr>
</table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul></div>	
</form>
<?php endif; ?>
</div>
<? if(!empty($cond)): ?>
<div id="report">
	<div id="title"><p>รายงานการฉีดวัคซีน</p>
	<p>เขตความรับผิดชอบ (<?php echo $textarea; ?> เขต) : เขต <?php echo $textarea ?> จังหวัด <?php echo $textprovince ?>  อำเภอ <?php echo $textamphur ?>  ตำบล <?php echo $textdistrict ?></p>
	<p>สถานบริการ <?php echo $texthospital ?> <span>ปี <?php echo $textyear ?></span> เดือน ทั้งหมด ถึง ทั้งหมด </p>
 </div>
	<table class="tbreport" style="width:70%;margin-left:15%;margin-right:15%;">
		<tr><td colspan="2" style="text-align:right;">หน่วย:คน</td></tr>
		<tr>
			<th style="text-align:center">เงื่อนไข</th><th style="text-align:left">จำนวน (N=0)</th>
		</tr>
		<tr>
			<td>1. ผู้สัมผัสโรคพิษสุนัขบ้าที่<strong>ไม่เคยฉีดวัคซีน หรือเคยฉีดน้อยกว่า 3 เข็ม</strong></td>
			<td><strong><?php echo $total; ?></strong></td>			
		</tr>	
		<tr>
			<td>2. ผู้สัมผัสโรค<strong>มีประวัติเคยฉีดวัคซีน</strong>ป้องกันโรคพิษสุนัขบ้า<strong>ภายใน 6 เดือน</strong>ได้รับการฉีดวัคซีน</td>
			<td></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 1 เข็ม</span></td>
			<td><?php echo number_format($v6) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 2 เข็ม</span></td>
			<td><?php echo number_format($v7) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 3 เข็ม</span></td>
			<td><?php echo number_format($v8) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 4 เข็ม</span></td>
			<td><?php echo number_format($v9) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 5 เข็ม</span></td>
			<td><?php echo number_format($v10) ?></td>
		</tr>
		<tr>
			<td style="text-align:center"><strong>รวม</strong></td>
			<td ><strong><?php echo number_format($total2) ?></strong></td>
		</tr>
		<tr>
			<td><strong>3.ผู้สัมผัสโรค<strong>มีประวัติเคยฉีดวัคซีน</strong>ป้องกันโรคพิษสุนัขบ้า<strong>เกิน 6 เดือน</strong> ได้รับการฉีดวัคซีน</strong></td>
			<td></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 1 เข็ม</span></td>
			<td><?php echo number_format($v11) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 2 เข็ม</span></td>
			<td><?php echo number_format($v12) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 3 เข็ม</span></td>
			<td><?php echo number_format($v13) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 4 เข็ม</span></td>
			<td><?php echo number_format($v14) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 5 เข็ม</span></td>
			<td><?php echo number_format($v15) ?></td>
		</tr>
		<tr>
			<td style="text-align:center"><strong>รวม</strong></td>
			<td ><strong><?php echo number_format($total3) ?></strong></td>
		</tr>
		<tr>
			<td><strong>4. ผู้สัมผัสที่ถูกสุนัขหรือแมวกัดแล้วสัตว์<strong>ไม่ตายภายใน 10 วัน</strong> โดยผู้สงสัยว่าสัมผัสโรค ได้รับการฉีดวัคซีนครั้งนี้</strong></td>
			<td></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 1 เข็ม</span></td>
			<td><?php echo number_format($v16) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 2 เข็ม</span></td>
			<td><?php echo number_format($v17) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 3 เข็ม</span></td>
			<td><?php echo number_format($v18) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 4 เข็ม</span></td>
			<td><?php echo number_format($v19) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน 5 เข็ม</span></td>
			<td><?php echo number_format($v20) ?></td>
		</tr>
		<tr>
			<td style="text-align:center"><strong>รวม</strong></td>
			<td ><strong><?php echo number_format($total4) ?></strong></td>
		</tr>
		<tr>
			<td>5. ผู้สัมผัสโรคพิษสุนัขบ้า<strong>ฉีดวัคซีนไม่ครบเนื่องจากไม่สามารถติดตามได้หรือไม่ประสงค์จะฉีดต่อ</strong></td>
			<td><strong><?php echo number_format($total5) ?></strong></td>
		</tr>
		<tr>
			<td><strong>6. ชนิดของวัคซีน (โด๊ส)</strong></td>
			<td></td>
		</tr>
			<tr>
			<td><span class="para1">- PVRV</span></td>
			<td><? echo number_format($v21); ?></td>
		</tr>
				<tr>
			<td><span class="para1">- PCEC</span></td>
			<td><? echo number_format($v22); ?></td>
		</tr>
				<tr>
			<td><span class="para1">- HDCV</span></td>
			<td><? echo number_format($v23); ?></td>
		</tr>
				<tr>
			<td><span class="para1">- PDEV</span></td>
			<td><? echo number_format($v24); ?></td>
		</tr>		
		<tr>
			<td style="text-align:center"><strong>รวม</strong></td>
			<td ><strong><? echo number_format($total6); ?></strong></td>
		</tr>
	</table>
	<hr class="hr1">
	<div id="description">
		<p class="heading">หลักเกณฑ์การให้บริการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าที่ถูกต้อง</p>
		<ul>
			<li><strong>ผู้สัมผัสโรคพิษสุนัขบ้าที่ไม่เคยได้รับการฉีดวัคซีนฯ มาก่อน</strong> เมื่อได้รับเชื้อ (สัตว์ที่สัมผัสเป็นโรคพิษสุนัขบ้าและลักษณะที่สัมผัสเสี่ยงต่อการได้รับเชื้อ) 
				ต้องได้รับการฉีดวัคซีนครบชุด (ID 4 เข็ม, IM 5 เข็ม) กรณีที่สัตว์ที่สัมผัสเป็นสุนัขหรือแมวที่ไม่แน่ใจว่าเป็นโรคพิษสุนัขบ้าหรือไม่และสามารถติดตามดูอาการได้ 
				ถ้าสุนัขหรือแมวมีอาการปกติไม่ตายภายหลังการสัมผัส 10 วัน 
				ให้หยุดฉีดวัคซีนฯ ได้</li>
		  <li>
		  	<strong>ผู้สัมผัสที่เคยได้รับการฉีดวัคซีนที่มีคุณภาพมาแล้ว</strong>ตั้งแต่ 3 เข็มขึ้นไป ถ้าได้รับวัคซีนเข็มสุดท้ายไม่เกิน 6 เดือนต้องได้รับการฉีดวัคซีนฯ 
			กระตุ้น อีก 1 เข็ม แต่ถ้าได้รับวัคซีนเข็มสุดท้ายเกิน 6 เดือนต้องได้รับการฉีดวัคซีนกระตุ้นอีก 2 เข็ม
		  </li>
		  <li>
		  	 กรณีที่สัตว์สัมผัสเป็นสุนัขหรือแมวหลังจากเฝ้าดูอาการแล้ว 10 วัน หลังจากถูกกัด ยังมีอาการปกติให้ถือว่าสุนัขหรือแมวนั้นไม่มีเชื้อในขณะที่ถูกกัด จึงให้หยุดฉีดวัคซีนได้
		  </li>		  		  	
		</ul>
		<div><strong>(ผู้สัมผัสที่ได้รับวัคซีนที่มีคุณภาพมาแล้วน้อยกว่า 3 เข็ม หรือได้รับวัคซีนป้องกันโรคพิษสุนัขบ้าชนิดที่ผลิตจากสมองสัตว์  ให้ปฎิบัติเหมือนผู้ที่ไม่เคยได้รับการฉีดวัคซีนมาก่อน)</strong></div>
	</div>

	<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	
		<div id="btn_printout"><a href="report/index/5/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>
<?php endif; ?>