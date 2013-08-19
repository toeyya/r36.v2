<script type="text/javascript" src="media/js/report_analyze.js"></script>
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
<div id="loading"><img src="media/images/loading2.gif" width="98px" height="20px"></div>
<?php if(!empty($cond)): ?>
 <div id="report">
	<div id="title">				  
		<p>ปัจจัยที่เกี่ยวข้องกับการรายงานผลการฉีดวัคซีนผู้สัมผัสโรคพิษสุนัขบ้า</p>
		<p>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?> </p>				
	</div>
	<div class="right"><button class="column-chart img" name="column"></button>
		<a href="report/analyze/index/8<?php echo '?'.$_SERVER['QUERY_STRING'].'&excel=excel' ?>" class="excel" name="btn_excel"></a></div> 
	<h6>ตาราง จำนวนของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตาม <?php echo $head; ?>และ <?php echo $detail_minor_name[$detail_minor]; ?></h6>		
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
		<? $grp =(!empty($date_type)) ? "group by ".$date_type."  order by ".$date_type : '';
		
			for($main=0;$main<count($detailmain_B);$main++){
					for($main_sub=1;$main_sub<count($detailminor_name);$main_sub++){
						$sql ="SELECT count(historyid) as cnt 
							   FROM n_history inner join n_information on historyid=information_historyid
							   WHERE  $cond and $detailmain_T[$main]='1' AND use_rig = '".$detailminor_T[$main_sub]."'";														
						$sumrow = $this->db->GetOne($sql);								
		?>
	  <tr class="para1">
			<td height="20"><strong><? echo $detailmain_B[$main]?></strong></td>
			<td><strong><? echo $detailminor_name[$main_sub]?></strong></td>
				<?  
					for($numWH=0;$numWH<count($detailmain_wh);$numWH++){
						$sql ="SELECT  count(historyid) as cnt 
								FROM n_history inner join n_information on historyid=information_historyid
								WHERE  $cond and $detailmain_T[$main]$detailmain_wh[$numWH] ='1' AND use_rig = '".$detailminor_T[$main_sub]."'";
						$sum  = $this->db->GetOne($sql);						
						if($sum!='0'){
							$sumpercent=$sum/$sumrow*100;
						}else{
							$sumpercent=0;
						}
				?>
				<td><? echo number_format($sum).'<br>('.number_format($sumpercent,1).')';?></td>
				<? }
				?>
				<td><? echo number_format($sumrow).'<br>(100.0)';?></td>
	  </tr>
	  <?	 $detailmain_B[$main]='';	} 
	  }?>
	</table>
			<hr class="hr1">		
			<div id="reference"><?php echo $reference?></div>			
			<div id="btn_printout">
			<a href="report/analyze/index/8<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>  	
  </div>  
<?php endif; ?>