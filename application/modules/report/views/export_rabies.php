<div id="title">ส่งออกข้อมูลผู้สัมผัสโรคพิษสุนัขบ้า</div>
<div id="search">
<form action="report/index/4" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
	  <tr>
			<th>จังหวัด</th>
			<td>
			<span id="provincelist">
				<select name="province" class="styled-select" id="prvince">
					<option value="">โปรดเลือก</option>
				</select>
			</span>
			</td>			
	  </tr>
	  <tr>
		<th>อำเภอ</th>
		<td>
			<span id="amphurlist">
				<select name="amphur" class="styled-select">
					<option value="">ทั้งหมด</option>
				</select>
			</span></td>
		</tr>
		<tr>
		<th>ตำบล</th>
			<td>
				<span id="districtlist">
					<select name="district" class="styled-select" id="district">
						<option value="">ทั้งหมด</option>
					</select>
				</span>					</td>
		</tr>
		<tr>
			<th>สถานพยาบาล</td>
			<td>
				<span id="hospitallist">
				<select name="hospital" class="styled-select" id="hospital">
					<option value="">ทั้งหมด</option>
				</select>
				</span></td>			
	  </tr>
	  <tr>
	    <th>วันที่เริ่มต้น</th>
	    <td><input type="text" class="datepicker input_box_patient " name="s_date"></td>		
      </tr>   
  	  <tr>
	    <th>วันที่สิ้นสุด</th>
	    <td><input type="text" class="datepicker input_box_patient " name="e_date"></td>		
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
