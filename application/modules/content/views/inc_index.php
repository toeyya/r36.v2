<ul class="breadcrumb" > 
	<li><a href="home">หน้าแรก</a><span class="divider">/</span></li> 
	<li><a href="content/index/<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li> 
</ul>
<div <?php echo  ($category['id']=="6") ? 'id="news-pr"':'class="pic"'; ?>>
	<ul>
		<?php foreach($contents as $content): ?>
		 <li>
		 	<? if($category['id']!="6"): ?>
		 	<?php if($content['image']): ?>
        		<img  class="content-img img-polaroid" src="uploads/content/thumbnail/<?php echo $content['image'] ?>" width="89px" height="67px" />         
    		<?php else: ?>
       			<img class="content-img img-polaroid" style="float:left;margin-right:10px;" src="themes/default/media/images/logo89x67.png" width="89px" height="67px"/>    	
        	<?php endif; ?>
        	<?php endif; ?>
        	<a href="content/view/<?php echo $category['id'] ?>/<?php echo $content['id']?>"/><?php echo $content['title'] ?></a><br/>
        	<span class="textNews">      		
        		<?php echo $content['intro']; ?>
        	</span> 
        	<span class="dataNew">(<?php echo  db_to_th($content['start_date']); ?>)</span>
			<?php if( $content['file']): ?>
			<div class= "download" id="download" >
				<a href="document/download/<?php echo  $content['id']; ?>">
					<span class="btn btn-mini">
					<i class="icon-file"></i> <?php echo  $content['doc'] ?>
					</span>
				</a>
			</div>
			<?php endif; ?>

        </li>
        <div class="clr"></div><hr class="hr1">    
		<?php endforeach; ?>
	</ul>
</div>
<?php echo $pagination; ?>