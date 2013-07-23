<ul class="breadcrumb"> 
	<li><a href="home">หน้าแรก</a><span class="divider">/</span></li> 
	<li><a href="content/index/<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li> 
</ul>
<div class="clr"></div><hr class="hr1">
<div id="contentNewsPR">
<h5><?php echo $content['title'];?></h5>
<div style="background-color:#F5F5F5;padding:3px;font-size:11px;color:#969696;padding-left:10px; "><i class="icon-tags"></i> <?php echo $content['tag'];?><i class="icon-time"></i> <? echo db_to_th($content['created']) ?></div>
	<?php if($content['image']): ?>
		<div style="text-align: center; margin:10px auto;"><img src="uploads/content/<?php echo $content['image'] ?>"></div>	
	<?php endif; ?>
	<?php echo $content['detail'];?>
	<?php if($content['file']):  ?>
		<div class="attach">
		<h2>เอกสารแนบ</h2>
		<a href="uploads/content/download/<?php echo $content['file']; ?>" target="_blank"><span class="btn btn-mini"><i class="icon-file"></i> <?php echo $content['doc'] ?></span></a>
		</div>
	<?php endif; ?>
</div>