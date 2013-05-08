<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title> 
		<link rel="stylesheet" href="media/css/default.css" type="text/css" media="screen" charset="utf-8" /> 
		<link rel="stylesheet" href="themes/admin/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" /> 
		<link rel="stylesheet" href="media/css/pagination.css" type="text/css" media="screen" charset="utf-8" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="media/js/jquery.corner.js"></script>
		<script type="text/javascript" src="themes/admin/media/js/default.js"></script>	
		
		
		<?php echo $template['metadata']; ?>
	</head>
	<body>
		<div id="header"><?php include_once('_header.inc.php'); ?></div> 
		<div id="container"><?php echo $template['body']; ?></div> 
		<div id="footer"></div> 
	</body>
</html>