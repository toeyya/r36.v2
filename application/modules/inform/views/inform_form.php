<script type="text/javascript">
function show_hide_clear_means()
{
	var means=$('#means:checked').val();
	var information_id=$('input[name=information_id]').val();
	console.log(information_id);
	var tomorrow,clear;
		if(means=="2" || means=="1"){		
				if(means=="2"){
					$("#meanstr tr:eq(5)").hide();
					
				}else{					
					$("#meanstr tr:eq(5)").show();
				}
				if(information_id==''){
					for(clear=0;clear<5;clear++)
					{
								if(means=="2" && clear==3){continue;}					
								if($("#vaccine_date["+clear+"]").val() == '' || typeof $("#vaccine_date["+clear+"]").val() == "undefined"){											
										var tomorrow=increment_vaccine_date($('#datetouch').val(),clear);																	
										if( means=="2" && clear==4){  
											document.getElementById("vaccine_date[3]").value=tomorrow;
										}else{
											document.getElementById("vaccine_date["+clear+"]").value=tomorrow;	
										}	
								}//vaccine_date							
					 }//for
				}// information_id 
				$("#meanstr").css('display','');
				$('#after_symptom_vaccine').css('display','');
			}else{
					/** กรณีไม่ฉีดแล้ว ต้องไม่แสดงข้อมูลอาการหลังฉีดวัคซีน */
							c =document.form1;
							document.getElementById("after_vaccinetr").style.display='none';
							document.getElementById("otherafter_vaccinedetail7").style.display='none';
							c.after_vaccine_detail1.checked=false;
							c.after_vaccine_detail2.checked=false;
							c.after_vaccine_detail3.checked=false;
							c.after_vaccine_detail4.checked=false;
							c.after_vaccine_detail5.checked=false;
							c.after_vaccine_detail6.checked=false;
							c.after_vaccine_detail7.checked=false;
							c.after_vaccine_text.value='';
							c.after_vaccine_date.value='';
							c.after_vaccine_cure_comment.value='';					
					/***************************************************/
					$("#meanstr").css('display','none');
					$('#after_symptom_vaccine').css('display','none');
					for(clear=0;clear<5;clear++){
						$("#vaccine_date["+clear+"]").val('');
						$("#vaccine_name["+clear+"]").val('0');
						$("#vaccine_no["+clear+"]").val('');						
						$("#vaccine_cc["+clear+"]").val('');
						$("#vaccine_point["+clear+"]").val('');
						$("#byname["+clear+"]").val('');
					}
			}
}//function
function calculateClose(dateText, inst)
{
		means=$('#means:checked').val();
		if(dateText!='')
		{
			var dt = dateText;
			selectdate = dt.split('/');
			if(selectdate[2].length=="4"){
			
			}else{
				dt = selectdate[2]+'/'+selectdate[1]+'/'+(parseInt(selectdate[0])+543);
			}					
			this.value = dt;		
			if(document.getElementById("vaccine_date[0]").value==dt){			
				for(var clear=0;clear<5;clear++){
						if(means=="2" && clear==3){continue;}			
						var tomorrow=increment_vaccine_date(dt,clear);					
						if( means=="2" && clear==4){  
							document.getElementById("vaccine_date[3]").value=tomorrow;					
						}else{
							document.getElementById("vaccine_date["+clear+"]").value=tomorrow;	
						}													
				}//for
			}//if
		}//if dateText
}//function
function  disableChkage(){
	var prefix=$('select[name=prefix_name] option:selected').index();
	$('input[name=chkage]').attr('disabled',true);
	if(prefix==4 || prefix==5){
		$('input[name=chkage]').attr('disabled',false);
	}
	if(prefix==1 || prefix==4){
		$("input[name=gender]").eq(0).attr('checked','checked');
	}else{
		
		$("input[name=gender]").eq(1).attr('checked','checked');
	}
}

$(document).ready(function(){
	/*$( "#accordion" ).accordion({
            heightStyle: "content"
        });*/
     $('#multiAccordion').multiAccordion({
            heightStyle: "content"
        });
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

var process='<?php echo $process ?>';
if(process=='view'){
	$('#form1').find('input,select').attr('disabled','disabled');
}
$('.datepicker').datepick({format: 'Y-m-d', showOn: 'both', buttonImageOnly: true, buttonImage: 'js/jquery/jquery.datepick/calendar.gif' },$.datepick.regional['th']);  
$('input[name=means]').change(show_hide_clear_means);		
$('input[name=chkage]').attr('disabled',true);
$('select[name=prefix_name]').change(disableChkage);
$('select[name=prefix_name]').click(disableChkage);
	var ref1,ref3;
	var process=$('input[name=process]').val();
	//alert(process);
	if(process=="vaccine")
	{				
		$('input[name=checkerHN]').css('display','none');
		$('#part1 :input,#part2 :input,#part3 :input,#part4 :input,#part6 :input,input[name=means],#after_symptom_vaccine :input,#closecasemaintr :input').attr('disabled',true);
		$('input[name=save],input[name=button]').attr('disabled',false);	
	}else if(process=="addnew"){			
		$('#part3 :input[type=radio],#part4 :input[type=radio],#part2 :input[type=checkbox],#part5 :input[type=radio]').removeAttr('checked');
		$("#part5 :input[type=text]").val('');
		$("#part6").find('input').slice(0,3).val('');		
	}/*else{
		show_hide_clear_means();
	}	*/


	$("#provinceid").change(function(){
		ref1=$("#provinceid option:selected").val();
		$.ajax({
			type:'get',
			url:'<?php echo base_url() ?>district/getAmphur',			
			data:'name=amphurid&ref1='+ref1,
			success:function(data){
				$("#address_amphur").html(data);
				$("#districtid").html('<select name="districtid" class="styled-select " id="districtid"><option value="">-โปรดเลือก-</option></select>');
			}
		});
	});
	$("#amphurid").live('change',function(){	
		var ref2=$("#amphurid option:selected").val();
		$.ajax({
			type:'get',
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=districtid&ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#address_district").html(data);
			}
		})
	});
		$("#provinceidplace").live('change',function(){
	  		ref3=$("#provinceidplace option:selected").val();
		 	$.ajax({
		 	type:'get',
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphuridplace&ref1='+ref3,
			success:function(data){
				$("#input_place_amphur").html(data);
				$("#input_place_district").html('<select name="districtidplace" class="styled-select " id="districtidplace"><option value="">-โปรดเลือก-</option></select>');
			}
		 });
	});
	$("#amphuridplace").live('change',function(){
		var ref4=$("#amphuridplace option:selected").val();
		$.ajax({
			type:'get',		
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=districtidplace&ref1='+ref3+'&ref2='+ref4,
			success:function(data){
				$("#input_place_district").html(data);
			}	
		});		
	});

	$("#hospitalprovince").change(function(){
		var ref4=$("#hospitalprovince option:selected").val();
		$.ajax({
			type:'get',		
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=hospitalamphur&ref1='+ref4,
			success:function(data){
				$("#input_Hamphur").html(data);				
			}	
		});				
	})
	$("input[name=placetouch]").click(function(){		
		var obj=$(this).val();	
		var ref,mode;
		mode="";
		if(obj=="1"){
				ref=10;ref3=10;	
				$('#districtidplace').rules("add",{required: true,  messages: {required: "ระบุตำบล", } });
				$('#amphuridplace').rules("add",{required: true,  messages: { required: "ระบุอำเภอ", } });			
				$("#amphur_place").find('span').html('*');	
		}else if(obj=="2"){
					ref=20;	
					$("#amphur_place").find('span').html('');	
					$("#input_place_district").html('<select name="districtidplace" class="styled-select " id="districtidplace"><option value="">-โปรดเลือก-</option></select>');
					$('#districtidplace').rules("remove", "required");
					$('#amphuridplace').rules("remove", "required");
					mode="place_amppattaya";
		}else if(obj=="3" || obj=="4"){
					ref='';ref3='';
					$("#amphur_place").find('span').html('*');	
					$('#districtidplace').rules("add",{required: true, messages: { required: "ระบุตำบล", } });
					$('#amphuridplace').rules("add",{required: true,  messages: { required: "ระบุอำเภอ", } });
		}
		show_hide_clear_placetouch(document.form1);	
		 $.ajax({
		 	type:'get',
			url:'<?php echo base_url() ?>district/getProvince',
			data:'name=provinceidplace&ref1='+ref,
			success:function(data){
				$("#input_place_province").html(data);
			}
		 });
		 $.ajax({
			type:'get',
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphuridplace'+'&ref1='+ref+'&mode='+mode,
			success:function(data){
				$("#input_place_amphur").html(data);			
			}
		 });
	});
	
	
	
		/***********  prevent double submit  ***********/
	$("input[type=submit]").attr( 'disabled',false); 
	 $.validator.setDefaults({
		   	  submitHandler: function() {
		   	  	if(process=='vaccine')
		   	  	{
		   	  			document.form1.submit();	
		   	  	}else{
			  	   var answer;							
					var idcard=$('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val();
					var digit_last=$('#cardW4').val();
					$.ajax({
						type:'get',
						url:'<?php echo base_url()?>inform/chk_idcard',
						data:'idcard='+idcard+'&digit_last='+digit_last,
						dataType: "json",
						success:function(data){									  							
							if(data.chk=="no"){
								alert("กรุณาระบุบัตรประชาชนให้ถูกต้องและครบถ้วน");						
							}else{							
								/***********  prevent double submit  ***********/
								$(":disabled").removeAttr('disabled');
								$("input[type=submit]").attr('disabled',true); 	
								document.form1.submit();								
							}// if*/							
						}//success function
					})// ajax		
				}//vaccine		
			}	//submitHandler			
	  });// validator.setDefaults		
	$('#headanimal').click(function(){ $("#headanimalplace").valid();	}); 
	$('#putdrug').click(function(){$('input[name=putdrugdetail]').valid();});
	$('#historyprotect').click(function(){ $('input[name=historyprotectdetail]').valid();});
	$('#washbefore').click(function(){$('input[name=washbeforedetail]').valid();});
	$('#reasonbite').click(function(){$('input[name=causedetail]').valid();});
	$('#causedetail_other').click(function(){$('input[name=causetext]').valid();});
	
	
	$("#form1").validate({
		debug:false,
		rules:{
			firstname:"required",surname:"required",
			age:{required:true,number:true},
			provinceid:"required",amphurid:"required",districtid:"required", doctorname:"required",reportname:"required",
			 positionname:"required", reportdate:"required",
			 telephone:{required:true,minlength:6,maxlength:10},
			 datetouch:"required",	provinceidplace:"required", typeanimal:"required", ageanimal:"required",
			statusanimal:"required",historyvacine:"required",historyprotect:"required",use_rig:"required",means:"required",placetouch:"required"	,
			headanimalplace:{required: "#headanimal:checked" },putdrugdetail:{required: "#putdrug:checked"},
			historyprotectdetail:{required:'#historyprotect:checked'},washbeforedetail:{required:'#washbefore:checked'},
			causedetail:{required:'#reasonbite:checked'},causetext:{required:'#causedetail_other:checked'},
		
			
		},
		messages:{
			firstname:"ระบุชื่อ",surname:"ระบุนามสกุล",
			age:{required:"ระบุอายุ",number:"ระบุตัวเลขเท่านั้น"},	
			provinceid:"ระบุจังหวัด",amphurid:"ระบุอำเภอ",districtid:"ระบุตำบล",doctorname:"ระบุแพทย์", reportname:"ระบุผู้รายงาน",
			 positionname:"ระบุตำแหน่ง", reportdate:"ระบุวันที่รายงาน",
			 telephone:{required:"ระบุเบอร์โทร",minlength:"ระบุอย่างน้อย 6 หลัก",maxlength:"ระบุเกินกว่า 10 หลัก"},
			 datetouch:"ระบุวันที่สัมผัสโรค",provinceidplace:"ระบุจังหวัด", typeanimal:"ระบุชนิดสัตว์",ageanimal:"ระบุอายุสัตว์",
			 statusanimal:"ระบุสถานภาพสัตว์",historyvacine:"ระบุประวัติฉีดวัคซีน",historyprotect:"ระบุประวัติฉีดวัคซีน",use_rig:"ระบุการฉีดอิมมูโนโกลบูลิน",means:"ระบุการฉีดโดยวิธี"	,
			 placetouch:"ระบุสถานที่สัมผัสโรค",
			 headanimalplace:"ระบุสถานที่ด้วยค่ะ",putdrugdetail:"ระบุการใส่ยาด้วยค่ะ", historyprotectdetail:"ระบุการฉีดด้วยค่ะ", washbeforedetail:'ระบุการล้างแผลด้วยค่ะ',
			 causedetail:'ระบุสาเหตุที่ถูกกัดด้วยค่ะ',causetext:'ระบุสาเหตุอื่นๆด้วยค่ะ'
		},
			errorPlacement: function(error, element){								
				if((element.attr('name')=='firstname') || (element.attr('name')=='surname') || (element.attr('name')=='age'))
				{					
					element.next().html(error);				
				}else{
					if(element.is(':radio'))
					{ 
						var name=element.attr('name');
						$('input[name='+name+']').eq($('input[name='+name+']').length-1).closest("td").next().find('span').html(error);
						if(name=='use_rig' || name =='means')$('input[name='+name+']').eq($('input[name='+name+']').length-1).closest("td").find('span').html(error);
						if(name=="causedetail") $('input[name='+name+']').closest('table').closest("tr").prev().find('td').eq(4).find('span').eq(1).html(error);
					
					}else{
					error.appendTo(element.parent());
					}
				}						
			},
		invalidHandler: function(form, validator) {
	        if (validator.numberOfInvalids() > 0) {
	            validator.showErrors();
	            var index=[];
	            var temp;
	            var i=0;
                $(".error").each(function(){                	
                 	if(temp!=$(this).closest(".ui-accordion-content").index(".ui-accordion-content")){ 
                 		// ไม่เก็บ index ซ้ำกัน
                 		temp=$(this).closest(".ui-accordion-content").index(".ui-accordion-content");                  		
                		index[i]=temp;  
                		i++;               		              		
                 	}                	 	
                });    
			   $('#multiAccordion').multiAccordion({active:index}); 				
	        }
   	 	}
	});	

// ????????????????????????????
 	if($('input[name=information_id]').val()==''){
			var today= new Date();
			var dd = today.getDate();
			var mm = today.getMonth() +1;
			var y = today.getFullYear()+543;
			var tomorrow = dd + '/' + mm + '/' + y;
			$('#datetouch').val(tomorrow);
	}	
	
	// popup_chk_idcard_edit

	$("a[name=chkidcard]").click(function(){		
		var result=chkid(document.form1);	
		if(result===true && result !==false){			
				var statusid=$('select[name=statusid] option:selected').val();
				var idcard=$('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val();
				var idpassport=$('input[name=idpassport]').val();
				var historyid=$('input[name=historyid]').val();		
				var in_out=$('input[name=in_out]').val();		
				var hn=$('input[name=hn]').val();
				$(this).attr('href','inform/chk_idcard_informhn?process=addnew&way=chk_idcard'+'&idcard='+idcard
														+'&idpassport='+idpassport+'&statusid='+statusid+'&historyid='+historyid+'&in_out='+in_out+'&hn='+hn);
				$(this).colorbox({iframe:true, innerWidth:500, innerHeight:425});		
				console.log(true);		
		}else{
			console.log(false);
		}
		//return false;
	});

	/***  กดเพื่อแก้ไขรหัสในกรณีกรอกผิด  ***/
	$('#editidcard').colorbox({iframe:true, innerWidth:500, innerHeight:425,href:'inform/chk_idcard_edit?historyid='+$('input[name=historyid]').val()});

	if($('input[name=idcard]').val()!=""){
		$('#cardW0,#cardW1,#cardW2,#cardW3,#cardW4').attr('disabled',true)	
	}
	$('.checkvaccine').blur(function(){
		$(this).removeClass('checkvaccine-cross').removeClass('checkvaccine-check');	
		if($(this).val()==null || $(this).val()=='' || $(this).val()=='undefined'){					
			$(this).addClass('checkvaccine-cross').next().remove();	
			$('<img src="media/images/crossmark.png" width="16px" height="16px;" class="cross">').insertAfter($(this));
		}else{
			$(this).addClass('checkvaccine-check').next().remove();			
			$('<img src="media/images/checkmark.png" width="16px" height="16px;" class="check">').insertAfter($(this));			
		}
	})
});

</script>



<div id="title">รายงานผู้สัมผัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า ( คนไข้<?php  if($in_out=='2'){echo 'นอก';}else if($in_out=='1'){echo 'ใน';} ?>เขตอำเภอ )</div>
<form id="form1" name="form1" method="post" action="<?php echo ($process=='vaccine')?"inform/save_vaccine":"inform/save" ?>" > 
	<?php 
			@$rs['daterig'] =($rs['daterig'] =='0000-00-00')?'': cld_my2date(@$rs['daterig']);
			@$rs['datelongfeel']	=(@$rs['datelongfeel']=='0000-00-00')?'':cld_my2date(@$rs['datelongfeel']);
			@$rs['datetouch'] = (@$rs['datetouch'] =='0000-00-00')? '':cld_my2date(@$rs['datetouch']);	
			@$rs['after_vaccine_date']=($rs['after_vaccine_date']=='0000-00-00')?'': cld_my2date($rs['after_vaccine_date']);

			
			$datetoday=date('Y')+543;
			$datetoday=$datetoday.'-'.date('m-d H:i:s');
			echo (@$rs['id']) ? form_hidden('updatetime',$datetoday) : form_hidden('created',$datetoday);
						
	?>

		<input type="hidden" name="process"  value="<?php echo $process ?>" />
		<input type="hidden" name="information_id" value="<?php echo @$rs['id'] ?>"  />
		<input type="hidden" name="historyid"  value="<?php echo @$rs['historyid'] ?>"/>
		<input type="hidden" name="idcard"  id="idcard" value="<?php echo @$rs['idcard'] ?>"  />
		<input type="hidden" name="in_out"  value="<?php echo $in_out?>" />

		<table width="100%"  border="0" cellspacing="0" cellpadding="3" class="tbchild">
              <tr>
                <th align="center" >
				จังหวัด<span class="alertred">*</span>								
					<? $wh="";
						 if(!empty($rs['hospitalprovince'])){
							$wh="AND province_id='".$rs['hospitalprovince']."'";
						}									
						$class='class="input_box_patient " id="hospitalprovince" disabled="disabled"';
						echo form_dropdown('hospitalprovince',get_option('province_id','province_name','n_province WHERE province_id<>""'.$wh.' ORDER BY province_name ASC'),@$rs['hospitalprovince'],$class,'-โปรดเลือก-');
					?>

				อำเภอ <span class="alertred">*</span>		
					<?php
						$class='class="input_box_patient " id="hospitalamphur" disabled="disabled"';
						$whamp="";	
							
							if(!empty($rs['hospitalamphur'])){
									$whamp="AND amphur_id ='".$rs['hospitalamphur']."' 
													   AND province_id='".$rs['hospitalprovince']."' ";
							}
							if($process=='vaccine'){
								if(!empty($rs['hospitalprovince'])){
									$whamp=" AND province_id = '".$rs['hospitalprovince']."'";
								}
							}
							if($whamp!=''){																							
									echo form_dropdown('hospitalamphur',get_option('amphur_id','amphur_name',"n_amphur WHERE amphur_id<>''".$whamp."  ORDER BY amphur_name ASC"),@$rs['hospitalamphur'],$class,'-โปรดเลือก-');
							}
						?>	
			ตำบล <span class="alertred">*</span>		
			<?php 
				$class='class="input_box_patient" id="hospitaldistrict" disabled="disabled" ';
				$whdistrict="";
					if(!empty($rs['hospitaldistrict'])){
							$whdistrict="AND amphur_id ='".$rs['hospitalamphur']."' 
											   AND province_id='".$rs['hospitalprovince']."' 
											   AND district_id='".$rs['hospitaldistrict']."'";
					}
					if($process=='vaccine'){
						if(!empty($rs['hospitalprovince'])){
							$whdistrict=" AND province_id = '".$rs['hospitalprovince']."'";
						}
					}
				if($whdistrict!=""){
					echo form_dropdown('hospitaldistrict',get_option('district_id','district_name',"n_district WHERE district_id<>'' $whdistrict ORDER BY district_name ASC"),@$rs['hospitaldistrict'],$class,'-โปรดเลือก-');
				}
			?>									
					
				 โรงพยาบาล<span class="alertred">*</span>
						<?php
								$whhospital="";
									if(!empty($rs['hospitalcode'])){
										$whhospital="AND hospital_code ='".$rs['hospitalcode']."'";
									}
								 if($process=='vaccine'){
									 if(!empty($rs['hospitalamphur'])){
											$whhospital="AND hospital_province_id='".$rs['hospitalprovince']."' AND hospital_amphur_id ='".$rs['hospitalamphur']."'  ";
									}									
								}
								if($whhospital!=''){
									$where=" WHERE hospital_id<>'' ".$whhospital." ORDER BY hospital_name ASC";	
									$class='class="input_box_patient " disabled="disabled"';																		
									echo form_dropdown('hospital',get_option('hospital_code','hospital_name'," n_hospital_1 ".$where),$rs['hospitalcode'],$class,'-โปรดเลือก-');
								}
						?>
			    </th>
              </tr>
              <tr>
                <th>
				<div align="center">
					HN <span class="alertred">*</span> &nbsp;
					<?php $hn=(isset($hn))?$hn:@$rs['hn']; ?>
					<input name="hn_s" type="text" class="input_box_patient " value="<?php echo $rs['hn'] ?>" size="20" readonly=""> - 					
					<input type="text" name="hn_no" size="2"  readonly=""  value="<?php echo $rs['hn_no']; ?>" class="input_box_patient nowidth " onKeyPress="return NumberOnly();" style="text-align:center" 
					<?php echo (@$rs['id'])? '':'readonly'; ?> <?php if($process=='vaccine'){echo 'disabled';} ?>>
					<input name="hospitalprovince" type="hidden"value="<?php echo @$rs['hospitalprovince']?>" >
					<input name="hospitalamphur" type="hidden"value="<?php echo @$rs['hospitalamphur']?>" >
					<input name="hospital" type="hidden"value="<?php echo @$rs['hospitalcode']?>" >
					<input name="hn" type="hidden"value="<?php echo @$rs['hn']?>" >
				</div>
				</th>
              </tr>
              <tr>
                <th>
				<? 
				 if(@$rs['statusid']==''){@$rs['statusid']=1;}?>
					เลขประจำตัวประชาชน/เลขที่ passport/ชื่อ-นามสกุล : 
					<select name="statusid"  class="styled-select " onChange="return selectType_id(this.value);" <?php echo $value_disabled?>>
						<option value="1" <? if(@$rs['statusid']=='1'){ echo 'checked';}?>>เลขประจำตัวประชาชน</option>
						<option value="2" <? if(@$rs['statusid']=='2'){ echo 'checked';}?>>เลขที่ passport</option>
						
					</select>
					&nbsp;&nbsp;
					<span id="Show_idpassport" <? if(@$rs['statusid']=='2'){print "style='display:'";}else{print "style='display:none'";}?>>
						<input name="idpassport" type="text" class="input_box_patient " value="<?php echo @$rs['idcard'];?>" size="20" maxlength="50" <?php echo $value_disabled?>>
					</span>
					<span id="Show_idcard" <? if(@$rs['statusid']=='2'){print 'style = "display:none"';  }?>> 
						<input name="cardW0" id="cardW0" type="text" class="input_box_patient nowidth" size="1" maxlength="1" value="<?php echo @$cardW0?>"
						 onKeyPress="return NumberOnly();" onKeyUp=" if(this.value.length==1) {this.form.cardW1.value='';this.form.cardW1.focus();}" <?php echo $value_disabled?> />
						  -
						  <input name="cardW1"  id="cardW1" type="text" class="input_box_patient nowidth" size="4" maxlength="4"  value="<?php echo @$cardW1?>" 
						  onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==4){this.form.cardW2.value='';this.form.cardW2.focus();}" <?php echo $value_disabled?>/>
						  -
						  <input name="cardW2"  id="cardW2" type="text" class="input_box_patient nowidth" size="5" maxlength="5"   value="<?php echo @$cardW2?>"
						   onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==5){this.form.cardW3.value='';this.form.cardW3.focus();}" <?php echo $value_disabled?>/>
						  -
						  <input name="cardW3" id="cardW3" type="text" class="input_box_patient nowidth" size="2" maxlength="2"  value="<?php echo @$cardW3?>" 
						  onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==2){this.form.cardW4.value='';this.form.cardW4.focus();}" <?php echo $value_disabled?>/>
						  -
						<input name="cardW4" id="cardW4" type="text" class="input_box_patient nowidth" size="1" maxlength="1"  value="<?php echo @$cardW4?>"  
						onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==1){FChkCardID(this.form);}" <?php echo $value_disabled?>/>				
					</span>&nbsp;&nbsp;
					 					
					<!-- กรณีข้อมูลเดิมไม่สมบูรณ์ จะทำให้บรรทึกไม่ผ่าน 
					<button name="editidcard" id="editidcard" title="กดเพื่อแก้ไขรหัสในกรณีกรอกผิด" class="btn_press"></button>-->
			
				</th>
              </tr>
            </table>	

<div id="multiAccordion" style="margin-top:10px">
    <h3><a href="javascript:void(0);">ส่วนที่ 1 : ข้อมูลทั่วไป</a></h3>
    <div id="section1">
				<table width="100%"  id="part1" height="100%" class="tbchild">
				  <tr>
					<th width="3%" valign="top">1.1</td>
					<td width="97%" valign="top"><table width="100%"  class="tbchild noborder">
                      <tr>
                        <td valign="top">
					   คำนำหน้า : <select name="prefix_name" class="styled-select ">
							 	<option value="">- โปรดเลือก -</option>
								<option value="นาย" <?php  echo (@$rs['prefix_name']=='นาย')? "selected='selected'":"" ?>>นาย</option>
								<option value="นาง" <?php  echo (@$rs['prefix_name']=='นาง')? "selected='selected'":"" ?>>นาง</option>
								<option value="นางสาว" <?php  echo (@$rs['prefix_name']=='นางสาว')? "selected='selected'":"" ?>>นางสาว</option>
								<option value="ด.ช." <?php  echo (@$rs['prefix_name']=='ด.ช.')? "selected='selected'":"" ?>>ด.ช.</option>
								<option value="ด.ญ." <?php  echo (@$rs['prefix_name']=='ด.ญ.')? "selected='selected'":"" ?>>ด.ญ.</option>							
							 </select>							
							 ชื่อ<span class="alertred">*</span> :
                               <input name="firstname" type="text" class="input_box_patient " id="firstname" value="<?php echo @$rs['firstname'];?>" size="20" />
							   <span></span> &nbsp;&nbsp;
							  นามสกุล<span class="alertred">*</span> :
                              <input name="surname" type="text" value="<?php echo @$rs['surname'];?>" size="20"  class="input_box_patient ">
							  <span></span>&nbsp;&nbsp;
							อายุ<span class="alertred">*</span> :
                            <input name="age" id="age"  type="text" size="2" maxlength="2" value="<?php echo @$rs['age'];?>" class="input_box_patient auto"  onKeyUp="chk_than15(this.value);">
							<span></span> &nbsp;&nbsp;
							 ปี (
                             <input name="chkage" type="checkbox" value="Y" <? if(@$chkage=='Y'){echo "checked";}?> onClick="chk_than1(document.form1);"/>
                        ต่ำกว่า 1 ปี  ) </p>
					    </td>
					</tr>
					<tr><td>
							เพศ : <input name="gender" type="radio" value="1" <? if(@$rs['gender']=='1'){ echo "checked";}?>> ชาย&nbsp;&nbsp;
							  		 <input name="gender" type="radio" value="2" <? if(@$rs['gender']=='2'){ echo "checked";}?>> หญิง</td>
						
                      </tr>
                      <tr>
                        <td>สถานภาพสมรส: 
                        	<input name="marryname" type="radio" value="1" <? if(@$rs['marryname']=='1'){echo "checked";}?>> โสด&nbsp;&nbsp;
                        	<input name="marryname" type="radio" value="2" <? if(@$rs['marryname']=='2'){echo "checked";}?>> คู่&nbsp;&nbsp;
                        	<input name="marryname" type="radio" value="3" <? if(@$rs['marryname']=='3'){echo "checked";}?>> หย่าร้าง&nbsp;&nbsp;
                        	<input name="marryname" type="radio" value="4" <? if(@$rs['marryname']=='4'){echo "checked";}?>> หม้าย</td>
                      </tr>
                      <tr>
                        <td height="40">
						สัญชาติ : 
						<input name="nationality" type="radio" value="1" <? if(@$rs['nationalityname']=='1'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);"> ไทย&nbsp;&nbsp;
						<input name="nationality" type="radio" value="2" <? if(@$rs['nationalityname']=='2'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);"> อื่นๆ 
						<span id="nationality_tr1" <? if(@$rs['nationalityname']!='2'){ print 'style = "display:none"';}?>>
						สัญชาติ :&nbsp; 
							<select name="nationalityname"  class="styled-select " onChange="show_hide_clear_nationality_text(this)">
								<option value="0" <? if(@$rs['nationalityname']=='0'){echo "selected";}?>>เลือกสัญชาติ</option>
								<option value="2" <? if(@$rs['nationalityname']=='2'){echo "selected";}?>>จีน/ฮ่องกง/ใต้หวัน</option>
								<option value="3" <? if(@$rs['nationalityname']=='3'){echo "selected";}?>>พม่า</option>
								<option value="4" <? if(@$rs['nationalityname']=='4'){echo "selected";}?>>มาเลเซีย</option>
								<option value="5" <? if(@$rs['nationalityname']=='5'){echo "selected";}?>>กัมพูชา</option>
								<option value="6" <? if(@$rs['nationalityname']=='6'){echo "selected";}?>>ลาว</option>
								<option value="7" <? if(@$rs['nationalityname']=='7'){echo "selected";}?>>เวียดนาม</option>
								<option value="8" <? if(@$rs['nationalityname']=='8'){echo "selected";}?>>ยุโรป</option>
								<option value="9" <? if(@$rs['nationalityname']=='9'){echo "selected";}?>>อเมริกา</option>
								<option value="10" <? if(@$rs['nationalityname']=='10'){echo "selected";}?>>ไม่ทราบสัญชาติ</option>
								<option value="11" <? if(@$rs['nationalityname']=='11'){echo "selected";}?>>อื่นๆ</option>
                          </select>&nbsp;
							<span id="nationality_div" <? if(@$rs['nationalityname']!='11'){ print 'style = "display:none"';}?>>
								  <span class="alertred">(โปรดระบุ)</span>&nbsp;
								  <input name="othernationalityname" id="othernationalityname" type="text" value="<?php echo @$rs['othernationalityname'];?>" class="input_box_patient " size="20">
						  </span>
						</span>
						</td>
                      </tr>
                      <tr>
                        <td height="30">&nbsp;
						<span id="nationality_tr2" <? if(@$rs['nationalityname']!='2'){ print 'style = "display:none"';}?>>
						เลือกประเภทของต่างด้าว :&nbsp;
                          <select name="typeforeign"  class="styled-select ">
								<option value="0">เลือกประเภท</option>
								<option value="1" <? if(@$rs['typeforeign']=='1'){ print "selected";}?>>ชาวต่างด้าวที่เข้ามาขายแรงงาน</option>
								<option value="2" <? if(@$rs['typeforeign']=='2'){ print "selected";}?>>ชาวต่างด้าวที่เข้ามารักษาเมื่อหายแล้วกลับประเทศ</option>
								<option value="3" <? if(@$rs['typeforeign']=='3'){ print "selected";}?>>นักท่องเที่ยว</option>
						  </select>
						  </span>
					    </td>
                      </tr>
                      <tr>
                        <td>
							อาชีพขณะสัมผัสโรค :&nbsp;
							<?php echo form_dropdown('occupationname',get_option('id','name','n_occupations'),@$rs['occupationname'],'class="styled-select " onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_than15"','- กรุณาเลือกอาชีพ-'); ?>
							<?php 
							$class='class="styled-select" onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_less15"';
							echo form_dropdown('occupationname_b',get_option('id','name','n_occupations where id in(1,2,3)'),@$rs['occupationname'],$class,'- กรุณาเลือกอาชีพ-'); ?>
						<? if(@$rs['age']>15){ 
										echo	"<script>document.getElementById ('occupation_less15').style.display='none'</script>";
								}else{ 
										echo	"<script>document.getElementById ('occupation_than15').style.display='none'</script>";
								}
						?>
							<span  id="otheroccupationname_tr" <? if(@$rs['occupationname']!='20'){ print 'style = "display:none"'; }?>>
							<span class="alertred">(โปรดระบุ)&nbsp;
						<input name="otheroccupationname" id="otheroccupationname"  type="text" class="input_box_patient " size="10" value="<?php echo @$rs['otheroccupationname'];?>" /></span>
						</span>
						</td>
                      </tr>
                      <tr>
                        <td><table width="100%">
                          <tr>
                            <td width="10%">ที่อยู่ปัจจุบัน</td>
                            <td width="8%"><div align="right">เลขที่ : </div></td>
                            <td width="19%">
                              <input name="nohome" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['nohome'];?>"></td>
                            <td width="12%"><div align="right">หมู่ที่ : </div></td>
                            <td width="19%"><input name="moo" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['moo'];?>" /></td>
                            <td width="11%"><div align="right">หมู่บ้าน : </div></td>
                            <td width="21%"><input name="villege" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['villege'];?>"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><div align="right">ซอย : </div></td>
                            <td><input name="soi" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['soi'];?>" /></td>
                            <td><div align="right">ถนน : </div></td>
                            <td><input name="road" type="text" class="input_box_patient " id="road" value="<?php echo @$rs['road'];?>" size="20" /></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><div align="right">จังหวัด<span class="alertred">*</span> :</div></td>
                            <td>
								<?php
								echo form_dropdown('provinceid',get_option('province_id','province_name',"n_province where province_id<>'' ORDER BY province_name ASC"),@$rs['provinceid'],'class="styled-select "  id="provinceid"','-โปรดเลือก-');								
								?>
                         
							</td>
                            <td s><div align="right">อำเภอ/เขต<span class="alertred">*</span> : </div></td>
                            <td>
							<span id="address_amphur">
								<?
								$whamp="";
								if(@$rs['provinceid']!=''){
										if(@$rs['amphurid']!=''){
											$whamp="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
										}else{
											$whamp="AND province_id='".$rs['provinceid']."'";
										}										
									$class='class="input_box_patient " id="amphurid"';
									echo form_dropdown('amphurid',get_option('amphur_id','amphur_name',"n_amphur where amphur_id<>''".$whamp),@$rs['amphurid'],$class,'-โปรดเลือก');
								}else{ ?>
								<select name="amphurid" id="amphurid" class="styled-select ">
									<option value="">-โปรดเลือก-</option>
								</select>
								<?php }?>
    
							</span>     
							</td>
                            <td><div align="right">ตำบล/แขวง<span class="alertred">*</span> : </div></td>
                            <td>
							<span id="address_district">
								<?
									if(@$rs['amphurid']!=''){
										if($rs['districtid']!=''){
											$whdis="AND district_id ='".$rs['districtid']."' AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
										}else{
											$whdis="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
										}
										$whdis =$whdis." ORDER BY district_name ASC";
										echo form_dropdown('districtid',get_option('district_id','district_name',"n_district WHERE district_id <>'' ".$whdis),@$rs['districtid'],'class="input_box_patient " id="districtid"','-โปรดเลือก-');										
									}else{ ?>
									<select name="districtid" id="districtid" class="styled-select">
										<option value="">-โปรดเลือก-</option>
									</select>
								<?php }?>										

							</span>                        
							</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td ><div align="right">โทร<span class="alertred">*</span> : </div></td>
                            <td><input name="telephone" type="text" class="input_box_patient " size="20" id="telephone" value="<?php echo @$rs['telephone'];?>"></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="7">อาชีพผู้ปกครอง : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <?php 
                              	if(@$rs['age']>15){ $disabled='disabled="disabled"';}else{$disabled='';}
                             	$class=' id="occparentsname" class="styled-select " onChange="show_hide_clear_otheroccparentsname(this);"'.$disabled;
                              	echo form_dropdown('occparentsname',get_option('id','name','n_occupations'),@$rs['occparentsname'],$class,'-โปรดเลือก-') ?>
							  <span id="otheroccparentsname_tr"  <? if(@$rs['otheroccparentsname']!='19'){ print 'style = "display:none"';}?>>
							  <span class="alertred">(โปรดระบุ)</span>
                              	<input name="otheroccparentsname" id="otheroccparentsname" type="text" class="input_box_patient " size="10" value="<?php echo @$rs['otheroccparentsname'];?>" />
							  </span>
							  </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top">1.2</td>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="2" class="noborder">
                      <tr>
                        <td width="15%" valign="top">สถานที่สัมผัสโรค : </td>
                        <td width="85%">
						<input name="placetouch" type="radio" value="1"  <? if(@$rs['placetouch']=='1'){ echo 'checked';}?>>  &nbsp;เขต กทม. </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>	
						<input name="placetouch" type="radio" value="2" <? if(@$rs['placetouch']=='2'){ echo 'checked';}?>> &nbsp;เขตเมืองพัทยา</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="17%">
							  <input name="placetouch" type="radio" value="3"  <? if(@$rs['placetouch']=='3'){ echo 'checked';}?>> &nbsp;เขตเทศบาล</td>
                              <td width="83%">
							  <span id="detailplacetouch_td1" <? if(@$rs['placetouch']!='3'){ print 'style = "display:none"';}?>>
								<input name="detailplacetouch" type="radio" value="1" <? if(@$rs['detailplacetouch']=='1'){ print "checked";}?>>นคร&nbsp;&nbsp;&nbsp;
                                <input name="detailplacetouch" type="radio" value="2"  <? if(@$rs['detailplacetouch']=='2'){ print "checked";}?>>เมือง&nbsp;&nbsp;&nbsp;
                                <input name="detailplacetouch" type="radio" value="3"  <? if(@$rs['detailplacetouch']=='3'){ print "checked";}?>>ตำบล
								</span></td>
								
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="17%">	<input name="placetouch" type="radio" value="4"   <? if(@$rs['placetouch']=='4'){ echo 'checked';}?>>&nbsp;&nbsp;เขตอบต.</td>
                              <td width="83%">
                              	<span id="detailplacetouch_td2" <? if(@$rs['placetouch']!='4'){ print 'style = "display:none"';}?>>
                              	<input name="detailplacetouch" type="radio" value="4"  <? if(@$rs['detailplacetouch']=='4'){ print "checked";}?>> ในชุมชน/ตลาด&nbsp;&nbsp;&nbsp;
                                <input name="detailplacetouch" type="radio" value="5"   <? if(@$rs['detailplacetouch']=='5'){ print "checked";}?>> ชนบท</span></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td width="17%"><div align="right">หมู่ที่ : </div></td>
                              <td width="25%"><input name="mooplace" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['mooplace'];?>"></td>
                              <td width="18%"><div align="right">หมู่บ้าน/ชุมชน : </div></td>
                              <td width="40%"><input name="villegeplace" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['villegeplace'];?>"></td>
                            </tr>
                            <tr>
							<?
							$wh_pt="";
							 if(@$rs['placetouch']=='1' || @$rs['placetouch']=='2'){
										$wh_pt="AND province_id ='".@$rs['provinceidplace']."'";
							}?>
                              <td><div align="right">จังหวัด<span class="alertred">*</span> : </div></td>
                              <td>
							 <span id="input_place_province">
								<?php
									$class='class="styled-select "  id="provinceidplace"';
									echo form_dropdown('provinceidplace',get_option('province_id','province_name',"n_province WHERE province_id<>''".$wh_pt."  ORDER BY province_name ASC"),@$rs['provinceidplace'],$class,'-โปรดเลือก-');
									
								?>
							</span>                           
							  </td>
                              <td><div align="right">อำเภอ<span class="alertred">*</span> : </div></td>
                              <td>
							  <span id="input_place_amphur">
							  <? if(@$rs['placetouch']!='2'){?>
								  <?
										if(@$rs['provinceidplace']!=''){
											$where=" where province_id='".@$rs['provinceidplace']."'";										
											echo form_dropdown('amphuridplace',get_option('amphur_id','amphur_name'," n_amphur".$where."  ORDER BY amphur_name ASC"),@$rs['amphuridplace'],'class="input_box_patient "  id="amphuridplace"','-โปรดเลือก-');																															
								  		}else{
								  ?>
								  		<select name="amphuridplace" id="amphuridplace" class="styled-select"><option value="">-โปรดเลือก-</option></select>
							<?php } ?>
							  <? }else{?>
							  <select name="amphuridplace" class="styled-select" id="amphuridplace">
                                  <option value="">-โปรดเลือก-</option>
                                  <option value="99" selected="selected">เมืองพัทยา</option>
							  </select>
							  <? }?>
							  </span>
							  </td>
                            </tr>
                            <tr>
                              <td id="amphur_place"><div align="right">ตำบล/แขวง<span class="alertred">*</span> : </div></td>
                              <td>
							  <span id="input_place_district">							  
								  <?
								  		if(@$rs['amphuridplace']!=''){				
												$where="WHERE amphur_id='".@$rs['amphuridplace']."' AND province_id='".@$rs['provinceidplace']."' ORDER BY district_name ASC";
												echo form_dropdown('districtidplace',get_option('district_id','district_name',"n_district ".$where),@$rs['districtidplace'],'class="input_box_patient " id="districtidplace"','-โปรดเลือก-');
										}else{?>
								  <select name="districtidplace" class="styled-select" id="districtidplace">
	                                  <option value="">-โปรดเลือก-</option>	                          
								  </styled-select>								  	
							  <?php } ?>
							  </span>
							  </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
				    <td>1.3</td>
				    <td>วันที่สัมผัสโรค : <span class="alertred">*</span>
						<input name="datetouch" type="text" size="10"  id="datetouch" class="input_box_patient auto datepicker" readonly=""  value="<?php echo @$rs['datetouch']; ?>" />
					</td>
			      </tr>
			      
				</table>	
    </div>
    <h3><a href="javascript:void(0);">ส่วนที่ 2 : ตำแหน่งและลักษณะการสัมผัส</a></h3>
    <div id="section2">
			<table width="100%" class="tbchild" id="part2">
                <tr> 
                  <td height="216" align="left" valign="middle"> 
                    <table width="218" height="259" border="0" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="211" height="196" colspan="5" align="center" valign="middle" >
							<div  style="position:relative;width:222px;height:264px;background:url(images/body_man1.gif);  "  id="body_man">
										<div id="markhead" style="position:absolute; left:160px; top:15px; width:12px; height:12px; z-index:8;"></div>
										<div id="markface" style="position:absolute; left:57px; top:24px; width:12px; height:12px; z-index:1;"></div>
										<div id="markneck" style="position:absolute; left:57px; top:45px; width:12px; height:12px; z-index:2;"></div>
										<div id="markbody" style="position:absolute; left:57px; top:72px; width:12px; height:12px; z-index:3;"></div>
										<div id="markarm" style="position:absolute; left:25px; top:92px; width:12px; height:12px; z-index:4;"></div>
										<div id="markhand" style="position:absolute; left:22px; top:135px; width:12px; height:12px; z-index:5;"></div>
										<div id="markleg" style="position:absolute; left:47px; top:192px; width:12px; height:12px; z-index:6;"></div>								
										<div id="markfeet" style="position:absolute; left:49px; top:232px; width:12px; height:12px; z-index:7;"></div>									
								</div>								
						</td>
                      </tr>
                    </table></td>
                  <th rowspan="2" align="left" valign="top"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:2px;">
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td width="45" rowspan="5" align="center" bgcolor="#FFFFFF">ลำดับที่</td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td width="90" rowspan="5" align="center" bgcolor="#FFFFFF">ตำแหน่งที่สัมผัส</td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="20" colspan="11" align="center" bgcolor="#FFFFFF">ลักษณะการสัมผัส</td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="20" colspan="3" align="center" bgcolor="#FFFFFF"><span class="style1">ถูกกัด</span></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td colspan="3" align="center" bgcolor="#FFFFFF"><span class="style2">ถูกข่วน</span></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td colspan="3" align="center" bgcolor="#FFFFFF"><span class="style3">ถูกเลีย / ถูกน้ำลาย</span></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="20" align="center" bgcolor="#E60000"><font color="#FFFFFF">มีเลือดออก</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" bgcolor="#FF777A"><font color="#FFFFFF">ไม่มีเลือดออก</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" bgcolor="#669966"><font color="#FFFFFF">มีเลือดออก</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"> 
                        </td>
                        <td align="center" bgcolor="#36CF74"><font color="#FFFFFF">ไม่มีเลือดออก</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"> 
                        </td>
                        <td align="center" bgcolor="#6394bd"><font color="#FFFFFF">ที่มีแผล</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"> 
                        </td>
                        <td align="center" bgcolor="#35ADF4"><font color="#FFFFFF">ที่ไม่มีแผล</font></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
					  <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">1</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">ศีรษะ</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="head_bite_blood"  id="head_bite_blood" <? if(@$rs['head_bite_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1"  onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="head_bite_noblood" id="head_bite_noblood" <? if(@$rs['head_bite_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="head_claw_blood" id="head_claw_blood" <? if(@$rs['head_claw_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="head_claw_noblood"  id="head_claw_noblood" <? if(@$rs['head_claw_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="head_lick_blood" id="head_lick_blood" <? if(@$rs['head_lick_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="head_lick_noblood" id="head_lick_noblood" <? if(@$rs['head_lick_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#E60000"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#FF777A"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#669966"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#36CF74"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#6394bd"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#35ADF4"></td>
                        <td height="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">&nbsp;</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">หน้า</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="face_bite_blood" id="face_bite_blood" <? if(@$rs['face_bite_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="face_bite_noblood"  id="face_bite_noblood" <? if(@$rs['face_bite_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="face_claw_blood" id="face_claw_blood" <? if(@$rs['face_claw_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="face_claw_noblood" id="face_claw_noblood" <? if(@$rs['face_claw_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="face_lick_blood"  id="face_lick_blood" <? if(@$rs['face_lick_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="face_lick_noblood"  id="face_lick_noblood" <? if(@$rs['face_lick_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#E60000"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#FF777A"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#669966"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#36CF74"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#6394bd"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#35ADF4"></td>
                        <td height="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">&nbsp;</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">ลำคอ</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="neck_bite_blood"  id="neck_bite_blood" <? if(@$rs['neck_bite_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="neck_bite_noblood"  id="neck_bite_noblood" <? if(@$rs['neck_bite_noblood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="neck_claw_blood"  id="neck_claw_blood" <? if(@$rs['neck_claw_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="neck_claw_noblood" id="neck_claw_noblood" <? if(@$rs['neck_claw_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="neck_lick_blood" id="neck_lick_blood" <? if(@$rs['neck_lick_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="neck_lick_noblood" id="neck_lick_noblood" <? if(@$rs['neck_lick_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">2</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">มือ</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="hand_bite_blood" id="hand_bite_blood" <? if(@$rs['hand_bite_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="hand_bite_noblood" id="hand_bite_noblood" <? if(@$rs['hand_bite_noblood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="hand_claw_blood" id="hand_claw_blood" <? if(@$rs['hand_claw_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="hand_claw_noblood"  id="hand_claw_noblood" <? if(@$rs['hand_claw_noblood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="hand_lick_blood"  id="hand_lick_blood" <? if(@$rs['hand_lick_blood']=='1'){ echo 'checked';}?>  type="checkbox" value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="hand_lick_noblood" id="hand_lick_noblood" <? if(@$rs['hand_lick_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">3</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">แขน</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="arm_bite_blood" id="arm_bite_blood" <? if(@$rs['arm_bite_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="arm_bite_noblood"  id="arm_bite_noblood" <? if(@$rs['arm_bite_noblood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="arm_claw_blood" id="arm_claw_blood"  <? if(@$rs['arm_claw_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="arm_claw_noblood" id="arm_claw_noblood"  <? if(@$rs['arm_claw_noblood']=='1'){ echo 'checked';}?>  type="checkbox" value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="arm_lick_blood" id="arm_lick_blood" <? if(@$rs['arm_lick_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="arm_lick_noblood" id="arm_lick_noblood" <? if(@$rs['arm_lick_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">4</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">ลำตัว</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="body_bite_blood" id="body_bite_blood" <? if(@$rs['body_bite_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="body_bite_noblood" id="body_bite_noblood" <? if(@$rs['body_bite_noblood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="body_claw_blood" id="body_claw_blood" <? if(@$rs['body_claw_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="body_claw_noblood" id="body_claw_noblood"  <? if(@$rs['body_claw_noblood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="body_lick_blood" id="body_lick_blood" <? if(@$rs['body_lick_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="body_lick_noblood"  id="body_lick_noblood" <? if(@$rs['body_lick_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">5</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">ขา</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> 
                        	<input name="leg_bite_blood"  id="leg_bite_blood" <? if(@$rs['leg_bite_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> 
                        	<input name="leg_bite_noblood"  id="leg_bite_noblood" <? if(@$rs['leg_bite_noblood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> 
                        	<input name="leg_claw_blood" id="leg_claw_blood" <? if(@$rs['leg_claw_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> 
                        	<input name="leg_claw_noblood" id="leg_claw_noblood"  <? if(@$rs['leg_claw_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> 
                        	<input name="leg_lick_blood"  id="leg_lick_blood" <? if(@$rs['leg_lick_blood']=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        </td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> 
                        	<input name="leg_lick_noblood"  id="leg_lick_noblood"<? if(@$rs['leg_lick_noblood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">6</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">เท้า</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> 
                        	<input name="feet_bite_blood"  id="feet_bite_blood"<? if(@$rs['feet_bite_blood']=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> 
                        	<input name="feet_bite_noblood" <? if(@$rs['feet_bite_noblood']=='1'){ echo 'checked';}?> type="checkbox" id="feet_bite_noblood" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> 
                        	<input name="feet_claw_blood"  <? if(@$rs['feet_claw_blood']=='1'){ echo 'checked';}?> type="checkbox" id="feet_claw_blood" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> 
                        	<input name="feet_claw_noblood" <? if(@$rs['feet_claw_noblood']=='1'){ echo 'checked';}?> type="checkbox" id="feet_claw_noblood" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> 
                        	<input name="feet_lick_blood" <? if(@$rs['feet_lick_blood']=='1'){ echo 'checked';}?> type="checkbox" id="feet_lick_blood" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4">
                        	 <input name="feet_lick_noblood" <? if(@$rs['feet_lick_noblood']=='1'){ echo 'checked';}?> type="checkbox" id="feet_lick_noblood" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">                     	
                        </td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td height="20" colspan="15"><input type="checkbox" name="food_dangerous" value="1" id="food_dangerous" <? if(@$rs['food_dangerous']=='1'){ echo 'checked';}?>>
                          กินอาหารดิบหรือดื่มน้ำที่สัมผัสเชื้อโรคพิษสุนัขบ้า</td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                    </table></th>
                </tr>
                <tr> 
                  <th align="center" valign="middle" >&nbsp;</th>
                </tr>
               
              </table>
    </div>
    <h3><a href="javascript:void(0);">ส่วนที่ 3 : สัตว์นำโรค</a></h3>
    <div id='section3'>
		<table width="100%"  id="part3" class="tbchild">
				  <tr>
					<td width="4%" valign="top"><div align="center">3.1</div></td>
				    <td width="96%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="28%" valign="top">ชนิดสัตว์นำโรค<span class="alertred">*</span> : </td>
                        <td width="3%"><div align="center">
                          <input name="typeanimal"  id="typeanimal"   type="radio" value="1" <? if(@$rs['typeanimal']=='1'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td width="23%">สุนัข</td>
                        <td width="3%"><div align="center">
                          <input name="typeanimal" id="typeanimal"  type="radio" value="2" <? if(@$rs['typeanimal']=='2'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td width="11%">แมว</td>
                        <td width="3%"><div align="center">
                          <input name="typeanimal" id="typeanimal" type="radio" value="3" <? if(@$rs['typeanimal']=='3'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td width="29%">ลิง</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="typeanimal" id="typeanimal" type="radio" value="4" <? if(@$rs['typeanimal']=='4'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td>ชะนี</td>
                        <td><div align="center">
                          <input name="typeanimal" id="typeanimal" type="radio" value="5" <? if(@$rs['typeanimal']=='5'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td>หนู</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="typeanimal"  id="typeanimal_other" type="radio" value="6" <? if(@$rs['typeanimal']=='6'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td colspan="5">อื่นๆ <span></span>
                        <span class="alertred" id="typeotherspan" <? if(@$rs['typeanimal']!='6'){echo 'style="display:none"';}?>>
						<select name="typeother" class="styled-select" id="typeother">
							  <option value="0" <? if(@$rs['typeother']=='0'){echo 'selected';}?> selected="selected">กรุณาเลือก</option>
							  <option value="1" <? if(@$rs['typeother']=='1'){echo 'selected';}?>>คน</option>
							  <option value="2" <? if(@$rs['typeother']=='2'){echo 'selected';}?>>วัว</option>
							  <option value="3" <? if(@$rs['typeother']=='3'){echo 'selected';}?>>กระบือ</option>
							  <option value="4" <? if(@$rs['typeother']=='4'){echo 'selected';}?>>สุกร</option>
							  <option value="5" <? if(@$rs['typeother']=='5'){echo 'selected';}?>>แพะ</option>
							  <option value="6" <? if(@$rs['typeother']=='6'){echo 'selected';}?>>แกะ</option>
							  <option value="7" <? if(@$rs['typeother']=='7'){echo 'selected';}?>>ม้า</option>
							  <option value="8" <? if(@$rs['typeother']=='8'){echo 'selected';}?>>กระรอก</option>
							  <option value="9" <? if(@$rs['typeother']=='9'){echo 'selected';}?>>กระแต</option>
							  <option value="10" <? if(@$rs['typeother']=='10'){echo 'selected';}?>>พังพอน</option>
							  <option value="11" <? if(@$rs['typeother']=='11'){echo 'selected';}?>>กระต่าย</option>
							  <option value="12" <? if(@$rs['typeother']=='12'){echo 'selected';}?>>สัตว์ป่า (สัตว์ที่อยู่ในป่าแล้วกัด)</option>
							  <option value="13" <? if(@$rs['typeother']=='13'){echo 'selected';}?>>ไม่ทราบ</option>
						</select></span>
						<span></span>
						</td>
                      </tr>
                      <tr>
                        <td>อายุสัตว์<span class="alertred">*</span> : </td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="1" <? if(@$rs['ageanimal']=='1'){ print "checked";}?>>
                        </div></td>
                        <td>น้อยกว่า 3 เดือน </td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="2" <? if(@$rs['ageanimal']=='2'){ print "checked";}?>>
                        </div></td>
                        <td>3 - 6 เดือน </td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="3" <? if(@$rs['ageanimal']=='3'){ print "checked";}?>>
                        </div></td>
                        <td>6 - 12 เดือน </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="4" <? if(@$rs['ageanimal']=='4'){ print "checked";}?>>
                        </div></td>
                        <td>มากกว่า 1 ปี </td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="5" <? if(@$rs['ageanimal']=='5'){ print "checked";}?>>
                        </div></td>
                        <td colspan="3">ไม่ทราบ <span></span></td>
                      </tr>
                    </table></td>
				  </tr>
				  
				  <tr>
					<td valign="top"><div align="center">3.2</div></td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="28%" valign="top">สถานภาพสัตว์<span class="alertred">*</span> :</td>
                        <td width="3%"><div align="center"><input name="statusanimal" type="radio" value="1" <? if(@$rs['statusanimal']=='1'){ print "checked";}?>></div></td>
                        <td width="69%">มีเจ้าของ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center"><input name="statusanimal" type="radio" value="2" <? if(@$rs['statusanimal']=='2'){ print "checked";}?>></div></td>
                        <td>ไม่มีเจ้าของ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center"><input name="statusanimal" type="radio" value="3" <? if(@$rs['statusanimal']=='3'){ print "checked";}?>></div></td>
                        <td>ไม่ทราบ <span></span></td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top"><div align="center">3.3</div></td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="28%" valign="top">การกักขังติดตามดูอาการของสุนัข / แมว :</td>
                        <td><div align="center">
                          <input name="detain" id="datain" type="radio" value="1" <? if(@$rs['detain']=='1'){ print "checked";}?> onClick="show_hide_clear_detaindate(document.form1);">
                        </div></td>
                        <td width="15%">กักขังได้ / ติดตามได้</td>
                        <td width="54%">
						<table width="100%" border="0" cellspacing="0" cellpadding="2" id="detaindatetable" <? if(@$rs['detain']!='1'){ print 'style = "display:none"';}?>>
                          <tr>
                            <td width="39%"><input name="detaindate" type="radio" value="1" <? if(@$rs['detaindate']=='1'){ print "checked";}?>>
                              ตายเองภายใน 10 วัน </td>
                            <td width="61%"><input name="detaindate" type="radio" value="2"  <? if(@$rs['detaindate']=='2'){ print "checked";}?>>
                              &nbsp;ไม่ตายภายใน 10 วัน  <span></span></td>
                          </tr>
                        </table>
						</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="detain" type="radio" value="2" <? if(@$rs['detain']=='2'){ print "checked";}?> onClick="show_hide_clear_detaindate(document.form1);">
                        </div></td>
                        <td>กักขังไม่ได้</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="detain" type="radio" value="3" <? if(@$rs['detain']=='3'){ print "checked";}?> onClick="show_hide_clear_detaindate(document.form1);">
                        </div></td>
                        <td>ถูกฆ่าตาย</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="detain" type="radio" value="4" <? if(@$rs['detain']=='4'){ print "checked";}?> onClick="show_hide_clear_detaindate(document.form1);">
                        </div></td>
                        <td>หนีหาย / จำไม่ได้ </td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top" align="center">3.4</td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="28%">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า<span class="alertred">*</span></td>
                        <td align="center"><input name="historyvacine" type="radio" value="1" <? if(@$rs['historyvacine']=='1'){print "checked";}?> onClick="show_hide_clear_historyvacine(document.form1);"></td>
                        <td width="69%">ไม่ทราบ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="center">
                          <input name="historyvacine" type="radio" value="2" <? if(@$rs['historyvacine']=='2'){print "checked";}?> onClick="show_hide_clear_historyvacine(document.form1);">
                        </td>
                        <td>ไม่เคยฉีด</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td  align="center">
                          <input name="historyvacine" type="radio" value="3" <? if(@$rs['historyvacine']=='3'){print "checked";}?> onClick="show_hide_clear_historyvacine(document.form1);">
                        </td>
                        <td>เคยฉีด 1 ครั้ง </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="center">
                          <input name="historyvacine" type="radio" value="4" <? if(@$rs['historyvacine']=='4'){print "checked";}?> onClick="show_hide_clear_historyvacine(document.form1);">
                        </td>
                        <td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td width="34%">เคยฉีดเกิน 1 ครั้ง ครั้งสุดท้าย </td>
								<td width="66%"><span></span>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" id="historyvacine_withintable"<? if(@$rs['historyvacine']!='4'){print 'style = "display:none"';}?>>
									  <tr>
										<td width="33%"><input name="historyvacine_within" type="radio" value="1" <? if(@$rs['historyvacine_within']=='1'){print "checked";}?>>
									    ภายใน 1 ปี </td>
										<td width="67%"><input name="historyvacine_within" type="radio" value="2" <? if(@$rs['historyvacine_within']=='2'){print "checked";}?>>
										  เกิน 1 ปี </td>
									  </tr>
									</table>
									
								</td>
							  </tr>
							</table>	
						</td>
                      </tr>
                    </table>
					</td>
				  </tr>
				  <tr>
					<td valign="top"><div align="center">3.5</div></td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="28%" valign="top">สาเหตุที่ถูกกัด</td>
                        <td width="3%" align="center"><input name="reasonbite" type="radio" value="1" <? if(@$rs['reasonbite']=='1'){ print "checked";}?> onClick="show_hide_clear_cousedetail(document.form1);"></td>
                        <td width="24%">ถูกกัดโดย<span class="alertred"><b>ไม่มี</b></span>สาเหตุโน้มนำ</td>
                        <td width="3%" align="center"><div align="left">
                          <input name="reasonbite"  id="reasonbite" type="radio" value="2"  <? if(@$rs['reasonbite']=='2'){ print "checked";}?> onClick="show_hide_clear_cousedetail(document.form1);">
                        </div></td>
                        <td width="44%">ถูกกัดโดย<span class="alertred"><b>มี</b></span>สาเหตุโน้มนำ  <span></span></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="causedetailtable" <? if(@$rs['reasonbite']!='2'){print 'style = "display:none"';}?>>
                          <tr>
                            <td width="89%"><input name="causedetail" type="radio" value="1" <? if(@$rs['causedetail']=='1'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              ทำให้สัตว์เจ็บปวด โมโหหรือตกใจ </td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="2" <? if(@$rs['causedetail']=='2'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              พยายามแยกสัตว์ที่กำลังต่อสู้กัน</td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="3" <? if(@$rs['causedetail']=='3'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              เข้าใกล้สัตว์แม่ลูกอ่อน</td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="4" <? if(@$rs['causedetail']=='4'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              รบกวนสัตว์ขณะกินอาหาร</td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="5" <? if(@$rs['causedetail']=='5'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              เข้าไปในบริเวณที่สัตว์คิดว่าเป็นเจ้าของ
                             
                              </td>
                            </tr>
                          <tr>
                            <td>
                            	
                            	<input name="causedetail" id="causedetail_other"  type="radio" value="6" <? if(@$rs['causedetail']=='6'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              อื่นๆ <span class="alertred" id="causetextspan" <? if(@$rs['causedetail']!='6'){print 'style = "display:none"'; }?>>
                              <input name="causetext" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['causetext'];?>">
                              </span> 
                              
                              </td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top" align="center">3.6</td>
				    <td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="28%" valign="top">การส่งหัวสัตว์ตรวจ</td>
                        <td width="2%"><input name="headanimal" type="radio" value="1" <? if(@$rs['headanimal']=='1'){ print "checked";}?> onClick="show_hide_clear_headanimalplace(document.form1);"></td>
                        <td width="68%">ไม่ได้ส่งตรวจ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><input name="headanimal" id="headanimal" type="radio" value="2" <? if(@$rs['headanimal']=='2'){ print "checked";}?> onClick="show_hide_clear_headanimalplace(document.form1);"></td>
                        <td>ส่งที่</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="2" id="headanimalplacetable"  <? if(@$rs['headanimal']!='2'){print 'style = "display:none"'; }?>>
                          <tr>
                            <td colspan="2">
					  		<?php 
					  			$class=' id="headanimalplace" class="input_box_patient " onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('headanimalplace',get_option('id','name','n_animalplaces'),@$rs['headanimalplace'],$class,'-โปรดเลือก-'); ?>
					  		</td>
                            </tr>
                          <tr id="otherheadanimalplacetr" <? if(@$rs['headanimalplace']!='34'){print 'style = "display:none"'; }?>>
                            <td colspan="2"><span class="alertred">(โปรดระบุ)</span>&nbsp;&nbsp;
                            	<input name="otherheadanimalplace" id="otherheadanimalplace" type="text" class="input_box_patient " value="<?php echo @$rs['otherheadanimalplace'];?>" size="40">
                            </td>
                            </tr>
                          <tr>
                            <td width="4%"><input name="batteria" type="radio" value="1" <? if(@$rs['batteria']=='1'){ print "checked";}?>></td>
                            <td width="96%">พบเชื้อ</td>
                          </tr>
                          <tr>
                            <td><input name="batteria" type="radio" value="2" <? if(@$rs['batteria']=='2'){ print "checked";}?> /></td>
                            <td>ไม่พบเชื้อ</td>
                          </tr>
                        </table>
						</td>
                      </tr>
                    </table>
					</td>
				  </tr>
				     
			  </table>			
    </div>
    <h3><a href="javascript:void(0)">ส่วนที่ 4 : ประวัติและการดูแลของผู้สัมผัสก่อนพบเจ้าหน้าที่</a></h3>
    <div id="section4">
		<table width="100%" class="tbchild" id="part4"  >
              <tr>
                <td width="4%" valign="top"><div align="center">4.1</div></td>
                <td width="96%"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="part4">
                  <tr>
                    <td width="30%" valign="top">การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</td>
                    <td width="3%"><input name="washbefore" type="radio" value="1" <? if(@$rs['washbefore']=='1'){ echo "checked";}?>  onclick="show_hide_clear_washbefore(document.form1);"></td>
                    <td width="19%">ไม่ได้ล้าง</td>
                    <td width="3%"><div align="center">
                      <input name="washbefore" id="washbefore" type="radio" value="2"  <? if(@$rs['washbefore']=='2'){ echo "checked";}?>   onclick="show_hide_clear_washbefore(document.form1);" />
                    </div></td>
                    <td width="46%">ล้างด้วย</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0"  id="washbeforetr" <? if(@$rs['washbefore']!='2'){ echo ' style="display:none"';}?>>
                      <tr>
                        <td width="5%"><div align="center">
                            <input name="washbeforedetail" type="radio" value="1"  <? if(@$rs['washbeforedetail']=='1'){print "checked";}?> onClick="show_hide_clear_washbeforedetail(document.form1);">
                        </div></td>
                        <td width="95%">น้ำ</td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="washbeforedetail" type="radio" value="2" <? if(@$rs['washbeforedetail']=='2'){print "checked";}?> onClick="show_hide_clear_washbeforedetail(document.form1);">
                        </div></td>
                        <td>น้ำและสบู่/ผงซักฟอก</td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="washbeforedetail" type="radio" value="3"  <? if(@$rs['washbeforedetail']=='3'){print "checked";}?> onClick="show_hide_clear_washbeforedetail(document.form1);">
                        </div></td>
                        <td>อื่นๆ 
							<span class="alertred"  id="washbeforedetailtd" <? if(@$rs['washbeforedetail']!='3'){print 'style = "display:none"';}?>>(โปรดระบุ)&nbsp;
								  <input name="washbeforetext" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['washbeforetext'];?>">
							</span>
							<span></span>
						</td>
                      </tr>
                    </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top"><div align="center">4.2</div></td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="30%" valign="top">การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</td>
                    <td width="3%"><input name="putdrug"  type="radio" value="1" <? if(@$rs['putdrug']=='1'){print "checked";}?> onClick="show_hide_clear_putdrug(document.form1);"></td>
                    <td width="18%">ไม่ได้ใส่ยา</td>
                    <td width="3%"><div align="center">
                      <input name="putdrug" id="putdrug" type="radio" value="2" <? if(@$rs['putdrug']=='2'){print "checked";}?> onClick="show_hide_clear_putdrug(document.form1);">
                    </div></td>
                    <td width="46%">ใส่ยา</td>
                    </tr>
                  <tr >
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="putdrugtr" <? if(@$rs['putdrug']!='2'){print 'style = "display:none"'; }?>>
                      <tr>
                        <td width="5%"><div align="center">
                            <input name="putdrugdetail" type="radio" value="1" <? if(@$rs['putdrugdetail']=='1'){print "checked";}?> onClick="show_hide_clear_putdrugdetail(document.form1);">
                        </div></td>
                        <td width="95%">สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์เช่น โพวีดีน เบตาดีนฯลฯ</td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="putdrugdetail"   type="radio" value="2"  <? if(@$rs['putdrugdetail']=='2'){print "checked";}?> onClick="show_hide_clear_putdrugdetail(document.form1);">
                        </div></td>
                        <td>ทิงเจอร์ไอโอดีน / แอลกอฮอล์</td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="putdrugdetail" id="putdrugdetail_other"  type="radio" value="3" <? if(@$rs['putdrugdetail']=='3'){print "checked";}?> onClick="show_hide_clear_putdrugdetail(document.form1);">
                        </div></td>
                        <td>อื่นๆ <span class="alertred" id="putdrugdetailtr" <? if(@$rs['putdrugdetail']!='3'){echo 'style="display:none"'; }?>>(โปรดระบุ)&nbsp;
                              <input name="putdrugtext" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['putdrugtext']?>">
                        </span>
                       <span></span>
                        </td>
                      </tr>
                    </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top"><div align="center">4.3</div></td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top" width="20%">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัส หรือสงสัยว่าสัมผัส<span class="alertred">*</span></td>
                    <td width="2%"><div align="center">
                        <input name="historyprotect"  type="radio" value="1" <? if(@$rs['historyprotect']=='1'){ print "checked";}?> onClick="show_hide_clear_historyprotect(document.form1);">
                    </div></td>
                    <td width="46%">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div align="center"><input name="historyprotect"  id="historyprotect" type="radio" value="2" <? if(@$rs['historyprotect']=='2'){ print "checked";}?> onClick="show_hide_clear_historyprotect(document.form1);"></div></td>
                    <td>เคยฉีด 3 เข็มหรือมากกว่า<span></span> </td>
                  </tr>
                  <tr id="historyprotecttr" <? if(@$rs['historyprotect']!='2'){print 'style = "display:none"'; }?>>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="5%"><div align="center">
                              <input name="historyprotectdetail" type="radio" value="1" <? if(@$rs['historyprotectdetail']=='1'){print "checked";}?>>
                          </div></td>
                          <td width="95%">ภายใน 6 เดือน</td>
                        </tr>
                        <tr>
                          <td><div align="center">
                              <input name="historyprotectdetail" type="radio" value="2" <? if(@$rs['historyprotectdetail']=='2'){print "checked";}?>>
                          </div></td>
                          <td>เกิน 6 เดือน  <span></span></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              
            </table>
    </div>
     <h3><a href="javascript:void(0)">ส่วนที่ 5 : การฉีดอิมมูโนโกลบุลินและวัคซีนในครั้งนี้</a></h3>
    <div id="section5">

	<table width="100%"  id="part5" class="tbchild">
              <tr>
                <td width="4%" valign="top"><div align="center">5.1</div></td>
                <td width="96%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="14%" valign="top">การฉีดอิมมูโนโกลบูลิน(RIG)<span class="alertred">*</span></td>
								<td width="79%"> 
									<input name="use_rig"  type="radio" value="1" <? if(@$rs['use_rig']=='1'){print "checked";}?>  onclick="show_hide_clear_use_rig(document.form1);">ไม่ฉีด&nbsp;&nbsp;
									<input name="use_rig"  type="radio" value="2" <? if(@$rs['use_rig']=='2'){print "checked";}?>  onclick="show_hide_clear_use_rig(document.form1);">ฉีด 								
									<span></span>
								</td>

						  </tr>
						</table>					
						</td>
                  </tr>
                  <tr id="use_rigtr1" <? if(@$rs['use_rig']!='2'){ echo 'style="display:none"'; }?>>
                    <td height="22">&nbsp;&nbsp;<input name="erig_hrig" type="radio" value="1" <? if(@$rs['erig_hrig']=='1'){ print "checked";}?> onClick="show_hide_clear_erig_hrig(document.form1);">
                      ERIG Lot. No. 
					  <span class="alertred" id="erig_hrig_input_box_patient 1" <? if(@$rs['erig_hrig']!='1'){ echo 'style="display:none"';}?>>
                      <input name="erig_no"  type="text" class="input_box_patient auto" size="20" value="<?php echo @$rs['erig_no'];?>" >
                      </span></td>
                  </tr>
                  <tr id="use_rigtr2" <? if(@$rs['use_rig']!='2'){print 'style = "display:none"'; }?>>
                    <td height="22">&nbsp;&nbsp;<input name="erig_hrig" type="radio" value="2"  <? if(@$rs['erig_hrig']=='2'){ print "checked";}?> onClick="show_hide_clear_erig_hrig(document.form1);">
                      HRIG Lot. No. 
					  <span class="alertred"  id="erig_hrig_input_box_patient 2" <? if(@$rs['erig_hrig']!='2'){ echo 'style="display:none"';}?>>
                      <input name="hrig_no" type="text" class="input_box_patient auto" size="20" value="<?php echo @$rs['hrig_no'];?>" >
                      </span></td>
                  </tr>
                  <tr id="use_rigtr3" <? if(@$rs['use_rig']!='2'){print 'style = "display:none"';  }?>>
                    <td>ปริมาณที่ฉีด&nbsp;
					<input name="quantityiu" id="quantityiu" type="text" class="input_box_patient auto" size="5" value="<?php echo @$rs['quantityiu'];?>"  onKeyUp="chkFormatNam (this.value,this.name);" > IU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;น้ำหนักคนไข้&nbsp; <!-- onBlur="check_ui(this);" -->
					<input name="weight_patient" id="weight_patient" type="text" size="5" class="input_box_patient auto" value="<?php echo @$rs['weight_patient'];?>"  onKeyUp="chkFormatNam (this.value,this.name);" >

					<input name="daterig" type="text" size="10" class="input_box_patient auto datepicker" readonly=""  value="<?php echo @$rs['daterig'] ?>" />
					</td>
                  </tr>
                  <tr id="use_rigtr4" <? if(@$rs['use_rig']!='2'){print 'style = "display:none"';  }?>>
                    <td>อาการหลังฉีด RIG&nbsp;&nbsp;&nbsp; 
					  <input name="after_rig" type="radio" value="1" <? if(@$rs['after_rig']=='1'){ print "checked";}?> onClick="show_hide_clear_after_rig(document.form1);">ไม่มี&nbsp;&nbsp;&nbsp;
                      <input name="after_rig" type="radio" value="2" <? if(@$rs['after_rig']=='2'){ print "checked";}?> onClick="show_hide_clear_after_rig(document.form1);">มี (ระบุอาการ)</td>
                  </tr>
                  <tr id="use_rigtr5" <? if(@$rs['use_rig']!='2'){print 'style = "display:none"'; }?>>
                    <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" id="after_rigtr" <? if(@$rs['after_rig']!='2'){print 'style = "display:none"'; }?>>
						  <tr>
							<td width="23%">&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail1" value="1" <? if(@$rs['after_rigdetail1']=='1'){print "checked";}?>> บวมแดง</td>
							<td width="8%">&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail2" value="1" <? if(@$rs['after_rigdetail2']=='1'){print "checked";}?>>คันบริเวณที่ฉีด</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail3" value="1" <? if(@$rs['after_rigdetail3']=='1'){print "checked";}?>>เป็นไข้</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail4" value="1" <? if(@$rs['after_rigdetail4']=='1'){print "checked";}?>>ปวดศีรษะ</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail5" value="1" <? if(@$rs['after_rigdetail5']=='1'){print "checked";}?>>เป็นผื่นคันทั่วไป</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail6" value="1" <? if(@$rs['after_rigdetail6']=='1'){print "checked";}?>>ช็อค</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail7" value="1" <? if(@$rs['after_rigdetail7']=='1'){print "checked";}?> onClick="show_hide_clear_after_rigdetail7(document.form1);">
							  อื่นๆ&nbsp;<span class="alertred" id="otherafter_rigdetail7" <? if(@$rs['after_rigdetail7']!='1'){print 'style = "display:none"';  }?>>(โปรดระบุ)&nbsp;&nbsp;
							  <input name="after_rigtext" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['after_rigtext']?>">
							  </span></td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2">ระยะเวลาที่มีอาการ</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;&nbsp;&nbsp;
							  <input name="longfeel" type="radio" value="1" <? if(@$rs['longfeel']=='1'){ print "checked";}?>>
							  ภายใน 2 ชม. </td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;&nbsp;&nbsp;
							  <input name="longfeel" type="radio" value="2" <? if(@$rs['longfeel']=='2'){ print "checked";}?>>
							  หลัง 2 ชม. <span class="alertred">(ระบุวันที่)&nbsp;
								<input name="datelongfeel" id="datelongfeel" type="text" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$rs['datelongfeel'];?>" />
							  </span></td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td height="15">&nbsp;</td>
							<td width="9%" valign="top">การรักษา</td>
							<td width="60%"><textarea name="cure_comment" cols="30" rows="5" class="input_box_patient"><?php echo @$rs['cure_comment'];?></textarea></td>
							<td>&nbsp;</td>
						  </tr>
						</table>&nbsp;
					</td>
                  </tr>
                </table>
				</td>
              </tr>
              <tr>
                <td valign="top"><div align="center">5.2</div></td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">
                    	<!-- n_vaccine -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="15%" valign="top">การฉีดวัคซีนโดยวิธี <span class="alertred">*</span></td>
							<td width="85%">
								  <input name="means"  id="means" type="radio" value="1" <? if(@$rs['means']=='1'){print "checked";}?>>&nbsp;เข้ากล้ามเนื้อ&nbsp;&nbsp;&nbsp;
								  <input name="means"  id="means" type="radio" value="2" <? if(@$rs['means']=='2'){print "checked";}?>> เข้าในผิวหนัง&nbsp;&nbsp;&nbsp;
								  <input name="means"  id="means" type="radio" value="3" <? if(@$rs['means']=='3'){print "checked";}?>>ไม่ฉีด
							  <span></span>
							  </td>
						  </tr>
						  <tr>
						    <td colspan="2" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td colspan="3" align="center">
									<table  id="meanstr"  class="tbvaccine"<? if(@$rs['means']=='3' || @$rs['means']==''){ print "style='display:none'";}?>>
										  	<tr>
												<th>ครั้งที่ </th>
												<th>วันที่ฉีด</th>
												<th>ชื่อวัคซีน</th>
												<th>เลขที่วัคซีน</th>
												<th>ขนาด(c.c)</th>
												<th>จำนวนจุดที่ฉีด</th>
												<th>ชื่อผู้ฉีด</th>
												<th>สถานที่</th>
												
										  </tr>
										  <? 						
											$result=(!empty($rs['id'])) ? $this->db->Execute("select * from n_vaccine where information_id='".$rs['id']."' ORDER BY vaccine_id ASC"):"";																																		
										$key=4;
										$vaccine_id=array('','','','','');
										$vaccine_date=array('','','','','');
										$vaccine_name=array('','','','','');
										$vaccine_no=array('','','','','');
										$vaccine_cc=array('','','','','');
										$vaccine_point=array('','','','','');
										$byname=array('','','','','');
										$byplace=array('','','','','');
										if($process=='vaccine'){
											if(!empty($rs['hospitalcode'])){
												$hospital_name=$this->db->GetOne("select hospital_name from n_hospital_1 where hospital_code='".$rs['hospitalcode']."' ");
											}									
										}else if($process=='addnew' || $process=='' ||$process="view"){
											$hospital_name=$this->session->userdata('R36_HOSPITAL_NAME');										
										}
										
										if($result){
											foreach($result as $key=>$rec_vaccine){
														$vaccine_id[$key] = $rec_vaccine['vaccine_id'];
														$vaccine_date[$key] = cld_my2date($rec_vaccine['vaccine_date']);
														$vaccine_name[$key] = $rec_vaccine['vaccine_name'];
														$vaccine_no[$key] = $rec_vaccine['vaccine_no'];
														$vaccine_cc [$key]= $rec_vaccine['vaccine_cc'];
														$vaccine_point[$key] = $rec_vaccine['vaccine_point'];
														$byname[$key] = $rec_vaccine['byname'];
														$byplace[$key] = ($rec_vaccine['byplace']=='')?$hospital_name:'';
											}
											$max_rec=$result->Recordcount();
										}	
																				
										
										$max=(@$rs['means']=="2")? 4:5;
										  for($i=0;$i<$max;$i++){
												if($byplace[$i]==''){ $byplace[$i]=$hospital_name;$hospital_name='';}
												echo form_hidden('vaccine_id',$vaccine_id[$i]);
										  ?>
										  <tr>
												<td><?php echo $i+1;?></td>
												<td>
													<input name="vaccine_date[<?php echo $i?>]" type="text" size="10" class="input_box_patient auto datepicker" id="vaccine_date[<?php echo $i?>]" readonly="" value="<?php echo $vaccine_date[$i];?>"
													<? if($vaccine_date[$i]!="" && $process=='vaccine'){echo 'disabled';} ?> />
												</td>
												<td>
													<select name="vaccine_name[<?php echo $i?>]" class="styled-select" id="vaccine_name[<?php echo $i?>]" <?php  if($vaccine_name[$i]!="" && $process=='vaccine'){echo 'disabled';} ?>>
														<option value="0" <? if($vaccine_name[$i]=='0'){ echo 'selected';}?>>เลือกชนิด</option>
														<option value="1" <? if($vaccine_name[$i]=='1'){ echo 'selected';}?>>PVRV</option>
														<option value="2" <? if($vaccine_name[$i]=='2'){ echo 'selected';}?>>PCEC</option>
														<option value="3" <? if($vaccine_name[$i]=='3'){ echo 'selected';}?>>HDCV</option>
														<option value="4" <? if($vaccine_name[$i]=='4'){ echo 'selected';}?>>PDEV</option>
												  </select> 
												</td>
												<td>
													<input name="vaccine_no[<?php echo $i?>]"  class="checkvaccine"  type="text" id="vaccine_no[<?php echo $i?>]" size="10" value="<?php echo $vaccine_no[$i]?>" <? if($vaccine_no[$i]!="" && $process=="vaccine"){echo 'disabled';} ?> >											
												</td>													
												<td>
													<input name="vaccine_cc[<?php echo $i?>]" class="checkvaccine"  type="text" id="vaccine_cc[<?php echo $i?>]"  value="<?php echo $vaccine_cc[$i]?>" size="3" maxlength="10" <? if($vaccine_cc[$i]!="" && $process=='vaccine'){echo 'disabled';} ?>>												
												</td>
												<td>											
													<input type="text" name="vaccine_point[<?php echo $i?>]" class="checkvaccine"   size="2" id="vaccine_point[<?php echo $i?>]"  maxlength="1" value="<?php echo $vaccine_point[$i];?>" 
													<? if($vaccine_point[$i]!="" && $process=="vaccine"){echo 'disabled';} ?> />
												</td>
												<td>
													<input name="byname[<?php echo $i?>]" type="text" class="checkvaccine" id="byname[<?php echo $i?>]" value="<?php echo $byname[$i]?>" size="10"  <? if($byname[$i]!='' && $process=='vaccine'){echo 'disabled';} ?>>
												</td>
												<td >
													<input name="byplace[<?php echo $i?>]" type="text" readonly="readonly" id="byplace[<?php echo $i?>]" value="<?php echo (!empty($rs['id'])) ? $hospital_name :$byplace[$i];?>" size="20" <? if($byplace[$i]!="" && $process=='vaccine'){echo 'disabled';} ?>></td>
										  </tr>
										  <?  
										  }
										  ?>
									</table>
								
								</td>
                                </tr>
                              <tr id="after_symptom_vaccine">
                                <td width="14%">อาการหลังฉีดวัคซีน</td>
                                <td width="6%"><input name="after_vaccine" type="radio" value="1" <? if(@$rs['after_vaccine']=='1'){ print "checked";}?> onClick="show_hide_after_vaccine(document.form1);">ไม่มี</td>
                                <td width="73%"><input name="after_vaccine" type="radio" value="2" <? if(@$rs['after_vaccine']=='2'){ print "checked";}?> onClick="show_hide_after_vaccine(document.form1);">มี (ระบุอาการ) </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" id="after_vaccinetr" <? if(@$rs['after_vaccine']!='2'){echo 'style="display:none"'; }?>>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail1" value="1" <? if(@$rs['after_vaccine_detail1']=='1'){echo 'checked';}?> />
                                      บวมแดง</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail2" value="1"<? if(@$rs['after_vaccine_detail2']=='1'){echo 'checked';}?> />
                                      คันบริเวณที่ฉีด</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail3" value="1" <? if(@$rs['after_vaccine_detail3']=='1'){echo 'checked';}?>/>
                                      เป็นไข้</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail4" value="1" <? if(@$rs['after_vaccine_detail4']=='1'){echo 'checked';}?>/>
                                      ปวดศีรษะ</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail5" value="1" <? if(@$rs['after_vaccine_detail5']=='1'){echo 'checked';}?>/>
                                      เป็นผื่นคันทั่วไป</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail6" value="1"  <? if(@$rs['after_vaccine_detail6']=='1'){echo 'checked';}?>/>
                                      ช็อค</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail7" value="1"  <? if(@$rs['after_vaccine_detail7']=='1'){echo 'checked';}?> onClick="show_hide_after_vaccinedetail7(document.form1);"/> 
                                      อื่นๆ 
									  <span class="alertred" id="otherafter_vaccinedetail7" <? if(@$rs['after_vaccine_detail7']!='1'){print 'style = "display:none"';  }?>>
									  (โปรดระบุ)&nbsp;&nbsp;
                                      <input name="after_vaccine_text" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['after_vaccine_text'];?>">
                                      </span></td>
                                    </tr>
                                  <tr>
                                    <td width="22%">วันที่มีอาการ</td>
                                    <td width="78%">
                                    
									<input name="after_vaccine_date" type="text" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$rs['after_vaccine_date'];?>" />
									</td>
                                  </tr>
                                  <tr>
                                    <td valign="top">การรักษา</td>
                                    <td><textarea name="after_vaccine_cure_comment" cols="30" rows="5" class="input_box_patient"><?php echo @$rs['after_vaccine_cure_comment'];?></textarea></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
						    </tr>
						</table>				
						</td>
                  </tr>
                </table></td>
              </tr>
			  <? if($in_out=='1'){?>
              <tr id="closecasemaintr"  <? // if((@$rs['hospitalprovince']!=@$rs['provinceid']) || (@$rs['hospitalamphur']!=@$rs['amphurid'])){print 'style = "display:none"'; }?>>
                <td valign="top"  align="center">5.3</td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="12%">ท่านต้องการปิด Case หรือไม่ </td>
                    <td width="67%">
					<input name="closecase" type="radio" value="1" checked="cheecked" <? if(@$rs['closecase']=='1'){print "checked";}?>  onclick="show_hide_closecase_chk(document.form1);">
                      ไม่ต้องการ&nbsp;&nbsp;&nbsp;
                      <input name="closecase" type="radio" value="2" <? if(@$rs['closecase']=='2'){print "checked";}?>  onclick="if(confirm('คุณแน่ใจหรือไม่ที่ต้องการปิดเคสข้อมูลนี้')){show_hide_closecase_chk(document.form1);}else{document.form1.closecase[1].checked=false;}">
                      ต้องการ</td>
                  </tr>
                  <tr>
                    <td colspan="2">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="closecasetr" <? if(@$rs['closecase']!='2'){echo 'style="display:none" ';}?>>
                      <tr>
                        <td width="25%">&nbsp;</td>
                        <td width="4%">สาเหตุ</td>
                        <td><input name="closecase_reason" type="radio" value="1" <? if(@$rs['closecase_reason']=='1'){ print "checked";}?> onClick="show_hide_closecase_reason(document.form1);">
                          ฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าครบตามมาตรฐาน</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input name="closecase_reason" type="radio" value="2" <? if(@$rs['closecase_reason']=='2'){ print "checked";}?>  onclick="show_hide_closecase_reason(document.form1);">
                          ฉีดวัคซีนกระตุ้นครบตามมาตรฐาน</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input name="closecase_reason" type="radio" value="3" <? if(@$rs['closecase_reason']=='3'){ print "checked";}?>  onclick="show_hide_closecase_reason(document.form1);">
                          ฉีดวัคซีนไม่ครบ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" id="closecase_reasontr" <? if(@$rs['closecase_reason']!='3'){ echo 'style="display:none" ';}?>>
                          <tr>
                            <td width="11%"><div align="right">
                              <input type="checkbox" name="closecase_reason_detail1" value="1" <? if(@$rs['closecase_reason_detail1']=='1'){ print "checked";}?>>
                            </div></td>
                            <td width="89%">สุนัข/แมว มีอาการปกติภายใน 10 วัน </td>
                          </tr>
                          <tr>
                            <td><div align="right">
                              <input type="checkbox" name="closecase_reason_detail2" value="1" <? if(@$rs['closecase_reason_detail2']=='1'){ print "checked";}?>>
                            </div></td>
                            <td>ติดต่อคนไข้ไม่ได้/คนไข้ไม่มาฉีด</td>
                          </tr>
                        </table>
						</td>
                      </tr>
                    </table></td>
                    </tr>
                </table></td>
              </tr>
			  <? }?>			  
            </table>
				<table width="65%" border="0" align="right" cellpadding="3" cellspacing="0" id="part6">
				  <tr>
					<td width="31%"><div align="right"><b>ชื่อแพทย์ผู้สั่งการรักษา <span class="alertred">*</span> </b></div></td>
					<td width="69%"><span class="alertred">
					  <input name="doctorname" type="text" class="input_box_patient " size="20" value="<?php echo @$rs['doctorname'];?>">
					</span></td>
				  </tr>
				  <tr>
					<td><div align="right"><b>ชื่อผู้รายงาน <span class="alertred">*</span> </b></div></td>
					<td><span class="alertred">
					  <input name="reportname" type="text" class="input_box_patient " id="reportname" value="<?php echo @$rs['reportname'];?>" size="20" />
					</span></td>
				  </tr>
				  <tr>
					<td><div align="right"><b>ตำแหน่ง <span class="alertred">*</span> </b></div></td>
					<td><span class="alertred">
					  <input name="positionname" type="text" class="input_box_patient " id="positionname" value="<?php echo @$rs['positionname'];?>" size="20" />
					</span></td>
				  </tr>
				  <tr>
					<td><div align="right"><b>วันที่รายงาน <span class="alertred">*</span> </b></div></td>
					<td>
					<?
						$Ydate=date('Y')+543;
						$datedeflaut=date("-m-d");
						$reportdate=cld_my2date($Ydate.$datedeflaut);
					?>
			        <input name="reportdate" type="text" size="10" class="input_box_patient " readonly="" value="<?php echo (@$rs['reportdate'])? cld_my2date(@$rs['reportdate']):$reportdate;?>"> 

				    </td>
				  </tr>
			  </table>
    </div>    
</div>
 <div class="btn_inline">
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div> 
</form>

<? if(@$rs['head_bite_blood']=='1'){ echo "<script language='javascript'>show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(@$rs['head_bite_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(@$rs['head_claw_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(@$rs['head_claw_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(@$rs['head_lick_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(@$rs['head_lick_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(@$rs['face_bite_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(@$rs['face_bite_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(@$rs['face_claw_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(@$rs['face_claw_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(@$rs['face_lick_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(@$rs['face_lick_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(@$rs['neck_bite_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(@$rs['neck_bite_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(@$rs['neck_claw_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(@$rs['neck_claw_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(@$rs['neck_lick_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(@$rs['neck_lick_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(@$rs['hand_bite_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(@$rs['hand_bite_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(@$rs['hand_claw_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(@$rs['hand_claw_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(@$rs['hand_lick_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(@$rs['hand_lick_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(@$rs['arm_bite_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(@$rs['arm_bite_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(@$rs['arm_claw_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(@$rs['arm_claw_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(@$rs['arm_lick_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(@$rs['arm_lick_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(@$rs['body_bite_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(@$rs['body_bite_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(@$rs['body_claw_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(@$rs['body_claw_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(@$rs['body_lick_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(@$rs['body_lick_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(@$rs['leg_bite_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(@$rs['leg_bite_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(@$rs['leg_claw_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(@$rs['leg_claw_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(@$rs['leg_lick_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(@$rs['leg_lick_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(@$rs['feet_bite_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(@$rs['feet_bite_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(@$rs['feet_claw_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(@$rs['feet_claw_noblood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(@$rs['feet_lick_blood']=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(@$rs['feet_lick_noblood']=='1'){
	 echo "<script language=\"javascript\">
					show_mark(document.getElementById('feet_bite_blood').checked
										,document.getElementById('feet_bite_noblood').checked
										,document.getElementById('feet_claw_blood').checked
										,document.getElementById('feet_claw_noblood').checked
										,document.getElementById('feet_lick_blood').checked
										,document.getElementById('feet_lick_noblood').checked
										,document.getElementById('markfeet')
										);
				</script>";}?>
