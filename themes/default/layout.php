<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<base href="<?php echo base_url(); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $template['title']; ?></title>
<script type="text/javascript" src="media/js/jquery-1.7.2.min.js"></script>
<?php include('_css.php'); ?>
<?php echo $template['metadata']; ?>

</head>
<?php flush(); ?>
<body>
<div id="wrap">
    <div class="main">
    	<div class="logo"></div>
        <div class="clr"></div>
		<?php include('_menu_top.php'); ?>
        <div class="animal"></div>
        <div class="clr"></div>
        <div id="col1">
			<?php include('_menu_left.php'); ?>
			<?php echo modules::run('users/inc_login'); ?>
           	<?php echo modules::run('dashboards/inc_home'); ?>				
		<div class="clr"></div>	
        </div>
        <div id="cols2" style="position:relative; float:left; top:-29px; margin-left:5px;min-height:250px;height:auto; width:704px;background-color:#FFFFFF">
        	<div class="content"><?php echo $template['body']; ?></div>
        	<div class="clr"></div>
        </div>
         <div class="clr"></div>
         <?php include('_footer.php'); ?>   
    </div>
</div>
<?php include('_script.php'); ?>
</body>
</html>
