<ul class="breadcrumb"> 
	<li><a href="home">หน้าแรก</a><span class="divider">/</span></li> 
	<li><a href="content/index/<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li> 
</ul>
<?php if($category['id']=="6"): ?>
<img src="themes/default/media/images/title_pr.png" width="141" height="25" />
<?php elseif($category['id']=="7"): ?>
<img src="themes/default/media/images/title_2.png" width="69" height="25" />
<?php endif; ?>
<hr class="hr1">
<div id="contentNewsPR">
<h5><?php echo $content['title'];?></h5>
<div style="background-color:#F5F5F5;padding:3px;font-size:11px;color:#969696;padding-left:10px">
	<span style="margin:0 5px;"><i class="icon-tags"></i> <?php echo $content['tag'];?></span>
	<span style="margin:0 5px;"><i class="icon-calendar"></i> <? echo db_to_th($content['created']) ?><span>
</div>
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