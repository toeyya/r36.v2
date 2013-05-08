<div id="title">สรุปรายงานการสอบสวนผู้เสียชีวิตด้วยโรคพิษสุนัขบ้ารายจังหวัด </div>
<div id="search">
<form action="report/dead" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
	  <tr>
			<th width="20%">รูปแบบเขตความรับผิดชอบ</th>
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
			<th>จำแนกรายปี</th>	
			<td>
			<select name="year" class="styled-select">
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
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li>
      </ul>
</div>
</form>