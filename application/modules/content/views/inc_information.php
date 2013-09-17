<img src="themes/default/media/images/title_pr.png" width="141" height="25" /><hr class="hr1">
<div id="news-pr">
  <ul>
  	
  	<?php foreach($contents as $item): ?>
  		<?if ($item['url']=='') {?>
  			<li><a href="content/view/<?php echo $item['category_id'] ?>/<?php echo $item['id']?>/<?php echo $item['url']?>"/><?php echo $item['title'] ?></a></li>
  			<? }
  			else {?>
				<li><a href="<?php echo $item['url']?>"><?php echo $item['title'] ?></a></li>  
			 <? }
  			?>	                
  	<?php endforeach; ?>
  </ul>
 <a href="content/view_all/<?php echo $category_id ?>" class="btn_readAll"  name="submit" ></a>
 <span class="clear"></span>
</div>
