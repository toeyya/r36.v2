
    <div class="login content-left ">   		
    		<span class="text-loginSystem">ลงชื่อเข้าใช้ระบบ</span>
    		
    		<div id="login_aleady">    			   	 	   	
		    	<ul>
		    		<li class="usermail">สวัสดี :<label><?php echo $this->session->userdata('R36_MAIL'); ?></label></li>
		    		<li class="level_name">ประเภท :<label><?php echo $this->session->userdata('R36_LEVEL_NAME'); ?></label></li>
		    		<hr class="hr1">
		    		<li>			  	
					   <div style="text-align:center;">
						<?php 
						$link ="users/r36/users/index/".$this->session->userdata('R36_UID');
						if($this->session->userdata('confirm_email')=="1" && $this->session->userdata('confirm_province')=="1" && $this->session->userdata('confirm_admin')=="1"){									
							$link ='inform/index';									
						}?>					   	
					   	<a href="<?php echo $link ?>" 			target="_blank" class="btn btn-mini btn-info"  name="prog_r36">โปรแกรม ร.36</a> 					   						
						<a href="gis_map" 		target="_blank" class="btn btn-mini btn-info"  name="link_map">ระบบภูมิศาสตร์ ฯ(GIS)</a>
					    <a href="users/logout" class="btn btn-small" style="margin-top:5px;"   name="logout">ออกจากระบบ</a>
					   </div>
					 	
		   			</li>
		    	</ul> 
	    	</div>
    		
    		<div id="login_form">
	    	<form>						                      	           
	        	<div class="form-field"><input class="u_text" type="text" name="username" /><span></span>
				<input class="u_password" type="password" name="password"/></div>
				<input class="btn_go" type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;" >	           
            	<div class="forgot-usr-pwd"><a href="users/register">ลงทะเบียน</a>|<a href="users/forgetPassword">ลืมรหัสผ่าน</a></div>  
             </form>                      			        	
        	</div>                                              
    </div>
<link rel="stylesheet" href="media/js/jquery.notifyBar.css" type="text/css" media="screen" />
<script type="text/javascript" src="media/js/jquery.notifyBar.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#login_aleady').hide();$('a[name=link_map]').hide();
<?php if($this->session->userdata('R36_UID')){ ?>
	$('#login_aleady').show();$('#login_form').hide();
<?php } ?>
<?php if($this->session->userdata('R36_LEVEL')!== FALSE){ 
		if($this->session->userdata('login_gis')=="1" || permission('gis','act_read')){ ?>
			$('a[name=link_map]').show();
<?php }} ?>	
					
				
function set_notify(pcls,phtml){
	$(function (){
		$.notifyBar({
	  		cls:  pcls,
	    	html: phtml,
	    	delay: 500,
	    	animationSpeed: "normal"
		});
	});   	
}
	$('.btn_go').click(function(e){
		var email = $('input[name=username]').val();
		var password = $('input[name=password]').val();	
		if(email.length==0 && password.length==0){
			set_notify('error','กรุณาทำการล็อคอินค่ะ');
		}else{									
			$.ajax({
				url:'users/login',
				dataType:'json',
				type:'post',
				data:'username='+email+'&password='+password,
				success:function(data){
					if(data.cls=="success"){
						$('#login_aleady').show();
						$('#login_form').hide();
						$('a[name=prog_r36]').attr('href',data.link);
						$('.usermail').find('label').text(data.r36_mail);
						$('.level_name').find('label').text(data.r36_level);
						$(data.btn_gis).insertAfter('a[name=prog_r36]');
						if(data.gis1 || data.gis2){
							$('a[name=link_map]').show();
						}						
					}					
  					set_notify(data.cls,data.html);
	   			}
			})
	  }//else
	  e.preventDefault();
	})	

})	    
</script>