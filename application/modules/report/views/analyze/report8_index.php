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
	$('.btn_submit').click(function(){
		var index = $('#detail_main option:selected').val();
		$('#formreport').attr('action','report/analyze/index/'+index);
	})
	
 	
})
</script>
<div id="title">ปัจจัยที่เกี่ยวข้องกับการรายงานผลการฉีดวัคซีนผู้สัมผัสโรคพิษสุนัขบ้า</div>
<div id="search">
<form action="report/analyze/" method="get" name="formreport"  id="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
	  <tr>
	  	<th>เลือกปัจจัยที่เกี่ยวข้อง</th>
	  	<?php $arr_detail_main =array(1=>'อายุผู้สัมผัสหรือสงสัยว่าสัมผัส',2=>'สถานที่สัมผัส',3=>'ชนิดสัตว์นำโรค',4=>'อายุสัตว์',5=>'สัตว์ถูกฆ่าตาย กับ สัตว์ตายเองภายใน 10  วัน',6=>'ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์',7=>'ประวัติการฉีดวัคซีนของผู้สัมผัส',8=>'การฉีดอิมมูโนโกลบุลิน',9=>'จำนวนครั้งที่ฉีดวัคซีนในคน'); 
	  						?>
	  	<td colspan="5"><?php echo form_dropdown('detail_main',$arr_detail_main,@$_GET['detail_main'],'class="styled-select" id="detail_main"','ปัจจัยหลัก'); ?>
			<span id="show_minor">
			<?php if(empty($_GET['detail_minor'])): ?>	
				<select name="detail_minor" class="styled-select"><option value="">ปัจจัยรอง</option></select>		
			<? else: ?>
				<select name="detail_minor" class="styled-select"><option value="<?php echo $_GET['detail_minor'] ?>"><?php echo $detail_minor_name[$detail_minor]; ?></option></select>
			<? endif; ?>
			</span>
		</td>
	
	  </tr>
	<?php require 'include/conditionreport.php'; ?>
	  <tr>
	    <th>ปีที่สัมผัสโรค</th>
	 	<td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>						
 
	  <th>ปีที่บันทึกรายการ</th>
	    <td><?php echo form_dropdown('year_report_start',get_year_option(),@$_GET['year_report_start'],'class="styled-select"','ทั้งหมด') ?></td>
      </tr>
  </table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul></div>	
 </form>
</div>
<?php if($cond): ?>
 <div id="report">
	<div id="title">				  
		<p>ปัจจัยที่เกี่ยวข้องกับการรายงานผลการฉีดวัคซีนผู้สัมผัสโรคพิษสุนัขบ้า</p>
		<p>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?> </p>				
	</div>
	<table class="tbreport">
	<tr>
		<th rowspan="2" colspan="2">การฉีดอิมมูโนโกลบูลิน</th>
		<th colspan="2">ถูกกัด</th>
		<th colspan="2">ถูกข่วน</th>
		<th colspan="2">ถูกเลีย / ถูกน้ำลาย</th>
		<th rowspan="2">รวม</th>
	</tr>
	<tr>
		<th>มีเลือดออก</th>
		<th>ไม่มีเลือดออก</th>
		<th>มีเลือดออก</th>
		<th>ไม่มีเลือดออก</th>
		<th>มีเลือดออก</th>
		<th>ไม่มีเลือดออก</th>		
	</tr>
	<tr></tr>
	</table>
  </div>  
<?php endif; ?>