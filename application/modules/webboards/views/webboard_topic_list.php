<style>
.admin_action{font-size:12px;}
</style>
<ul id="breadcrumbs">
  <li><a href="home">หน้าแรก</a></li>
  <li><a href="webboards">เว็บบอร์ด</a></li>
  <li class="active"><?php echo $category['name']?></li>
</ul>

<div id="webboardpage">
	<h1 class="green">
		<span>เว็บบอร์ด</span>
		<div class="corner_left"></div>
		<div class="corner_right"></div>
	</h1>
	<div id="data">
		<div class="addtopic right"><a href="webboards/newtopic/<?echo $category_id?>/normal"><img src="media/images/webboard/btn_newpost.png" height="29" width="102" style="margin-bottom:10px;"></a></div><br clear="all">
		<table class="tbwebboard">
			<tbody>
				<tr style="background: url(&quot;images/bg_topboard.gif&quot;) repeat-x scroll 0% 0% transparent;">
					<th width="24"><img src="media/images/webboard/ico_pin.png" alt="กระทู้ปักหมุด" title="กระทู้ปักหมุด" style="max-width:24px;height:24px;"></th>
					<th width="61%">กระทู้</th>
					<th width="6%">อ่าน</th>
					<th width="6%">ตอบ</th>
					<th width="24%">ความคิดเห็นล่าสุด</th>
				</tr>
				
				<?php foreach($webboard_quizs_stick as $webboard_quiz): ?>
				<tr>
					<td>
							<?php  $result_count=$this->db->GetOne("select count(*)as cnt from webboard_quizs left join webboard_answers on webboard_quiz_id=webboard_quizs.id");?>
							<?php if($result_count > 15):?>							
							<img src="media/images/webboard/ico_hit.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ" />
							<?php else:?>
								<?php if($webboard_quiz['type'] == "normal"):?>
								<img src="media/images/webboard/ico_regular.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" />
								<?php elseif($webboard_quiz['type'] == "vote"):?>
								<img src="media/images/webboard/ico_pollboard.png" alt="โพล" title="โพล" />
								<?php endif;?>
							<?php endif;?>
					</td>
					<td>
						<a href="webboards/view_topic/<?php echo $webboard_quiz['id']?>" class="topicpost"><?php echo $webboard_quiz['title']?></a><br>
โดย <a href="users/profile/<?php echo $webboard_quiz['user_id']?>" ><?php echo $webboard_quiz['author'] ?></a><img src="media/images/webboard/ico_time.png" style="margin-bottom: -2px;" height="12"  width="12"> 
		<span class="f10"><?php echo mysql_to_th($webboard_quiz['created'],'S',TRUE) ?></span>

						<?php if (login_data('fullname')=='Administrators'):?>
						<div class="admin_action">
							<?php if($webboard_quiz['stick'] == 0):?>
							<a href="webboards/stick_thread/<?php echo $webboard_quiz['id']?>">ปักหมุด</a> | 
							<?php else:?>
							<a href="webboards/unstick_thread/<?php echo $webboard_quiz['id']?>">ยกเลิกปักหมุด</a> | 
							<?php endif;?>
							<a href="webboards/newtopic/<?php echo $category_id?>/<?php echo $webboard_quiz['type'] ?>/<?php echo $webboard_quiz['id']?>">แก้ไข</a> | 
							<!-- <a rel="lightbox" href="webboards/topic_move_category/<?php echo $webboard_quiz->id?>?iframe=true&width=410&height=200">ย้าย</a> |  -->
							<a href="webboards/delete_topic/<?php echo $webboard_quiz['id']?>" onclick="return confirm('ต้องการลบกระทู้นี้?')">ลบ</a>
						</div>
						<?php endif;?>
					</td>
					<td class="aligncenter"><?php echo $webboard_quiz['counter'] ?></td>
					<td class="aligncenter"><?php  echo $this->answer->get_one("count(*)","webboard_quiz_id",$webboard_quiz['id']);  ?></td>
					<td>
						<?php
						$result_count=$this->db->GetRow("select *,count(*)as cnt from  webboard_answers where webboard_quiz_id=".$webboard_quiz['id']);
						 if($result_count['cnt']):?>
						<span class="f10">
							<?php //echo mysql_to_th($webboard_quiz->webboard_answer->order_by("id", "desc")->limit(1)->get()->created,'S',TRUE)
								$rs=$this->db->GetRow("SELECT *,max(created) as max_created FROM webboard_answers WHERE webboard_quiz_id=".$webboard_quiz['id']);
									echo mysql_to_th($rs['max_created'],"S",TRUE);
							?>	
							</span>
							โดย 
							<?php if($rs['user_id']): ?>						
							 	<a href="users/profile/<?php echo $rs['user_id']?>" ><?php echo $this->user->get_one("fullname","id",$rs['user_id']); ?></a>
							<?php else: ?>						
								<?php echo $rs['author'] ?>
							<?php endif; ?>
						<?php else: ?>
						ไม่มีความคิดเห็น :(
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach;?>
				
				<tr style="background: #eee;">
					<td width="4%"></td>
					<td width="61%">ชื่อกระทู้</td>
					<td width="6%">อ่าน</td>
					<td width="6%">ตอบ</td>
					<td width="24%">ความคิดเห็นล่าสุด</td>
				</tr>
				
				<?php foreach($webboard_quizs as $webboard_quiz): ?>
				<tr>
					<td>

							<?php  $result_count=$this->db->GetOne("select count(*)as cnt from webboard_answers where webboard_quiz_id=".$webboard_quiz['id']);?>
							<?php if($result_count > 15):?>
								<img src="media/images/webboard/ico_hit.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ" />
							<?php else:?>
								<?php if($webboard_quiz['type'] == "normal"):?>
								<img src="media/images/webboard/ico_regular.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" />
								<?php elseif($webboard_quiz['type'] == "vote"):?>
								<img src="media/images/webboard/ico_pollboard.png" alt="โพล" title="โพล" />
								<?php endif;?>
							<?php endif;?>

					</td>
					<td>
						<a href="webboards/view_topic/<?php echo $webboard_quiz['id']?>" class="topicpost"><?php echo $webboard_quiz['title']?></a><br />
						<?php if($webboard_quiz['user_id']): ?>
						โดย <a href="users/profile/<?php echo $webboard_quiz['user_id']?>" ><?php echo $webboard_quiz['fullname'] ?></a>
						<?php else: ?>
						โดย <a href="javascript:;" ><?php echo $webboard_quiz['author'] ?></a>    
						<?php endif; ?>
						<img src="media/images/webboard/ico_time.png" style="margin-bottom: -2px;" height="12" width="12"> 
						<span class="f10"><?php echo mysql_to_th($webboard_quiz['created'],'S',TRUE) ?> 
														<?php if($webboard_quiz['group_id'] != 0):?>
															(<?php echo $webboard_quiz['group_name'] ?>)
														<?php endif;?>
						</span>

						<?php if (login_data('fullname')=='Administrators'):?>
						<div class="admin_action">
							<?php if($webboard_quiz['stick'] == 0):?>
							<a href="webboards/stick_thread/<?php echo $webboard_quiz['id']?>">ปักหมุด</a> | 
							<?php else:?>
							<a href="webboards/unstick_thread/<?php echo $webboard_quiz['id']?>">ยกเลิกปักหมุด</a> | 
							<?php endif;?>
							<a href="webboards/newtopic/<?php echo $category_id?>/<?php echo $webboard_quiz['type'] ?>/<?php echo $webboard_quiz['id']?>">แก้ไข</a> | 
							<!-- <a rel="lightbox" href="webboards/topic_move_category/<?php echo $webboard_quiz->id?>?iframe=true&width=410&height=200">ย้าย</a> |  -->
							<a href="webboards/delete_topic/<?php echo $webboard_quiz['id']?>" onclick="return confirm('ต้องการลบกระทู้นี้?')">ลบ</a>
						</div>
						<?php endif;?>
					</td>
					<td class="aligncenter"><?php echo $webboard_quiz['counter'] ?></td>
					<td class="aligncenter"><?php  echo $this->answer->get_one("count(*)","webboard_quiz_id",$webboard_quiz['id']);  ?></td>
					<td>
					<?php
						$result_count=$this->db->GetRow("select *,count(*)as cnt from  webboard_answers where webboard_quiz_id=".$webboard_quiz['id']);
						 if($result_count['cnt']):?>
						<span class="f10">
							<?php //echo mysql_to_th($webboard_quiz->webboard_answer->order_by("id", "desc")->limit(1)->get()->created,'S',TRUE)
									$rs=$this->db->GetRow("SELECT *,max(created) as max_created FROM webboard_answers WHERE webboard_quiz_id=".$webboard_quiz['id']);
									echo mysql_to_th($rs['max_created'],"S",TRUE);
							?>	
							</span>
							โดย 
							<?php if($rs['user_id']): ?>						
							 	<a href="users/profile/<?php echo $rs['user_id']?>" ><?php echo $this->user->get_one("fullname","id",$rs['user_id']); ?></a>
							<?php else: ?>						
								<?php echo $rs['author'] ?>
							<?php endif; ?>
						<?php else: ?>
						ไม่มีความคิดเห็น :(
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach;?>
				
				
				</tbody></table>
			<div style="padding-top: 5px;"><?php echo $pagination ?></div>
		<div id="explain">
			<img src="media/images/webboard/2.png" alt="กระทู้ปกติ" title="กระทู้ปกติ" height="24" width="24" />กระทู้ปกติ
			<img src="media/images/webboard/3.png" alt="กระทู้น่าสนใจ" title="กระทู้น่าสนใจ" height="24" width="24"/>กระทู้น่าสนใจ
			<img src="media/images/webboard/4.png" alt="กระทู้ปักหมุด" title="กระทู้ปักหมุด" height="24" width="24">กระทู้ปักหมุด
			</div>
</div>
	</div>