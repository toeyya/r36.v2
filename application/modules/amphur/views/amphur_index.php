<h1>อำเภอ</h1>
<div class="search">
<form action="amphur/index" method="get" name="form1" >		
	จังหวัด<?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['province_id'],'class="styled-select"','-ทั้งหมด-')?>
	อำเภอ <input type="text" class="input_box_patient" name="amphur_name" value="<?php echo @$_GET['amphur_name']?>">
	<button class="btn" type="submit" name="btn_search" >ค้นหา</button>
</form>
</div>
<table  class="list">
	  <tr>
		<th>จังหวัด</th>
		<th>โค้ดอำเภอ</th>
		<th>อำเภอ</th>		
		<th width="10%">			
			<?php if(permission('setting', 'act_create')):?>
				<a href="amphur/form" name="btn_add" class="btn">เพิ่มรายการ</a>
			<?php endif; ?>
		</th>
	  </tr>
	  
	  <?php foreach($result as $key=>$item): ?>
	  <tr>
	  	<td><?php echo $item['province_name'] ?></td>
	  	<td><?php echo $item['amphur_id'] ?></td>
	  	<td><?php echo $item['amphur_name'] ?></td>
	  	<td>
	  		<?php if(permission('settings', 'act_update')):?>
	  		<a title="แก้ไข" href="amphur/form/<?php echo $item['amp_pro_id']?>" class="btn">แก้ไข</a>
	  		<?php endif; ?>
	  		<?php if(permission('settings', 'act_delete')):?>
	  		<a title="ลบ" href="amphur/delete/<?php echo $item['amp_pro_id']?>/<?php echo $item['amphur_id'] ?>/<?php echo $item['province_id'] ?>" class="btn" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
	  		<?php endif; ?>
	  	</td>	  	
	  </tr>
	  <?php endforeach; ?>
	 </table>
	 <?php echo $pagination; ?>