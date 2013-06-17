<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title> 
		<?php include('_script.php'); ?>
		<?php echo $template['metadata']; ?>
	</head>
	<body> 
	<div id="header"><?php include_once('_header.inc.php'); ?></div> 
		<div id="container">
			<div id="menu"><?php include_once '_menu.inc.php'; ?></div> 
			<div id="content"><div class="inner"><?php echo $template['body']; ?></div></div> 
		</div> 
		<div id="footer"></div> 
	</body>
</html>