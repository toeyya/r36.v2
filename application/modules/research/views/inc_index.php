<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>งานศึกษาวิจัย</li>   
</ul>

<div id="register">
<table class="table table-striped">
	<tr>
		<th>ประเภทงานวิจัย</th>
		<th>จำนวนเรื่อง</th>
	</tr>
<?php foreach($result as $item): ?>
	<tr>
		<td><a href="research/detail/<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $item['cnt']?></td>
	</tr>
<?php endforeach; ?>	
</table>
</div>