<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title> 
		<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.colorbox.js"></script>
		<script type="text/javascript"src="js/jquery.datepick/jquery.datepick.js" ></script>
		<script  type="text/javascript"src="js/jquery.datepick/jquery.datepick-th.js"></script>
		<script type="text/javascript" src="js/checkobj.js" ></script>
		<link type="text/css"  href="js/jquery.datepick/redmond.datepick.css" rel="stylesheet"  media="screen"/>	
		<link rel="stylesheet" type="text/css" href="css/template.css" media="screen"/>
		<link rel="stylesheet" media="screen"  href="css/colorbox.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
		

		<?php echo $template['metadata']; ?>	
		<style type="text/css">
			img.datepick-trigger {
			margin:0px 2px;
			vertical-align: top;	
		}
		
		</style>
		
	</head>
	<body>	
	<?php echo $template['body']; ?>					
	</body>
</html>