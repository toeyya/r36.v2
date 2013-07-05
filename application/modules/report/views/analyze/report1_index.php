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
	<h6>ตาราง จำนวนของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามอายุผู้สัมผัส และ เพศ </h6>	
	<table class="tbreport">
		<tr><th rowspan="3">อายุผู้สัมผัสหรือสงสัยว่าสัมผัส</th></tr>
		<tr>
			<th colspan="<?php echo count($minordetail)+1; ?>"><strong><?php echo $detail_minor_name[$detail_main] ?></strong></th>
		</tr>
		<tr>
			<?php foreach($minordetail as $item): ?>
			<th><?php echo $item; ?></th>
			<?php endforeach; ?>
			<th>รวม</th>
		</tr>
		<?php for($i=1;$i<$main;$i++): ?>
		<tr class="para1">
			<td class="pad-left"><?php echo $detail_main_name[$i] ?></td>
			<?php for($j=1;$j<$minor;$j++): ?>
			<td><?php echo ${'main'.$i.$j}; ?></td>	
						
			<?php endfor; ?>			
			<td><?php echo ${'main'.$i}; ?></td>
		</tr>		
		<?php endfor; ?>
		
		
	</table>
			<hr class="hr1">		
			<div id="reference"><?php echo $reference?></div>			
			<div id="btn_printout">
			<a href="report/index/1<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>  
  </div><!--report -->

<?php endif; ?>