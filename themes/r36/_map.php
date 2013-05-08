<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<base href="<?php echo base_url(); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title><?php echo $template['title']; ?></title> 		
<?php include_once('_script.php'); ?>
<script type="text/javascript" src="js/report.js" ></script>
<?php echo $template['metadata']; ?>	
</head>
<body>	
	<?php include '_header.php'?>
	<div id="page">	
	<?php echo $template['body']; ?>	
	</div>				
</body>
</html>