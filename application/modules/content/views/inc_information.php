<img src="themes/default/images/icon-tv.png" width="20" height="26" style="display:block; float:left;"> 
<span class="title_pr">ข่าวประชาสัมพันธ์</span> 
<div class="viewAll">
	<img src="themes/default/images/bullet_arrow.png" width="3" height="5" /> <a href="content/index/1" class="viewAll_1">ดูทั้งหมด</a>
 </div>
<div class="clr"></div><hr class="hr1">
<div id="contentNewsPR">
 <ul>
 	<?php foreach($contents as $item): ?>
        <li>
        	<img src="uploads/content/<?php echo $item['image'] ?>" width="92px" height="67px" class="imgNews"/>
        	<a href="content/view/<?php echo $item['category_id'] ?>/<?php echo $item['id']?>"/><?php echo $item['title'] ?></a><br/>
        	<span class="textNews">      		
        		<?php echo $item['intro']; ?>
        	</span> 
        	<span class="dataNew">(<?php echo mysql_to_th($item['start_date']) ?>)</span>
        </li>
        <div class="clr"></div><hr class="hr1">    
    <?php endforeach; ?>
    </ul>
</div>