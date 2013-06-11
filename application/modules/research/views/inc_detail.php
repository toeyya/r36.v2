<h1></h1>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="research/index">งานศึกษาวิจัย</a><span class="divider">/</span></li>
    <li><?php echo $research_name; ?></li>
</ul>
<div id="news-pr">
	<ul>
		<?php foreach($result as $item): ?>
		<li><a href="research/view/<?php echo $item['id'] ?>"><?php echo $item['title'] ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>	
