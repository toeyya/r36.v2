<h1></h1>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>คำถามที่พบบ่อย</li>
</ul>
<div id="register">
<table class="table table-striped">
	<tr>
		<th>ประเภทคำถาม</th>
		<th>จำนวนคำถาม</th>
	</tr>
<?php foreach($result as $item): ?>
	<tr>
		<td><a href="question/detail/<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $item['cnt']?></td>
	</tr>
<?php endforeach; ?>	
</table>
</div>