
		<link rel="stylesheet" href="media/css/reset.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="media/css/default.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="themes/admin/media/css/pagination.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="themes/admin/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" /> 
		<link rel="stylesheet" type="text/css" href="media/js/jquery.datepick/redmond.datepick.css"  media="screen"/>
		<link charset="utf-8" media="screen" type="text/css" href="media/js/tag/jquery.tag.css" rel="stylesheet">
		<script type="text/javascript" src="media/js/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="media/js/jquery.validate.js"></script>
		<script type="text/javascript" src="media/js/jquery.datepick/jquery.datepick.js"></script>
		<script type="text/javascript" src="media/js/jquery.datepick/jquery.datepick-th.js"></script>
		<script type="text/javascript" src="media/js/tag/jquery.tag.editor-min.js"></script>
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
});
</script>
