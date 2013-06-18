<div id="title">แบบฟอร์มประวัติคนไข้</div>
<div id="search">
<form name="form1"  method="get" id="form1" action="inform/patient">
	<table>
		<tr><th>ชื่อ / นามสกุล / บัตรประชาชน / บัตร passport </th>
		<td colspan="2"><input type="text" name="name" value="<?php echo  @$_GET['name']?>"></td>
		<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['province_id'],'class="styled-select" id="province_id"','--เลือกจังหวัด--') ?></td>
		<td><?php echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name','n_amphur order by amphur_id asc'),@$_GET['province_id'],'class="styled-select" id="province_id"','--เลือกอำเภอ--') ?></td>
		<th><?php echo form_dropdown('district_id',get_option('district_id','district_name','n_district order by district_name asc'),@$_GET['district_id'],'class="styled-select"','--เลือกตำบล--'); ?></th>
		<td><button class="btn_submit cencel" name="btn_submit" type="submit" value="btn_submit"></button></td>
	</tr>
	</table>	
</form>
</div>

<div id="boxAdd"><a href="inform/patient/form" class="btn_add1" name="btn_add"></a></div>
 <table class="tb_search_Rabies1" >			  			
	<tr> 
		<th>ลำดับ</th>
		<th>บัตรประชาชน/  บัตร passport</th>
		<th>ชื่อ-นามสกุล</th>
		<th>จังหวัด</th><th>อำเภอ</th><th>ตำบล</th>
		<th>การกระทำ</th>
	</tr>
<?php  if(!empty($result)): ?>
<?php 
$i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;
foreach($result as $item): ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $item['idcard'] ?></td>
		<td><?php echo $item['firstname']." ".$item['surname'] ?></td>
		<td><?php echo $item['province_name'] ?></td>
		<td><?php echo $item['amphur_name'] ?></td>
		<td><?php echo $item['district_name'] ?></td>
		<td>	
			<a title="แก้ไข" href="inform/patient/form/<?php echo $item['historyid']?>" class="btn_edit vtip"></a>
			<a title="ลบ" href="inform/patient/delete/<?php echo $item['historyid']?>" class="btn_delete vtip"  onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')" ></a>	</td>
	</tr>  
<?php endforeach; ?>
<?php endif; ?>
</table>  
<?php echo @$pagination; ?>
