<ul id="breadcrumbs">
  <li><a href="home">หน้าแรก</a></li>
  <li class="active">เว็บบอร์ด</li>
</ul>

<div id="webboardpage">
	<h1 class="green">เว็บบอร์ด</h1>
	<div id="data">
		<table class="tbwebboard">
			<tbody>
				<?php foreach($categories as $category): ?>
				 <tr>
                  <td><img src="media/images/webboard/ico_folder.png" height="32" width="32" style="max-width:32px; height:32px;"></td>
                  <td><a href="webboards/category/<?php echo $category['id']?>" class="topicpost"><?php echo $category['name']?></a><br/><?php echo $category['description'];?></td>
                  <?php  $quiz_result_count = $this->quiz->get_one("count(*)","webboard_category_id",$category['id']);
                  				$answer_result_count = $this->answer->get_one("count(*)","webboard_category_id",$category['id']);
								//$quiz= $this->quiz->where("webboard_category_id = ".$category['id'])->sort("")->order("id desc")->limit(1)->get();
								$quiz = $this->db->GetRow("select * from webboard_quizs where webboard_category_id=".$category['id']." order by id desc limit 1");
								
                  	?>
                  <td width="10%"><?php echo $quiz_result_count ?> กระทู้<br><?php  echo $answer_result_count; ?> ตอบ</td>
                  <td width="25%">กระทู้ล่าสุด <br><span class="f10"><?php echo @mysql_to_th($quiz['created'],'S',TRUE)?></span></br>
                  <?php if(!empty($quiz['user_id'])): ?>
		                  	<?php if($quiz['user_id']): ?>  
		                  						<?php $display=$this->user->get_one("display","id",$quiz['user_id']) ?>                                     
		                    โดย <a href="users/profile/<?php echo $quiz['user_id']?>" ><?php echo $display?></a>
		                    <?php else: ?>
		                     โดย <a href="javascript:;" ><?php echo $quiz['author']?></a>
		                    <?php endif; ?>
                    <?php endif; ?>
                  </td>
                </tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>