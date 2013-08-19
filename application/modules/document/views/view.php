<ul class="breadcrumb"> 
	<li><a href="home">หน้าแรก</a><span class="divider">/</span></li> 
	<li><a href="document/index">เอกสารเผยแพร่</a><span class="divider">/</span></li> 
	<li><a href="document/detail/<?php echo  $rs['document_id'] ?>"><? echo $document_name; ?></a><span class="divider">/</span></li>
	<li><? echo $rs['title']; ?></li>
</ul>

<img src="themes/default/media/images/title_doc.png" width="118" height="27" />
<hr class="hr1">
<div id="contentNewsPR">
<h5><?php echo $rs['title'];?></h5>
<div style="background-color:#F5F5F5;padding:3px;font-size:11px;color:#969696;padding-left:10px">
	<span style="margin:0 5px;"><i class="icon-calendar"></i> <? echo db_to_th($rs['created']) ?><span>
</div>
	<?php echo $rs['detail'];?>
	<?php if(!empty($rs['file'])):  ?>
		<div class="attach">
		<h2>เอกสารแนบ</h2>
		<a href="document/download/<?php echo $rs['id']; ?>" target="_blank"><span class="btn btn-mini"><i class="icon-file"></i> <?php echo $rs['file_title'] ?></span></a>
		</div>
	<?php endif; ?>
</div>