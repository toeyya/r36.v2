<ul class="breadcrumb">
  <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
  <li class="active">เว็บบอร์ด</li>
</ul>

<div id="webboardpage">
	<h1 class="green">เว็บบอร์ด</h1>
	<div id="data">
		<table class="tbwebboard table">
			<tbody>
				<?php foreach($categories as $category): ?>
				 <tr>
                  <td><img src="themes/default/media/images/webboards/folder.png" height="48" width="48" style="max-width:48px; height:48px;"></td>
                  <td><a href="webboards/category/<?php echo $category['id']?>" class="topicpost"><?php echo $category['name']?></a><br/><?php echo $category['description'];?></td>
                  <?php  $quiz_result_count = $this->quiz->get_one("count(*)","webboard_category_id",$category['id']);
                  		$answer_result_count = $this->answer->get_one("count(*)","webboard_category_id",$category['id']);
						//$quiz= $this->quiz->where("webboard_category_id = ".$category['id'])->sort("")->order("id desc")->limit(1)->get();
						$quiz = $this->db->GetRow("select * from webboard_quizs where webboard_category_id = ".$category['id']." order by id desc");
								
                  	?>
                  <td width="10%"><?php echo $quiz_result_count ?> กระทู้<br><?php  echo $answer_result_count; ?> ตอบ</td>
                  <td width="25%">กระทู้ล่าสุด <br><span class="f10"><?php echo (!empty($quiz['created']) && $quiz['created']!="0000-00-00") ? db_to_th($quiz['created'],'S',TRUE):''?></span></br>
                  <?php                   
                  if(!empty($quiz['user_id'])): ?>		                  	
		              	<?php $name = $this->user->get_row("uid",$quiz['user_id']); 
		              	  if(!empty($name)): ?> 		              	                                    
		                                          โดย <a href="users/profile/<?php echo $quiz['user_id']?>" ><?php echo $name['userfirstname'].' '.$name['usersurname']?></a>		                   		                		                  
                    <?php endif; ?>
                     <?php endif; ?>
                  </td>
                </tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>