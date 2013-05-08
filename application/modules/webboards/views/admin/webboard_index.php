<h1>เว็บบอร์ด</h1>
<?php include "_menu.php";?>
<br>

<?php //echo $pagination()?>
<table class="list" id="weblinks-list">
	<tr>
		<th>หัวข้อ</th>
		<th>เข้าชม</th>
		<th>ตอบ</th>
		<th>โดย</th>
		<th>หมวดหมู่</th>
		<th width="95">
			<?php //if(permission('webboards', 'create')):?>
			<a class="btn" href="webboards/admin/webboard_quizs/form">ตั้งกระทู้ใหม่</a>
			<?php //endif;?>
		</th>
	</tr>
	
	<?php foreach ($webboard_quizs as $webboard_quiz):?>
	<tr <?php echo cycle()?>>
		<td><?php echo $webboard_quiz['title'] ?></td>
		<td><?php echo $webboard_quiz['counter'] ?></td>
		<td><?php //echo $webboard_quiz->webboard_answer->result_count() ?></td>
		<td><?php //echo $webboard_quiz->user->display ?></td>
		<td><?php //echo $webboard_quiz->webboard_category->name ?></td>
		<td>
			<?php //if(permission('webboards', 'update')):?>
			<a class="btn" href="webboards/admin/webboard_quizs/form/<?php echo $webboard_quiz['id']?>" >แก้ไข</a> 
			<?php //endif;?>
			<?php //if(permission('webboards', 'delete')):?>
			<a class="btn" href="webboards/admin/webboard_quizs/delete/<?php echo $webboard_quiz['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE;?>')">ลบ</a>
			<?php //endif;?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php //echo $pagination()?>