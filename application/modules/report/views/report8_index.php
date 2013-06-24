<div id="title">ข้อมูลการฉีดวัคซีนและอิมมูโนโกลบุลิน </div>
<div id="search">
<form action="report/index/8" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
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
			<span id="grouplist">
				<select name="group" class="styled-select" id="group"><option value="">ทั้งหมด</option></select>
			</span>
			</td>
			<th>จังหวัด</th>
			<td>
			<span id="provincelist">
				<select name="province" class="styled-select" id="prvince"><option value="">ทั้งหมด</option></select>
			</span>
			</td>			
	  </tr>
	  <tr>
		<th>อำเภอ</th>
		<td>
			<span id="amphurlist">
				<select name="amphur" class="styled-select"><option value="">ทั้งหมด</option></select>
			</span></td>
		<th>ตำบล</th>
			<td>
				<span id="districtlist">
					<select name="district" class="styled-select" id="district"><option value="">ทั้งหมด</option></select>
				</span>	
			</td>
			<th>สถานบริการ</td>
			<td>
				<span id="hospitallist">
				<select name="hospital" class="styled-select" id="hospital"><option value="">ทั้งหมด</option></select>
				</span></td>			
	  </tr>
	  
	 	  <tr>
	    <th>ตั้งแต่เดือน ปี(วันที่สัมผัสโรค)</th>
	    <td>
	    	<select name="month" class="styled-select">
			<option value="">ทั้งหมด</option>
			<?
			for($i=1;$i<=12;$i++){
			?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
			<?
			}
			?>
			</select>-
			<select name="year" class="styled-select">
				<option value="">ทั้งหมด</option>
				<?
				$syear = (date('Y')+543)-10;
				for($i=$syear;$i<=(date('Y')+543);$i++){
				?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?
				}
				?>
			</select>	
		</td>
			<th>ถึง เดือน ปี (วันที่สัมผัสโรค)</th>
	    	<td>
	    	<select name="month" class="styled-select">
			<option value="">ทั้งหมด</option>
			<?
			for($i=1;$i<=12;$i++){
			?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
			<?
			}
			?>
			</select>-
			<select name="year" class="styled-select">
				<option value="">ทั้งหมด</option>
				<?
				$syear = (date('Y')+543)-10;
				for($i=$syear;$i<=(date('Y')+543);$i++){
				?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?
				}
				?>
			</select>					
		</td>
	</tr>
	<tr>
	  <th>ตั้งแต่เดือน ปี(วันที่บันทึกข้อมูล)</th>
	    <td>
	    	<select name="month" class="styled-select">
			<option value="">ทั้งหมด</option>
			<?
			for($i=1;$i<=12;$i++){
			?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
			<?
			}
			?>
			</select> - <select name="year" class="styled-select">
				<option value="">ทั้งหมด</option>
				<?
				$syear = (date('Y')+543)-10;
				for($i=$syear;$i<=(date('Y')+543);$i++){
				?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?
				}
				?>
			</select></td>			
			<th>ถึง เดือน ปี (วันที่บันทึกข้อมูล)</th>
	    	<td>
		    	<select name="month" class="styled-select">
			<option value="">ทั้งหมด</option>
			<?
			for($i=1;$i<=12;$i++){
			?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
			<?
			}
			?>
			</select> -  <select name="year" class="styled-select">
				<option value="">ทั้งหมด</option>
				<?
				$syear = (date('Y')+543)-10;
				for($i=$syear;$i<=(date('Y')+543);$i++){
				?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
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
</div>
<div id="report">
	<div id="title">				  
		<p>รายงานการฉีดวัคซีนและอิมมูโนโกลบุลิน</p>
	    <p>เขตความรับผิดชอบ (<?php echo $textarea;?>) :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด<?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?> ตำบล <?php echo $textdistrict; ?></p>
		<p>โรงพยาบาล <?php echo $texthospital;?> </p>
		<p>เดือน มกราคม ปี 2556 ถึงเดือน กุมภาพันธ์ ปี 2556</p>				
	</div>
	<div class="right">หน่วย :คน</div>
	<table class="tbreport1">
		<tr>
			<td colspan="10" style="text-align:center;" class="B">จำนวนผู้รับการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าและอิมมูโนโกลบูลิน</td>
		</tr>
		<tr style="text-align: center;">
			<td colspan="2">ฉีดวัคซีนครบชุด <br/>(ครบชุด 4-5 เข็ม หรือกระตุ้น)</td>
			<td colspan="2">ฉีดวัคซีนต่ำกว่า 4-5 เข็ม </td>
			<td colspan="2">ฉีดวัคซีนไม่ครบชุด </td>
			<td colspan="2">ฉีดวัคซีนรวม</td>
			<td rowspan="2">ไม่ฉีดวัคซีน </td>
			<td rowspan="2">ฉีดอิมมูโนโกลบูลิน (RIG)</td>
		</tr>
		<tr>
			<td class="topic">IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>

		</tr>
		<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>
	</table>	
	<div id="description">
		<table class="tbdesc">
			<tr>
				<th>ฉีดวัคซีนครบชุด<br/>(ครบชุด 4-5 เข็ม <br/>หรือกระตุ้น)</th>
				<td><strong>หมายถึง </strong> <ul>
					<li>ผู้สัมผัสโรคที่ได้รับวัคซีนป้องกันโรคพิษสุนัขบ้าตามคู่มือสร้างเสริมภูมิคุ้มกันโรคของกรมควบคุมโรค กระทรวงสาธารณสุข จนครบชุดเข้ากล้ามเนื้อ 5 เข็ม หรือเข้าในผิวหนังแบบ 4 เข็ม (2-2-2-0-2)</li>
    				<li>ผู้สัมผัสโรคที่ได้รับการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้ากระตุ้น 1 หรือ 2 เข็ม หลังถูกสุนัขกัด เนื่องจากเคยได้รับ ฉีดวัคซีนป้องกันโรคพิษสุนัขบ้ามาก่อน ตั้งแต่ 3 เข็มขึ้นไป ภายในระยะเวลา 6 เดือน หรือเกิน 6 เดือน</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th>ฉีดวัคซีนต่ำกว่า <br/>4 หรือ 5 เข็ม</th>
				<td><strong>หมายถึง </strong>ผู้สัมผัสโรคที่ได้รับการฉีดวัคซีนฯ พร้อมกับสังเกตอาการสุนัขหรือแมว แล้วสุนัขหรือแมวมีอาการปกติใน 10 วัน จึงหยุดฉีด</td>
			</tr>
			<tr>
				<th>ฉีดไม่ครบชุด</th>
				<td><strong>หมายถึง </strong> ผู้สัมผัสโรคพิษสุนัขบ้าที่ได้รับการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าหลังสัมผัสโรคไม่ครบตามคู่มือสร้างเสริมภูมิคุ้มกัน โรคของกรมควบคุมโรค กระทรวงสาธารณสุข</td>
			</tr>
			<tr>
				<th>ช่วงเวลา</th>
				<td><strong>หมายถึง </strong> ระยะเวลาของข้อมูลที่ต้องการ เช่น ม.ค. 2555 - ธ.ค. 2555 หรือ ม.ค. 2555 - มี.ค. 2556</td>
			</tr>
		</table>							
	</div>
	<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	
		<div id="btn_printout"><a href="report/index/8/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>