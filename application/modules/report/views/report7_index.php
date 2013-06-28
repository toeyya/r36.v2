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
			<th width="20%">เขตความรับผิดชอบ</th>
			<td>
				<select name="area" id="area" class="styled-select" >
					<option value="-">กรุณาเลือกเขต</option>
					<option value="1" <?php echo ($_GET['area']=="1")? "selected='selected":''; ?>>รูปแบบเดิม (12 เขต)</option>
					<option value="2" <?php echo ($_GET['area']=="2")? "selected='selected":''; ?>>รูปแบบใหม่ (19 เขต)</option>
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
      
      </ul>
</div>
</form>
</div><!--search -->

<div id="report">
<div id="title">
	<p>รายงานผู้เสียชีวิต</p>
</div>
<div class="right">หน่วย: ราย</div>
<div id="multiAccordion">
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
		<tr style="text-align: center;">
			<td>1</td>			
			<td>27 ต.ค. 2554</td>
			<td>ชาย</td>
			<td>16</td>
			<td>นักเรียน/นักศึกษา</td>		
			<td>เขตอบต. (จ.พิษณุโลก อ.เมือง ต.โพณพิษสัย)</td>
			<td>13 ต.ค. 2554</td>
			<td>23 ต.ค. 2254</td>
			<td>11 วัน</td>	
		 	<td>สำนักสุขศาสตร์สัตว์และสุขศึกษาที่ 5 จ.เชียงใหม่ ผล:positive</td>	
		</tr>
		</table>
				<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	
			<div id="btn_printout"><a href="report/dead/1/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
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
			<div id="btn_printout"><a href="report/dead/2/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>
	</div><!--section2 -->

</div><!-- mulicordion -->			

</div><!--report-->

