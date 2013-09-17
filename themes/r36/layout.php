<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo base_url(); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title><?php echo $template['title']; ?></title> 
  <?php include_once('_css.php'); ?>
  <?php echo $template['metadata']; ?>	  
</head>
<?php flush(); ?>
<body> 
	<div class="main">
	<div class="name"></div>       
    <div class="userlogedin">
    	<span class="userlogedin_text1">ผู้ใช้:  </span>
    	 <span class="userlogedin_text2"><?php echo $this->session->userdata("R36_FNAME")." ".$this->session->userdata('R36_SURNAME') ?></span>
    	<span class="userlogedin_text1">สิทธิ์ :</span><span class="userlogedin_text2"><?php echo $this->session->userdata('R36_LEVEL_NAME')?></span>
		<span>| <a href="users/logout">ออกจากระบบ</a></span>
	</div>
  </div>
 <div class="clr"></div>	
	<div id="bg_dog1">
	<?php include '_header.php'?>
	<?php include '_script.php'; ?>      
		<div id="content">	
		<?php echo $template['body']; ?>	
		</div> 	
	</div>		
	<div class="clr"></div>	
	<div class="footer">Copyright © 2013 Department Disease Control. All Right Reserved.</div>
</body>	
  
</html>
