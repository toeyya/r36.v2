<script type="text/javascript">
$(document).ready(function(){
	     $('#multiAccordion').multiAccordion({
            heightStyle: "content",
            active:0
        });
	$('input[type=submit]').click(function(){
		if($('#area option:selected').val()==""){
			alert("กรุณาเลือกรูปแบบเขตความรับผิดชอบในการออกรายงาน");
		}
	})
})
	
</script>
<div id="title">ข้อมูลการสัมผัสโรค - ภาพรวม</div>
<div id="search">
<form action="report/index/4" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
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
			</select>					</td>
			<th>เดือนที่สัมผัสโรค</th>
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
			</select>
		</td>
		
      </tr>   
	  <tr>  
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
			<th>เดือนที่บันทึกรายการ</th>
	    	<td>
			<select name="month_report" class="styled-select">
			<option value="">ทั้งหมด</option>
			<?
			for($i=1;$i<=12;$i++){
			?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
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
<div id="report">
		<div id="title">				  
		<p>รายงานผู้สัมผัสโรคในภาพรวม</p>
	    <p>เขตความรับผิดชอบ (<?php echo $textarea;?>) :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>โรงพยาบาล <?php echo $texthospital;?>  ปี  <?php echo $textyear;?>  เดือน  <?php echo $textmonth;?></p>				
		</div>
<div id="multiAccordion">
    <h3><a href="javascript:void(0);">ส่วนที่ 1 : ข้อมูลทั่วไป</a></h3>
    <div id="section1">
		<h6>ตารางที่ 1 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามข้อมูลทั่วไป</h6>
		<table class="tbreport">
			<tr>
				<th>ข้อมูลทั่วไป</th>
				<th>จำนวน (N=0)</th>
				<th>ร้อยละ</th>
			</tr>
		<tr ><td colspan="3"><strong>เพศ</strong></td></tr>
		<tr class="para1">
			<td class="pad-left">ชาย</td>
			<td>0</td>
			<td>0</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">หญิง</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr ><td colspan="3"><strong>กลุ่มอายุ</strong></td></tr>
		<tr class="para1">
			<td class="pad-left">ต่ำกว่า 1 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">1-5 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">6-10 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">11-15 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">16-25 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">26-35 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">36-45 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">46-55 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">56-65 ปี</td>
			<td>0</td>
			<td>0</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">66 ปีขึ้นไป</td>	
			<td>0</td>
			<td>0</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
		</tr>
		</table>
		<hr class="hr1">		
		<div id="btn_printout"><a href="report/index/1/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		</div> <!-- section1-->
		<p class="page-break"></p>
		 <h3><a href="javascript:void(0);">ส่วนที่ 2 : ตำแหน่งและลักษณะการสัมผัส</a></h3>
		<div id="section2">
			<h6>ตารางที่ 2 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามสถานที่สัมผัสโรค ลักษณะการสัมผัสโรค และตำแหน่งที่สัมผัส</h6>
			<table class="tbreport">
				<tr>
					<th>การสัมผัส</th>
					<th>จำนวน (N=70,297)</th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="3"><strong>สถานที่สัมผัสโรค</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">เขต กทม.</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เขตเมืองพัทยา</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เขตเทศบาล</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left2">นคร</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left2">เมือง</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left2">ตำบล</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left2">ระบุ</td>
					<td>0</td>
					<td>0</td>		
				</tr>		
			</table>
			<hr class="hr1">					
			<div id="btn_printout"><a href="report/index/1/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>

		</div><!-- section2 -->
		<p class="page-break"></p>
		 <h3><a href="javascript:void(0);">ส่วนที่ 3 : สัตว์นำโรค</a></h3>
		<div id="section3">
			<h6>ตารางที่ 3 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้าแจกแจงตามชนิดและประวัติของสัตว์นำโรค </h6>
			<table class="tbreport">
				<tr>
					<th>ชนิดและประวัติของสัตว์</th>
					<th>จำนวน (N=70,297)</th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="3"><strong>ชนิดสัตว์</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">สุนัข</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">แมว</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ลิง</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ชะนี</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">หนู</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left2">คน</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left2">วัว</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left2">กระบือ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left2">สุกร</td>
					<td>0</td>
					<td>0</td>		
				</tr>								
			</table>
		<hr class="hr1">				
		<div id="btn_printout"><a href="report/index/1/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>

		</div><!--section3 -->
		<p class="page-break"></p>
		 <h3><a href="javascript:void(0);">ส่วนที่ 4 : ประวัติการได้รับวัคซีน และการปฏิบัติตนของผู้สัมผัสโรค</a></h3>
		<div id="section4">
			<h6>ตารางที่ 4  จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามการดูแลบาดแผลและประวัติการได้รับวัคซีน </h6>
			<table class="tbreport">
				<tr>
					<th>การดูแลบาดแผลและประวัติการได้รับวัคซีน</th>
					<th>จำนวน (N=70,297)</th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="3"><strong>การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ได้ล้าง</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ล้าง</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ได้ล้าง</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr ><td colspan="3"><strong>วิธีการล้างแผล (n=47,882)</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">น้ำ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">น้ำและสบู่ / ผงซักฟอก</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr ><td colspan="3"><strong>การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ได้ใส่ยา</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ใส่ยา</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
			</table>	
			<hr class="hr1">		
			<div id="btn_printout"><a href="report/index/1/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>

		</div><!--section4-->
		 <p class="page-break"></p>
		 <h3><a href="javascript:void(0);">ส่วนที่ 5 : การฉีดอิมมูโนโกลบุลินและวัคซีนในครั้งนี้</a></h3>
		<div id="section5">
			<h6>ตารางที่ 5  จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามการฉีดอิมมูโนโกลบุลินและวัคซีน </h6>
			<table class="tbreport">
				<tr>
					<th>การฉีดอิมมูโนโกลบุลินและวัคซีน</th>
					<th>จำนวน (N=70,297)</th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="5"><strong>อิมมูโนโกลบุลิน (RIG)</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ฉีด</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ฉีด</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr ><td colspan="3"><strong>ชนิดของอิมมูโนโกลบูลิน (RIG) (n=47,882)</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ERIG</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">HRIG</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr ><td colspan="3"><strong>อาการหลังฉีดอิมมูโกลบูลิน (RIG) (n=6,312)</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่แพ้</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">แพ้</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr ><td colspan="3"><strong>อาการแพ้อิมมูโนโกลบูลิน (n=66)</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">บวมแดง</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">คันบริเวณที่ฉีด</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">เป็นไข้</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ปวดศรีษะ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เป็นผื่นคันทั่วไป</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ช๊อก</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr ><td colspan="3"><strong>ระยะเวลาที่มีอาการแพ้อิมมูโนโกลบุลิน (n=6,312)</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่แพ้</td>
					<td>0</td>
					<td>0</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">แพ้</td>
					<td>0</td>
					<td>0</td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td>0</td>
					<td>0</td>		
				</tr>
			</table>	
			<hr class="hr1">		
			<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>			
			<div id="btn_printout"><a href="report/index/1/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>
		</div><!--section5-->
	</div><!-- multicordion -->
</div><!--report -->