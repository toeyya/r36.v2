<div id="title">ข้อมูลรายจังหวัด</div>
<div id="search">
<form action="report/index/6" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
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
				<select name="group" class="styled-select" id="group">
					<option value="">ทั้งหมด</option>
				</select>
			</span>
			</td>
			<th>จังหวัด</th>
			<td>
			<span id="provincelist">
				<select name="province" class="styled-select" id="prvince">
					<option value="">ทั้งหมด</option>
				</select>
			</span>
			</td>			
	  </tr>
	 	  <tr>
	    <th>ปีของวันที่สัมผัสโรค</th>
	    <td>
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
			</select>					</td>
			<th>เดือนของวันที่สัมผัสโรค</th>
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
			</select>
		</td>
	</tr>
	<tr>
	  <th>ปีของวันที่บันทึกรายการ</th>
	    <td>
			<select name="year_report" class="styled-select">
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
			<th>เดือนของวันที่บันทึกรายการ</th>
	    	<td>
			<select name="month_report" class="styled-select">
			<option value="">ทั้งหมด</option>
			<?
			for($i=1;$i<=12;$i++){
			?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
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
<div id="title">
	<p>รายงานจังหวัดนนทบุรี  เดือน ม.ค. ปี 2556</p>
</div>
<div class="right">หน่วย: คน</div>
<table class="tbreport">
	<tr>
		<th rowspan="2">อำเภอ</th>
		<th rowspan="2">ยอดรวม</th>
		<th colspan="2">สิทธิการรักษา</th>		
	</tr>
	<tr>
		<th>สถานบริการนี้</th>
		<th>สถานบริการอื่น</th>
	</tr>
	<tr class="para1">
		<td class="pad-left">บางกรวย</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr class="para1">
		<td class="pad-left">บางบัวทอง</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr class="para1">
		<td class="pad-left">ปากเกร็ด</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr class="para1">
		<td class="pad-left">เมืองนนทบุรี</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr class="para1">
		<td class="pad-left">ไทรน้อย</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr class="total para1">
		<td class="pad-left">รวม</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
</table>
<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	
		<div id="btn_printout"><a href="report/index/6/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>	
</div>