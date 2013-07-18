	<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">				  
		<span>ปัจจัยที่เกี่ยวข้องกับการรายงานผลการฉีดวัคซีนผู้สัมผัสโรคพิษสุนัขบ้า</span><br/>
		<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span><br/>
		<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
		<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?> </span></br>				
	</div>
	<h6 style="font-size:13px;">ตาราง จำนวนของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตาม <?php echo $head; ?>และ <?php echo $detail_minor_name[$detail_minor]; ?></h6>	
	<table class="tbreport" border="1" width="864">
		<?php $row=(!empty($minordetail_head))? "4":"3"; ?>
		<tr><th rowspan="<?php echo $row; ?>" colspan="2"><?php echo $head; ?></th>			
		</tr>				
		<tr>
			<th colspan="<?php echo count($minordetail)+1; ?>"><strong><?php echo $detail_minor_name[$detail_minor] ?></strong></th>
		</tr>
		<?php if(!empty($minordetail_head)): ?>
		<tr><? foreach($minordetail_head as $key =>$item): ?>
			<th colspan="<?php echo $minorvalue_head[$key] ?>"><?php echo $item; ?></th>
			<?php endforeach; ?>
			
		</tr>		
		<?php endif; ?>
		<tr>
			<?php foreach($minordetail as $item): ?>
			<th><?php echo $item; ?></th>
			<?php endforeach; ?>
			<th>รวม</th>
		</tr>
		<?php $row_sum = 0;		
			foreach($detail_main_type as $key=>$i): ?>
		<tr class="para1">
			<td><strong><?php echo $detail_main_name_head[$key] ?></strong></td>
			<td><strong><?php echo $detail_main_name[$key] ?></strong></td>
			<?php foreach($minorvalue as $j): ?>
				<td><?php 
				$sum[$j] =	${'main'.$i.$j};			
				if(empty($sum_all[$j])){$sum_all[$j]=0;}
				$sum_all[$j] += $sum[$j];					
				echo  number_format(${'main'.$i.$j}); ?><br/><?php  echo compute_percent(${'main'.$i.$j},${'total_main'.$i},1) ?></td>							
			<?php endforeach; ?>			
			<td><?php  $row_sum =$row_sum + ${'total_main'.$i};
			echo number_format(${'total_main'.$i}); ?></td>			
		</tr>		
		<?php endforeach; ?>
		
		<tr class="total">			
			<td>รวม</td>
			<?php if(!empty($detail_main_name_head)): ?><td></td><? endif; ?>
		<?php foreach($minorvalue as $j): ?>			
			<td><?php echo number_format($sum_all[$j]); ?></td>			
		<?php endforeach; ?>
			<td><? 
			echo number_format($row_sum); ?></td>					
		</tr>
							
		</tr>
	</table>
<hr class="hr1">		
<div id="reference"><?php echo $reference?></div>			
