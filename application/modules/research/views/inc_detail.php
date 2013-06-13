<h1></h1>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="research/index">งานศึกษาวิจัย</a><span class="divider">/</span></li>
    <li><?php echo $research_name; ?></li>
</ul>
<h1><img src="themes/default/media/images/title_research.png" width="101" height="24"></h1>
<div id="news-pr">
	<ul>
		<?php foreach($result as $item): ?>
		<li><a href="research/view/<?php echo $item['research_id'] ?>/<?php echo $item['id'] ?>"><?php echo $item['title'] ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>	
