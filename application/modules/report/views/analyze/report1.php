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
<form action="report/index/1" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
<table class="tb_patient1">
<?php require 'include/conditionreport.php'; ?>
	<tr>
	    <th>ปีที่สัมผัสโรค</th>
	    
<td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>
		<th>เดือนที่สัมผัสโรค</th>
	    <td><?php echo form_dropdown('month_start',get_month(),@$_GET['month_start'],'class="styled-select"','ทั้งหมด'); ?></td>					
      </tr>   	
  </table>
  <div class="btn_inline">
      <ul>
      	<li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      
      </ul>
</div>	
</form>

</div>

<div id="report">
		<div id="title">				  
		<p>รายงานผู้สัมผัสโรคในภาพรวม</p>
	    <p>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></p>				
		</div>

<div id="multiAccordion">
    <h3>ส่วนที่ 1 : ข้อมูลทั่วไป</h3>
    <div id="section1">
		<h6>ตารางที่ 1 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามข้อมูลทั่วไป <a href="" class="excel"></a></h6>
		<table class="tbreport">
		<tr>
			<th>ข้อมูลทั่วไป</th>
			<th>จำนวน</th>
			<th>ร้อยละ</th>
		</tr>
		<tr><td colspan="3"><strong>เพศ</strong></td></tr>
		<tr class="para1">
			<td class="pad-left">ชาย</td>
			<td></td>
			<td></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">หญิง</td>
			<td></td>
			<td></td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td></td>
			<td></td>
		</tr>
		<tr ><td colspan="3"><strong>กลุ่มอายุ</strong></td></tr>
			
		<tr class="para1">
			<td class="pad-left"></td>
			<td></td>
			<td></td>
		</tr>
		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td></td>
			<td></td>		
		</tr>
		<tr class="para1"><td colspan="3" class="pad-left2"></td></tr>
		<tr><td colspan="3"><strong>อาชีพขณะสัมผัสโรค</strong></td></tr>		
		<tr class="para1">
			<td class="pad-left"></td>
			<td></td>
			<td></td>
		</tr>
		
		</table>		
		<hr class="hr1">		
		<div id="btn_printout">&nbsp;พิมพ์รายงาน</div>
		</div> <!-- section1-->
		<p class="page-break"></p>
		 <h3>ส่วนที่ 2 : ตำแหน่งและลักษณะการสัมผัส</h3>
		<div id="section2">
			<h6>ตารางที่ 2 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามสถานที่สัมผัสโรค ลักษณะการสัมผัสโรค และตำแหน่งที่สัมผัส</h6>
			<table class="tbreport">
				<tr>
					<th>การสัมผัส</th>
					<th>จำนวน </th>
					<th>ร้อยละ</th>
				</tr>
				<tr><td colspan="3"><strong>สถานที่สัมผัสโรค</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">เขต กทม.</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เขตเมืองพัทยา</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left" colspan="3">เขตเทศบาล</td>	
				</tr>	
				<tr class="para1">
					<td class="pad-left2">นคร</td>
					<td></td>
					<td></td>			
				</tr>	
				<tr class="para1">
					<td class="pad-left2">เมือง</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left2">ตำบล</td>
					<td></td>
					<td></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left2">ไม่ระบุ</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left" colspan="3">เขตอบต.</td>
				</tr>	
				<tr class="para1">
					<td class="pad-left2">ในชุมชน / ตลาด</td>
					<td></td>
					<td></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left2">ชนบท</td>
					<td></td>
					<td></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left2">ไม่ระบุ</td>
					<td></td>
					<td></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>	
				</tr>

				<tr><td colspan="3"><strong>ลักษณะการสัมผัส</strong></td></tr>
				<tr class="para1">
					<td class="pad-left" colspan="3">ถูกกัด</td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">มีเลือดออก</td>
					<td></td>
					<td></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">ไม่มีเลือดออก</td>
					<td></td>
					<td></td>
			    </tr>			
				<tr class="para1">
					<td class="pad-left" colspan="3">ถูกข่วน</td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">มีเลือดออก</td>
					<td></td>
					<td></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">ไม่มีเลือดออก</td>
					<td></td>
					<td></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left" colspan="3">ถูกเลีย / ถูกข่วน</td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">ที่มีแผล</td>
					<td></td>
					<td></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">ที่ไม่มีแผล</td>
					<td></td>
					<td></td>
			    </tr>			    
				<tr class="para1">
					<td class="pad-left">กินอาหารดิบหรือดื่มน้ำที่สัมผัสเชื้อโรคพิษสุนัขบ้า</td>
					<td></td>
					<td></td>		
				</tr>
				<tr><td colspan="4"><strong>ตำแหน่งที่สัมผัส</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ศีรษะ</td>
					<td></td>
					<td></td>
			    </tr>			    			    
				<tr class="para1">
					<td class="pad-left">หน้า</td>
					<td></td>
					<td></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left">ลำคอ</td>
					<td></td>
					<td></td>
			    </tr>			    			    
				<tr class="para1">
					<td class="pad-left">มือ</td>
					<td></td>
					<td></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left">แขน</td>
					<td></td>
					<td></td>
			    </tr>			    			    
				<tr class="para1">
					<td class="pad-left">ลำตัว</td>
					<td></td>
					<td></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left">ขา</td>
					<td></td>
					<td></td>
			    </tr>			    			    
				<tr class="para1">
					<td class="pad-left">เท้า</td>
					<td></td>
					<td></td>
			    </tr>
			</table>
			<hr class="hr1">					
			<div id="btn_printout">&nbsp;พิมพ์รายงาน</div>

		</div><!-- section2 -->
		<p class="page-break"></p>
		 <h3>ส่วนที่ 3 : สัตว์นำโรค</h3>
		<div id="section3">
			<h6>ตารางที่ 3 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้าแจกแจงตามชนิดและประวัติของสัตว์นำโรค </h6>
			<table class="tbreport">
				<tr>
					<th>ชนิดและประวัติของสัตว์</th>
					<th>จำนวน </th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="3"><strong>ชนิดสัตว์</strong></td></tr>
				
				<tr class="para1">
					<td class="pad-left"></td>
					<td></td>
					<td></td>		
				</tr>
				
				<tr class="para1">
					<td class="pad-left" colspan="3">อื่นๆ</td>
				</tr>
				
				<tr class="para1">
					<td class="pad-left2">></td>
					<td></td>
					<td></td>		
				</tr>
				
				<tr><td colspan="14"><strong>อายุสัตว์</strong></td></tr>
				
				<tr class="para1">			
					<td class="pad-left"></td>						
					<td></td>					
					<td></td>
			
				</tr>
				<tr><td colspan="14"><strong>สถานภาพสัตว์</strong></td></tr>	
				<tr class="para1">
					<td class="pad-left"></td>
					<td></td>
					<td></td>		
				</tr>
				
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>				
				</tr>
				<tr class="page-break"><td colspan="14"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong></td></tr>	
				<tr class="para1">
					<td class="pad-left">กักขังได้ / ติดตามได้</td>	
					<td></td>
					<td></td>
				</tr>
				<tr class="para1">
					<td class="pad-left2">ตายภายใน 10 วัน</td>	
					<td></td>
					<td></td>
				</tr>
				<tr class="para1">
					<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
					<td></td>
					<td></td>
				</tr>	
				<tr class="para1">
					<td class="pad-left">กักขังไม่ได้</td>	
					<td></td>
					<td></td>
		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ถูกฆ่าตาย</td>	
					<td></td>
					<td></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left">หนีหาย / จำไม่ได้</td>	
					<td></td>
					<td></td>
		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>	
					<td></td>
					<td></td>
				</tr>	
				<tr><td colspan="14"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า</strong></td></tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ทราบ</td>						
					<td></td>					
					<td></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่เคยฉีด</td>	
					<td></td>
					<td></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 1 ครั้ง</td>	
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 1 ครั้งสุดท้าย</td>
					<td></td>
					<td></td>			
				</tr>								
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>	
					<td></td>
					<td></td>		
				</tr>													
			</table>
		<hr class="hr1">				
		<div id="btn_printout">&nbsp;พิมพ์รายงาน</div>
		</div><!--section3 -->
		<p class="page-break"></p>
		 <h3>ส่วนที่ 4 : ประวัติการได้รับวัคซีน และการปฏิบัติตนของผู้สัมผัสโรค</h3>
		<div id="section4">
			<h6>ตารางที่ 4  จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามการดูแลบาดแผลและประวัติการได้รับวัคซีน </h6>
			<table class="tbreport">
				<tr>
					<th>การดูแลบาดแผลและประวัติการได้รับวัคซีน</th>
					<th>จำนวน </th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="3"><strong>การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ได้ล้าง</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">ล้าง</td>
					<td></td>
					<td></td>			
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>			
				</tr>
				<tr ><td colspan="3"><strong>วิธีการล้างแผล </strong></td></tr>
				<tr class="para1">
					<td class="pad-left">น้ำ</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">น้ำและสบู่ / ผงซักฟอก</td>
					<td></td>
					<td></td>	
				</tr>	
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td></td>
					<td></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>	
				</tr>
				<tr ><td colspan="3"><strong>การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ได้ใส่ยา</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">ใส่ยา</td>
					<td></td>
					<td></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>		
				</tr>
				<tr ><td colspan="3"><strong>ชนิดยาที่ใช้ใส่ฆ่าเชื้อ </strong></td></tr>
				<tr class="para1">
					<td class="pad-left">สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์ เช่น โพวิดีน เบตาดีน ฯลฯ</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">ทิงเจอร์ไอโอดีน แอลกอฮอล์</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td></td>
					<td></td>		
				</tr>		
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>		
				</tr>
				<tr ><td colspan="3"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัสหรือสงสัยว่าสัมผัส</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 3 เข็มหรือมากกว่า</td>
					<td></td>
					<td><</td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>		
				</tr>					
				<tr ><td colspan="3"><strong>ระยะเวลาที่ฉีดวัคซีน </strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ภายใน 6 เดือน</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">เกิน 6 เดือน</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>		
				</tr>				
			</table>	
			<hr class="hr1">		
			<div id="btn_printout">&nbsp;พิมพ์รายงาน</div>

		</div><!--section4-->
		 <p class="page-break"></p>
		 <h3>ส่วนที่ 5 : การฉีดอิมมูโนโกลบุลินและวัคซีนในครั้งนี้</h3>
		<div id="section5">
			<h6>ตารางที่ 5  จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามการฉีดอิมมูโนโกลบุลินและวัคซีน </h6>
			<table class="tbreport">
				<tr>
					<th>การฉีดอิมมูโนโกลบุลินและวัคซีน</th>
					<th>จำนวน </th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="5"><strong>อิมมูโนโกลบุลิน (RIG)</strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ฉีด</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ฉีด</td>
					<td></td>
					<td></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>		
				</tr>
				<tr ><td colspan="3"><strong>ชนิดของอิมมูโนโกลบูลิน (RIG) </strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ERIG</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">HRIG</td>
					<td></td>
					<td></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>			
				</tr>
				<tr ><td colspan="3"><strong>อาการหลังฉีดอิมมูโกลบูลิน (RIG) </strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่แพ้</td>
					<td></td>
					<td></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left">แพ้</td>
					<td></td>
					<td></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>	
				</tr>
				<tr ><td colspan="3"><strong>อาการแพ้อิมมูโนโกลบูลิน </strong></td></tr>
				<tr class="para1">
					<td class="pad-left">บวมแดง</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">คันบริเวณที่ฉีด</td>
					<td></td>
					<td></td>			
				</tr>	
				<tr class="para1">
					<td class="pad-left">เป็นไข้</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">ปวดศรีษะ</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">เป็นผื่นคันทั่วไป</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ช๊อก</td>
					<td></td>
					<td></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>		
				</tr>
				<tr ><td colspan="3"><strong>ระยะเวลาที่มีอาการแพ้อิมมูโนโกลบุลิน </strong></td></tr>
				<tr class="para1">
					<td class="pad-left">ภายใน 2 ชั่วโมง</td>
					<td></td>
					<td></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">หลัง 2 ชั่วโมง</td>
					<td></td>
					<td></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td></td>
					<td></td>		
				</tr>
			</table>	
			<hr class="hr1">		
			<div id="reference">
			</div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>
		</div><!--section5-->
	</div><!-- multicordion -->

</div><!--report -->