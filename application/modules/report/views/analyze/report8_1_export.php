	<div id="title" style="text-align:center;width:400px;font-size:14px;font-weight:bold">				  
		<span>ปัจจัยที่เกี่ยวข้องกับการรายงานผลการฉีดวัคซีนผู้สัมผัสโรคพิษสุนัขบ้า</span><br/>
		<span>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></span><br/>
		<span>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></span></br>
		<span>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?> </span></br>				
	</div>
	<h6 style="font-size:13px;">ตาราง จำนวนของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตาม <?php echo $head; ?>และ <?php echo $detail_minor_name[$detail_minor]; ?></h6>	
	<table class="tbreport" border="1" width="864">
	<tr>
		<th rowspan="2" colspan="2">การฉีดอิมมูโนโกลบูลิน</th>
		<th colspan="2">ถูกกัด</th>
		<th colspan="2">ถูกข่วน</th>
		<th colspan="2">ถูกเลีย / ถูกน้ำลาย</th>
		<th rowspan="2">รวม</th>	
	</tr>
	<tr>
		<th>มีเลือดออก</th>
		<th>ไม่มีเลือดออก</th>
		<th>มีเลือดออก</th>
		<th>ไม่มีเลือดออก</th>
		<th>มีเลือดออก</th>
		<th>ไม่มีเลือดออก</th>
		
	</tr>
		<? $grp =(!empty($date_type)) ? "group by ".$date_type."  order by ".$date_type : '';
		
			for($main=0;$main<count($detailmain_B);$main++){
					for($main_sub=1;$main_sub<count($detailminor_name);$main_sub++){
						$sql ="SELECT count(historyid) as cnt 
							   FROM n_history inner join n_information on historyid=information_historyid
							   WHERE  $cond and $detailmain_T[$main]='1' AND use_rig = '".$detailminor_T[$main_sub]."'";														
						$sumrow = $this->db->GetOne($sql);								
		?>
	  <tr>
			<td height="20"><strong><? echo $detailmain_B[$main]?></strong></td>
			<td><strong><? echo $detailminor_name[$main_sub]?></strong></td>
				<?  
					for($numWH=0;$numWH<count($detailmain_wh);$numWH++){
						$sql ="SELECT  count(historyid) as cnt 
								FROM n_history inner join n_information on historyid=information_historyid
								WHERE  $cond and $detailmain_T[$main]$detailmain_wh[$numWH] ='1' AND use_rig = '".$detailminor_T[$main_sub]."'";
						$sum  = $this->db->GetOne($sql);						
						if($sum!='0'){
							$sumpercent=$sum/$sumrow*100;
						}else{
							$sumpercent=0;
						}
				?>
				<td><? echo number_format($sum).'<br>'.number_format($sumpercent,1);?></td>
				<? }
				?>
				<td><? echo number_format($sumrow).'<br>100.0';?></td>
	  </tr>
	  <?	 $detailmain_B[$main]='';	} 
	  }?>
	</table>
<hr class="hr1">		
<div id="reference"><?php echo $reference?></div>	