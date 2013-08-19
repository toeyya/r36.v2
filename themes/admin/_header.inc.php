<div id="site-info"><strong>Site:</strong> <a href="home">ร.36</a></div>
<div id="login-info"><strong>Login as:</strong> <?php echo login_data(" userfirstname +' '+usersurname as name") ?> - <? echo $this->session->userdata('R36_LEVEL_NAME');?>| <a href="users/admin/auth/logout" onclick="return confirm('ยืนยันการออกจากระบบ')" >Logout</a></div> 
<div class="clear"></div>