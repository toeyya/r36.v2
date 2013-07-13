<script type="text/javascript">
	$(document).ready(function(){
	 $('#multiAccordion').multiAccordion({
            heightStyle: "content",
        	 active:0 
        });	

	})
</script>
<? error_reporting(E_ALL ^ E_NOTICE); ?>
 <div id="title">รายงานผู้เสียชีวิต </div>
<div id="search">
<form action="report/dead" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
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
	<th>ปีที่สัมผัสโรค</th>	
	<td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>			
	  </tr>  
	</table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul>
</div>
</form>
</div><!--search -->

<div id="report" style="width:100%;margin:0px;">
<div id="title">
	<p>รายงานผู้เสียชีวิต</p>
</div>
<div class="right">หน่วย: ราย</div>
<div id="multiAccordion" style="width:100%;margin:0px;">
	<h3><a href="javascript:void(0)">ประวัติผู้เสียชีวิต</a></h3>
	<div id="section1">
	<table class="tbreport">
		<tr>
			<th>ราย</th>
			<th>วันที่เสียชีวิต</th>
			<th>เพศ</th>	
			<th>อายุ</th>
			<th>อาชีพ</th>	
			<th>สถานที่สัมผัสโรค</th>
			<th>วันที่สัมผัสโรค</th>
			<th>วันเริ่มมีอาการ</th>
			<th>ระยะฟักตัว</th>
			<th>ผลตรวจทางห้องปฏิบัติการ</th>
		</tr>
		<? foreach($result as $item): ?>
		<tr style="text-align: center;">
			<td>1</td>			
			<td><? echo (!empty($item['enddate'])) ? db_to_th($item['enddate']):''; ?></td>
			<td>ชาย</td>
			<td>16</td>
			<td>นักเรียน/นักศึกษา</td>		
			<td>เขตอบต. (จ.พิษณุโลก อ.เมือง ต.โพณพิษสัย)</td>
			<td><? echo (!empty($item['datetouch'])) ? db_to_th($item['datetouch']):''; ?></td>
			<td><? echo (!empty($item['startdate'])) ? db_to_th($item['startdate']):'' ?></td>
			<td></td>	
		 	<td>สำนักสุขศาสตร์สัตว์และสุขศึกษาที่ 5 จ.เชียงใหม่ ผล:positive</td>	
		</tr>
		<?php endforeach; ?>
		</table>
			<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	
			<div id="btn_printout"><a href="report/index/7/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>
	</div>

	<h3><a herf="javascript:void(0)">ประวัติของสัตว์ที่กัด</a></h3>
	<div id="section2">
		<table class="tbreport">
		<tr>
			<th>ผู้สัมผัสรายที่</th>
			<th>ชนิดสัตว์</th>
			<th>สถานภาพ</th>	
			<th>อายุ</th>
			<th>การฉีดวัคซีนป้องกันโรค</th>	
			<th>สาเหตุถูกกัด</th>
			<th>สาเหตุการตายของสัตว์</th>
			<th>การส่งตรวจ</th>
		</tr>
		<tr style="text-align: center;">
			<td>1</td>
			<td></td>
			<td></td>
			<td></td>		
			<td></td>
			<td></td>
			<td></td>
			<td></td>	
		</tr>
		</table>
			<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	
			<div id="btn_printout"><a href="report/index/7/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>
	</div><!--section2 -->

</div><!-- mulicordion -->			

</div><!--report-->

