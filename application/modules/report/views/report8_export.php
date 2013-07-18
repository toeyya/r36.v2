
	<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">				  
		<span>รายงานการฉีดวัคซีนและอิมมูโนโกลบุลิน</span><br/>
		<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span><br/>
		<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
		<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?> </span></br>
		<span>เดือน <?php echo $textmonth_start; ?> ปี <?php echo $textyear_start ?> ถึงเดือน <?php echo $textmonth_end; ?> ปี <?php echo $textyear_end ?></span>				
	</div>		
	<div class="right">หน่วย : คน</div>
	<table class="tbreport1" border="1" width="864">
		<tr>
			<td colspan="10" style="text-align:center;" class="B">จำนวนผู้รับการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าและอิมมูโนโกลบูลิน</td>
		</tr>
		<tr style="text-align: center;">
			<td colspan="2">ฉีดวัคซีนครบชุด <br/>(ครบชุด 4-5 เข็ม หรือกระตุ้น)</td>
			<td colspan="2">ฉีดวัคซีนต่ำกว่า 4-5 เข็ม </td>
			<td colspan="2">ฉีดวัคซีนไม่ครบชุด </td>
			<td colspan="2">ฉีดวัคซีนรวม</td>
			<td rowspan="2">ไม่ฉีดวัคซีน </td>
			<td rowspan="2">ฉีดอิมมูโนโกลบูลิน (RIG)</td>
		</tr>
		<tr>
			<td class="topic">IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>
			<td>IM</td>
			<td>ID</td>

		</tr>
		<tr>
			<td><? echo number_format($total1); ?></td>
			<td><? echo number_format($total2); ?></td>
			<td><? echo number_format($total3); ?></td>
			<td><? echo number_format($total4); ?></td>
			<td><? echo number_format($total5); ?></td>
			<td><? echo number_format($total6); ?></td>
			<td><? echo number_format($total7); ?></td>
			<td><? echo number_format($total8); ?></td>
			<td><? echo number_format($total9); ?></td>
			<td><? echo number_format($total10); ?></td>
		</tr>
	</table>	
	
	<div id="description" style="text-align:center;width:400px;">
		<table class="tbdesc" width="864">
			<tr>
				<th>ฉีดวัคซีนครบชุด<br/>(ครบชุด 4-5 เข็ม หรือกระตุ้น)</th>
				<td><strong>หมายถึง </strong> <ul style="width:864;">
					<li>ผู้สัมผัสโรคที่ได้รับวัคซีนป้องกันโรคพิษสุนัขบ้าตามคู่มือสร้างเสริมภูมิคุ้มกันโรคของกรมควบคุมโรค กระทรวงสาธารณสุข จนครบชุดเข้ากล้ามเนื้อ 5 เข็ม หรือเข้าในผิวหนังแบบ 4 เข็ม (2-2-2-0-2)</li>
    				<li>ผู้สัมผัสโรคที่ได้รับการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้ากระตุ้น 1 หรือ 2 เข็ม หลังถูกสุนัขกัด เนื่องจากเคยได้รับ ฉีดวัคซีนป้องกันโรคพิษสุนัขบ้ามาก่อน ตั้งแต่ 3 เข็มขึ้นไป ภายในระยะเวลา 6 เดือน หรือเกิน 6 เดือน</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th>ฉีดวัคซีนต่ำกว่า <br/>4 หรือ 5 เข็ม</th>
				<td><strong>หมายถึง </strong>ผู้สัมผัสโรคที่ได้รับการฉีดวัคซีนฯ พร้อมกับสังเกตอาการสุนัขหรือแมว แล้วสุนัขหรือแมวมีอาการปกติใน 10 วัน จึงหยุดฉีด</td>
			</tr>
			<tr>
				<th>ฉีดไม่ครบชุด</th>
				<td><strong>หมายถึง </strong> ผู้สัมผัสโรคพิษสุนัขบ้าที่ได้รับการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าหลังสัมผัสโรคไม่ครบตามคู่มือสร้างเสริมภูมิคุ้มกัน โรคของกรมควบคุมโรค กระทรวงสาธารณสุข</td>
			</tr>
			<tr>
				<th>ช่วงเวลา</th>
				<td><strong>หมายถึง </strong> ระยะเวลาของข้อมูลที่ต้องการ เช่น ม.ค. 2555 - ธ.ค. 2555 หรือ ม.ค. 2555 - มี.ค. 2556</td>
			</tr>
		</table>							
	</div>
	<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>	