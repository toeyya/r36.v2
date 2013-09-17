<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<base href="<?php echo base_url(); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $template['title']; ?></title>
<?php include('_script.php'); ?>
 <?php echo $template['metadata']; ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-43317447-1', '164.115.32.57/r36');
  ga('send', 'pageview');

</script>
<?php flush(); ?>
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
</body>

</html>
