<ul id="breadcrumbs"> 
	<li><a href="home">หน้าแรก</a></li> 
	<li><a href="content/index/<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li> 
</ul>
<div id="contentNewsPR">
	<ul>
		<?php foreach($contents as $content): ?>
		 <li>
		 	<?php if($content['image']): ?>
        	<img src="uploads/content/thumbnail/<?php echo $content['image'] ?>" width="92" height="67" class="imgNews"/>
        	<?php endif; ?>
        	<a href="content/view/<?php echo $category_id ?>/<?php echo $content['id']?>"/><?php echo $content['title'] ?></a><br/>
        	<span class="textNews">      		
        		<?php echo $content['intro']; ?>
        	</span> 
        	<span class="dataNew">(<?php echo mysql_to_th($content['start_date']) ?>)</span>
        </li>
        <div class="clr"></div><hr class="hr1">    
		<?php endforeach; ?>
	</ul>
</div>
<?php echo $pagination; ?>