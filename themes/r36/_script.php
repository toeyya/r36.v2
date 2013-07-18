<link rel="stylesheet" type="text/css" 	href="media/css/default.css" media="screen"/>
<link rel="stylesheet" type="text/css" 	href="media/css/style.css" media="screen"/>
<link rel="stylesheet" type="text/css" 	href="media/css/menu.css" media="screen"/>
<link rel="stylesheet" type="text/css" 	href="media/css/pagination.css" media="screen" />
<link rel="stylesheet" type="text/css"	href="media/js/jquery-multi-open-accordion/css/jquery-ui-1.8.9.custom/jquery-ui-1.10.1.custom.css">
<link rel="stylesheet" type="text/css"   href="media/css/colorbox.css" media="screen"/>
<link rel="stylesheet" type="text/css" 	href="media/js/jquery.datepick/redmond.datepick.css"  media="screen"/>
<link rel="stylesheet" type="text/css" 	href="media/css/print.css" media="print" />
<link rel="stylesheet" type="text/css" 	href="media/css/vtip.css" />

<script type="text/javascript" src="media/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="media/js/jquery.livequery.js" ></script>
<script type="text/javascript" src="media/js/Highcharts/js/highcharts.js" ></script>
<script type="text/javascript" src="media/js/jquery.colorbox.js"></script>
<script type="text/javascript" src="media/js/jquery.datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="media/js/jquery.datepick/jquery.datepick-th.js"></script>
<script type="text/javascript" src="media/js/jquery.rowcount-1.0.js"></script>
<script type="text/javascript" src="media/js/jquery.validate.js"></script>
<script type="text/javascript" src="media/js/checkobj.js" ></script>

<script type="text/javascript" src="media/js/jquery-multi-open-accordion/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="media/js/jquery-multi-open-accordion/jquery.multi-accordion-1.5.3.js"></script>
<script type="text/javascript" src="media/js/vtip.js"></script>
<script>
$(function(){  
	$.datepick.regional['th'] = {
		clearText: 'ลบ', clearStatus: '',
		closeText: 'ปิด', closeStatus: '',
		prevText: '&laquo;&nbsp;ย้อน', prevStatus: '',
		prevBigText: '&#x3c;&#x3c;', prevBigStatus: '',
		nextText: 'ถัดไป&nbsp;&raquo;', nextStatus: '',
		nextBigText: '&#x3e;&#x3e;', nextBigStatus: '',
		currentText: 'วันนี้', currentStatus: '',
		monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
		monthStatus: '', yearStatus: '',
		weekHeader: 'Sm', weekStatus: '',
		dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
		dayNamesShort: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		dayStatus: 'DD', dateStatus: 'D, M d',
		dateFormat: 'yy/mm/dd', firstDay: 0,
		initStatus: '', isRTL: false,
		beforeShow: calculateShow,
		onClose: calculateClose,
		showMonthAfterYear: false, yearSuffix: ''};		
		$.datepick.setDefaults($.datepick.regional['th']);			
      $('.datepicker').datepick({format: 'Y-m-d', showOn: 'both', buttonImageOnly: true, buttonImage: 'media/js/jquery.datepick/calendar.gif'
      },$.datepick.regional['th']);  		

//$.colorbox({width:"70%", height:"80%", inline:true,href:"report/schedule"});
});
</script>


