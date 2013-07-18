
<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">				  
	<span>รายงานผู้สัมผัสโรคจำแนกตามสิทธิการรักษาของสถานบริการ <?php echo $texttype;?></span>
 	<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span><br/>
	<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
	<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?> เดือน  <?php echo $textmonth_start;?></span>					
</div>
<table class="tbreport">         
  <tr>
    <th style="text-align: center" rowspan="2"><strong>รายการ</strong></th>
    <th colspan="2" style="text-align:center"><strong>สิทธิการรักษา</strong></th>
  </tr>
  <tr>          	
    <th align="center"><strong>สถานบริการนี้</strong></th>
    <th align="center"><strong>สถานบริการอื่น</strong></th>
  </tr> 
  <tr>
    <td><strong> จำนวนผู้สัมผัสโรค ( N = <?php echo number_format($in_out1+$in_out2); ?> )</strong></td>
    <td align="center"><strong><?php echo number_format($in_out1); ?></strong></td>
    <td align="center"><strong><?php echo number_format($in_out2); ?></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong> สัญชาติ (คน) </strong></td>  
  </tr>
  <tr >
    <td><span class="para1">ไทย</span></td>
    <td align="center"><?php echo number_format($in_out3); ?></td>
    <td align="center"><?php echo number_format($in_out14); ?></td>
  </tr>
  <tr>
    <td><span class="para1">จีน/ฮ่องกง/ใต้หวัน</span></td>
    <td align="center"><?php echo number_format($in_out4); ?></td>
    <td align="center"><?php echo number_format($in_out15); ?></td>
  </tr>
  <tr>
    <td><span class="para1">พม่า</span></td>
    <td align="center"><?php echo number_format($in_out5); ?></td>
    <td align="center"><?php echo number_format($in_out16); ?></td>
  </tr>
  <tr>
    <td><span class="para1">มาเลเซีย</span></td>
    <td align="center"><?php echo number_format($in_out6); ?></td>
    <td align="center"><?php echo number_format($in_out17); ?></td>
  </tr>
  <tr>
    <td><span class="para1">กัมพูชา</span></td>
    <td align="center"><?php echo number_format($in_out7); ?></td>
    <td align="center"><?php echo number_format($in_out18); ?></td>
  </tr>
  <tr>
    <td ><span class="para1">ลาว</span></td>
    <td align="center"><?php echo number_format($in_out8); ?></td>
    <td align="center"><?php echo number_format($in_out19); ?></td>
  </tr>
  <tr>
    <td><span class="para1">เวียดนาม</span></td>
    <td align="center"><?php echo number_format($in_out9); ?></td>
    <td align="center" ><?php echo number_format($in_out20); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ยุโรป</span></td>
    <td align="center" ><?php echo number_format($in_out10); ?></td>
    <td align="center" ><?php echo number_format($in_out21); ?></td>
  </tr>
  <tr>
    <td><span class="para1">อเมริกา</span></td>
    <td align="center" ><?php echo number_format($in_out11); ?></td>
    <td align="center" ><?php echo number_format($in_out22); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ไม่ทราบสัญชาติ</span></td>
    <td align="center" ><?php echo number_format($in_out12); ?></td>
    <td align="center" ><?php echo number_format($in_out23); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ไม่ระบุ</span></td>
    <td align="center" ><?php echo number_format($in_out13); ?></td>
    <td align="center" ><?php echo number_format($in_out24); ?></td>
  </tr>

  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center"><strong><?php echo number_format($total3); ?></strong></td>
    <td align="center"><strong><?php echo number_format($total4); ?></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong> ชนิดของอิมมูโนโกลบุลิน (RIG)</td>  
  </tr>
  <tr>
    <td><span class="para1">ERIG</span></td>
    <td align="center" ><?php echo number_format($in_out25); ?></td>
    <td align="center" ><?php echo number_format($in_out26); ?></td>
  </tr>
  <tr>
    <td><span class="para1">HRIG</span></td>
    <td align="center" ><?php echo number_format($in_out27); ?></td>
    <td align="center" ><?php echo number_format($in_out28); ?></td>
  </tr>

  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center"><strong><?php echo number_format($total3); ?></strong></td>
    <td align="center"><strong><?php echo number_format($total4); ?></strong></td>
  </tr>            
  <tr>
    <td colspan="3"><strong> ชนิดของวัคซีน </strong></td>

  </tr>
  <tr>
    <td><span class="para1">PVRV</span></td>
    <td align="center" ><?php echo number_format($in_out29); ?></td>
    <td align="center" ><?php echo number_format($in_out30); ?></td>
  </tr>
  <tr>
    <td><span class="para1">PCEC</span></td>
    <td align="center" ><?php echo number_format($in_out31); ?></td>
    <td align="center" ><?php echo number_format($in_out32); ?></td>
  </tr>
  <tr>
    <td><span class="para1">HDCV</span></td>
    <td align="center" ><?php echo number_format($in_out33); ?></td>
    <td align="center" ><?php echo number_format($in_out34); ?></td>
  </tr>
  <tr>
    <td><span class="para1">PDEV</span></td>
    <td align="center" ><?php echo number_format($in_out35); ?></td>
    <td align="center" ><?php echo number_format($in_out36); ?></td>
  </tr>

		
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center" ><strong><?php echo number_format($total5); ?></strong></td>
    <td align="center" ><strong><?php echo number_format($total6); ?></strong></td>
  </tr>
</table>
<hr class="hr1">
<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>			



