<div id="title">ข้อมูลสถานพยาบาล</div>
<?php foreach($result as $item): ?>
<table width="50%"  class="tbform">
        <tr> 
          <th width="110" height="20"  class="topic">จังหวัด :</th>
          <td width="242" height="20"><?php  echo $item['province_name']; ?></td>
        </tr>
        <tr> 
          <th height="20" class="topic">อำเภอ :</th>
          <td height="20"><?php echo $item['amphur_name']; ?></td>
        </tr>
        <tr > 
        	<?php 
        	$sql="select district_name from n_district where province_id= ? and amphur_id = ? and district_id= ? ";
        	$district_name=$this->db->GetOne($sql,array($item['hospital_province_id'],$item['hospital_amphur_id'],$item['hospital_district_id'])); ?>
          <th height="20"  class="topic">ตำบล :</th>
          <td height="20"><?php echo $district_name; ?></td>
        </tr>        
        <tr> 
          <th class="topic">สถานพยาบาล:</th>
          <td><?php echo $item['hospital_name'];?></td>
        </tr>
          <tr> 
          <th height="20"  class="topic">โค้ดโรงพยาบาล :</th>
          <td height="20"><?php echo $item['hospital_code_healthoffice']; ?></td>
        </tr>
        <tr> 
          <th class="topic">สังกัด :</th>
          <td><?php 
				         $hospital_type_name['1'] = 'รัฐบาล';
						 $hospital_type_name['2'] = 'เอกชน';
		          		echo $hospital_type_name[$item['hospital_type']]
          		?>
          </td>
        </tr>
        <tr> 
          <th   class="topic" valign="top">เขต :</th>
          <td>
		  เขตเดิม : <?php if($item['province_level_old']=='0'){echo 'กทม.';}else{ echo $item['province_level_old'];}?>
		  <br />
		  เขตใหม่ :<?php if($item['province_level_new']=='0'){echo 'กทม.';}else{ echo $item['province_level_new'];}?>
		  </td>
        </tr>
        <tr align="center" > 
          <td height="20" colspan="2">
          	<?php $breadcrum="hospital/index?province_id=".$item['hospital_province_id']."&amphur_id=".$item['hospital_amphur_id']; ?>
          	<input type="button" name="main" value="กลับหน้าหลัก"  class="Submit" onClick="window.location.href='<?php echo base_url().$breadcrum;?>'">
          </td>
        </tr>
</table>
<?php endforeach; ?>