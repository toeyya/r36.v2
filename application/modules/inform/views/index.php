<script type="text/javascript">
$(document).ready(function(){
	//$('.alert-error').hide();
	$('.btn_add').removeAttr('disabled');
	$('input[name=closecase_person]').val('');
	$('input[name=closecase]').val('');
	var province_id,amphur_id,district_id;	
	$("select[name=hospital_province_id]").change(function(){
		province_id=$("select[name=hospital_province_id] option:selected").val();
		$('#input_amphur').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');	
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=hospital_amphur_id&ref1='+province_id,
			success:function(data){
				$('#input_amphur').html(data);				
				$('#input_hospital').html('<select name="hospitalcode" class="styled-select" id="hospitalcode"><option value="">-โปรดเลือก-</option></select>');
				$('#input_district').html('<select name="hospital_district_id" class="styled-select" id="hospital_district_id"><option value="">-โปรดเลือก-</option></select>');					
			}
		});
	});

	$("select[name=hospital_amphur_id]").live('change',function(){
		amphur_id=$("select[name=hospital_amphur_id] option:selected").val();
		$('#input_district').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');	
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=hospital_district_id&ref1='+province_id+'&ref2='+amphur_id,
			success:function(data){
				$("#input_district").html(data);
			}
		});
	});
	$('select[name=hospital_district_id]').live('change',function(){
		district_id =$('select[name=hospital_district_id] option:selected').val();
		$('#input_hospital').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');	
		$.ajax({
			url:'<?php echo base_url()?>hospital/getHospital',
			data:'name=hospitalcode&ref1='+province_id+'&ref2='+amphur_id+'&ref3='+district_id,
			success:function(data){
					$('#input_hospital').html(data);
			}
		});
	});
	var chk_p;
	function chk_closecase_person(){		
		//console.log("person");
		$('#loading').show();
		if($('select[name=statusid] option:selected').val()=="1"){
			var idcard=$('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val();					
		}else{
			var idcard=$('input[name=idcard]').val();
		}
		
			if(idcard.length==13){											
				$.ajax({
					url:'<?php echo base_url() ?>inform/closecase_person/'+idcard+'/true',
					dataType:'json',
					success:function(data){
						$('input[name=closecase_person]').val(data.chk);					
						//console.log("chk-p = "+data.chk);
						if(data.chk=="yes"){											  																	 	
						 	$('#btn_view1').attr('href','inform/closecase_person/'+data.idcard);
						 	$('#loading').hide();
						 	$.colorbox({width:"50%", height:"30%", inline:true,href:"#closecase_person"});												  
						}else{														
							$.colorbox.close();
							document.form1.submit();
						}
					}				
				})	
			}else{
				$.colorbox.close();
			}	
			return true;				
	}
	$('#ifm').attr('src','#');
	$('#loading').hide();
	var request;
	var chk_c;
	function chk_closecase(){		
		//$('.btn_add').attr('disabled',true);		
		//$.colorbox({width:"50%", height:"50%", inline:true,href:"#load",escKey:false,closeButton:false,onClosed:function(){if(request!=undefined){request.abort();}$('.btn_add').attr('disabled',false);}});									
		$('#loading').show();
		request=$.ajax({
			url:'<?php echo base_url() ?>inform/closecase/true',
			dataType:'json',
			success:function(data){
				$('input[name=closecase]').val(data.chk);
				//chk_c = data.chk;
				//console.log("chk_c ="+data.chk);
				if(data.chk=="yes"){
					$('#loading').hid();		  	
				  	$.colorbox({width:"50%", height:"30%", inline:true,href:"#closecase"});			  				 						
				}else{															
					chk_closecase_person();
				}						
			}			
		})					 			
	}		

	$('.btn_submit').click(function(e){
		 $('.alert-error').hide();
		 $('#form1').validate({ignore: "#form1 *" });	 
		 $('input').removeClass('error');
		 $('label.error').remove();
		 $('#form1').attr('action','inform/index');
		 $('input[name=action]').val('search');		 		 
		 document.form1.submit();	
		 e.preventDefault();	
	});
	// START ####  กรณีเพิ่มรายการ  ####
	$('.btn_add').click(function(e){
		$('.alert-error').hide();					
		$('#form1').attr('action','inform/addNew');	
		$('input[name=action]').val('');	
		if($('input[name=level]').val()=="05"){// กรณี สิทธิ์การใช้เป็น staff จะเลือกโรงพยาบาลอื่นๆไม่ได้																						
				$("#hospitalprovince option").filter(function(){return $(this).val() == $('input[name=h_province_id]').val()}).prop('selected', 'selected');
				$('#hospital_amphur_id').find('option').remove().end().append('<option  selected="selected" value="'+$('input[name=h_amphur_id]').val()+'">'+$('input[name=amphur_name]').val()+'</option>');
				$('#hospital_district_id').find('option').remove().end().append('<option  selected="selected" value="'+$('input[name=h_district_id]').val()+'">'+$('input[name=district_name]').val()+'</option>');
				$('#hospitalcode').find('option').remove().end().append('<option  selected="selected" value="'+$('input[name=h_code]').val()+'">'+$('input[name=h_name]').val()+'</option>');																																			
		}	
	})
	
   		$.validator.addMethod("alphanumericspecial", function(value, element) {
        	return this.optional(element) || value == value.match(/^[0-9/]+$/);
        }, "ระบุได้เฉพาะตัวเลขและเครื่องหมาย / ");	
		
		 $.validator.setDefaults({
		 	submitHandler:function(event){		 		
		 		if($('input[name=level]').val()=="05"){
			 		//if($('input[name=closecase]').val() =="yes" || $('input[name=closecase]').val().length == 0){
						chk_closecase(); // แสดงรายการที่ยังไมได้ปิดเคส	
					//}
				}else{
					document.form1.submit();
				}			 	 	 				 	
		 	}
		 });
		 $('#form1').validate({
		 	 onkeyup: false,
		 	 groups: {
    				groupidcard:"cardW0 cardW1 cardW2 cardW3 cardW4"
  			},
		 	rules:{
		 		hn:{
		 			required :true,
		 			alphanumericspecial:true
		 			
		 		},
		 		hospital_province_id:"required",hospital_amphur_id:"required",hospital_district_id:"required",hospitalcode:"required",
				idcard:  { required: {depends: function(element) {	return $('#statusid option:selected').val() == '2' }}, number:true},   
		 		cardW0:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW1:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW2:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW3:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW4:{
		 			required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true,	 		
		 			remote:{
		 				url:'<?php echo base_url(); ?>users/chkidcard/patient',
				        data:{ idcard: function() { return $('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val(); },
				          	   digit_last:function(){return $('#cardW4').val(); }				          
				        }
		 			}		 		
		 		}       			 		
		 	},
		 	messages:{		 		
		 		hospital_province_id:" กรุณาระบุ",hospital_amphur_id:" กรุณาระบุ",hospital_district_id:" กรุณาระบุ",hospitalcode:" กรุณาระบุ",
		 		hn:{
		 			required:" กรุณาระบุ"		 					 			
		 		},idcard:"กรุณาระบุ",
		 		cardW0:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"},
		 		cardW1:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"},
		 		cardW2:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"},
		 		cardW3:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"},
		 		cardW4:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข",remote :" ระบุไม่ถูกต้อง"}		 		
		 	},
		 	errorPlacement: function(error, element) {
		     if (element.attr("name") == "cardW0"  || element.attr("name") == "cardW1" 	|| element.attr('name') == "cardW2" || element.attr('name')=="cardW3" || element.attr('name')=="cardW4")
		       error.insertAfter("#cardW4");
		     else
		       error.insertAfter(element);
		   }
		 }) ;
// END ####  กรณีเพิ่มรายการ  ####

	 $('#Show_passport').css('display','none');
	 $('#statusid').change(function(){
 		if($('#statusid option:selected').val()=="1"){		 			
 		 	$('#Show_passport').css('display','none');$('#Show_idcard').css('display','');
 		}else{$('#Show_passport').css('display',''); $('#Show_idcard').css('display','none');}		 	
	 })

		 
	$('.tb_patient1 tr:eq(5)').nextUntil('tr:eq(8)').hide();		
	$('input[name=search_adv]').change(function(){                
	     $('.tb_patient1 tr:eq(5)').nextUntil('tr:eq(8)').toggle(this.checked);
	}).change(); //ensure visible state matches initially

	if($('input[name=search_adv]:checked')){
		$('input[name=search_adv]').trigger('change');
	}
	
	$('.btn_delete').click(function(){
		if(confirm('ยืนยันการลบข้อมูลนี้ ?')){	
			var btn_del =$(this);		
			var historyid= $(this).prev().val();
			var information_id = $(this).prev().prev().val();
			$.ajax({
				data:'id='+information_id+'&historyid='+historyid,
				url:'<? echo base_url();?>/inform/delete',
				success:function(){
					btn_del.closest("tr").fadeOut('slow');
				}
			})
		}
	})

	
});
</script>
<div id="title">แบบฟอร์มคนไข้ที่สัมผัสโรค</div>

<div id="search">
<form name="form1"  method="get" id="form1" action="inform/index">	
<?php error_reporting(E_WARNING); 

	if($this->session->userdata('R36_LEVEL')=="05"){
		$hospitalcode=$this->session->userdata('R36_HOSPITAL');
		$rs=$this->hospital->get_row("hospital_code",$hospitalcode);	
		$province_name = $this->db->GetOne("select province_name from n_province where province_id = ? ",$rs['hospital_province_id']);
		$province_name = ThaiToUtf8($province_name);
		$amphur_name = $this->db->GetOne("select amphur_name from n_amphur where province_id = '".$rs['hospital_province_id']."'  and amphur_id = '".$rs['hospital_amphur_id']."' ");
		$amphur_name = ThaiToUtf8($amphur_name);
		$district_name = $this->db->GetOne("select district_name from n_district where province_id = ? and amphur_id = ? and district_id = ? ",array($rs['hospital_province_id'],$rs['hospital_amphur_id'],$rs['hospital_district_id']));
		$district_name = ThaiToUtf8($district_name);
		$data =array('province_name'=>$province_name,'amphur_name'=>$amphur_name,'district_name' => $district_name
					,'level' => $this->session->userdata('R36_LEVEL'),'h_province_id' => $rs['hospital_province_id']
					,'h_amphur_id' => $rs['hospital_amphur_id'],'h_district_id' => $rs['hospital_district_id']
					,'h_code' =>$hospitalcode,'h_name'=>$rs['hospital_name'],'closecase'=>'','closecase_person'=>'');
		echo form_hidden($data);
	}
	echo form_hidden('action','');
	//$this->db->debug=true;
	//var_dump($_GET);
?>		
	<table class="tb_patient1">				
			<tr> 
				  <th><span class="alertred">*</span>จังหวัด :</th>
				  <td>				  	
						<?php echo form_dropdown('hospital_province_id',get_option('province_id','province_name',"n_province where province_id <>''  order by province_name asc"),$_GET['hospital_province_id'],'class="input_box_patient" id="hospitalprovince"','-โปรดเลือก-') ?>
				  </td>
				  <th height="20"  ><span class="alertred">*</span>อำเภอ :</th>
				  <td>
						<span id="input_amphur">
							<?php 
							$whamphur="";
							 if(!empty($_GET['hospital_province_id'])){
									$whamphur="AND province_id ='".$_GET['hospital_province_id']."'";
								 	$amphur_id="amphur_id <>'' ";									 										
							 }else{
							 	 	$amphur_id="amphur_id ='' ";
							 }
						
							 echo form_dropdown('hospital_amphur_id',get_option('amphur_id','amphur_name',"n_amphur where $amphur_id $whamphur  order by amphur_name asc"),$_GET['hospital_amphur_id'],'class="input_box_patient" id="hospital_amphur_id"','-โปรดเลือก-');
							?>
					</span> 				
				  </td>
			</tr>

			<tr> 
				  <th><span class="alertred">*</span>ตำบล :</th>
				  <td >
						<span id="input_district">
							<?php
							$wh="";
							 if(!empty($_GET['hospital_province_id'])){
									$wh="AND province_id ='".$_GET['hospital_province_id']."' AND amphur_id='".$_GET['hospital_amphur_id']."'";	
								 	$whdistrict="  district_id<>''";							 										
							 }else{
							 		$whdistrict="  district_id=''";
							 }	
							 echo form_dropdown('hospital_district_id',get_option('district_id','district_name',"n_district where $whdistrict $wh  order by district_name asc"),@$_GET['hospital_district_id'],'class="input_box_patient" id="hospital_district_id"','-โปรดเลือก-');
							?>
					</span> 				
				  </td>
				   <th ><span class="alertred">*</span>สถานบริการ :</th>
				  <td> 
						<span id="input_hospital">											
								<?php				
								$whhospital="";
								 if(!empty($_GET['hospital_amphur_id'])){
										$whhospital=" hospital_id<>'' AND hospital_province_id='".@$_GET['hospital_province_id']."' AND   hospital_amphur_id ='".@$_GET['hospital_amphur_id']."' AND hospital_district_id ='".@$_GET['hospital_district_id']."' ";										
								 }else{								 										 
									  $whhospital=" hospital_id=''";
								 }
										echo form_dropdown('hospitalcode',get_option('hospital_code','hospital_name',"n_hospital_1 where $whhospital ORDER BY hospital_name ASC"),@$_GET['hospitalcode'],'class="input_box_patient" id="hospitalcode"','-โปรดเลือก-');
					  			 ?>
						</span> 
				  </td>
			</tr>
			<tr> 
				  <th ><span class="alertred">*</span> รหัส HN :</th>
				  <td><input name="hn" type="text" id="hn" size="30" maxlength="300"  class="input_box_patient" value="<?php echo @$_GET['hn'] ?>"></td>				  		
				<th ><span class="alertred">*</span> ประเภทบัตร : </th>
				<td><select name="statusid"  id="statusid"  class="input_box_patient">			
						<option value="1" <?php if(@$_GET['statusid']=='1'){ echo "selected='selected'";}?> selected="selected">เลขประจำตัวประชาชน</option>
						<option value="2" <?php if(@$_GET['statusid']=='2'){ echo "selected='selected'";}?>>เลขที่ passport</option>
					</select>					
					<span id="Show_passport"> 
						<input name="idcard" type="text" id="idcard" size="30" maxlength="300"  class="input_box_patient" value="<?php echo @$_GET['idcard']?>">
					</span>
					<span id="Show_idcard"> 
							<input name="cardW0" id="cardW0" type="text" class="input_box_patient" size="1" maxlength="1" value="<?php echo @$_GET['cardW0']?>" style="width:20px;"> -
							<input name="cardW1" id="cardW1" type="text" class="input_box_patient" size="4" maxlength="4" value="<?php echo @$_GET['cardW1']?>" style="width:80px;margin-left:0px;"> -
							<input name="cardW2" id="cardW2" type="text" class="input_box_patient" size="5" maxlength="5" value="<?php echo @$_GET['cardW2']?>"style="width:100px;margin-left:0px;"> -
							<input name="cardW3" id="cardW3" type="text" class="input_box_patient" size="2" maxlength="2"  value="<?php echo @$_GET['cardW3']?>"style="width:40px;margin-left:0px;"> -
							<input name="cardW4" id="cardW4" type="text" class="input_box_patient" size="1" maxlength="1"  value="<?php echo @$_GET['cardW4'] ?>" style="width:20px;margin-left:0px;">				
					</span>
		
				</td>
			</tr>

			<tr>
				<th><span class="alertred">*</span> สิทธิการรักษาพยาบาล</th>
				<td colspan="4">
					<span style="margin-left:12px;"> 
						<input type="radio" name="in_out" value="1" checked="checked" <?php echo (@$_GET['in_out']=="1")?'checked="checked"':''; ?>> สิทธิการรักษาสถานบริการนี้
						<input type="radio" name="in_out" value="2" <?php echo (@$_GET['in_out']=="2")?'checked="checked"':''; ?>> สิทธิการรักษาสถานบริการอื่น
					</span>

				</td>
			</tr>
			<tr>
				<th width="20%">ประเภทสิทธิการรักษาพยาบาล</th>
				<td colspan="4"><?php echo form_dropdown('right_id',get_option('id','name','n_right'),@$_GET['right_id'],'class="input_box_patient"','- โปรดเลือก -') ?></td>
			</tr>
			<tr>
				<th></th>
				<td colspan="4">
					<p style="margin-left:13px;"><input type="checkbox" name="search_adv" value="1" <?php echo (!empty($_GET['search_adv']))? "checked='checked'":''  ?>>
						<span class="bold blue">ค้นหาขั้นสูง (advanced search)</span></p>
			  </td>
			</tr>
			
			<tr> 
				  <th >ชื่อ-นามสกุล :</th>
				  <td colspan="4"><input name="name" type="text" id="name" size="30" maxlength="300"  class="input_box_patient" value="<?php echo @$_GET['name'] ?>"> -
				  <input name="surname" type="text" id="surname" size="30" maxlength="300"  class="input_box_patient" value="<?php echo @$_GET['surname'] ?>">
				  </td>
			</tr>				
			<tr> 
				  <th>วันที่สัมผัสโรค</th>
				  <td>
				  	<input type="text" name="startdate" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$_GET['startdate'] ?>" /> ถึง		  
				 	<input type="text" name="enddate" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$_GET['enddate']; ?>" /> </td>		
				  <th>วันที่บันทึกรายการ </th>
				 <td><input type="text" name="report_startdate" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$_GET['report_startdate'] ?>" /> ถึง
				  <input type="text" name="report_enddate" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$_GET['report_enddate']; ?>" /> </td>				  
			  
			
			</tr>			
			<tr>
				  <th>ประเภทการปิดเคส</th>
				  <td colspan="3">		
						<ul class="list" >
							<li><input type="checkbox" name="total_vaccine[]" value="1"<?php if(@$_GET['total_vaccine']){if(in_array('1',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								 	<span class="syringe1 syringe" title="1 เข็ม"> </span> ฉีด 1 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="2"<?php if(@$_GET['total_vaccine']){if(in_array('2',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
							 		<span class="syringe2 syringe" title="2 เข็ม"> </span> ฉีด 2 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="3"<?php if(@$_GET['total_vaccine']){if(in_array('3',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
									 <span class="syringe3  syringe" title="3 เข็ม"></span> ฉีด 3 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="4"<?php if(@$_GET['total_vaccine']){if(in_array('4',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
									 <span class="syringe4 syringe" title="4 เข็ม"></span> ฉีด 4 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="5"<?php if(@$_GET['total_vaccine']){if(in_array('5',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								 	<span class="syringe5  syringe" title="5 เข็ม"> </span> ฉีด 5 เข็ม</li>
						</ul>							
				</td>						
			</tr>				
	  </table>
<div class="btn_inline">
	<ul><li><button class="btn_submit cencel" name="btn_submit" type="submit" value="btn_submit"></button></li></ul></div></div>
<div id="boxAdd"><button class="btn_add" type="submit" name="btn_add"></button></div>
</form>
<?php if(empty($result) && !empty($_GET)): ?>
<div class="alert alert-error" style="width:50%;margin:3% auto;text-align: center;font-weight: bold;">ไม่พบรายการที่ต้องการค้นหา </div>	
<?php endif; ?>
 <table class="tb_search_Rabies1" >			  			                  	
			<?php
			if(!empty($result)): ?>
	          <tr> 
	            <th>ลำดับ </th>
	            <th>รหัสโรงพยาบาล/HN</th>
	            <th>บัตรประชาชน/เลขที่ passport</th>
	            <th>ชื่อ-นามสกุล</th>
	            <th>โรงพยาบาล</th>
	            <th>วันที่สัมผัสโรค</th>
	            <th>จำนวนวัคซีน(เข็ม)</th>
	            <th>การกระทำ</th>
	          </tr> 
			<? $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;
			 foreach($result as $key =>$rec): ?>
              <tr> 
                <td align="center"><?php echo $i++;?></td>
                <td><?php echo $rec['hospitalcode'].'/'.$rec['hn'].'-'.$rec['hn_no'];?></td>
                <td><?php echo $rec['idcard'] ?></td>
				<td><?php echo $rec['firstname'].' '.$rec['surname'];?></td>
				<td><?php echo $rec['hospital_name']?></td>
				<td><?php echo cld_my2date($rec['datetouch'])?></td>
                <td align="center"><p class="syringe<?php echo $rec['total_vaccine'] ?> syringe" title="<?php echo $rec['total_vaccine'] ?> เข็ม"></p></td>
            	<td><a title="ดู" href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'] ?>/<?php echo $rec['in_out'] ?>/view" class="btn_view vtip" target="_blank"></a> 			

				<?php if($this->session->userdata('R36_LEVEL')=='00' || ($this->session->userdata('R36_LEVEL')=='02' && ($this->session->userdata('R36_PROVINCE')==$rec['hospitalprovince']))){?>
					<a title="แก้ไข" href="inform/form/<?php echo $rec['id']?>/<?php echo $rec['historyid'] ?>/<?php echo $rec['in_out']; ?>"  class="btn_edit vtip" target="_blank" ></a>
					<input type="hidden" name="information_id" value="<?php echo $rec['id'] ?>" /><input type="hidden" name="historyid" value="<?php echo $rec['historyid'] ?>"/>
					<a title="ลบ"   href="javascript:void(0)" class="btn_delete vtip"></a>	
				 <?  }else if($rec['closecase']=="1" || $rec['closecase']=="" || $rec['closecase']=="0"){  
				 		if(($this->session->userdata('R36_LEVEL')=='05' || $this->session->userdata('R36_LEVEL')=='03')){ ?>											
							<a  title="แก้ไข"  href="inform/form/<?php echo $rec['id']?>/<?php echo $rec['historyid'] ?>/<?php echo $in_out; ?>" class="btn_edit vtip" target="_blank"></a>								
				 <?  } ?>
					<a title="เพิ่มจำนวนเข็ม" href="inform/form/<?php echo $rec['id']?>/<?php echo $rec['historyid'] ?>/<?php echo $rec['in_out']; ?>/vaccine"  class="btn_syring vtip"  target="_blank"></a>
				 <?php } ?>

				</td>
              </tr>            
			  <?php endforeach; ?>
			 <?php endif; ?>			    
</table>	
<?php echo (isset($pagination))? $pagination:''; ?>
<div id="loading" style="text-align:center;width:100%;height:20px;"><img src="media/images/loading2.gif" width="98px" height="20px"></div>

<div style="display:none;">
<div id="closecase" style="text-align: center;">
	<div class="alert alert-warning"><span class="label label-warning">ไม่สามารถเพิ่มข้อมูลได้</span> กรุณาปิดเคสที่อายุ มากกว่า 90 วัน จึงสามารถเพิ่มรายการได้</div>
	<a  href="inform/closecase" target="_blank" class="btn btn-primary"  name="btn_view" id="btn_view">คลิกดูรายการ</a>			
</div>
</div>
<div style="display:none;"><div id="closecase_person" style="text-align: center;">
	<div class="alert alert-warning"><span class="label label-warning">มีเคสนี้อยู่แล้วในระบบ</span> คุณต้องปิดเคสนี้ก่อนจึงสามารถเพิ่มครั้งที่สัผมัสโรคได้</div>
	<a  href="inform/closecase_person/false/" target="_blank" class="btn btn-primary"  name="btn_view" id="btn_view1">คลิกดูรายการ</a>	
</div></div>
<div style="display:none;"><div id="load" style="padding-top:20%;padding-left:40%"><img src="media/images/loadingmove.gif" width="78px" height="20px"></div></div>


