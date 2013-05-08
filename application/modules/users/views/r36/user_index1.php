<script type="text/javascript">
	$(window).load(function(){
		var browser;
		 if($.browser.mozilla)browser = "user/popup_list";                   
         else if($.browser.msie)browser = "popup_list";
             
		if($('input[name=chk]').val()=="show_popup"){
			window.open(browser,'popup_list','width=800,height=400,status=no,scrollbars=yes,toolbar=no,menubar=no,location=no,top=100,left=10'); 						
		}
		return false;
	});
</script>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="formlogin">
	<input name="action" type="hidden" value="">	
	<input name="chk" type="hidden" value="<?php echo $chk ?>">
	<table width="100%"  class="tbform tbnoborder">
	  <tr>	  	
			<td width="43%" valign="top" style='border:none'>
				<?php if($this->session->userdata('R36_UID') && $this->session->userdata('R36_LEVEL')=='00'): ?>
					<table width="65%" border="0" align="center" cellpadding="5" cellspacing="1"  class="tbform">
		                  <tr><th height="15" class="thhead"></th></tr>
		                  <tr><td><img src="images/user1_find.gif" border="0">&nbsp;<a href="user/search">ค้นหาผู้ใช้ระบบ</a></td></tr>
		                  <tr><td><img src="images/user1_add.gif" border="0">&nbsp;<a href="user/form">เพิ่มผู้ใช้ระบบ</a></td></tr>
		                  <tr><td><img src="images/edit16x16.gif" border="0">&nbsp;<a href="user/edit_template">ปรับแต่งข้อความต้อนรับ</a></td> </tr>
						  <tr><td ><img src="images/log-icon.png" border="0" >&nbsp;<a href="log/index">ประวัติการเข้าใช้ระบบ</a></td></tr>
		                  <tr><th height="15" class="thhead"></th></tr>
		        	</table>
		        <?php endif; ?>
			</td>	
			<td width="57%" style='border:none'>
					<table width="65%" border="0" align="left" cellpadding="5" cellspacing="1" class="tbform">
					  <tr>
						<th colspan="2" class="thhead"><div align="center" class="headtable">ยินดีต้อนรับ<BR>คุณ <?php echo $rs['userfirstname']?> <?php echo $rs['usersurname']?></div></th>
					  </tr>
					  <tr>
						<th width="34%" ><div align="right" class="topic">Username :&nbsp;&nbsp;</div></th>
						<td width="66%" ><?php echo $rs['username']?></td>
					  </tr>
					  <tr>
						<th><div align="right"  class="topic">ชื่อ :&nbsp;&nbsp;</div></th>
						<td><?php echo $rs['userfirstname']?></td>
					  </tr>
					  <tr>
						<th><div align="right"  class="topic">นามสกุล :&nbsp;&nbsp;</div></th>
						<td><?php echo $rs['usersurname']?></td>
					  </tr>
					  <tr>
						<th><div align="right"  class="topic">E-mail :&nbsp;&nbsp;</div></th>
						<td><?php echo $rs['usermail']?></td>
					  </tr>
					  <tr>
						<td colspan="2" align="center">
						<? if($this->session->userdata('R36_LEVEL')=='00' || $this->session->userdata('R36_LEVEL')=='02' || $this->session->userdata('R36_LEVEL')=='03' || $this->session->userdata('R36_LEVEL')=='05'){?>
						<img src="images/warning2.gif" width="16" height="16" align="absmiddle"> 
						<a href="user/popup_list" target="_blank">ตารางนัดหมายคนไข้</a>
						 <img src="images/warning2.gif" width="16" height="16" align="absmiddle"><br>
						<? }?>
						<img src="images/data_edit.gif" border="0"> <a href="user/form/edit/<?php echo $rs['uid'] ?>">แก้ไขข้อมูลส่วนตัว</a><br>
						<img src="images/lock2.gif" border="0"> <a href="user/logout">ออกจากระบบ</a></td>
					  </tr>
					</table>
			</td>
	  </tr>
	</table>
</form>