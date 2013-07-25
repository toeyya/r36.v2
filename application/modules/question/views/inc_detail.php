<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="question/index">คำถามที่พบบ่อย</a><span class="divider">/</span></li>
    <li><?php echo $question_name; ?></li>
</ul>
<h1><img src="themes/default/media/images/title_faq.png" width="121" height="28"></h1>
<hr class="hr1">
<div>
<ul class="question" >
	<?php foreach($result as $item): ?>
	<li><span class="bold"><?php echo $item['question'] ?></span>
		<p><span class="answer">คำตอบ</span><?php echo strip_tags($item['answer'],'<br>'); ?></p>
	</li>
	<hr class="hr1">
	<?php endforeach; ?>	
</ul>

<?php echo $pagination; ?>
</div>	
