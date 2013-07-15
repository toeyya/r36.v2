<div id="title">ข้อมูลผู้รับวัคซีนจำแนกตามสิทธิการรักษาของสถานบริการ</div>
<div id="search">
<?php if(empty($cond)): ?>
<form action="report/index/4" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
	<?php require 'include/conditionreport.php'; ?>
		<tr>
	    	<th>ปีที่สัมผัสโรค</th>
	    	<td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>
			<th>เดือนที่สัมผัสโรค</th>
	    	<td><?php echo form_dropdown('month_start',get_month(),@$_GET['month_start'],'class="styled-select"','ทั้งหมด'); ?></td>					      	  					
      </tr>   	  
  </table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li> </ul>
</div>	
</form>
<?php endif; ?>
</div>
<div id="report">
<div id="title">				  
	<p>รายงานผู้สัมผัสโรคจำแนกตามสิทธิการรักษาของสถานบริการ <?php echo $texttype;?></p>
    <p>เขตความรับผิดชอบ <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
	<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
	<p>สถานบริการ<?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></p>				
</div>

<?php if(!empty($cond)): ?>
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
    <td><strong>1. จำนวนผู้สัมผัสโรค ( N = <?php echo number_format($total); ?> )</strong></td>
    <td align="center"><strong><?php echo number_format($in_out1); ?></strong></td>
    <td align="center"><strong><?php echo number_format($in_out2); ?></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>2. สัญชาติ (คน) </strong>
		<input type="hidden" name="render" value="container1">
		<button class="bar-chart img" name="bar" ></button>
		<button class="column-chart img" name="column"></button>
		<button class="pie-chart img" name="pie"></button>	    	
    </td>  
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
 <tr class="tr-graph">
  	<td colspan="3">
  		<div id="container1" class="container"></div>
  		<button name="close" title="close" value="close" class="btn btn_close">ปิด</button>
  	</td>
</tr>	
		
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center"><strong><?php echo number_format($total3); ?></strong></td>
    <td align="center"><strong><?php echo number_format($total4); ?></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>3. ชนิดของอิมมูโนโกลบุลิน (RIG) (โด๊ส)
		<input type="hidden" name="render" value="container2">
		<button class="bar-chart img" name="bar" ></button>
		<button class="column-chart img" name="column"></button>
		<button class="pie-chart img" name="pie"></button>	</td>  
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
  <tr class="tr-graph">
  	<td colspan="3">
  		<div id="container2" class="container"></div>
  		<button name="close" title="close" value="close" class="btn btn_close">ปิด</button>
  	</td>
 </tr>	
		
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center"><strong><?php echo number_format($total3); ?></strong></td>
    <td align="center"><strong><?php echo number_format($total4); ?></strong></td>
  </tr>            
  <tr>
    <td colspan="3"><strong>4. ชนิดของวัคซีน (โด๊ส)</strong>		
    	<input type="hidden" name="render" value="container3">
		<button class="bar-chart img" name="bar" ></button>
		<button class="column-chart img" name="column"></button>
		<button class="pie-chart img" name="pie"></button></td>

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
  <tr class="tr-graph">
  	<td colspan="3">
  		<div id="container3" class="container"></div>
  		<button name="close" title="close" value="close" class="btn btn_close">ปิด</button>
  	</td>
</tr>	
		
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center" ><strong><?php echo number_format($total5); ?></strong></td>
    <td align="center" ><strong><?php echo number_format($total6); ?></strong></td>
  </tr>
</table>
<hr class="hr1">
<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>			
<div id="btn_printout"><a href="report/index/4<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
<div id="area_btn_print">
	<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
	<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
</div>
</div>
<?php endif;?>



