<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="document/index">เอกสารเผยแพร่</a><span class="divider">/</span></li>
    <li><?php echo $document_name; ?></li>
</ul>
<h1></h1>
<?php foreach($result as $item): ?>
<div class="brochure">	
	<ul>
		<li class="image"><?php echo (!empty($item['image'])) ? img(array('src'=>'uploads/document/thumbnail/'.$item['image'],'width'=>'100px','height'=>'80px')): img(array('src'=>'themes/default/media/images/logo60x60.png','width'=>'60px','height'=>'60px'))?></li>
		<li class ="title">
			<?php echo $item['title'] ?>
			<p><?php echo $item['intro'] ?></p>
			<?php if(!empty($item['file'])): ?>
			<span style="block"><a href="document/download/<?php echo $item['id'] ?>"><i class="icon-file"></i><?php echo $item['file_title'] ?></a></span>
			<?php endif; ?>
		</li>					
	</ul>
</div>	
<?php endforeach; ?>