<div id="report">
<div id="title">
	<p class="head">ผู้ใช้ระบบ</p>	
	<p><span>ชื่อ/นามสกุล /สถานพยาบาล</span> <?php echo $name; ?></p>
	<p><span>สิทธิ์การใช้งาน</span> <?php echo $position_name; ?></p>
	<p><span>จังหวัด</span> <?php echo $province ?> <span>อำเภอ</span> <?php echo $amphur ?> <span>ตำบล</span> <?php echo $district ?> <span>สถานพยาบาล</span> <?php echo $hospital ?></p>
</div>
<hr class="hr1">	
<table  class="list" >
	  <tr>	  
		<th>แสดง</th>		
		<th>ชื่อ - นามสกุล</th>
		<th>สิทธิ์การใช้งาน</th>
		<th>สถานบริการ/หน่วยงาน</th>
		<th>จังหวัด</th>
		<th>วันลงทะเบียน</th>
		<th style="width:20%;text-align:center;">การอนุมัติ</th>		
	  </tr>	  
		<?php foreach($result as $key => $item): ?>
		<tr>				
				<td><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['uid'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>								
				<td><?php echo $item['userfirstname'];?> <?php echo $item['usersurname'];?></td>
				<td><?php echo $item['level_name']; echo (!empty($item['userlevel'])) ? "(เขตที่  ".$item['userlevel'].")" :'';?></td>
				<td><?php echo (!empty($item['hospital_name'])) ? $item['hospital_name']: $item['agency'] ?></td>
				<td><?php $province_name = $this->db->GetOne("SELECT province_name FROM n_province 
															  LEFT JOIN n_hospital_1 ON province_id = hospital_province_id 
															  WHERE hospital_code='".$item['userhospital']."'"); 
						echo ($item['userposition']=="02") ? $item['province_name'] : ThaitoUtf8($province_name);
					?>				
				</td>
				<td><?php echo DB2DateTime($item['created']); ?></td>
				<td>
					<div class="format">
						<?php if($this->session->userdata('R36_LEVEL')=='00' || $this->session->userdata('R36_LEVEL')=="02"): ?>
						<input type="checkbox"   id="check1<?php echo $key;?>"  value="<?php echo $item['uid'] ?>" <?php echo ($item['confirm_province']=="1") ? 'checked="checked"':'' ; ?> />
						<label for="check1<?php echo  $key;?>">ระดับจังหวัด</label>
							<? if($this->session->userdata('R36_LEVEL')=="00"): ?>
						<input type="checkbox"   id="check2<?php echo $key; ?>"   value="<? echo $item['uid'] ?>" <?php echo ($item['confirm_admin']=="1") ? 'checked="checked"':'' ; ?>/>
						<label for="check2<?php echo $key; ?>">ระดับกรม</label>
							<? endif; ?>
						<? endif; ?>
					</div>
				</td>
				

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
