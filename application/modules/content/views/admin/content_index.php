<h1><?php echo $category['name']; ?></h1>
<div class="search">
	<form method="get">
		<label>หัวข้อ: </label>
		<input type="text" name="search" value="<?php echo (isset($_GET['search']))?$_GET['search']:'' ?>" /> 		
		<input type="submit" value="ค้นหา" class="button" />
	</form>
</div>
<table class="list">
	<tr>
		<th width="60">แสดง</th>
		<th>หัวข้อ</th>
		<th width="120">โดย</th>
		<th width="90">
			
			<a class="btn" href="content/admin/content/form/<?php echo $category_id ?>">เพิ่มรายการ</a>
		</th>
	</tr>
	<?php foreach($result as $content): ?>
	<tr <?php echo cycle()?>>
		<td><input type="checkbox" class="list_check" name="active" value="<?php echo $content['id'] ?>" <?php echo ($content['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td>
			<?php echo $content['title']?>
		</td>

		<td><?php echo $content['userfirstname'].' '.$content['usersurname']?></td>
		<td>
			<a class="btn" href="content/admin/content/form/<?php echo $content['category_id'] ?>/<?php echo $content['id']?>" >แก้ไข</a> 
			<a class="btn" href="content/admin/content/delete/<?php echo $content['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE ?>')">ลบ</a>
		</td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php echo $pagination;?>