<div id="title">สรุปข้อมูลการสัมผัสโรครายปี (เดือน)</div>
<div id="search">
<form action="report/index/6" method="post" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
		<table class="tb_patient1">
			  <tr>
				<th>รูปแบบเขตความรับผิดชอบ</th>
				<td>
					<select name="area" class="styled-select widthselect"  id="area" onchange="ListGroupByArea();">
						<option value="-">กรุณาเลือกเขต</option>
						<option value="1">รูปแบบเดิม (12 เขต)</option>
						<option value="2">รูปแบบใหม่ (19 เขต)</option>
					</select>
				</td>
				<th>ข้อมูลรายเขต</th>
				<td>
				<span id="grouplist">
					<select name="group" class="styled-select widthselect" id="group">
						<option value="">ทั้งหมด</option>
					</select>
				</span></td>

				<th>ข้อมูลรายจังหวัด</th>
				<td>
				<span id="provincelist">
					<select name="province" class="styled-select widthselect">
						<option value="">ทั้งหมด</option>
					</select>
				</span></td>
			  </tr>
		  <tr>
			<th>ข้อมูลรายอำเภอ</th>
			<td>
				<span id="amphurlist">
					<select name="amphur" class="styled-select widthselect">
						<option value="">ทั้งหมด</option>
					</select>
				</span>
			</td>
			<th>ข้อมูลรายโรงพยาบาล</th>
			<td>
				<span id="hospitallist">
				<select name="hospital" class="styled-select widthselect">
					<option value="">ทั้งหมด</option>
				</select>
				</span>
			</td>

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
</div>