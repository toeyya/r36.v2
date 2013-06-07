<!--  <script language="javascript">
$(function(){
	$("input[name='pollBtn2']").click(function(){
		var p = $(this).parent().parent();
		if(p.find("input[name=poll]:checked").attr('checked')){
			$.get("webboards/vote",{id:p.find("input[name=id]").val(),id_ans:p.find("input[name=poll]:checked").val()},function(data){
				p.parent().find('.poll-result').html(data).show();
				p.hide();
				$(".counter").text(parseInt($(".counter").text()) + 1);							
				});
			}
		return false;
	});
	
	$("input[name='viewBtn2']").click(function(){
		var p = $(this).parent().parent();
			$.get("webboards/view/" + p.find("input[name=id]").val(),function(data){
				p.parent().find('.poll-result').html(data).show();
				p.hide();
				});
		return false;
	});
	
});
</script> -->

<style type="text/css">
.linetopic{font-size: 12px; border-bottom: 1px solid #aaa; padding-bottom: 5px;}
ul.unstyled li{list-style-image:none; font-size: 12px; margin:0;}
</style>

<ul id="breadcrumbs">
  <li><a href="home">หน้าแรก</a></li>
  <li><a href="webboards">เว็บบอร์ด</a></li>
   <li><a href="webboards/category/<?php echo $webboard_quizs['webboard_category_id']?>"><?php echo $webboard_category['name']?></a></li>
  <li class="active"><?php echo $webboard_quizs['title']?></li>
</ul>

<div id="webboardpage">
	<h1><span>เว็บบอร์ด</span></h1>
            <div class="addtopic right" style="margin:0 0 10px 0;"><a href="webboards/reply/<?php echo $webboard_quizs['id']?>/-1"><img src="media/images/webboard/btn_post.png" height="29" width="107"></a></div><br clear="all">
				<table class="tbwebboard table table-bordered">
                <tbody>
					<tr>
                		<th width="25%" style="color:#595959; font-weight:100; text-align:center;">ดู : <?php echo $webboard_quizs['counter']?> | ตอบ : <?php echo $webboard_answer_counter; ?></th>
                		<th>กระทู้ : <?php echo $webboard_quizs['title']?></th>
                	</tr>
					<tr>
						<td valign="top" style="padding:10px 25px; vertical-align:top;">
							<img src="<?php echo avatar($users['avatar'],'thumbs/') ?>" style="padding:2px; border:1px solid #ccc;"><br>
							<ul class="unstyled">
							    <?php if($webboard_quizs['user_id']): ?>
								<li><b><?php echo $users['fullname']?></b></li>
								<?php else: ?>
								    <li><b><?php echo $webboard_quizs['author']?></b></li>
								    <li>กลุ่ม : บุคคลทั่วไป</li>
								<?php endif; ?>
								<?php if (login_data('fullname')=='Administrators'):?>
								<li>IP : <?php echo $webboard_quizs['ip']?></li>
								<?php endif;?>

							</ul>
						</td>
						<td valign="top" style="vertical-align:top;">
						<div class="linetopic"><a href="webboards/view_topic/<?php echo $webboard_quizs['id']?>" class="topicpost"><?php echo $webboard_quizs['title']?></a>
						

							<?php if($webboard_answer_counter > 15):?>
								<img src="media/images/webboard/ico_hit.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ">
							<?php else:?>
								<?php if($webboard_quizs['type'] == "normal"):?>
								<img src="media/images/webboard/ico_regular.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" height="24" width="24">						
								<?php endif;?>
							<?php endif;?>					
						<br><i class="icon-time"></i> <span class="f10"><?php echo mysql_to_th($webboard_quizs['created'],'S',TRUE)?> </span>
						<div class="boxrequestdel">
							<i class="icon-remove"></i> <a id="relate-quiz" data-toggle="modal" href='#relate' class="link_prev">แจ้งลบความคิดเห็นนี้</a><input class="quiz-id" type="hidden" name="quiz-id" value="<?=$webboard_quizs['id']?>"> 
							|<i class="icon-edit"></i> <a href="webboards/reply/<?php echo $webboard_quizs['id']?>/0" class="link_prev">อ้างถึงข้อความนี้</a></div></div>
						<div class="post">
							<?php if(login_data('fullname')=="Administrators"):?>
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
							<img src="<?php echo avatar($users['avatar'],'thumbs/') ?>" style="padding:2px; border:1px solid #ccc;"><br>
							<ul class="unstyled">
							    <?php if($webboard_ans['user_id']): ?>
								<li><b><?php echo $webboard_ans['fullname'] ?></b></li>
								<?php else: ?>
								    <li><b><?php echo $webboard_ans['author'] ?></b></li>
								    <li>กลุ่ม : บุคคลทั่วไป</li>
								<?php endif; ?>
								<?php if (login_data('fullname')=='Administrators'):?>
								<li>IP : <?php echo $webboard_ans['ip']?></li>
								<?php endif;?>

							</ul>
						<td valign="top" style="vertical-align:top;"><div class="linetopic"><a href="#" class="topicpost"><?php echo $webboard_quizs['title']?></a>

						<?php if($webboard_quizs['group_id'] != 0):?>
						<img src="media/images/webboard/ico_lock.png" alt="กระทู้เฉพาะกลุ่ม" title="<?php echo lang_decode($webboard_quiz->group->name,'th')?>" height="24" width="24">
						<?php else: ?>
							<?php $webboard_answer_counter= $this->answer->get_one("count(*)","webboard_quiz_id",$webboard_ans['webboard_quiz_id']); ?>
							<?php if($webboard_answer_counter > 15):?>
								<img src="media/images/webboard/ico_hit.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ">
							<?php else:?>
								<?php if($webboard_quizs['type'] == "normal"):?>
								<img src="media/images/webboard/ico_regular.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" height="24" width="24">								
								<?php endif;?>
							<?php endif;?>
						<?php endif;?>
						
                  <br><i class="icon-time"></i> <span class="f10"><?php echo mysql_to_th($webboard_ans['created'],'S',TRUE)?></span>
                  <div class="boxrequestdel">
                  		<i class="icon-remove"></i> <a class="relate-ans" data-toggle="modal" href='#relate' class="link_prev">แจ้งลบความคิดเห็นนี้</a>
                  		<input type="hidden" class="ans-id" value="<?php echo $webboard_ans['id']?>">
                   | 	<i class="icon-edit"></i> 		<a href="webboards/reply/<?php echo $webboard_quizs['id']?>/<?php echo $webboard_ans['id']?>/quote" class="link_prev">อ้างถึงข้อความนี้</a>
                  </div>
                  </div><br>
					<div class="post">
						<?php if(is_login('Administrator')):?>
								<div style="float:right;"><a href="webboards/reply/<?php echo $webboard_quizs['id']?>/<?php echo $webboard_ans['id']?>/edit">แก้ไข</a> | <a href="webboards/delete_answer/<?php echo $webboard_ans->id?>" onclick="return confirm('ต้องการลบความเห็นนี้?')">ลบ</a></div>
						<?php endif;?>
	                  	<?php echo censor(link_filter($webboard_ans['detail']))?>
					
						
					</div>
                  </td>
                  </tr>
				  <?php endforeach; ?>
				  
				</tbody></table>
<div id="explain">
	<img src="media/images/webboard/2.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" height="24" width="24" />กระทู้ปกติ
    <img src="media/images/webboard/3.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ" height="24" width="24"/>กระทู้น่าสนใจ
    <img src="media/images/webboard/4.png" alt="กระทู้ปักหมุด" title="กระทู้ปักหมุด" height="24" width="24">กระทู้ปักหมุด

	
</div>
<div style="padding-top: 5px;"><?php echo $pagination?></div>

</div>