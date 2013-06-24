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
		<td></td>
	</tr>
	<?php endforeach; ?>
</table>