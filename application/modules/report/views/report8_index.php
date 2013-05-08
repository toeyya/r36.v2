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