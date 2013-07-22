<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">					  
	<span>รายงานผู้สัมผัสโรคในภาพรวม</span><br/>
	<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span></br>
	<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
	<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></span>				
</div>
<h3>ส่วนที่ 4 : ประวัติการได้รับวัคซีน และการปฏิบัติตนของผู้สัมผัสโรค</h3>
<h6>ตารางที่ 4  จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามการดูแลบาดแผลและประวัติการได้รับวัคซีน</h6>
<table class="tbreport" border="1" width="864">
	<tr>
		<th>การดูแลบาดแผลและประวัติการได้รับวัคซีน</th>
		<th>จำนวน (N=<?php echo $total_n; ?>)</th>
		<th>ร้อยละ</th>
	</tr>
	<tr ><td colspan="3"><strong>การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ได้ล้าง</td>
		<td><?php echo number_format($total_wash1); ?></td>
		<td><?php echo compute_percent($total_wash1,$total_n); ?></td>			
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">ล้าง</td>
		<td><?php echo number_format($total_wash2); ?></td>
		<td><?php echo compute_percent($total_wash2,$total_n); ?></td>			
	</tr>	
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>
		<td><?php echo number_format($total_wash0); ?></td>
		<td><?php echo compute_percent($total_wash0,$total_n); ?></td>			
	</tr>

	<tr ><td colspan="3"><strong>วิธีการล้างแผล </strong><strong>(n=<?php echo number_format($total_washdetail_all); ?>)</strong>									
	</td></tr>
	<tr class="para1">
		<td style="padding-left:10px;">น้ำ</td>
		<td><?php echo number_format($total_washdetail1); ?></td>
		<td><?php echo compute_percent($total_washdetail1,$total_washdetail_all); ?></td>		
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">น้ำและสบู่ / ผงซักฟอก</td>
		<td><?php echo number_format($total_washdetail2); ?></td>
		<td><?php echo compute_percent($total_washdetail2,$total_washdetail_all); ?></td>	
	</tr>	
	<tr class="para1">
		<td style="padding-left:10px;">อื่นๆ</td>
		<td><?php echo number_format($total_washdetail3); ?></td>
		<td><?php echo compute_percent($total_washdetail3,$total_washdetail_all); ?></td>	
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>
		<td><?php echo number_format($total_washdetail0); ?></td>
		<td><?php echo compute_percent($total_washdetail0,$total_washdetail_all); ?></td>	
	</tr>
	<tr><td colspan="3"><strong>การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</strong>	</td></tr>
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ได้ใส่ยา</td>
		<td><?php echo number_format($total_drug1); ?></td>
		<td><?php echo compute_percent($total_drug1,$total_n); ?></td>			
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">ใส่ยา</td>
		<td><?php echo number_format($total_drug2); ?></td>
		<td><?php echo compute_percent($total_drug2,$total_n); ?></td>		
	</tr>	
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>
		<td><?php echo number_format($total_drug0); ?></td>
		<td><?php echo compute_percent($total_drug0,$total_n); ?></td>		
	</tr>
	<tr><td colspan="3"><strong>ชนิดยาที่ใช้ใส่ฆ่าเชื้อ </strong><strong>(n = <? echo number_format($total_drugdetail_all) ?>)</strong>				
	</td></tr>
	<tr class="para1">
		<td style="padding-left:10px;">สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์ เช่น โพวิดีน เบตาดีน ฯลฯ</td>
		<td><?php echo number_format($total_drugdetail1); ?></td>
		<td><?php echo compute_percent($total_drugdetail1,$total_n); ?></td>			
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">ทิงเจอร์ไอโอดีน แอลกอฮอล์</td>
		<td><?php echo number_format($total_drugdetail2); ?></td>
		<td><?php echo compute_percent($total_drugdetail2,$total_n); ?></td>		
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">อื่นๆ</td>
		<td><?php echo number_format($total_drugdetail3); ?></td>
		<td><?php echo compute_percent($total_drugdetail3,$total_n); ?></td>		
	</tr>		
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>
		<td><?php echo number_format($total_drugdetail0); ?></td>
		<td><?php echo compute_percent($total_drugdetail0,$total_n); ?></td>		
	</tr>

	<tr ><td colspan="3"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัสหรือสงสัยว่าสัมผัส</strong></td></tr>
	<tr class="para1">
		<td style="padding-left:10px;">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม</td>
		<td><?php echo number_format($total_protect10); ?></td>
		<td><?php echo compute_percent($total_protect10,$total_n); ?></td>			
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">เคยฉีด 3 เข็มหรือมากกว่า</td>
		<td><?php echo number_format($total_protect20); ?></td>
		<td><?php echo compute_percent($total_protect20,$total_n); ?></td>		
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>
		<td><?php echo number_format($total_protect00); ?></td>
		<td><?php echo compute_percent($total_protect00,$total_n); ?></td>		
	</tr>					
	<tr ><td colspan="3"><strong>ระยะเวลาที่ฉีดวัคซีน </strong><strong>(n= <? echo number_format($total_protect_all); ?>)</strong></td></tr>
	<tr class="para1">
		<td style="padding-left:10px;">ภายใน 6 เดือน</td>
		<td><?php echo number_format($total_protect21); ?></td>
		<td><?php echo compute_percent($total_protect21,$total_protect_all); ?></td>			
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">เกิน 6 เดือน</td>
		<td><?php echo number_format($total_protect22); ?></td>
		<td><?php echo compute_percent($total_protect22,$total_protect_all); ?></td>		
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>
		<td><?php echo number_format($total_protect20); ?></td>
		<td><?php echo compute_percent($total_protect20,$total_protect_all); ?></td>		
	</tr>				
</table>		
<hr class="hr1">		
<div id="reference"><?php echo $reference?></div>	
		 