<div id="title">ตารางนัดหมายคนไข้  ประจำวันที่<?php  echo db_to_th(date('Y-m-d')); ?></div>
<div id="report">
	<div id="title">
		<p>รายงานตารางนัดหมายคนไข้  ประจำวันที่ <?php  echo db_to_th(date('Y-m-d')); ?></p>
		<p><?php echo $this->session->userdata('R36_HOSPITAL_NAME')?> 
				จังหวัด <?php echo $hospital['province_name'] ?>
				อำเภอ <?php echo $hospital['amphur_name'] ?> 
				ตำบล <?php echo $hospital['district_name'] ?></p>
	</div>
	<table class="tb_search_Rabies1" width="90%">
	<tr>
	  <th width="3%">ลำดับ</th>
	  <th width="10%">HN - ครั้งที่</th>
	  <th width="10%">วันที่สัมผัสโรค</th>
	  <th width="10%">วันที่ฉีดวัคซีนครั้งต่อไป</th>	   
	  <th width="15%">ชื่อ-นามสกุล</th>
	  <th width="15%">เลขที่บัตรประชาชน /passport</th>
	  <th width="10%">โทรศัพท์</th>
	  <th width="10%">สิทธิ์การรักษา</th>
	  <th width="7%">ฉีดโดยวิธี</th>
	  <th width="7%">จำนวนเข็ม</th>	  
	</tr>

<? 	$means_name=array('1'=>'ID','2'=>'IM');		
	$inout=array('1'=>'สถานบริการนี้','2'=>'สถานบริการอื่น');	
	$i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;
?>	
<?php foreach($result as $item): ?>
		<tr>
		  <td><?php echo $i++;  ?></td>
		  <td><a href="inform/form/<?php echo $item['id']?>/<?php echo $item['historyid']?>/<?php  echo $item['in_out'] ?>/vaccine" target="_blank"><?php echo $item['hn'].'-'.$item['hn_no'];?></a></td>
		  <td><?php echo cld_my2date($item['datetouch']) ?></td>
		  <td><?php echo DB2date($item['vaccine_date']) ?></td>
		  <td><?php echo $item['firstname']?> <?php echo $item['surname']?></td>
		  <td><?php echo $item['idcard'] ?></td>
		  <td><?php echo $item['telephone']?></td>
		  <td><?php echo $inout[$item['in_out']]?></td>
		  <td style="text-align: center"><?php echo $means_name[$item['means']]?></td>
		  <td><?php echo $item['total_vaccine']?></td>		  		  		
		</tr>
<?php  endforeach;?>	     
  </table>
  <?php echo $pagination; ?>
		<div id="btn_printout"><a href="report/schedule/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>    
</div><!-- report -->