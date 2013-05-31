<script type="text/javascript">
$(document).ready(function(){
	$("#detail_main").change(function(){
	//onchange="url='js/getlist.php?mode=D_main&ref1='+formreport.detail_main.value;load_divForm(url,'show_minor');"
	 var ref1=$("#detail_main option:selected").val();
		 $.ajax({
		 	type:'get',
			url:'<?php echo base_url() ?>media/js/getlist.php',
			data:'mode=D_main&ref1='+ref1,
			success:function(data){
				$("#show_minor").html(data);
			}
		 })
	});
})
</script>
<div id="title">ปัจจัยที่เกี่ยวข้องกับการรายงานผลการฉีดวัคซีนผู้สัมผัสโรคพิษสุนัขบ้า</div>
<div id="search">
<form action="report/index/4" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
	  <tr>
	  	<th>เลือกปัจจัยที่เกี่ยวข้อง</th>
	  	<td colspan="5"><select name="detail_main" class="styled-select" id="detail_main">
							<option value="-">ปัจจัยหลัก</option>
							<option value="1">อายุผู้สัมผัสหรือสงสัยว่าสัมผัส</option>
							<option value="2">สถานที่สัมผัส</option>
							<option value="3">ชนิดสัตว์นำโรค</option>
							<option value="4">อายุสัตว์</option>
							<option value="5">สัตว์ถูกฆ่าตาย กับ สัตว์ตายเองภายใน 10  วัน</option>
							<option value="6">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์</option>
							<option value="7">ประวัติการฉีดวัคซีนของผู้สัมผัส</option>
							<option value="8">การฉีดอิมมูโนโกลบุลิน</option>
							<option value="9">จำนวนครั้งที่ฉีดวัคซีนในคน</option>
				</select>
				<span id="show_minor">
					<select name="detail_minor" class="styled-select"><option value="-">ปัจจัยรอง</option></select>
				</span>
		</td>
	
	  </tr>

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

		<th>อำเภอ</th>
		<td>
			<span id="amphurlist">
				<select name="amphur" class="styled-select">
					<option value="">ทั้งหมด</option>
				</select>
			</span></td>
		<th>ตำบล</th>
			<td>
				<span id="districtlist">
					<select name="district" class="styled-select" id="district">
						<option value="">ทั้งหมด</option>
					</select>
				</span>					</td>
			<th>สถานบริการ</td>
			<td>
				<span id="hospitallist">
				<select name="hospital" class="styled-select" id="hospital">
					<option value="">ทั้งหมด</option>
				</select>
				</span></td>			
	  </tr>

	  <tr>
	    <th>ปีที่สัมผัสโรค</th>
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
			</select>							
 
	  <th>ปีที่บันทึกรายการ</th>
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