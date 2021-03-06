
	<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">					  
		<span>รายงานผู้สัมผัสโรครายไตรมาส</span><br/>
	    <span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span><br/>
		<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span><br/>
		<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></span><br/>				
	</div>
	<table class="tbreport"  border="1" width="864"> 
		<thead>
		<tr><td colspan="6" style="text-align:right;">หน่วย:ราย</td></tr>
		<tr>
			<th rowspan="2">ข้อมูล</th>
			<th colspan="5">ไตรมาส (N=<?php echo number_format($total_n); ?>)</th>
		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th >รวม</th>
		</tr>
		</thead>
		<tbody>
		<tr class="para1">
			<td align="left"><strong>ผู้สัมผัสโรคพิษสุนัขบ้า</strong></td>
			<td><? echo number_format($q1) ?></td>
			<td><? echo number_format($q2) ?></td>
			<td><? echo number_format($q3) ?></td>
			<td><? echo number_format($q4) ?></td>
			<td><? echo number_format($total_n); ?></td>
		</tr>
		<?  $i=0;
			foreach($module as $field =>$name): ?>
			<tr ><td colspan="6"><strong><? echo $name; ?></strong>
				<input type="hidden" name="render" value="container<?php echo $i=$i+1; ?>">
				<button class="bar-chart img" name="bar"></button>
				<button class="column-chart img" name="column"></button>
		    	<button class="pie-chart img" name="pie"></button>	
			</td></tr>
			<? foreach(${$field} as $key =>$i): ?>
			<tr class="para1">
				<td class="pad-left"><? echo $i ?></td>		
				<? for($j=1;$j<5;$j++): ?>
					<td><? echo number_format(${$field.$key.$j}) ?><p class="percentage"><?php echo compute_percent(${$field.$key.$j},${'q'.$j}); ?></p></td>
				<? endfor; ?>
				<td><? echo number_format(${$field.$key}); ?></td>
			</tr>
			<? endforeach; ?>
		<? endforeach; ?>		

				<tr><td colspan="5"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong></td></tr>	
				<tr class="para1">
					<td class="pad-left" colspan="3">กักขังได้ / ติดตามได้</td>	
				</tr>
				<tr class="para1">
					<td class="pad-left2">ตายภายใน 10 วัน</td>
					<? for($j=1;$j<5;$j++): ?>	
					<td><?php echo number_format(${'total_detain11'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain11'.$j},${'q'.$j}); ?></p></td>					
					<? endfor; ?>
					<td><? echo number_format($total_detain_all11); ?></td>
				</tr>
				<tr class="para1">
					<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_detain12'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain12'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>
					<td><? echo number_format($total_detain_all12); ?></td>
				</tr>	
				<tr class="para1">
					<td class="pad-left">กักขังไม่ได้</td>
					<? for($j=1;$j<5;$j++): ?>	
					<td><?php echo number_format(${'total_detain20'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain20'.$j},${'q'.$j}); ?></p></td>					
					<? endfor; ?>
					<td><? echo number_format($total_detain_all20); ?></td>
				</tr>	
				<tr class="para1">
					<td class="pad-left">ถูกฆ่าตาย</td>	
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_detain30'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain30'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>
					<td><? echo number_format($total_detain_all30); ?></td>
				</tr>
				<tr class="para1">
					<td class="pad-left">หนีหาย / จำไม่ได้</td>
					<? for($j=1;$j<5;$j++): ?>	
					<td><?php echo number_format(${'total_detain40'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain40'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>
					<td><? echo number_format($total_detain_all40); ?></td>
				</tr>	
				<tr class="para1">					
					<td class="pad-left">ไม่ระบุ</td>
					<? for($j=1;$j<5;$j++): ?>	
					<td><?php echo number_format(${'total_detain00'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain00'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>
					<td><? echo number_format($total_detain_all00); ?></td>
				</tr>	
			<tr class="tr-graph">
			  	<td colspan="3">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container10" class="container"></div> 			
			  		</div>
			  	</td>
			</tr>
				<tr><td colspan="6"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า</strong></td></tr>			
				<tr class="para1">
					<td class="pad-left">ไม่ทราบ</td>	
					<? for($j=1;$j<5;$j++): ?>					
					<td><?php echo number_format(${'total_vaccinedog10'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_vaccinedog10'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all10); ?></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่เคยฉีด</td>	
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_vaccinedog20'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_vaccinedog20'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all20); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 1 ครั้ง</td>						
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_vaccinedog30'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_vaccinedog30'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all30); ?></td>								
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 1 ครั้งสุดท้าย</td>
					<? for($j=1;$j<5;$j++): ?>
					<td><?php 
					$total4 = ${'total_vaccinedog41'.$j}+${'total_vaccinedog42'.$j};
					echo number_format($total4); ?><p class="percentage"><?php echo compute_percent($total4,${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all41+$total_vaccinedog_all42); ?></td>			
				</tr>								
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>					
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_vaccinedog00'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_vaccinedog00'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all00); ?></td>								
				</tr>
			<tr><td colspan="6"><strong>สาเหตุที่ถูกกัด</strong></td></tr>	
				<tr class="para1">
					<td class="pad-left">ถูกกัดโดยไม่มีสาเหตุโน้มนำ</td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_reason10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason10'.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format($total_reason_all10); ?></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left" colspan="6">ถูกกัดโดยมีสาเหตุโน้มนำ</td>
					<?php $reason = array(1=>'ทำให้สัตว์เจ็บปวด โมโห หรือตกใจ',2=>'พยายามแยกสัตว์ที่กำลังต่อสู้กัน',3=>'เข้าใกล้สัตว์แม่ลูกอ่อน',4=>'รบกวนสัตว์ขณะกินอาหาร',5=>'เข้าไปในบริเวณที่สัตว์คิดว่าเป็นเจ้าของ',6=>'อื่นๆ'); ?>				
				</tr>		
				<?php for($i=1;$i<7;$i++): ?>
				<tr class="para1">
					<td class="pad-left2"><?php echo $reason[$i]; ?></td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_reason2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason2'.$i.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format(${'total_reason_all2'.$i}); ?></td>
				</tr>
				<?php endfor; ?>
				<tr class="para1">
					<td class="pad-left2">ไม่ระบุ</td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_reason20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason20'.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format($total_reason_all20); ?> </td>
				</tr>		
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_reason00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason00'.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format($total_reason_all00); ?> </td>
				</tr>				
				
				<tr><td colspan="6"><strong>การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>	
					<tr class="para1">
						<td class="pad-left">ไม่ได้ล้าง</td>	
						<?php  for($j=1;$j<5;$j++): ?>
						<td><?php echo number_format(${'total_wash10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash10'.$j},${'q'.$j}); ?></p></td>
						<?php endfor; ?>
						<td><?php echo number_format($total_wash_all10); ?></p></td>
			
					</tr>				
					<tr class="para1">
						<td class="pad-left" colspan="6">ล้าง</td>	
						<?php $wash = array(1=>'น้ำ',2=>'น้ำและสบู่ / ผงซักฟอก',3=>'อื่นๆ'); ?>							
					</tr>
					<?php for($i=1;$i<4;$i++): ?>
					<tr class="para1">
						<td class="pad-left2"><?php echo $wash[$i]; ?></td>	
						<?php  for($j=1;$j<5;$j++): ?>
						<td><?php echo number_format(${'total_wash2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash2'.$i.$j},${'q'.$j}); ?></p></td>
						<?php endfor; ?>
						<td><?php echo number_format(${'total_wash_all2'.$i}); ?></p></td>
					</tr>	
					<?php endfor; ?>
					<tr class="para1">
						<td class="pad-left2">ไม่ระบุ</td>	
						<?php  for($j=1;$j<5;$j++): ?>
						<td><?php echo number_format(${'total_wash20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash20'.$j},${'q'.$j}); ?></p></td>
						<?php endfor; ?>
						<td><?php echo number_format($total_wash_all20); ?></p></td>
			
					</tr>		
					<tr class="para1">
						<td class="pad-left">ไม่ระบุ</td>	
						<?php  for($j=1;$j<5;$j++): ?>
						<td><?php echo number_format(${'total_wash00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash00'.$j},${'q'.$j}); ?></p></td>
						<?php endfor; ?>
						<td><?php echo number_format($total_wash_all00); ?> </p></td>			
					</tr>	
					<tr><td colspan=""><strong>การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</strong></td></tr>	
						<tr class="para1">
							<td class="pad-left">ไม่ได้ใส่ยา</td>	
							<?php  for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_drug10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug10'.$j},${'q'.$j}); ?></p></td>
							<?php endfor; ?>
							<td><?php echo number_format($total_drug_all10); ?></td>
				
						</tr>	
						<tr class="para1"><td class="pad-left" colspan="6">ใส่ยา</td>	</tr>
						<?php $drug = array(1=>'สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์ฯ',2=>'ทิงเจอร์ไอโอดีนแอลกอฮอล์ฯ',3=>'อื่นๆ'); ?>
						<?php for($i=1;$i<4;$i++): ?>
						<tr class="para1">
							<td class="pad-left2"><?php echo $drug[$i]; ?></td>	
							<?php  for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_drug2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug2'.$i.$j},${'q'.$j}); ?></p></td>
							<?php endfor; ?>
							<td><?php echo number_format(${'total_drug_all2'.$i}); ?></td>
						</tr>	
						<?php endfor; ?>
						<tr class="para1">
							<td class="pad-left2">ไม่ระบุ</td>	
							<?php  for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_drug20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug20'.$j},${'q'.$j}); ?></p></td>
							<?php endfor; ?>
							<td><?php echo number_format($total_drug_all20); ?> </td>
				
						</tr>		
						<tr class="para1">
							<td class="pad-left">ไม่ระบุ</td>	
							<?php  for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_drug00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug00'.$j},${'q'.$j}); ?></p></td>
							<?php endfor; ?>
							<td><?php echo number_format($total_drug_all00); ?> </td>				
						</tr>	
						<tr><td colspan="6"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัส</strong></td></tr>			
						<tr class="para1">
							<td class="pad-left">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม</td>	
							<? for($j=1;$j<5;$j++): ?>					
							<td><?php echo number_format(${'total_historyprotect10'.$j}); ?><p><?php echo compute_percent(${'total_historyprotect10'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all10); ?></td>
				
						</tr>
						<tr class="para1">
							<td class="pad-left" colspan="3">เคยฉีด 3 เข็มหรือมากกว่า</td>		
						</tr>
						<tr class="para1">
							<td class="pad-left2">ภายใน 6 เดือน</td>						
							<? for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_historyprotect21'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect21'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all21); ?></td>								
						</tr>
						<tr class="para1">
							<td class="pad-left2">เกิน 6 เดือน</td>
							<? for($j=1;$j<5;$j++): ?>
							<td><?php 							
							echo number_format(${'total_historyprotect22'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect22'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all22); ?></td>			
						</tr>
						<tr class="para1">
							<td class="pad-left2">ไม่ระบุ</td>
							<? for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_historyprotect20'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect20'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all20); ?></td>			
						</tr>								
						<tr class="para1">
							<td class="pad-left">ไม่ระบุ</td>					
							<? for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_historyprotect00'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect00'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all00); ?></td>								
						</tr>	
					<tr><td colspan="6"><strong>วิธีการฉีดวัคซีน</strong>
						<input type="hidden" name="render" value="container16">
						<button class="bar-chart img" name="bar" ></button>
						<button class="column-chart img" name="column"></button></td>
					</tr>
				<?php $vaccine = array(1=>'เข้ากล้ามเนื้อ',2=>'เข้าผิวหนัง',3=>'ไม่ฉีด');?>	
				<?php for($i=1;$i<4;$i++): ?>	
				<tr class="para1">
					<td class="pad-left"><?php echo $vaccine[$i]; ?></td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_means'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_means'.$i.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format(${'total_means_all'.$i}); ?> </td>		
				</tr>
				<?php endfor; ?>							
		<tr><td colspan="6"><strong>ชนิดวัคซีน</strong></td></tr>
		<?php $vaccine = array(1=>'PVRV',2=>'PCEC',3=>'HDCV',4=>'PDEV');?>	
		<?php for($i=1;$i<5;$i++): ?>	
		<tr class="para1">
			<td class="pad-left"><?php echo $vaccine[$i]; ?></td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_vaccine'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccine'.$i.$j},${'q'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_vaccine_all'.$i}); ?> </td>		
		</tr>
		<?php endfor; ?>	

		<tr><td colspan="6"><strong>การแพ้วัคซีน</strong></td></tr>
		<?php $vaccine = array('1'=>'ไม่มี','2'=>'มี');
			for($i=1;$i<3;$i++): ?>
		<tr class="para1">			
			<td class="pad-left"><?php echo $vaccine[$i] ?></td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_aftervaccine'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_aftervaccine'.$i.$j},${'q'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_aftervaccine_all'.$i}); ?></td>		
		</tr>
		<?php endfor; ?>												
		</tbody>				
	</table>
			<hr class="hr1">
		<div id="reference"><?php echo $reference?></div>			
