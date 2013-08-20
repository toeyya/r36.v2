<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $template['title']; ?></title>
<?php include('_script.php'); ?>
 <?php echo $template['metadata']; ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43317447-1', '164.115.32.57');
  ga('send', 'pageview');

</script>

</head>
<body>
<div id="wrap">
    <div class="main">
    	<div class="logo"></div>
        <div class="name"></div>
        <div class="clr"></div>
		<?php include('_menu_top.php'); ?>
        <div class="animal"></div>
        <div class="clr"></div>
        <div id="col1">
			<?php include('_menu_left.php'); ?>
			<br>
				<?php echo modules::run('users/inc_login'); ?>
            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="21" height="21"><img src="themes/default/media/images/tbCol1_topLeft.png" width="21" height="21" /></td>
                <td background="themes/default/media/images/tbCol1_top.png">&nbsp;</td>
                <td width="21" height="21"><img src="themes/default/media/images/tbCol1_topRight.png" width="21" height="21" /></td>
              </tr>
              <tr>
                <td background="themes/default/media/images/tbCol1_left.png">&nbsp;</td>
                <td bgcolor="#FFFFFF" valign="top">
                	<span class="title_counter">จำนวนผู้เยี่ยมชมเว็บไซต์</span><br><br>
					<table width="100%" border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td width="17%" align="center"><img src="themes/default/media/images/counter_1.png" width="16" height="16" /></td>
                        <td width="60%">วันนี้</td>
                        <td width="23%" align="right">999</td>
                        <td width="23%">คน</td>
                      </tr>
                      <tr>
                        <td align="center"><img src="themes/default/media/images/counter_2.png" width="16" height="16" /></td>
                        <td>เดือนนี้</td>
                        <td align="right">12389</td>
                        <td>คน</td>
                      </tr>
                      <tr>
                        <td align="center"><img src="themes/default/media/images/counter_3.png" width="26" height="23" /></td>
                        <td>รวม</td>
                        <td align="right">987698</td>
                        <td>คน</td>
                      </tr>
                    </table>        
			    </td>
                <td background="themes/default/media/images/tbCol1_right.png">&nbsp;</td>
              </tr>
              <tr>
                <td width="21" height="21"><img src="themes/default/media/images/tbCol1_bottomLeft.png" width="21" height="21" /></td>
                <td background="themes/default/media/images/tbCol1_bottom.png">&nbsp;</td>
                <td width="21" height="21"><img src="themes/default/media/images/tbCol1_bottomRight.png" width="21" height="21" /></td>
              </tr>
            </table>            
				
            <br>
        </div>
        <div id="col2">
        
			<div class="marquee">
			   <?php echo modules::run('content/inc_marquee'); ?>             
           </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_topLeft.png" width="22" height="22" /></td>
            <td background="themes/default/media/images/tbCol2_top.png">&nbsp;</td>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_topRight.png" width="22" height="22" /></td>
          </tr>
          <tr>
            <td background="themes/default/media/images/tbCol2_left.png">&nbsp;</td>
            <td bgcolor="#FFFFFF"><img src="themes/default/media/images/title_pr.png" width="141" height="25" /><hr class="hr1">
				<?php echo modules::run('content/inc_information'); ?>
             <br><br><br>
                <?php echo modules::run('content/inc_knowledge'); ?>
                
            </td>
            <td background="themes/default/media/images/tbCol2_right.png">&nbsp;</td>
          </tr>
          <tr>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_bottomLeft.png" width="22" height="22" /></td>
            <td background="themes/default/media/images/tbCol2_bottom.png"> </td>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_bottomRight.png" width="22" height="22" /></td>
          </tr>
        </table>
        </div>
         <div class="clr"></div>
           <?php include('_footer.php'); ?>     
    </div>
</div>
</body>
</html>
