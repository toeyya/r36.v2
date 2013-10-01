<div id="report">
<div id="title">
<p class="head">สถานพยาบาล</h3>
<p><span>จังหวัด</span> <?php echo $province ?> <span>อำเภอ</span> <?php echo $amphur; ?> <span>ตำบล</span> <?php echo $district ?> <span>สถานพยาบาล</span> <?php echo $hospital; ?></p>  	
</div>
<hr class="hr1">
<table  class="list">
  <tr>
	<th width="25%">ชื่อสถานพยาบาล</th>
	<th width="12%">โค้ดสถานพยาบาล</th>
	<th width="15%">ตำบล</th>
	<th width="15%">อำเภอ</th>
	<th width="18%">จังหวัด</th>	
  </tr>
   
	 <?php foreach($result as $item): ?>
	 <?php 	$rs=$this->db->Execute("SELECT id FROM n_information WHERE hospitalcode ='".$item['hospital_code']."'");
	 				$chk_del=$rs->RecordCount();
					$sql="select district_name from n_district where province_id= ? and amphur_id = ? and district_id= ? ";
					$district_name=$this->db->GetOne($sql,array($item['hospital_province_id'],$item['hospital_amphur_id'],$item['hospital_district_id']))
	  ?>
	  	<tr>
			<td><?php echo $item['hospital_name'];?></td>
			<td><?php echo $item['hospital_code_healthoffice'] ?></td>
			<td><?php echo ThaiToUtf8($district_name); ?>	</td>
			<td><?php echo $item['amphur_name']?>	</td>
			<td><?php echo $item['province_name'] ?>	</td>					
	  </tr>
	  <?php endforeach; ?>
  </table>
 <hr class="hr1">		
<div id="reference"><?php echo $reference; ?></div>	  		
<div id="area_btn_print">
	<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
	<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
</div> 
</div>

