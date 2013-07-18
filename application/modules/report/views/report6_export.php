
	<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">				  
		<span>รายงานจังหวัด<?php echo $textprovince ?>  เดือน  <?php echo $textmonth_start ?> ปี  <? echo $textyear_start ?></span><br/>					
	</div>		
<table class="tbreport" border="1" width="864">
	<tr><td colspan="4" style="text-align: right;">หน่วย: คน</td></tr>
	<tr>
		<th rowspan="2">อำเภอ</th>		
		<th colspan="2">สิทธิการรักษา</th>		
		<th rowspan="2">ยอดรวม</th>
	</tr>
	<tr>
		<th>สถานบริการนี้</th>
		<th>สถานบริการอื่น</th>
	</tr>
	<?php 
	$total1=0;$total2=0;$total_all=0;
	foreach($result as $item): ?>
	<tr class="para1">
		<td class="pad-left"><?php echo $item['amphur_name'] ?></td>		
		<td><?php echo $in =number_format($item['cnt1']); $total1 =$total1 + $in;?></td>
		<td><?php echo $out=number_format($item['cnt2']); $total2 =$total2 + $out;?></td>
		<td><?php echo $all= $in+$out; number_format($all); $total_all =$total_all + $all ?></td>
	</tr>
	<?php endforeach; ?>
	<tr class="total para1">
		<td class="pad-left">รวม</td>
		<td><?php echo number_format($total1); ?></td>
		<td><?php echo number_format($total2); ?></td>
		<td><?php echo number_format($total_all); ?></td>
	</tr>
</table>
	<hr class="hr1">
	<div id="reference"><?php echo $reference?></div>	
