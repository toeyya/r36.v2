<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $template['title']; ?></title>
<?php include('_script.php'); ?>
<?php echo $template['metadata']; ?>

</head>
<?php flush(); ?>
<body>
<div id="wrap">
    <div class="main"> 
    	<div class="logo"></div>    
		<?php include('_menu_top.php'); ?>
        <div class="animal"></div>
        <div class="clr"></div>
        <div id="col1">
			<?php include('_menu_left.php'); ?>
			<?php echo modules::run('users/inc_login'); ?>
           	<?php echo modules::run('dashboards/inc_home'); ?>				
		<div class="clr"></div>	
        </div>
        <div id="col2">        
			<div class="marquee">
			   <?php echo modules::run('content/inc_marquee'); ?>             
           </div>
			<div class="content">
				<?php echo modules::run('content/inc_information'); ?>
                <?php echo modules::run('content/inc_knowledge'); ?>				
			</div>
		<div class="clr"></div>
        </div><!-- div2--> 
        <div class="clr"></div>    
        <?php include('_footer.php'); ?>     
    </div><!--main-->
</div>
</body>

</html>
