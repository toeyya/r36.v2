<script type="text/javascript">
$(document).ready(function(){
	$('a.gallery').colorbox();
})
</script>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="document/index/<?php echo $document_id ?>">เอกสารเผยแพร่</a><span class="divider">/</span></li>
    <li><?php echo $document_name; ?></li>
</ul>
<h1><img src="themes/default/media/images/title_doc.png" width="118" height="27"></h1>
<?php foreach($result as $item): ?>	
<div class="brochure">	
		<?php if($item['image']): ?>
    		<a class="gallery" href="uploads/document/thumbnail/<?php echo $item['image'] ?>">
    		<img  class="content-img img-polaroid" src="uploads/document/thumbnail/<?php echo $item['image'] ?>" width="89px" height="67px" id="img1"/>
    		</a>       
		<?php else: ?>
   			<img class="content-img img-polaroid"  src="themes/default/media/images/logo89x67.png" width="89px" height="67px"/>    	
    	<?php endif; ?>	
    	<span class="title"><a href="document/view/<? echo $document_id ?>/<? echo $item['id'] ?>"><?php echo $item['title'] ?></span></a>     	
    	<div class="intro" >   		
    		<?php echo $item['intro']; ?>
    	</div>
		<?php if($item['file']): ?>
		<div class= "download" id="download"><a href="document/download/<?php echo $item['id']; ?>"><span class="btn btn-mini"><i class="icon-file"></i> <?php echo $item['file_title'] ?></span></a></div>
		<?php endif; ?>								
</div>	
<?php endforeach; ?>