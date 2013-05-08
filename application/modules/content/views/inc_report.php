<img src="themes/default/images/icon-report.png" width="24" height="30" border="0" style="display:block; float:left;"/>
<span class="title_Vision">รายงานผลการดำเนินงาน</span> 
<div class="viewAll"><img src="themes/default/images/bullet_arrow.png" width="3" height="5" /> <a href="content/index/11" class="viewAll_1">ดูทั้งหมด</a></div>
<div class="clr"></div><hr class="hr1">
<div id="report">
    <ul>
    	<?php foreach($contents as $content): ?>
        <li>	<a href="content/view/<?php echo $content['category_id'] ?>/<?php echo $content['id']?>"/><?php echo $content['title'] ?></a></li>
        <?php endforeach; ?>       
    </ul>
</div>