<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="document/index">เอกสารเผยแพร่</a><span class="divider">/</span></li>
    <li><?php echo $document_name; ?></li>
</ul>
<h1></h1>
<div id="brochure">
	<ul>
		<?php foreach($result as $item): ?>
		<li class="image"><?php echo (!empty($item['image'])) ? img(array('src'=>'uploads/document/thumbnail/'.$item['image'],'width'=>'77px','height'=>'50px')): img(array('src'=>'themes/default/media/image/dummy/133x94px','width'=>'133px','height'=>'94px'))?></li>
		<li class ="title">
			<a href="document/view/<?php echo $item['document_id'] ?>/<?php echo $item['id'] ?>"><?php echo $item['title'] ?></a>
			<p><?php echo $item['intro'] ?></p>
		</li>
		
		<?php endforeach; ?>
	</ul>
</div>	
