<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title> 
		<script type="text/javascript" src="media/js/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="media/js/Highcharts/js/highcharts.js" ></script>
		<script type="text/javascript" src="media/js/printreport.js"></script>
		<link rel="stylesheet" type="text/css" href="media/css/default.css" />
		<link rel="stylesheet" type="text/css" href="media/css/style.css" />
		<link rel="stylesheet" type="text/css" href="media/css/print.css"/>	
		<script type="text/javascript" src="media/js/jquery-multi-open-accordion/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="media/js/jquery-multi-open-accordion/jquery.multi-accordion-1.5.3.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#loading').hide();
			$('#multiAccordion').multiAccordion('destroy');		
		});
	</script>
	</head>
	<body>	
	<?php echo $template['body']; ?>					
	</body>
</html>		