<div class="alert alert-warning"><span class="label label-warning">ไม่สามารถเพิ่มข้อมูลได้</span> กรุณาปิดเคสที่อายุ มากกว่า 90 วัน จึงสามารถเพิ่มรายการได้</div>
<table class="tb_search_Rabies1">
	<tr>
    <th>วันที่สัมผัสโรค</th>
	<th>HN</th>
	<th>ครั้งที่สัมผัสโรค</th>
	<th>ชื่อ-นามสกุล</th>
	<th>บัตรประชาชน/passport</th>
	<th>จำนวนเข็ม</th>
	<th></th>
	</tr>
	<?php 
	if(!empty($result)){
	foreach($result as $item): ?>
	<tr>
		<td><?php echo cld_my2date($item['datetouch']); ?></td>
		<td><?php echo $item['hn'] ?></td>
		<td><?php echo $item['hn_no'] ?></td>
		<td><?php echo $item['firstname'].' '.$item['surname']?></td>
		<td><?php echo $item['idcard'] ?></td>
		<td><span class="syringe<?php echo $item['total_vaccine']?> syringe" title="<?php echo $item['total_vaccine'] ?> เข็ม"> </span></td>
		<td><a href="inform/form/<?php echo $item['id'] ?>/<?php echo $item['information_historyid'] ?>"  title="แก้ไข" class="btn_edit vtip" target="_blank"></a>			
		</td>
	</tr>
	<?php endforeach;} ?>
</table>
<?php echo $pagination; ?>
