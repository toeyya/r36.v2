<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<base href="<?php echo base_url(); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $template['title']; ?></title>
<?php include('_script.php'); ?>
 <?php echo $template['metadata']; ?>
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
				<?php echo modules::run('dashboards/inc_home'); ?>
            <br>
        </div>
        <div id="cols2" style="position:relative; float:left; top:-39px; margin-left:8px; width:710px;">
        	        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_topLeft.png" width="22" height="22" /></td>
            <td background="themes/default/media/images/tbCol2_top.png">&nbsp;</td>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_topRight.png" width="22" height="22" /></td>
          </tr>
          <tr>
            <td background="themes/default/media/images/tbCol2_left.png">&nbsp;</td>
 			 <td bgcolor="#FFFFFF">	<?php echo $template['body']; ?></td>          
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
