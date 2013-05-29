<div id="title">รายงานสรุปผู้สัมผัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้ารายจังหวัด</div>
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
				<select name="group" class="styled-select" id="group">
					<option value="">ทั้งหมด</option>
				</select>
			</span>
			</td>
			<th>ข้อมูลรายจังหวัด</th>
			<td>
			<span id="provincelist">
				<select name="province" class="styled-select" id="prvince">
					<option value="">ทั้งหมด</option>
				</select>
			</span>
			</td>			
	  </tr>
	 	  <tr>
	    <th>จำแนกรายปีของวันที่สัมผัสโรค</th>
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
			<th>จำแนกรายเดือนของวันที่สัมผัสโรค</th>
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
	  <th>จำแนกรายปีของวันที่บันทึกรายการ</th>
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
			<th>จำแนกรายเดือนของวันที่บันทึกรายการ</th>
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
<table class="tbreport">
	<tr>
		<th>อำเภอ</th>
		<th>ยอดรวม(คน)</th>
		<th>สิทธิการรักษาสถานบริการนี้(คน)</th>
		<th>สิทธิการรักษาสถานบริการอื่น(คน)</th>
	</tr>
	<tr>
		<td>บางกรวย</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr>
		<td>บางบัวทอง</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr>
		<td>ปากเกร็ด</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr>
		<td>เมืองนนทบุรี</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr>
		<td>ไทรน้อย</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
	<tr class="total">
		<td>รวม</td>
		<td>73</td>
		<td>55</td>
		<td>18</td>
	</tr>
</table>
		<div id="btn_printout"><a href="report/index/4/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>	