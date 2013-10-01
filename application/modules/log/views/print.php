<div id="report">
<div id="title">
<p class="head">ประวัติเข้าใช้ระบบ</p>
<p><span>ชื่อผู้ใช้ </span><?php echo $fullname; ?> <span>การกระทำ</span> <?php echo $action; ?>  <span>สิทธิ์การใช้งาน</span> <?php echo $position_name; ?></p>
<p><span>ตั้งแต่วันที่</span> <?php echo $firstDate; ?>  <span>ถึงวันที่ </span><?php echo $lastDate ?></p>
<p><span>จังหวัด</span> <?php echo $province; ?> <span>อำเภอ</span> <?php echo $amphur; ?> <span>ตำบล</span> <?php echo $district; ?> <span>โรงพยาบาล</span> <?php echo $hospital; ?></p>
</div>
<hr class="hr1">	
<table class="tbreport">
		  <tr>
			<th width="5%" >ลำดับ</th>
			<th width="12%">การกระทำ</th>
		    <th width="30%">รายละเอียด</th>
			<th width="18%">โดย</th>
			<th width="17%">สิทธิ์การใช้งาน</th>
			<th width="10%">IP address</th>
			<th width="18%">วันที่</th>
		  </tr>	 		 	
	 	<?php $i=1;foreach($result as $key =>$item): ?>		 
				  <tr>			 
				  <td><?php echo $i++; ?></td>
				  <td><?php echo $item['action'] ?> </td>
				  <td><?php echo $item['detail'] ?></td>
				  <td><?php echo $item['userfirstname'].' '.$item['usersurname'] ?> </td>
				  <td><?php echo (!empty($item['userposition']))? $position[$item['userposition']]:"";?></td>
				  <td><?php echo  $item['ipaddress']?></td>
				  <td><?php echo  DB2date($item['created'],true) ?>
				  <input type="hidden" name="uid"  value="<?php echo $item['uid']  ?>"/></td>
				  </tr>
		<?php endforeach;?>
</table>
<hr class="hr1">		
<div id="reference"><?php echo $reference?></div>	  		
<div id="area_btn_print">
	<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
	<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
</div> 
</div>