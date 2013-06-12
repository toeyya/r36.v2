<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="document/index">เอกสารเผยแพร่</a><span class="divider">/</span></li>
    <li><?php echo $research_name; ?></li>
</ul>
<h1></h1>
<div id="news-pr">
	<ul>
		<?php foreach($result as $item): ?>
		<li><a href="document/view/<?php echo $item['research_id'] ?>/<?php echo $item['id'] ?>"><?php echo $item['title'] ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>	
