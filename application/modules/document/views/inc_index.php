<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>เอกสารเผยแพร่</li>   
</ul>
<h1><img src="themes/default/media/images/title_doc.png" width="118" height="27"></h1>
<div id="register">
<table class="table table-striped">
	<tr>
		<th>ประเภทเอกสารเผยแพร่</th>
		<th>จำนวนเรื่อง</th>
	</tr>
<?php foreach($result as $item): ?>
	<tr>
		<td><a href="document/detail/<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $item['cnt']?></td>
	</tr>
<?php endforeach; ?>	
</table>
</div>