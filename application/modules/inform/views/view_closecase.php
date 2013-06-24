<div id="notice">กรุณาปิดเคส ก่อนทำการเพิ่มข้อมูลผู้สัมผัสโรค</div>
<table class="tblist">
	<tr>
	<th>HN</th>
	<th>ครั้งที่สัมผัสโรค</th>
	<th>ชื่อ-นามสกุล</th>
	<th>บัตรประชาชน/passport</th>
	<th></th>
	</tr>
	<?php 
	foreach($result as $item): ?>
	<tr>
		<td><?php echo $item['hn'] ?></td>
		<td><?php echo $item['hn_no'] ?></td>
		<td><?php echo $item['firstname'].' '.$item['surname']?></td>
		<td><?php echo $item['idcard'] ?></td>
		<td><a href="inform/form/<?php echo $item['information_historyid'] ?>" class="btn">แก้ไข</a>
				 <button class="btn" name="btn_delete" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')" >ลบ</button>
		</td>
	</tr>
	<?php endforeach; ?>
</table>