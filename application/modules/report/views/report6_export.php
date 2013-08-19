	<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">				  
		<span>รายงานจังหวัด<?php echo $textprovince ?>  เดือน  <?php echo $textmonth_start ?> ปี  <? echo $textyear_start ?></span><br/>					
	</div>		
<table class="tbreport" border="1" width="864">
	<tr><td colspan="4" style="text-align: right;">หน่วย: ราย</td></tr>
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
	$totalallin=0;$totalallout=0;$totalallamphur=0;$in=0;$out=0;	
	foreach($amphur as $key =>$item):
			$eachamphur=0;
			$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid
				  WHERE $cond in_out=1 and hospitalamphur<>'0' and hospitalamphur ='".$item['amphur_id']."'";
			$in = $this->db->GetOne($sql);
			$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid
				  WHERE $cond in_out=2 and hospitalamphur<>'0' and hospitalamphur ='".$item['amphur_id']."'";	
			$out = $this->db->GetOne($sql);
			$eachamphur		= $in + $out;
			$totalallin		= $totalallin + $in;
			$totalallout 	= $totalallout + $out;
			$totalallamphur = $totalallamphur + $eachamphur;		
				
	 ?>	
	<tr class="para1">
		<td class="pad-left"><?php echo $item['amphur_name'] ?></td>		
		<td><?php echo number_format($in);?></td>
		<td><?php echo number_format($out);?></td>
		<td><?php echo number_format($eachamphur);  ?></td>
	</tr>
	<?php endforeach; ?>
	<tr class="total para1">
		<td class="pad-left">รวม</td>
		<td><?php echo number_format($totalallin); ?></td>
		<td><?php echo number_format($totalallout); ?></td>
		<td><?php echo number_format($totalallamphur); ?></td>
	</tr>
	</table>
	<hr class="hr1">
	<div id="reference"><?php echo $reference?></div>	
