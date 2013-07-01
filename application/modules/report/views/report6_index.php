<div id="title">ข้อมูลรายจังหวัด</div>
<div id="search">
<form action="report/index/6" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
<table  class="tb_patient1">
  <tr>
	<th>เขตความรับผิดชอบ</th>
	<td><?php echo form_dropdown('area',get_option('id','name','n_area'),@$_GET['area'],'class="styled-select widthselect"  id="area"','กรุณาเลือกเขต');?>	</td>
	<th>เขต</th>
	<td>
	<?php if(!empty($_GET['area'])){ ?>
		<select name="group" class="styled-select" id="group">
		<option value="">ทั้งหมด</option>
	<?		$area=$_GET['area']; 	
		 	if($area=='1' || $area=='2'){
				if($area=='1'){
					$province=$this->province->select("province_level_old as groupno")->groupby("province_level_old")->sort("")->order("province_level_old")->get();
				}else{
					$province=$this->province->select("province_level_new as groupno")->groupby("province_level_new")->sort("")->order("province_level_new")->get();
				}									
				foreach($province as $rec){
				  if($rec['groupno']=='0'){
					$groupname = "กทม.";
				  }else{
					$groupname = "เขต ".$rec['groupno'];
				  } ?>
				  <option value="<? echo $rec['groupno'] ?>" <?php echo ($rec['groupno'] ==$_GET['group']) ? 'selected="selected"':'';?>><?php echo $groupname ?></option>
			<?php } ?>
			</select>								
	<?php }}else{ ?>
	<span id="grouplist"><select name="group" class="styled-select widthselect" id="group"><option value="">ทั้งหมด</option></select></span>
	<?php }; ?>
	</td>
	<th>จังหวัด</th>
	<td>			
		<?php if(!empty($_GET['province'])){
		echo form_dropdown('province',get_option('province_id','province_name','n_province'),$_GET['province'],'class="styled-select" id="prvince"','ทั้งหมด');
		}else{ ?>
		<span id="provincelist"><select name="province" class="styled-select widthselect"><option value="">ทั้งหมด</option></select></span>		
		<? } ?>			
	</td>
  	</tr>
	<tr>
	   <th>ปีสัมผัสโรค</th>
	   <td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>
	   <th>เดือนที่สัมผัสโรค</th>
	   <td><?php echo form_dropdown('month_start',get_month(),@$_GET['month_start'],'class="styled-select"','ทั้งหมด'); ?>	</td>
	</tr>
	<tr>
	   <th>ปีที่บันทึกรายการ</th>
	   <td><?php echo form_dropdown('year_report_start',get_year_option(),@$_GET['year_report_start'],'class="styled-select"','ทั้งหมด') ?></td>		
	   <th>เดือนที่บันทึกรายการ</th>
       <td><?php echo form_dropdown('month_report_start',get_month(),@$_GET['month_report_start'],'class="styled-select"','ทั้งหมด'); ?></td>
	</tr>
</table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul></div>
</form>

</div>
<?php if(!empty($cond)): ?>
<div id="report">	
<div id="title">
	<p>รายงานจังหวัด<?php echo $textprovince ?>  เดือน  <?php echo $textmonth_start ?> ปี  <? echo $textyear_start ?></p>
</div>
<table class="tbreport">
	<tr><td colspan="4" style="text-align: right;">หน่วย: คน</td></tr>
	<tr>
		<th rowspan="2">อำเภอ</th>		
		<th colspan="2">สิทธิการรักษา</th>		
		<th rowspan="2">ยอดรวม</th>
	</tr>
	<tr>
		<th>สถานบริการนี้</th>
		<th>สถานบริการอื่น</th>
	</tr>
	<?php 
	$total1=0;$total2=0;$total_all=0;
	foreach($result as $item): ?>
	<tr class="para1">
		<td class="pad-left"><?php echo $item['amphur_name'] ?></td>		
		<td><?php echo $in =number_format($item['cnt1']); $total1 =$total1 + $in;?></td>
		<td><?php echo $out=number_format($item['cnt2']); $total2 =$total2 + $out;?></td>
		<td><?php echo $all= $in+$out; number_format($all); $total_all =$total_all + $all ?></td>
	</tr>
	<?php endforeach; ?>
	<tr class="total para1">
		<td class="pad-left">รวม</td>
		<td><?php echo number_format($total1); ?></td>
		<td><?php echo number_format($total2); ?></td>
		<td><?php echo number_format($total_all); ?></td>
	</tr>
</table>
	<hr class="hr1">
	<div id="reference"><?php echo $reference?></div>	
	<div id="btn_printout"><a href="report/index/6<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
	<div id="area_btn_print">
		<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
		<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
	</div>
</div>	
<?php endif; ?>