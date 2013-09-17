
<script type="text/javascript" src="media/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="media/js/jquery.livequery.js" ></script>
<script type="text/javascript" src="media/js/jquery-multi-open-accordion/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="media/js/jquery-multi-open-accordion/jquery.multi-accordion-1.5.3.js"></script>
<script type="text/javascript" src="media/js/Highcharts/js/highcharts.js" ></script>
<script type="text/javascript" src="media/js/Highcharts/js/modules/exporting.js" ></script>
<script type="text/javascript" src="media/js/Highcharts/js/canvg.js" ></script>
<script type="text/javascript" src="media/js/jquery.colorbox.js"></script>
<script type="text/javascript" src="media/js/jquery.datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="media/js/jquery.datepick/jquery.datepick-th.js"></script>
<script type="text/javascript" src="media/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="media/js/checkobj.js" ></script>
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
	$('#loading').hide();
	
	$('.btn_submit').click(function(){
		$('#loading').show();
		
	})
});
$(window).load(function() {
	$('#loading').hide();
});	
</script>


