<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">					  
	<span>รายงานผู้สัมผัสโรคในภาพรวม</span><br/>
	<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span></br>
	<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
	<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></span>				
</div>

		
<h3>ส่วนที่ 2 : ตำแหน่งและลักษณะการสัมผัส</h3>		
<h6>ตารางที่ 2 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามสถานที่สัมผัสโรค ลักษณะการสัมผัสโรค และตำแหน่งที่สัมผัส </h6>
<table class="tbreport"  border="1" width="864">
	<tr>
		<th>การสัมผัส</th>
		<th>จำนวน (N=<?php echo $total_n; ?>)</th>
		<th>ร้อยละ</th>
	</tr>
	<tr><td colspan="3"><strong>สถานที่สัมผัสโรค</strong>
		
	</td></tr>
	<tr class="para1">
		<td style="padding-left:10px;">เขต กทม.</td>
		<td><?php echo number_format($total_placetouch10); ?></td>
		<td><?php echo compute_percent($total_placetouch10,$total_n); ?></td>		
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">เขตเมืองพัทยา</td>
		<td><?php echo number_format($total_placetouch20); ?></td>
		<td><?php echo compute_percent($total_placetouch20,$total_n); ?></td>		
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">เขตเทศบาล</td><? $total1 = $total_placetouch31+$total_placetouch32+$total_placetouch33 ?>
		<td><?php echo number_format($total1); ?></td>
		<td><?php  echo compute_percent($total1,$total_n); ?></td>
			
	</tr>	
	<tr class="para1">
		<td class="pad-left2">นคร</td>
		<td><?php echo number_format($total_placetouch31); ?></td>
		<td><?php echo compute_percent($total_placetouch31,$total_n); ?></td>			
	</tr>	
	<tr class="para1">
		<td class="pad-left2">เมือง</td>
		<td><?php echo number_format($total_placetouch32); ?></td>
		<td><?php echo compute_percent($total_placetouch32,$total_n); ?></td>		
	</tr>
	<tr class="para1">
		<td class="pad-left2">ตำบล</td>
		<td><?php echo number_format($total_placetouch33); ?></td>
		<td><?php echo compute_percent($total_placetouch33,$total_n); ?></td>		
	</tr>	
	<tr class="para1">
		<td class="pad-left2">ไม่ระบุ</td>
		<td><?php echo number_format($total_placetouch30); ?></td>
		<td><?php echo compute_percent($total_placetouch30,$total_n); ?></td>			
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">เขตอบต.</td><? $total2 = $total_placetouch41+$total_placetouch42+$total_placetouch40 ?>
		<td><?php echo number_format($total2); ?></td>
		<td><?php echo compute_percent($total2,$total_n);?></td>					
	</tr>	
	<tr class="para1">
		<td class="pad-left2">ในชุมชน / ตลาด</td>
		<td><?php echo number_format($total_placetouch41); ?></td>
		<td><?php echo compute_percent($total_placetouch41,$total_n); ?></td>	
	</tr>
	<tr class="para1">
		<td class="pad-left2">ชนบท</td>
		<td><?php echo number_format($total_placetouch42); ?></td>
		<td><?php echo compute_percent($total_placetouch42,$total_n); ?></td>	
	</tr>
	<tr class="para1">
		<td class="pad-left2">ไม่ระบุ</td>
		<td><?php echo number_format($total_placetouch40); ?></td>
		<td><?php echo compute_percent($total_placetouch40,$total_n); ?></td>	
	</tr>
	<tr class="para1">
		<td style="padding-left:10px;">ไม่ระบุ</td>
		<td><?php echo number_format($total_placetouch00); ?></td>
		<td><?php echo compute_percent($total_placetouch00,$total_n); ?></td>	
	</tr>
<tr><td colspan="3"><strong>ลักษณะการสัมผัส</strong><strong>(n=<?php echo number_format($totaltouch); ?>)</strong>
		
	</td></tr>
	<tr class="para1">
		<td style="padding-left:10px;" colspan="3">ถูกกัด</td>
    </tr>
	<tr class="para1">
		<td class="pad-left2">มีเลือดออก</td>
		<td><?php echo number_format($bite_blood); ?></td>
		<td><?php echo compute_percent($bite_blood,$totaltouch); ?></td>	
    </tr>
	<tr class="para1">
		<td class="pad-left2">ไม่มีเลือดออก</td>
		<td><?php echo number_format($bite_noblood); ?></td>
		<td><?php echo compute_percent($bite_noblood,$totaltouch); ?></td>	
    </tr>			
	<tr class="para1">
		<td style="padding-left:10px;" colspan="3">ถูกข่วน</td>
    </tr>
	<tr class="para1">
		<td class="pad-left2">มีเลือดออก</td>
		<td><?php echo number_format($lick_blood); ?></td>
		<td><?php echo compute_percent($lick_blood,$totaltouch); ?></td>	
    </tr>
	<tr class="para1">
		<td class="pad-left2">ไม่มีเลือดออก</td>
		<td><?php echo number_format($lick_noblood); ?></td>
		<td><?php echo compute_percent($lick_noblood,$totaltouch); ?></td>	
    </tr>
	<tr class="para1">
		<td style="padding-left:10px;" colspan="3">ถูกเลีย / ถูกข่วน</td>
    </tr>
	<tr class="para1">
		<td class="pad-left2">ที่มีแผล</td>
		<td><?php echo number_format($claw_blood); ?></td>
		<td><?php echo compute_percent($claw_blood,$totaltouch); ?></td>	
    </tr>
	<tr class="para1">
		<td class="pad-left2">ที่ไม่มีแผล</td>
		<td><?php echo number_format($claw_noblood); ?></td>
		<td><?php echo compute_percent($claw_noblood,$totaltouch); ?></td>	
    </tr>			    
	<tr class="para1">
		<td style="padding-left:10px;">กินอาหารดิบหรือดื่มน้ำที่สัมผัสเชื้อโรคพิษสุนัขบ้า</td>
		<td><?php echo number_format($total_food); ?></td>
		<td><?php echo compute_percent($total_food,$total_n); ?></td>		
	</tr>			
	<tr><td colspan="3"><strong>ตำแหน่งที่สัมผัส</strong><strong>(n=<?php echo number_format($total_position); ?>)</strong>	
	</td></tr>
	<tr class="para1">
		<td style="padding-left:10px;">ศีรษะ</td>
		<td><?php echo number_format($rs['head']); ?></td>
		<td><?php echo compute_percent($rs['head'],$total_position); ?></td>
    </tr>			    			    
	<tr class="para1">
		<td style="padding-left:10px;">หน้า</td>
		<td><?php echo number_format($rs['face']); ?></td>
		<td><?php echo compute_percent($rs['face'],$total_position); ?></td>
    </tr>
	<tr class="para1">
		<td style="padding-left:10px;">ลำคอ</td>
		<td><?php echo number_format($rs['neck']); ?></td>
		<td><?php echo compute_percent($rs['neck'],$total_position); ?></td>
    </tr>			    			    
	<tr class="para1">
		<td style="padding-left:10px;">มือ</td>
		<td><?php echo number_format($rs['hand']); ?></td>
		<td><?php echo compute_percent($rs['hand'],$total_position); ?></td>
    </tr>
	<tr class="para1">
		<td style="padding-left:10px;">แขน</td>
		<td><?php echo number_format($rs['arm']); ?></td>
		<td><?php echo compute_percent($rs['arm'],$total_position); ?></td>
    </tr>			    			    
	<tr class="para1">
		<td style="padding-left:10px;">ลำตัว</td>
		<td><?php echo number_format($rs['body']); ?></td>
		<td><?php echo compute_percent($rs['body'],$total_position); ?></td>
    </tr>
	<tr class="para1">
		<td style="padding-left:10px;">ขา</td>
		<td><?php echo number_format($rs['leg']); ?></td>
		<td><?php echo compute_percent($rs['leg'],$total_position); ?></td>
    </tr>			    			    
	<tr class="para1">
		<td style="padding-left:10px;">เท้า</td>
		<td><?php echo number_format($rs['feet']); ?></td>
		<td><?php echo compute_percent($rs['feet'],$total_position); ?></td>
    </tr>

</table>
<hr class="hr1">		
<div id="reference"><?php echo $reference?></div>						

