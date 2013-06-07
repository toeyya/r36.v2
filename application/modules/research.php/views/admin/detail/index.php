<h1>คำถามที่พบบ่อย</h1>
<div class="search">
<form action="question/index" method="get" name="form1" >
ประเภทคำถาม <?php echo form_dropdown('question_type',get_option('id','name','n_question'),@$_GET['question_type'],'','--โปรดเลือก--') ?>
คำถาม <input type="text" name="question" value="<?php echo @$_GET['name'] ?>" class="input_box_patient">
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>แสดง</th>
		<th>ประเภทคำถาม</th>
		<th>คำถาม</th>
		<th>โดย</th>
		<th width="90"><a href="question/admin/question_detail/form/<?php echo $question_id ?>" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a></th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>		
		<td width="70"><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['id'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td><?php echo $item['name'] ?></td>
		<td><div style="width:500px;height:32px;overflow: hidden"><?php echo $item['question'] ?></div></td>
		<td><?php echo $item['userfirstname'] ?> <?php echo $item['usersurname'] ?></td>
		<td><a href="question/admin/question_detail/form/<?php echo $question_id ?>/<?php echo $item['id'] ?>" class="btn" title="แก้ไข">แก้ไข</a>
				 <a href="question/admin/question_detail/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ">ลบ</a></td>
	</tr>
	<?php endforeach; ?>
</table>
