<div class="alert alert-warning"><span class="label label-warning">มีเคสนี้อยู่แล้วในระบบ</span> คุณต้องปิดเคสนี้ก่อนจึงสามารถเพิ่มครั้งที่สัผมัสโรคได้</div>
<table class="tb_search_Rabies1">
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
		<td><a href="inform/form/<?php echo $item['id'] ?>/<?php echo $item['information_historyid'] ?>"  title="แก้ไข" class="btn_edit vtip" target="_blank"></a>			
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $pagination; ?>
