<div id="title">รายงานสรุปผลการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าและอิมมูโนโกลบุลิน</div>
<div id="search">
<form action="report/index/6" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
	  <tr>
			<th>รูปแบบเขตความรับผิดชอบ</th>
			<td>
				<select name="area" id="area" class="styled-select" >
					<option value="-">กรุณาเลือกเขต</option>
					<option value="1" <?php echo (@$_GET['area']=="1")? "selected='selected":''; ?>>รูปแบบเดิม (12 เขต)</option>
					<option value="2" <?php echo (@$_GET['area']=="2")? "selected='selected":''; ?>>รูปแบบใหม่ (19 เขต)</option>
				</select>
			 </td>
			 <th>ข้อมูลรายเขต</th>
			<td>
			<span id="grouplist">
				<select name="group" class="styled-select" id="group"><option value="">ทั้งหมด</option></select>
			</span>
			</td>
			<th>ข้อมูลรายจังหวัด</th>
			<td>
			<span id="provincelist">
				<select name="province" class="styled-select" id="prvince"><option value="">ทั้งหมด</option></select>
			</span>
			</td>			
	  </tr>
	  <tr>
		<th>ข้อมูลรายอำเภอ</th>
		<td>
			<span id="amphurlist">
				<select name="amphur" class="styled-select"><option value="">ทั้งหมด</option></select>
			</span></td>
		<th>ข้อมูลรายตำบล</th>
			<td>
				<span id="districtlist">
					<select name="district" class="styled-select" id="district"><option value="">ทั้งหมด</option></select>
				</span>	
			</td>
			<th>ข้อมูลรายโรงพยาบาล</td>
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
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li>
      </ul>
</div>
</form>
</div>
<div id="report">
	<table class="tbreport1">
		<tr>
			<th colspan="10" style="text-align:center;" class="B">จำนวนฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าและอิมมูโนโกลบูลิน</th>
		</tr>
		<tr style="text-align: center;">
			<th colspan="2">ฉีดวัคซีนครบชุด <br/>(ครบชุด 4-5 เข็มหรือกระตุ้น) (ราย)</th>
			<th colspan="2">ฉีดวัคซีนต่ำกว่า 4-5 เข็ม <br/>(ราย)</th>
			<th colspan="2">ฉีดวัคซีนไม่ครบชุด <br/> (ราย)</th>
			<th colspan="2">ผู้ได้รับการฉีดวัคซีนรวม <br/> (ราย)</th>
			<th>ผู้ไม่ฉีดวัคซีน <br/>(ราย)</th>
			<th>ผู้ได้รับการฉีดอิมมูโนโกลบูลินโรคพิษสุนัขบ้า(RIG)<br/> (ราย)</th>
		</tr>
		<tr>
			<td>IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>
			<td></td>
			<td></td>
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
				
	</div>
		<div id="btn_printout"><a href="report/index/4/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>