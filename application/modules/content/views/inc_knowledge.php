<img src="themes/default/media/images/title_2.png" width="69" height="25" /><hr class="hr1">
<div class="pic">	
	<?php foreach($contents as $item): ?>
     <div class="span4">
     <?php if(!empty($item['image'])){  ?>
       <img class="content-img img-polaroid" style="float:left;margin-right:10px;" src="uploads/content/thumbnail/<?php echo $item['image'] ?>" width="89px" height="67px"/>
    <?php }else{ ?>
       <img class="content-img img-polaroid" style="float:left;margin-right:10px;" src="themes/default/media/images/logo89x67.png" width="89px" height="67px"/>
    <?php } ?>
        <a  href="content/view/<?php echo $item['category_id'] ?>/<?php echo $item['id']?>"/>
        <span class="title_news"><?php echo $item['title'] ?></span></a>
        <div class="textNews" ><?php echo $item['intro']; ?></div> 
              
     </div>
    <?php endforeach; ?>

<a href="content/view_all/<? echo $category_id ?>" class="btn_readAll"  name="submit" ></a>
<div class="clr"></div>
</div>
