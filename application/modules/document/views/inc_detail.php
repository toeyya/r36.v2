<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="document/index">เอกสารเผยแพร่</a><span class="divider">/</span></li>
    <li><?php echo $document_name; ?></li>
</ul>
<h1><img src="themes/default/media/images/title_doc.png" width="118" height="27"></h1>
<?php foreach($result as $item): ?>	
<div class="brochure">	
		<?php if($item['image']): ?>
    		<img  class="content-img img-polaroid" src="uploads/document/thumbnail/<?php echo $item['image'] ?>" width="89px" height="67px" />         
		<?php else: ?>
   			<img class="content-img img-polaroid"  src="themes/default/media/images/logo89x67.png" width="89px" height="67px"/>    	
    	<?php endif; ?>	
    	<span class="title"><?php echo $item['title'] ?></span>    	
    	<div class="intro" >   		
    		<?php echo $item['intro']; ?>
    	</div>
		<?php if($item['file']): ?>
		<a href="document/download/<?php echo $item['id']; ?>"><span class="btn btn-mini"><i class="icon-file"></i> <?php echo $item['file_title'] ?></span></a>
		<?php endif; ?>							
	
</div>	
<?php endforeach; ?>