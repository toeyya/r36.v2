<ul class="breadcrumb">
  <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
  <li class="active">เว็บบอร์ด</li>
</ul>

<div id="webboardpage">
<h1><img src="themes/default/media/images/title_webboard.png" width="75" height="28"></h1>
	<div id="data">
		<table class="tbwebboard table">
			<tbody>
				<?php foreach($categories as $category): ?>
				 <tr>
                  <td><img src="themes/default/media/images/webboards/folder.png" height="48" width="48" style="max-width:48px; height:48px;"></td>
                  <td><a href="webboards/category/<?php echo $category['id']?>" class="topicpost"><?php echo $category['name']?></a><br/><?php echo $category['description'];?></td>
                  <?php  $quiz_result_count = $this->quiz->get_one("count(*)","webboard_category_id",$category['id']);
                  		$answer_result_count = $this->answer->get_one("count(*)","webboard_category_id",$category['id']);
						
						$quiz = $this->db->GetRow("select *, CONVERT(VARCHAR(19), created, 120) as created from webboard_quizs where webboard_category_id = ".$category['id']." order by id desc");
						array_walk($quiz,'dbConvert');		
                  	?>
                  <td width="10%"><?php echo $quiz_result_count ?> กระทู้<br><?php  echo $answer_result_count; ?> ตอบ</td>
                  <td width="25%">
                  	<?php if($quiz_result_count>0){ ?>
                  	กระทู้ล่าสุด <br><span class="f10"><?php echo (!empty($quiz['created']) && $quiz['created']!="null") ? db_to_th($quiz['created'],'S',TRUE):''?></span></br>
                                                            โดย 										
					<?php if(!empty($quiz['user_id'])): ?>
					 	<?php if($this->session->userdata('R36_LEVEL')=="00"): ?>		
					 	<a href="users/r36/users/index/<?php echo $quiz['user_id']?>" ><?php $u=$this->user->get_row("uid",$quiz['user_id']);echo $u['userfirstname'].' '.$u['usersurname'] ?></a>
						<?php else: ?>						
						<?php $u=$this->user->get_row("uid",$quiz['user_id']);echo $u['userfirstname'].' '.$u['usersurname'] ?>
						<?php endif; ?>
					<?php endif; ?> 
					<? } ?>                
                  </td>
                </tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>