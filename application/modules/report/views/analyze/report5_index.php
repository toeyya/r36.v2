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
		<a href="report/analyze/index/5<?php echo '?'.$_SERVER['QUERY_STRING'].'&excel=excel' ?>" class="excel" name="btn_excel"></a></div> 
	<h6>ตาราง จำนวนของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตาม <?php echo $head; ?>และ <?php echo $detail_minor_name[$detail_minor]; ?></h6>	
	<table class="tbreport">
		<?php $row=(!empty($minordetail_head))? "4":"3"; ?>
		<tr><th rowspan="<?php echo $row; ?>" colspan="2"><?php echo $head; ?></th>		
		</tr>				
		<tr>
			<th colspan="<?php echo count($minordetail)+1; ?>"><strong><?php echo $detail_minor_name[$detail_minor] ?></strong></th>
		</tr>
		<?php if(!empty($minordetail_head)): ?>
		<tr><? foreach($minordetail_head as $key =>$item): ?>
			<th colspan="<?php echo $minorvalue_head[$key] ?>"><?php echo $item; ?></th>
			<?php endforeach; ?>
			
		</tr>		
		<?php endif; ?>
		<tr>
			<?php $row_sum=0;
				foreach($minordetail as $item): ?>
			<th><?php echo $item; ?></th>
			<?php endforeach; ?>
			<th>รวม</th>
		</tr>
		<?php foreach($detail_main_type as $key=>$i): ?>
		<tr class="para1">
			<td><strong><?php echo $detail_main_name_head[$key] ?></strong></td>
			<td><strong><?php echo $detail_main_name[$key] ?></strong></td>
			<?php foreach($minorvalue as $j): ?>
				<td><?php 
				$sum[$j] =	${'main'.$i.$j};			
				if(empty($sum_all[$j])){$sum_all[$j]=0;}
				$sum_all[$j] += $sum[$j];	
				echo number_format(${'main'.$i.$j}); ?><p class="percentage">(<?php  echo compute_percent(${'main'.$i.$j},${'total_main'.$i},1) ?>)</p></td>							
			<?php endforeach; ?>			
			<td><?php $row_sum =$row_sum + ${'total_main'.$i};
					 echo number_format(${'total_main'.$i}); ?></td>			
		</tr>		
		<?php endforeach; ?>
		
		<tr class="total">			
			<td>รวม</td>
			<?php if(!empty($detail_main_name_head)): ?><td></td><? endif; ?>
		<?php foreach($minorvalue as $j): ?>			
			<td><? echo number_format($sum_all[$j]); ?></td>			
		<?php endforeach; ?>
			<td><? echo number_format($row_sum); ?></td>					
		</tr>
	</table>
			<hr class="hr1">		
			<div id="reference"><?php echo $reference?></div>			
			<div id="btn_printout">
			<a href="report/analyze/index/5<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>  	
  </div>  
<?php endif; ?>