<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">					  
	<span>รายงานผู้สัมผัสโรคในภาพรวม</span><br/>
	<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span></br>
	<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
	<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></span>				
</div>
<h3>ส่วนที่ 5 : การฉีดอิมมูโนโกลบุลินและวัคซีนในครั้งนี้</h3>
<h6>ตารางที่ 5  จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามการฉีดอิมมูโนโกลบุลินและวัคซีน </h6>
	<table class="tbreport" border="1" width="864">
		<tr>
			<th>การฉีดอิมมูโนโกลบุลินและวัคซีน</th>
			<th>จำนวน (N=<?php echo $total_n;  ?>)</th>
			<th>ร้อยละ</th>
		</tr>
		<tr ><td colspan="3"><strong>อิมมูโนโกลบุลิน (RIG)</strong></td></tr>
		<tr class="para1">
			<td style="padding-left:10px;">ไม่ฉีด</td>
			<td><?php echo number_format($total_rig10);?></td>
			<td><?php echo compute_percent($total_rig10,$total_n); ?></td>		
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">ฉีด</td>
			<td><?php echo number_format($total_rig_all);?></td>
			<td><?php echo compute_percent($total_rig_all,$total_n); ?></td>		
		</tr>	
		<tr class="para1">
			<td style="padding-left:10px;">ไม่ระบุ</td>
			<td><?php echo number_format($total_rig00);?></td>
			<td><?php echo number_format($total_rig00);?></td>		
		</tr>				
		<tr ><td colspan="3"><strong>ชนิดของอิมมูโนโกลบูลิน (RIG) </strong><strong> (n=<? echo $total_rig_all; ?>)</strong>								
		</td></tr>
		<tr class="para1">
			<td style="padding-left:10px;">ERIG</td>
			<td><?php echo number_format($total_rig21);?></td>
			<td><?php echo compute_percent($total_rig21,$total_rig_all); ?></td>		
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">HRIG</td>
			<td><?php echo number_format($total_rig22);?></td>
			<td><?php echo compute_percent($total_rig22,$total_rig_all); ?></td>		
		</tr>	
		<tr class="para1">
			<td style="padding-left:10px;">ไม่ระบุ</td>
			<td><?php echo number_format($total_rig20);?></td>
			<td><?php echo compute_percent($total_rig20,$total_rig_all); ?></td>			
		</tr>								
		<tr ><td colspan="3"><strong>อาการหลังฉีดอิมมูโกลบูลิน (RIG) </strong><strong>(n=<?php echo number_format($total_afterrig_all) ?>)</strong></td></tr>
		<tr class="para1">
			<td style="padding-left:10px;">ไม่แพ้</td>
			<td><?php echo number_format($total_afterrig1);?></td>
			<td><?php echo compute_percent($total_afterrig1,$total_afterrig_all); ?></td>	
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">แพ้</td>
			<td><?php echo number_format($total_afterrig2);?></td>
			<td><?php echo compute_percent($total_afterrig2,$total_afterrig_all); ?></td>		
		</tr>	
		<tr class="para1">
			<td style="padding-left:10px;">ไม่ระบุ</td>
			<td><?php echo number_format($total_afterrig0);?></td>
			<td><?php echo compute_percent($total_afterrig0,$total_afterrig_all); ?></td>	
		</tr>
						
		<tr><td colspan="3"><strong>อาการแพ้อิมมูโนโกลบูลิน </strong><strong>(n= <?php echo number_format($total_detail) ?>)</strong>								
		</td></tr>
		<tr class="para1">
			<td style="padding-left:10px;">บวมแดง</td>
			<td><?php echo number_format($total_detail1);?></td>
			<td><?php echo compute_percent($total_detail1,$total_detail); ?></td>			
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">คันบริเวณที่ฉีด</td>
			<td><?php echo number_format($total_detail2);?></td>
			<td><?php echo compute_percent($total_detail2,$total_detail); ?></td>			
		</tr>	
		<tr class="para1">
			<td style="padding-left:10px;">เป็นไข้</td>
			<td><?php echo number_format($total_detail3);?></td>
			<td><?php echo compute_percent($total_detail3,$total_detail); ?></td>			
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">ปวดศรีษะ</td>
			<td><?php echo number_format($total_detail4);?></td>
			<td><?php echo compute_percent($total_detail4,$total_detail); ?></td>			
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">เป็นผื่นคันทั่วไป</td>
			<td><?php echo number_format($total_detail5);?></td>
			<td><?php echo compute_percent($total_detail5,$total_detail); ?></td>		
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">ช๊อก</td>
			<td><?php echo number_format($total_detail6);?></td>
			<td><?php echo compute_percent($total_detail6,$total_detail); ?></td>			
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">อื่นๆ</td>
			<td><?php echo number_format($total_detail7);?></td>
			<td><?php echo compute_percent($total_detail7,$total_detail); ?></td>		
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">ไม่ระบุ</td>
			<td><?php echo number_format($total_detailno);?></td>
			<td><?php echo compute_percent($total_detailno,$total_detail); ?></td>		
		</tr>
	
		<tr ><td colspan="3"><strong>ระยะเวลาที่มีอาการแพ้อิมมูโนโกลบุลิน </strong><strong>(n= <?php echo number_format($total_longfeel); ?>)</strong>
		</td></tr>
		<tr class="para1">
			<td style="padding-left:10px;">ภายใน 2 ชั่วโมง</td>
			<td><?php echo number_format($total_longfeel1);?></td>
			<td><?php echo compute_percent($total_longfeel1,$total_longfeel); ?></td>		
		</tr>
		<tr class="para1">
			<td style="padding-left:10px;">หลัง 2 ชั่วโมง</td>
			<td><?php echo number_format($total_longfeel2);?></td>
			<td><?php echo compute_percent($total_longfeel2,$total_longfeel); ?></td>		
		</tr>	
		<tr class="para1">
			<td style="padding-left:10px;">ไม่ระบุ</td>
			<td><?php echo number_format($total_longfeel0);?></td>
			<td><?php echo compute_percent($total_longfeel0,$total_longfeel); ?></td>		
		</tr>
	</table>	
	<hr class="hr1">		
	<div id="reference"><?php echo $reference?></div>			

