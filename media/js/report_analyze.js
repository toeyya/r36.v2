$(document).ready(function(){
	$("#detail_main").change(function(){
	 var ref1=$("#detail_main option:selected").val();
	 var base ='<?php echo base_url(); ?>';
	 $("#show_minor").html('<img src="media/images/loader.gif" width="16px" height="11px"/>');	
		 $.ajax({
		 	type:'get',
			url:'media/js/getlist.php',
			data:'mode=D_main&ref1='+ref1,
			success:function(data){
				$("#show_minor").html(data);								
			}
		 })
	});
	$('.btn_submit').click(function(){
		var index = $('#detail_main option:selected').val();
		var minor = $('select[name=detail_minor] option:selected').val();
		if(index.length<1){
			alert('กรุณาเลือกปัจจับหลัก');
			return false;
		}else if(minor.length<1){
			alert('กรุณาเลือกปัจจัยรอง');
			return false;
		}else{
			$('#formreport').attr('action','report/analyze/index/'+index);
		}
		
	})
	
 	
})
