<style type="text/css">
.linetopic{font-size: 12px; border-bottom: 1px solid #aaa; padding-bottom: 5px;}
ul.unstyled li{list-style-image:none; font-size: 12px; margin:0;}
</style>

<ul class="breadcrumb">
  <li><a href="home">หน้าแรก</a><span class="divider">/</span></li>
  <li><a href="webboards">เว็บบอร์ด</a><span class="divider">/</span></li>
   <li><a href="webboards/category/<?php echo $webboard_quizs['webboard_category_id']?>"><?php echo $webboard_category['name']?></a><span class="divider">/</span></li>
  <li class="active"><?php echo $webboard_quizs['title']?></li>
</ul>

<div id="webboardpage">
	<h1><img src="themes/default/media/images/title_webboard.png" width="75" height="28"></h1>
            <div class="addtopic right" style="margin:0 0 10px 0;"><a href="webboards/reply/<?php echo $webboard_quizs['id']?>/-1"><img src="themes/default/media/images/webboards/btn_post.png" height="29" width="107"></a></div><br clear="all">
				<table class="tbwebboard table table-bordered">
                <tbody>
					<tr>
                		<th width="25%" style="color:#595959; font-weight:100; text-align:center;">ดู : <?php echo $webboard_quizs['counter']?> | ตอบ : <?php echo $webboard_answer_counter; ?></th>
                		<th>กระทู้ : <?php echo $webboard_quizs['title']?></th>
                	</tr>
					<tr>
						<td valign="top" style="padding:10px 25px; vertical-align:top;">
							<img src="<?php echo avatar($users['image'],'thumbs/') ?>" style="padding:2px; border:1px solid #ccc;"><br>
							<ul class="unstyled">
							    <?php if($webboard_quizs['user_id']): ?>
								<li><b><?php echo $users['userfirstname']." ".$users['usersurname']?></b></li>								
								<li>IP : <?php echo $webboard_quizs['ip']?></li>
								<?php endif;?>

							</ul>
						</td>
						<td valign="top" style="vertical-align:top;">
						<div class="linetopic"><a href="webboards/view_topic/<?php echo $webboard_quizs['id']?>" class="topicpost"><?php echo $webboard_quizs['title']?></a>						

							<?php if($webboard_answer_counter > 15):?>
								<img src="themes/default/media/images/webboards/bookmark.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ">
							<?php else:?>
								<?php if($webboard_quizs['type'] == "normal"):?>
								<img src="themes/default/media/images/webboards/chat.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" height="24" width="24">						
								<?php endif;?>
							<?php endif;?>					
						<br><i class="icon-time"></i> <span class="f10"><?php echo db_to_th($webboard_quizs['created'],'S',TRUE)?> </span>
						<div class="boxrequestdel">
							<i class="icon-remove"></i> <a id="relate-quiz" data-toggle="modal" href='#relate' class="link_prev">แจ้งลบความคิดเห็นนี้</a><input class="quiz-id" type="hidden" name="quiz-id" value="<? echo $webboard_quizs['id']?>"> 
							|<i class="icon-edit"></i> <a href="webboards/reply/<?php echo $webboard_quizs['id']?>/0" class="link_prev">อ้างถึงข้อความนี้</a></div></div>
						<div class="post">
							<?php if(login_data('userposition')=="00"):?>
								<div style="float:right;">
									  <a href="webboards/newtopic/<?php echo $webboard_quizs['webboard_category_id']?>/<?php echo $webboard_quizs['type']?>/<?php echo $webboard_quizs['id']?>">แก้ไข</a> 
									| <a href="webboards/delete_topic/<?php echo $webboard_quizs['id']?>" onclick="return confirm('ต้องการลบกระทู้นี้?')">ลบ</a></div>
							<?php endif;?>
							
							<br>
							<?php echo censor(link_filter($webboard_quizs['detail']))?>

						</div>
						</td>
					</tr>
					
					<?php foreach($webboard_answers as $webboard_ans): ?>
					<tr>
						<td valign="top"  style="padding:10px 25px; vertical-align:top;">						
							<img src="<?php echo avatar($users['image'],'thumbs/') ?>" style="padding:2px; border:1px solid #ccc;"><br>
							<ul class="unstyled">
							    <?php if($webboard_ans['user_id']): ?>
								<li><b><?php echo $webboard_ans['userfirstname']." ".$webboard_ans['usersurname'] ?></b></li>
								<li>IP : <?php echo $webboard_ans['ip']?></li>								    
								<?php endif; ?>


							</ul>
						<td valign="top" style="vertical-align:top;"><div class="linetopic"><a href="#" class="topicpost"><?php echo $webboard_quizs['title']?></a>

							<?php $webboard_answer_counter= $this->answer->get_one("count(*)","webboard_quiz_id",$webboard_ans['webboard_quiz_id']); ?>
							<?php if($webboard_answer_counter > 15):?>
								<img src="themes/default/media/images/webboards/bookmark.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ">
							<?php else:?>
								<?php if($webboard_quizs['type'] == "normal"):?>
								<img src="themes/default/media/images/webboards/chat.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" height="24" width="24">								
								<?php endif;?>
							<?php endif;?>
						
						
                  <br><i class="icon-time"></i> <span class="f10"><?php echo db_to_th($webboard_ans['created'],'S',TRUE)?></span>
                  <div class="boxrequestdel">
                  		<i class="icon-remove"></i> <a class="relate-ans" data-toggle="modal" href='#relate' class="link_prev">แจ้งลบความคิดเห็นนี้</a>
                  		<input type="hidden" class="ans-id" value="<?php echo $webboard_ans['id']?>">
                   | 	<i class="icon-edit"></i> 		<a href="webboards/reply/<?php echo $webboard_quizs['id']?>/<?php echo $webboard_ans['id']?>/quote" class="link_prev">อ้างถึงข้อความนี้</a>
                  </div>
                  </div><br>
					<div class="post">
						<?php if(login_data('userposition')=="00"):?>
								<div style="float:right;"><a href="webboards/reply/<?php echo $webboard_quizs['id']?>/<?php echo $webboard_ans['id']?>/edit">แก้ไข</a> | <a href="webboards/delete_answer/<?php echo $webboard_ans['id']?>" onclick="return confirm('ต้องการลบความเห็นนี้?')">ลบ</a></div>
						<?php endif;?>
	                  	<?php echo censor(link_filter($webboard_ans['detail']))?>
					
						
					</div>
                  </td>
                  </tr>
				  <?php endforeach; ?>
				  
				</tbody></table>
<div id="explain">
	<img src="themes/default/media/images/webboards/chat.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" height="24" width="24" />กระทู้ปกติ
    <img src="themes/default/media/images/webboards/bookmark.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ" height="24" width="24"/>กระทู้น่าสนใจ
    <img src="themes/default/media/images/webboards/pinning.png" alt="กระทู้ปักหมุด" title="กระทู้ปักหมุด" height="24" width="24">กระทู้ปักหมุด	
</div>
<div style="padding-top: 5px;"><?php echo $pagination?></div>

</div>