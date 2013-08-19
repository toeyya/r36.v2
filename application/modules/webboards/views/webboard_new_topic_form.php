<style type="text/css">
table.form td {
padding:5px;
}
table.form th {
padding:5px;
text-align:right;
vertical-align:middle;
white-space:nowrap;
}
table.form th.top {
vertical-align:top;
}
table.form select {
width:250px;
}
table.form textarea {
height:100px;
width:250px;
}
table.form input.full[type="text"] {
width:500px;
}
table.form textarea.full {
width:500px;
}
table.form .img {
border:1px solid #CCCCCC;
}
table.form td .cirkuitSkin td.mceToolbar {
padding:1px 0 2px;
}
</style>


<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/tinymce.js"></script>

<ul class="breadcrumb">
  <li><a href="home">หน้าแรก</a><span class="divider">/</span></li>
  <li><a href="webboards">เว็บบอร์ด</a><span class="divider">/</span></li>
  <li><a href="webboards/category/<?php echo $categories['id']?>"><?php echo $categories['name']?></a><span class="divider">/</span></li>
  <li class="active">ตั้งกระทู้ใหม่</li>
</ul>
<div id="webboardpage">
	<h1>ตั้งกระทู้ใหม่</h1>
	<div id="data">
				<form id="frm-post" action="webboards/save/<?php echo $categories['id']?>/<?php echo $webboard_quizs['id']?>" method="post">
					<table class="form">
						<tr>
							<th>หัวข้อ</th>
							<td><?php echo form_input('title',$webboard_quizs['title'],'style="width:400px;"')?>
						</tr>			
						
						
						<tr>
							<th></th>
							<td>
								<?php echo uppic_mce();?>
							</td>
						</tr>
						<tr class="textarea">
							<th class="top">เนื้อหา</th>
							<td>
								<textarea name="detail" cols="20" class="editor[pm]"><?php echo $webboard_quizs['detail']?></textarea>
								<?php echo form_hidden('webboard_category_id',$categories['id'])?>
								<?php echo form_hidden('type',$topic_type)?>
							</td>
						</tr>
						
						<tr><th>ชื่อ</th><td><?php echo (is_login()) ? login_data("userfirstname").' '.login_data('usersurname'):''  ?> 					  			   
						</td></tr>
						<tr><th></th><td><img src="img.php" /></td></tr>
						<tr><th>รหัสลับ</th><td><?php echo form_input('captcha', NULL, 'size="14" class="input-small"'); ?></td></tr>
						<tr><th></th><td><button type="submit"  class="btn btn-primary">บันทึก</button></td></tr>
					</table>
					<?php echo ($webboard_quizs['id']) ? form_hidden('updated',time()) : form_hidden('created',time())?>
				</form>
	</div>
</div>
<script type="text/javascript" src="media/js/jquery.validate.min.js"></script>
<script language="javascript">
    $(function(){
        $("#frm-post").validate({
            rules: 
            {
                title: {required: true },
                captcha: { required: true, remote: "users/check_captcha" }
            },
            messages:
            {
                title: { required: "กรุณากรอกหัวข้อค่ะ" },              
                captcha: { required: "กรุณากรอกตัวอักษรตัวที่เห็นในภาพค่ะ", remote: "กรุณากรอกตัวอักษรให้ตรงกับภาพค่ะ" }
            }
        });
    });
</script>