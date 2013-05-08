<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title> 
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" charset="utf-8" /> 
		<link rel="stylesheet" href="themes/admin/css/layout.css" type="text/css" media="screen" charset="utf-8" /> 
		<link rel="stylesheet" href="themes/admin/css/style.css" type="text/css" media="screen" charset="utf-8" /> 
		<link rel="stylesheet" href="css/pagination.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/form.css" type="text/css" media="screen" charset="utf-8" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>		
		
		<script type="text/javascript" src="js/jquery.datepick/jquery.datepick.js"></script>
		<script type="text/javascript" src="js/jquery.datepick/jquery.datepick-th.js"></script>
		<link type="text/css"  href="js/jquery.datepick/redmond.datepick.css" rel="stylesheet" />			
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