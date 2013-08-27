<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title> 
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" charset="utf-8" /> 
		<link rel="stylesheet" href="themes/admin/css/layout.css" type="text/css" media="screen" charset="utf-8" /> 
		<link rel="stylesheet" href="themes/admin/css/style.css" type="text/css" media="screen" charset="utf-8" /> 		
		<script type="text/javascript" src="media/js/jquery-1.6.4.min.js"></script>	
		<script type="text/javascript" src="media/js/jquery.colorbox.js"></script>	
		<style type="text/css">
			img.datepick-trigger {
			margin:0px 2px;
			vertical-align: top;	
		}
		
		</style>
		<?php echo $template['metadata']; ?>	
	</head>
	<body>
		
		<?php echo $template['body']; ?>
		
	</body>
</html>