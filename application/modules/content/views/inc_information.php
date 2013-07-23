<div id="news-pr">
  <ul>
  	<?php foreach($contents as $item): ?>
	<li><a href="content/view/<? echo $item['category_id'] ?>/<? echo $item['id'] ?>"><?php echo $item['title'] ?></a></li>                
  	<?php endforeach; ?>
  </ul>
 </div>
<a href="content/view_all/<?php echo $category_id ?>" class="btn_readAll"  name="submit" ></a>