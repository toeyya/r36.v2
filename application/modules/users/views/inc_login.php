<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21" height="21"><img src="themes/default/media/images/tbCol1_topLeft.png" width="21" height="21" /></td>
    <td background="themes/default/media/images/tbCol1_top.png">&nbsp;</td>
    <td width="21" height="21"><img src="themes/default/media/images/tbCol1_topRight.png" width="21" height="21" /></td>
  </tr>
  <tr>
    <td background="themes/default/media/images/tbCol1_left.png">&nbsp;</td>
    <td bgcolor="#FFFFFF" height="202" valign="top">
    <div class="login">
    	<?php if($this->session->userdata('R36_UID')): ?> 
    	<span class="text-loginSystem">ลงชื่อเข้าใช้ระบบ</span> 	
    	<ul>
    		<li>สวัสดี :<label><?php echo $this->session->userdata('R36_MAIL')?></label></li>
    		<li>ประเภท :<label><?php echo $this->session->userdata('R36_LEVEL_NAME'); ?></label></li>
    		<hr class="hr1">
    		<li>
			   <?php 
			   $link="users/r36/users/index/".$this->session->userdata('R36_UID'); 
			   if($this->session->userdata('confirm_email')=="1" && $this->session->userdata('confirm_province')=="1" && $this->session->userdata('confirm_admin')=="1"): ?>
			   	<?php $link="inform/index"; ?>
			   <?php endif; ?>			
			   <div style="text-align:center;"><a href="<? echo $link ?>" target="_blank" class="btn btn-mini btn-info">โปรแกรม ร.36</a>  
			  	<?php //if($this->session->userdata('login_gis')=="1"): ?>
			   <a href="map/index" target="_blank" class="btn btn-mini btn-info">ระบบภูมิศาสตร์ ฯ(GIS)</a>
			   <?php //endif; ?></br>
			   <a href="users/logout" class="btn btn-mini" style="margin-top:5px;">logout</a></div>
			 	
   			</li>
    	</ul> 
    	 <?php else: ?>
    	<form action="users/login" method="post">
		<span class="text-loginSystem">ลงชื่อเข้าใช้ระบบ</span> 			                      	           
        	<div class="username-field"><input class="input_box" type="text" name="username" value="" /></div>
			<div class="password-field"><input class="input_box" type="password" name="password" value="" /></div>
			<input class="btn_go" type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;" >
            <div class="forgot-usr-pwd"><a href="users/register">ลงทะเบียน</a>|<a href="users/forgetPassword">ลืมรหัสผ่าน</a></div>                        			
         </form>
         <?php endif; ?>                            
    </div>
    </td>
    <td background="themes/default/media/images/tbCol1_right.png">&nbsp;</td>
  </tr>
  <tr>
    <td width="21" height="21"><img src="themes/default/media/images/tbCol1_bottomLeft.png" width="21" height="21" /></td>
    <td background="themes/default/media/images/tbCol1_bottom.png">&nbsp;</td>
    <td width="21" height="21"><img src="themes/default/media/images/tbCol1_bottomRight.png" width="21" height="21" /></td>
  </tr>
</table>