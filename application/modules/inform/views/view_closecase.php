<div class="alert alert-info">ไม่สามารถเพิ่มข้อมูลได้ !!! กรุณาปิดเคส จึงสามารถเพิ่มข้อมูลผู้สัมผัสโรครายต่อไปได้</div>

<table class="table table-striped">
	<tr>
    <th>วันที่สัมผัสโรค</th>
	<th>HN</th>
	<th>ครั้งที่สัมผัสโรค</th>
	<th>ชื่อ-นามสกุล</th>
	<th>บัตรประชาชน/passport</th>
	<th></th>
	</tr>
	<?php 
	foreach($result as $item): ?>
	<tr>
		<td><?php echo cld_my2date($item['datetouch']); ?></td>
		<td><?php echo $item['hn'] ?></td>
		<td><?php echo $item['hn_no'] ?></td>
		<td><?php echo $item['firstname'].' '.$item['surname']?></td>
		<td><?php echo $item['idcard'] ?></td>
		<td><a href="inform/form/<?php echo $item['id'] ?>/<?php echo $item['information_historyid'] ?>" class="btn btn-mini btn-info" target="_blank">แก้ไข</a>			
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $pagination; ?>
